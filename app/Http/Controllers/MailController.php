<?php

namespace App\Http\Controllers;

use App\Mail\FirstMail;
use Illuminate\Routing\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Mail\Mailable;
use App\Mail\NanayaMail;
class MailController extends Controller
{
    public function index()
    {
        return view ('Mail');
    }

    public function send(Request $request)
    {
        $MailData = 
        [
            'title' => $request->title,
            'content' => $request->content
        ];
        Mail::to('hieupront4560@gmail.com')->send(new FirstMail($MailData));
        return redirect()->back();
    }
}
