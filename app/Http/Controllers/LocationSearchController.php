<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\BlockUser;
use Illuminate\Http\Request;

class LocationSearchController extends Controller
{
    public function getPlaceName($placename,$type)
    {



      
        $users = User::where('placename',$placename)->get();
        // dd($users);
        $blockUsers = '';
        if(auth()->user()){
            $blockUsers = BlockUser::where('user_id',auth()->user()->id)->get();
           
            $blockIds = array();
    
            foreach ($blockUsers as $value) {
                array_push($blockIds,$value->block_user_id);
            }
        
            // dd($blockIds);

            return view('posts.search', [
                'users' => $users,
                'blocked'=>$blockIds,
                'location'=>$placename,
                'locationType'=>$type
            ]);
        }else{
            return view('posts.search', [
                'users' => $users,
                // 'blocked'=>$blockIds,
                'location'=>$placename,
                'locationType'=>$type
            ]);
            // return view('posts.search');
        }
        // return view('posts.search', [
        //         'users' => $users,
        //         'location'=>$placename,
        //         'locationType'=>'city'
        //     ]);


    }
    // public function getState($state)
    // {
    //     // dd('hello');
    //     $users = User::where('state',$state)->get();

    //     $blockUsers = '';
    //     if(auth()->user()){
    //         $blockUsers = BlockUser::where('user_id',auth()->user()->id)->get();
    //         $blockIds = array();
    
    //         foreach ($blockUsers as $value) {
    //             array_push($blockIds,$value->block_user_id);
    //         }
        
    //         return view('posts.search', [
    //             'users' => $users,
    //             'blocked'=>$blockIds,
    //             'location'=>$state,
    //             'locationType'=>'state'
    //         ]);
    //     }
    // }

    // public function getCountry($country)
    // {
    //     // dd('hello');
    //     $users = User::where('country',$country)->get();
    //     $blockUsers = '';
    //     if(auth()->user()){
    //         $blockUsers = BlockUser::where('user_id',auth()->user()->id)->get();
    //         $blockIds = array();
    
    //         foreach ($blockUsers as $value) {
    //             array_push($blockIds,$value->block_user_id);
    //         }
        
    //         return view('posts.search', [
    //             'users' => $users,
    //             'blocked'=>$blockIds,
    //             'location'=>$country,
    //             'locationType'=>'country'
    //         ]);
    //     }
    // }
}
