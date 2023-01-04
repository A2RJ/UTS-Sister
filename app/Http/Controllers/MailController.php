<?php

namespace App\Http\Controllers;

use App\Mail\PresencesMail;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;

class MailController extends Controller
{
    // jika gagal auth email gunakan App passwords google untuk auth
    public function presences()
    {
        $mailData = [
            'email' => "xcz.ardiansyahputra2468@gmail.com",
            'subject' => 'test email',
            'title' => 'Mail from uts brother',
            'body' => ''
        ];

        Mail::to($mailData['email'])->send(new PresencesMail($mailData));

        dd("Email is sent successfully.");
    }
}
