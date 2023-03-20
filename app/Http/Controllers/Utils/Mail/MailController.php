<?php

namespace App\Http\Controllers\Utils\Mail;

use App\Http\Controllers\Controller;
use App\Mail\PresencesMail;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Facades\Validator;

class MailController extends Controller
{
    // jika gagal auth email gunakan App passwords google untuk auth
    public function sendMail()
    {

        // $mailData = [
        //     'email' => "xcz.ardiansyahputra2468@gmail.com",
        //     'subject' => 'test email',
        //     'body' => 'Random'
        // ];

        // Mail::to($mailData['email'])->send(new PresencesMail($mailData));

        // dd("Email is sent successfully.");
    }
}
