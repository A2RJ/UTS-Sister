<?php

namespace App\Helpers;

use Carbon\Carbon;

class DateHelper
{
    public static function format_tgl_id($date, $withDay)
    {
        $format = "DD MMMM YYYY";
        if ($withDay) {
            $format = "dddd, " . $format;
        }
        return Carbon::parse($date)->locale('id')->isoFormat($format);
    }
}
