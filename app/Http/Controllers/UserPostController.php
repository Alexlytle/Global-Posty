<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\User;
use Illuminate\Http\Request;
use App\Models\BlockUser;

class UserPostController extends Controller
{
    public function index(User $user)
    {
        $posts = $user->posts()->paginate(20);

        // return view('pages.user', [
        //     'user' => $user,
        //     'posts' => $posts
        // ]);

        // $posts = Post::latest()->paginate(20);
        $blockUsers = '';
        if(auth()->user()){
            $blockUsers = BlockUser::where('user_id',auth()->user()->id)->get();
            // dd($blockUsers);
            $blockIds = array();
    
            foreach ($blockUsers as $value) {
                array_push($blockIds,$value->block_user_id);
            }
            return view('pages.user', [
                'posts' => $posts,
                'blocked'=>$blockIds,
                'user' => $user,
            ]);
        }
        return view('pages.user', [
            'posts' => $posts,
            'user' => $user,
        ]);
    }
}
