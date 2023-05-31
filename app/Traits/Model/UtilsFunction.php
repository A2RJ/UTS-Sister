<?php

namespace App\Traits\Model;

use Carbon\Carbon;
use Carbon\CarbonInterval;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\DB;
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

    // public function compareWorkHours($start, $end, $role, $workhour)
    // {
    //     $startDate = Carbon::parse($start);
    //     $endDate = Carbon::parse($end)->addDay();

    //     $totalWorkingDays = $startDate->diffInDaysFiltered(function ($date) {
    //         return !$date->isWeekend();
    //     }, $endDate);

    //     switch ($role) {
    //         case 'Dosen':
    //             $dailyHours = 3.6;
    //             break;
    //         case 'Dosen DT':
    //             $dailyHours = 6;
    //             break;
    //         case 'Tenaga Kependidikan':
    //             $dailyHours = 7;
    //             break;
    //         default:
    //             $dailyHours = 0;
    //             break;
    //     }

    //     $totalWorkSeconds = $dailyHours * 3600 * $totalWorkingDays;

    //     $workHours = floor($totalWorkSeconds / 3600);
    //     $workMinutes = floor(($totalWorkSeconds % 3600) / 60);
    //     $workSeconds = $totalWorkSeconds % 60;

    //     $formattedWorkHours = sprintf("%02d:%02d:%02d", $workHours, $workMinutes, $workSeconds);

    //     $targetWorkTime = Carbon::createFromFormat('H:i:s', $formattedWorkHours);
    //     $effectiveTime = Carbon::createFromFormat('H:i:s', $workhour);

    //     $difference = $effectiveTime->diff($targetWorkTime)->format('%H:%I:%S');

    //     $status = '';

    //     if ($effectiveTime->greaterThanOrEqualTo($targetWorkTime)) {
    //         $status = "Dosen telah mencapai atau melebihi target bekerja dalam range waktu.";
    //     } else {
    //         $status = "Dosen tidak mencukupi jam kerja. Selisih antara target bekerja dan jam kerja dosen adalah $difference.";
    //     }

    //     return [
    //         'targetWorkHours' => $formattedWorkHours,
    //         'workhour' => $workhour,
    //         'status' => $status
    //     ];
    // }

    public function compareWorkHours($start, $end, $role, $workhour)
    {
        $startDate = Carbon::parse($start);
        $endDate = Carbon::parse($end)->addDay();

        $totalWorkingDays = $startDate->diffInDaysFiltered(function ($date) {
            return !$date->isWeekend();
        }, $endDate);

        switch ($role) {
            case 'Dosen':
                $dailyHours = 3.6;
                break;
            case 'Dosen DT':
                $dailyHours = 6;
                break;
            case 'Tenaga Kependidikan':
                $dailyHours = 7;
                break;
            default:
                $dailyHours = 0;
                break;
        }

        $totalWorkSeconds = $dailyHours * 3600 * $totalWorkingDays;

        $workHours = floor($totalWorkSeconds / 3600);
        $workMinutes = floor(($totalWorkSeconds % 3600) / 60);
        $workSeconds = $totalWorkSeconds % 60;

        $formattedWorkHours = sprintf("%02d:%02d:%02d", $workHours, $workMinutes, $workSeconds);

        $targetWorkTime = Carbon::createFromFormat('H:i:s', $formattedWorkHours);
        $effectiveTime = Carbon::createFromFormat('H:i:s', $workhour);

        $difference = $effectiveTime->diff($targetWorkTime);

        $hoursDifference = $difference->h;
        $minutesDifference = $difference->i;
        $secondsDifference = $difference->s;

        $status = '';

        if ($effectiveTime->greaterThanOrEqualTo($targetWorkTime)) {
            $status = "Dosen telah mencapai atau melebihi target bekerja dalam range waktu.";
        } else {
            $status = "Dosen tidak mencukupi jam kerja. Selisih antara target bekerja dan jam kerja dosen adalah $hoursDifference jam, $minutesDifference menit, $secondsDifference detik.";
        }

        $lebih = '';
        $kurang = '';

        if ($effectiveTime->greaterThan($targetWorkTime)) {
            $lebih = $effectiveTime->diff($targetWorkTime)->format('%H:%I:%S');
        } elseif ($effectiveTime->lessThan($targetWorkTime)) {
            $kurang = $targetWorkTime->diff($effectiveTime)->format('%H:%I:%S');
        }

        return [
            'targetWorkHours' => $formattedWorkHours,
            'workhour' => $workhour,
            'lebih' => $lebih,
            'kurang' => $kurang,
            'status' => $status
        ];
    }
}
