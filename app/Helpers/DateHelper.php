<?php

namespace App\Helpers;

use Carbon\Carbon;
use Illuminate\Http\Request;

class DateHelper
{
    public static function format_tgl_id($date)
    {
        return Carbon::parse($date)->locale('id')->isoFormat('dddd, DD MMMM YYYY');
    }
}
