<?php

namespace App\Http\Controllers\Filament\Wr3;

use App\Helpers\DateHelper;
use App\Helpers\FileHelper;
use App\Http\Controllers\Controller;
use App\Models\Wr3\Dedication;
use App\Models\Wr3\ResearchProposal;
use Carbon\Carbon;
use Illuminate\Http\Request;

class LetterController extends Controller
{
    public function generateProposal(ResearchProposal $researchProposal)
    {
        $researchProposal->load(['participant', 'participant.humanResource:id,sdm_name,nidn']);
        $proposal = $researchProposal;
        $kop = FileHelper::toBase64(public_path('kop-surat/pengabdian.png'));

        $activityStartDate = Carbon::parse($proposal->start);
        $activityEndDate = '';
        if (DateHelper::isDateString($proposal->end)) {
            $activityEndDate = Carbon::parse($proposal->end)->addMonths(1);
        } else {
            $parts = explode(" ", $proposal->end);

            // Konversi bulan ke angka menggunakan switch
            $bulan_angka = 0;
            switch (strtolower($parts[1])) {
                case "januari":
                    $bulan_angka = 1;
                    break;
                case "februari":
                    $bulan_angka = 2;
                    break;
                case "maret":
                    $bulan_angka = 3;
                    break;
                case "april":
                    $bulan_angka = 4;
                    break;
                case "mei":
                    $bulan_angka = 5;
                    break;
                case "juni":
                    $bulan_angka = 6;
                    break;
                case "juli":
                    $bulan_angka = 7;
                    break;
                case "agustus":
                    $bulan_angka = 8;
                    break;
                case "september":
                    $bulan_angka = 9;
                    break;
                case "oktober":
                    $bulan_angka = 10;
                    break;
                case "november":
                    $bulan_angka = 11;
                    break;
                case "desember":
                    $bulan_angka = 12;
                    break;
            }

            // Format tanggal dalam format "YYYY-MM"
            $tanggal_format = $parts[2] . "-" . str_pad($bulan_angka, 2, "0", STR_PAD_LEFT);

            // Menampilkan hasil

            $activityEndDate = Carbon::parse($tanggal_format)->addMonths(1);
        }

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
            'token' => "$url/v/rinov/$proposal->id",
            'number' => $proposal->letterNumber->number,
            'month' => DateHelper::bulanToRomawi($proposal->letterNumber->month),
            'year' => $proposal->letterNumber->year,
            'title' => $proposal->proposal_title,
            'participants' => $researchProposal->participant,
            'start' => $startMonth,
            'end' => $endMonth,
            'location' => $proposal->location,
            'detail' => $detail,
            'accepted_date' => DateHelper::formatTglId($proposal->letterNumber->accepted_date, false),
        ];

        return view('filament.resources.wr3.research-proposal-resource.pages.print-letter', compact('kop', 'values'));
    }

    public function generateDedication(Dedication $dedication)
    {
        $kop = FileHelper::toBase64(public_path('kop-surat/pengabdian.png'));
        $url = env('APP_ENV') == 'production' ? 'https://kepegawaian.uts.ac.id' : 'http://127.0.0.1:8000';

        $start = DateHelper::formatTglId($dedication->start_date, true);
        $end = DateHelper::formatTglId($dedication->end_date, true);
        $date = $end ? "$start sampai $end" : $start;


        $values = [
            'token' => "$url/v/peng/$dedication->id",
            'number' => $dedication->letterNumber->number,
            'month' => $dedication->letterNumber->month,
            'year' => $dedication->letterNumber->year,
            'activity' => $dedication->activity,
            'participants' => $dedication->participant,
            'as' => $dedication->as,
            'theme' => $dedication->theme,
            'date' => $date,
            'location' => $dedication->location,
            'updated_at' => DateHelper::formatTglId($dedication->letterNumber->updated_at, false),
            'accepted_date' => DateHelper::formatTglId($dedication->letterNumber->accepted_date, false),
        ];

        return view('filament.lecture.resources.wr3.dedication-resource.pages.print-letter', compact('kop', 'values'));
    }
}
