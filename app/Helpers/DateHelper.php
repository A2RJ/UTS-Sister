<?php

namespace App\Helpers;

use Carbon\Carbon;

class DateHelper
{
    public static function formatTglId($date, $withDay)
    {
        $format = "DD MMMM YYYY";
        if ($withDay) {
            $format = "dddd, " . $format;
        }
        return Carbon::parse($date)->locale('id')->isoFormat($format);
    }

    public static function formatBulanTahunId($date)
    {
        $format = "MMMM YYYY";
        return Carbon::parse($date)->locale('id')->isoFormat($format);
    }

    public static function bulanToRomawi($bulan)
    {
        $romawi = [
            1 => 'I', 2 => 'II', 3 => 'III', 4 => 'IV', 5 => 'V', 6 => 'VI',
            7 => 'VII', 8 => 'VIII', 9 => 'IX', 10 => 'X', 11 => 'XI', 12 => 'XII'
        ];

        return $romawi[$bulan] ?? '';
    }
}
