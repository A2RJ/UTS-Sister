<?php

namespace App\Http\Controllers\Verify;

use App\Helpers\DateHelper;
use App\Helpers\FileHelper;
use App\Http\Controllers\Controller;
use App\Models\Wr3\ResearchProposal;
use Carbon\Carbon;
use Exception;
use Illuminate\Http\Request;

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
            }
        } catch (Exception $e) {
            throw $e;
            return "Invalid data";
        }
    }
}
