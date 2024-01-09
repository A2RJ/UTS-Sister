<?php

namespace App\Http\Controllers\Verify;

use App\Helpers\DateHelper;
use App\Helpers\FileHelper;
use App\Http\Controllers\Controller;
use App\Models\Wr3\Dedication;
use App\Models\Wr3\ResearchProposal;
use Carbon\Carbon;
use Exception;

class VerifyController extends Controller
{
    public function verifyData($surat, $id)
    {
        try {
            if ($surat == "rinov") {
                $proposal = ResearchProposal::whereId($id)->firstOrFail();
                $kop = FileHelper::toBase64(public_path('kop-surat/pengabdian.png'));

                $activityStartDate = Carbon::parse($proposal->start);
                $activityEndDate = Carbon::parse($proposal->end)->addMonth(); // Tambahkan 1 bulan ke akhir tanggal

                $startMonth = DateHelper::formatBulanTahunId($activityStartDate);
                $endMonth = DateHelper::formatBulanTahunId($activityEndDate);

                $detail = '';
                if ($activityStartDate->diffInMonths($activityEndDate) == 1) {
                    $detail = "selama 1 bulan terhitung sejak $startMonth";
                } else {
                    $detail = "selama " . $activityStartDate->diffInMonths($activityEndDate) . " bulan terhitung sejak $startMonth - $endMonth";
                }

                $url = env('APP_ENV') == 'production' ? 'https://kepegawaian.uts.ac.id' : 'http://127.0.0.1:8000';

                $values = [
                    'token'        => "$url/v/rinov/$proposal->id",
                    'number'       => $proposal->letterNumber->number,
                    'month'        => DateHelper::bulanToRomawi($proposal->letterNumber->month),
                    'year'         => $proposal->letterNumber->year,
                    'title'        => $proposal->proposal_title,
                    'participants' => json_decode($proposal->participants),
                    'start'        => $startMonth,
                    'end'          => $endMonth,
                    'location'     => $proposal->location,
                    'detail'       => $detail,
                    'accepted_date' => DateHelper::formatTglId($proposal->letterNumber->accepted_date, false),
                ];
                return view('verify.rinov', compact('values', 'kop'));
            } elseif ($surat == "peng") {
                $dedication = Dedication::whereId($id)->firstOrFail();
                $kop = FileHelper::toBase64(public_path('kop-surat/pengabdian.png'));
                $url = env('APP_ENV') == 'production' ? 'https://kepegawaian.uts.ac.id' : 'http://127.0.0.1:8000';

                $start = DateHelper::formatTglId($dedication->start_date, true);
                $end = DateHelper::formatTglId($dedication->end_date, true);
                $date = $end ? "$start sampai $end" : $start;

                $values = [
                    'token'        => "$url/v/peng/$dedication->id",
                    'number'     => $dedication->letterNumber->number,
                    'month'      => $dedication->letterNumber->month,
                    'year'       => $dedication->letterNumber->year,
                    'activity'   => $dedication->activity,
                    'participants'   => json_decode($dedication->participants),
                    'as'         => $dedication->as,
                    'theme'      => $dedication->theme,
                    'date'       => $date,
                    'location'   => $dedication->location,
                    'updated_at' => DateHelper::formatTglId($dedication->letterNumber->updated_at, false),
                    'accepted_date' => DateHelper::formatTglId($dedication->letterNumber->accepted_date, false),
                ];

                return view('verify.pengabdian', compact('kop', 'values'));
            }
        } catch (Exception $e) {
            throw $e;
            return "Invalid data";
        }
    }
}
