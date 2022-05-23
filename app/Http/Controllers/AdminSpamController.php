<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\ReportPost;
use Illuminate\Http\Request;

class AdminSpamController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $spams = ReportPost::all();

        // dd($spams[0]->post);

        return view('backend.fraud.index',compact('spams'));

    }

  

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy( $user)
    {
        $user = User::find($user);
    
        $user->delete();
        return back()->with('message','User has been deleted');
    }
}
