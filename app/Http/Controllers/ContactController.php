<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\ContactMe;
use Mail;

class ContactController extends Controller
{
    public function create(Request $request) {
        if($request->isMethod('get')) {
            $page = $request->page;
            $limit = null;

            if ($request->limit && $request->limit > 0) {
                $limit = $request->limit;
            }
            if ($limit || $page) {
                $all_messages = ContactMe::paginate($limit);
            } else {
                $all_messages = ContactMe::all();
            }
            return view('pages.contact');
        }
        if($request->isMethod('post')) {
            $this->validate($request->all(), [
                'name' => 'required',
                'email' => 'required|email',
                'message' => 'required'
            ]);
            $data = $request->only('name', 'email', 'message');
            ContactMe::create($data);
            $data['user_message'] = $data['message'];

            Mail::send('contact_email', $data, function($message) use ($request) {
                    $message->from($request->email);
                    $message->to(env('MAIL_CONTACT_US_ADDRESS'), 'Admin')->subject('contact Me');
                }
            );
            return back()->with('success', ' Votre Message à été envoyé avec succes !');
        }  
   }
}
