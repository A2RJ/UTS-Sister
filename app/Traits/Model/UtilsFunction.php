<?php

namespace App\Traits\Model;

use App\Helpers\DateHelper;
use Carbon\Carbon;
use Carbon\CarbonInterval;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\DB;
use Log;
use Rap2hpoutre\FastExcel\FastExcel;
use Symfony\Component\HttpFoundation\StreamedResponse;

trait UtilsFunction
{
    // bisa menerapkan query lain seperti where namun perhatikan AND, OR dalam query
    public function scopeSearch(Builder $query, ?string $keyword, array $columns = [], array $relations = [])
    {
        return $query->when($keyword, function ($query) use ($keyword, $columns, $relations) {
            $query->where(function ($query) use ($columns, $keyword) {
                foreach ($columns as $column) {
                    $query->orWhere($column, 'LIKE', '%' . $keyword . '%');
                }
            });

            foreach ($relations as $relation => $callback) {
                $query->orWhereHas($relation, $callback);
            }

            return $query;
        });
    }

    public function scopeSearchManual(Builder $query, ?string $keyword)
    {
        return $query->when($keyword, function ($query, $keyword) {
            return $query
                ->whereHas('humanResource', function ($query) use ($keyword) {
                    $query->where('sdm_name', 'LIKE', '%' . $keyword . '%');
                })
                ->orWhere('proposal_title', 'LIKE', '%' . $keyword . '%')
                ->orWhere('grant_scheme', 'LIKE', "%$keyword%")
                ->orWhere('target_outcomes', 'LIKE', "%$keyword%")
                ->orWhere('application_status', 'LIKE', "%$keyword%")
                ->orWhere('publication_title', 'LIKE', "%$keyword%")
                ->orWhere('author_status', 'LIKE', "%$keyword%")
                ->orWhere('journal_name', 'LIKE', "%$keyword%");
        });
    }

    // return OffCampusActivity::select('sdm_id', 'title as judul')->export(['sdm_id', 'judul']);
    public function scopeExport($query, ?array $columns = null): StreamedResponse
    {
        if ($columns === null) {
            $data = $query->get();
        } else {
            $data = $query->get($columns);
        }

        return (new FastExcel($data))
            ->download($this->getTable() . '.xlsx');
    }

    public function scopeWorkHours($query)
    {
        return $query->addSelect(
            DB::raw(
                'TIME_FORMAT(
                        GREATEST(0, SEC_TO_TIME(SUM(
                            CASE  
                                WHEN sdm_type = "Tenaga Kependidikan" THEN
                                    TIMESTAMPDIFF(
                                        SECOND, 
                                        GREATEST(check_in_time, DATE_ADD(DATE(check_in_time), INTERVAL 9 HOUR)),
                                        LEAST(check_out_time, DATE_ADD(DATE(check_out_time), INTERVAL 16 HOUR))
                                    )
                                WHEN sdm_type = "Dosen" THEN
                                    TIMESTAMPDIFF(
                                        SECOND, 
                                        GREATEST(check_in_time, DATE_ADD(DATE(check_in_time), INTERVAL 7 HOUR)),
                                        LEAST(check_out_time, DATE_ADD(DATE(check_out_time), INTERVAL 19 HOUR))
                                    )
                                WHEN sdm_type = "Dosen DT" THEN
                                    TIMESTAMPDIFF(
                                        SECOND, 
                                        GREATEST(check_in_time, DATE_ADD(DATE(check_in_time), INTERVAL 7 HOUR)),
                                        LEAST(check_out_time, DATE_ADD(DATE(check_out_time), INTERVAL 19 HOUR))
                                    ) 
                                ELSE 0
                            END
                        ))), "%H:%i:%s"
                    ) as effective_hours'
            ),
            DB::raw('TIME_FORMAT(SUM(0 + 0), "%H:%i:%s") as ineffective_hours')
        )
            ->whereColumn('check_out_time', '>', 'check_in_time')
            ->where('permission', 1);
    }

    public function checkInDateFormat()
    {
        if ($this->check_in_date) {
            return DateHelper::formatTglId($this->check_in_date, false);
        }
        return;
    }

    public function compareWorkHours($start, $end, $role, $workhour)
    {
        $startDate = false;
        $endDate = false;

        if ($start || $end) {
            $startDate = Carbon::parse($start);
            $endDate = Carbon::parse($end)->addDay();
        }
        if ($workhour->check_in_date || $workhour->check_out_date) {
            $startDate = Carbon::parse($workhour->check_in_date);
            $endDate = Carbon::parse($workhour->check_out_date)->addDay();
        }

        if (!$startDate || !$endDate) {
            return [
                'targetWorkHours' => 'Pilih range tanggal',
                'workhour' => 'Pilih range tanggal',
                'over' => 'Pilih range tanggal',
                'less' => 'Pilih range tanggal',
                'status' => 'Pilih range tanggal'
            ];
        }

        $totalWorkingDays = $startDate->diffInDaysFiltered(function ($date) {
            return !$date->isWeekend();
        }, $endDate);

        $totalPenalty = 0;
        switch ($role) {
            case 'Dosen':
                $dailyHours = 3.6;
                $penalty = 83.33; // 5k
                break;
            case 'Dosen DT':
                $dailyHours = 6;
                $penalty = 83.33; // 5k
                break;
            case 'Tenaga Kependidikan':
                $dailyHours = 7;
                $penalty = 83.33; // 5k
                break;
            default:
                $dailyHours = 0;
                $penalty = 0; // 5k
                break;
        }

        $totalWorkSeconds = ($dailyHours * 3600) * $totalWorkingDays;

        $workHours = floor($totalWorkSeconds / 3600);
        $remainingSeconds = $totalWorkSeconds % 3600;
        $workMinutes = floor($remainingSeconds / 60);
        $workSeconds = $remainingSeconds % 60;

        $formattedWorkHours = sprintf("%02d:%02d:%02d", $workHours, $workMinutes, $workSeconds);

        $workTimeParts = explode(':', $formattedWorkHours);
        $targetHours = (int) $workTimeParts[0];
        $targetMinutes = (int) $workTimeParts[1];
        $targetSeconds = (int) $workTimeParts[2];

        $targetWorkTime = [
            'hours' => $targetHours,
            'minutes' => $targetMinutes,
            'seconds' => $targetSeconds
        ];

        $effectiveTimeParts = explode(':', $workhour->effective_hours);
        $effectiveHours = (int) $effectiveTimeParts[0];
        $effectiveMinutes = (int) $effectiveTimeParts[1];
        $effectiveSeconds = (int) $effectiveTimeParts[2];

        $effectiveWorkTime = [
            'hours' => $effectiveHours,
            'minutes' => $effectiveMinutes,
            'seconds' => $effectiveSeconds
        ];

        $hoursDifference = $targetWorkTime['hours'] - $effectiveWorkTime['hours'];
        $minutesDifference = $targetWorkTime['minutes'] - $effectiveWorkTime['minutes'];
        $secondsDifference = $targetWorkTime['seconds'] - $effectiveWorkTime['seconds'];

        // Handle negative differences
        if ($secondsDifference < 0) {
            $minutesDifference--;
            $secondsDifference += 60;
        }
        if ($minutesDifference < 0) {
            $hoursDifference--;
            $minutesDifference += 60;
        }

        $status = '';

        if ($hoursDifference >= 0 && $minutesDifference >= 0 && $secondsDifference >= 0) {
            $status = "Dosen telah mencapai atau melebihi target bekerja dalam range waktu.";
        } else {
            $status = "Dosen tidak mencukupi jam kerja. Selisih antara target bekerja dan jam kerja dosen adalah $hoursDifference jam, $minutesDifference menit, $secondsDifference detik.";
        }

        $over = '';
        $less = '';

        if ($hoursDifference < 0 || $minutesDifference < 0 || $secondsDifference < 0) {
            $overHours = abs($hoursDifference);
            $overMinutes = abs($minutesDifference);
            $overSeconds = abs($secondsDifference);
            $over = sprintf("%02d:%02d:%02d", $overHours, $overMinutes, $overSeconds);
        } elseif ($hoursDifference > 0 || $minutesDifference > 0 || $secondsDifference > 0) {
            $lessHours = abs($hoursDifference);
            $lessMinutes = abs($minutesDifference);
            $lessSeconds = abs($secondsDifference);
            $less = sprintf("%02d:%02d:%02d", $lessHours, $lessMinutes, $lessSeconds);
            $penaltyHour = ($lessHours * 60) * $penalty;
            $penaltyMinute = $lessMinutes * $penalty;
            // Log::info($less);
            // Log::info($penaltyHour + $penaltyMinute);
            $totalPenalty = $penaltyHour + $penaltyMinute;
        }

        return [
            'targetWorkHours' => $formattedWorkHours,
            'workhour' => $workhour->effective_hours,
            'over' => $over,
            'less' => $less,
            'penalty' => $totalPenalty,
            'status' => $status
        ];
    }
}
