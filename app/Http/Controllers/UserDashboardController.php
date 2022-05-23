<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\BlockUser;
use Illuminate\Http\Request;

class UserDashboardController extends Controller
{
    public function index()
    {
        
        return view('dashboard.index');
    }


    public function deactivateaccount()
    {
            
    }

    public function userInfo()
    {
        $user = auth()->user();

        return view('dashboard.user-info',compact('user'));
    }


    public function changepassword()
    {
         return view('dashboard.change-password');
    }

    public function add_location()
    {
        $user = User::find(auth()->user()->id);

        return view('dashboard.location',compact('user'));
    }

    public function blockusers()
    {

       $blockUsers = BlockUser::where('user_id',auth()->user()->id)->get();
    
        return view('dashboard.blocked-users',compact('blockUsers'));
    }
    public function delete_block($id,Request $request)
    {

       $request->user()->blocked()->where('id',$id)->delete();

       return back();

    }

    public function update_location(Request $request)
    {
        $user = User::find(auth()->user()->id);
        $request->validate([
            'country'=>'required',
            'zipcode'=>'required',
                'state'=>'required'
        ]);
        // dd($user->zipcode);
        $user->country = $request->country;
        $user->placename = $request->placename;
        $user->state = $request->state;
        $user->save();

        return back();
    }

    public function update_user_info(User $user,Request $request)
    {
        $request->validate([
            'name'=>'required',
            'email'=>'required'
        ]);

        $user->name = $request->name;
        $user->email = $request->email;
        
        $user->save();

        return back();

    }

}
