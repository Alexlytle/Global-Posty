<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Message;
use Illuminate\Http\Request;

class ChatController extends Controller
{
    public function index()
    {
        return view('pages.chat');
    }

    public function send(User $user)
    {
        
        return view('pages.sendmessage',compact('user'));
    }
    public function send_post(Request $request)
    {
        $this->validate($request, [
            'body' => 'required|max:255',
            'to_user' => 'required|max:255',
        ]);
         Message::create([
            'from' => auth()->id(),
            'to' => $request->to_user,
            'text' => $request->body
        ]);

        return redirect()->route('chat');

    }
}
