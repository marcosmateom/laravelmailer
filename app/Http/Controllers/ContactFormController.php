<?php

namespace App\Http\Controllers;

use App\Mail\ContactFormMail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class ContactFormController extends Controller
{
    public function create()
    {
        return view('contact.create');
    }

    public function store()
    {
        $data = request()->validate([
            'name' => 'required',
            'email' => 'required|email',
            'message' => 'required',
        ]);
        
        //send email
        Mail::to('marroquin161390@unis.edu.gt')->send(new ContactFormMail($data));

        return redirect('contact')->with('message', 'Gracias por contactarnos');
    }
}
