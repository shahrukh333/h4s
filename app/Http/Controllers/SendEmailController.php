<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Mail\SendMail;

class SendEmailController extends Controller
{
    /**
     * this method sends emails
     */
    public function sendEmail($data)
    {
        Mail::to($data['to'])->send(new SendMail($data));
    }
}
