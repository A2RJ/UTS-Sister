<?php

namespace App\Traits\Utils;

use App\Models\Link;
use Exception;
use Illuminate\Support\Facades\Crypt;

trait Sharer
{
    public static function createLink($sdm_id, $meeting_id)
    {
        Link::create([
            'subject_id' => $sdm_id,
            'meeting_id' => $meeting_id,
            'link' => "$sdm_id-$meeting_id-" . uniqid()
        ]);
        return env('APP_REDIRECT') . "/verify?sharer=$sdm_id-$meeting_id-" . uniqid();
    }

    public static function verifyLink($string)
    {
        try {
            $parts = explode("-", $string);
            $sdm_id = $parts[0];
            $subject_id = $parts[1];
        } catch (Exception $th) {
            abort(500, 'Link is not valid');
        }
    }
}
