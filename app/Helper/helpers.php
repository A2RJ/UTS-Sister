<?php

use Carbon\Carbon;

if (!function_exists('format_tgl_id')) {
    function format_tgl_id($date)
    {
        return Carbon::parse($date)->locale('id')->isoFormat('dddd, DD MMMM YYYY');
    }
}
