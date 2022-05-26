<?php

namespace App\Http\Controllers;


use App\Models\BlockUser;
use App\Models\ReportPost;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\StorePostRequest;
use App\Http\Requests\UpdatePostRequest;
use App\Models\Post;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $posts = Post::latest()->paginate(10);
        $blockUsers = '';
        if(auth()->check()){
            if(auth()->user()->id !== 1){
                $blockUsers = BlockUser::where('user_id',auth()->user()->id)->get();
               
                $blockIds = array();
        
                foreach ($blockUsers as $value) {
                    array_push($blockIds,$value->block_user_id);
                }
                return view('posts.index', [
                    'posts' => $posts,
                    'blocked'=>$blockIds 
                ]);
            }else{
                 return view('backend.admin.index');
            }
           
        }else{
      
            $blockIds = null;
            
            return view('posts.index', [
                'posts' => $posts,
                'blocked'=>$blockIds 
            ]);
        }

            // return view('posts.index');

     
    }
    /*
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StorePostRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StorePostRequest $request)
    {
        $request->user()->posts()->create($request->only('body'));
        return back();
    }



    public function block(Post $post,Request $request)
    {
    
        BlockUser::create([
            'user_id' => $request->user()->id,
            'block_user_id'=>$post->user->id
        ]);
        return back();
    }

    public function report(Post $post,Request $request)
    {
     
        ReportPost::create([
            'user_id' => $request->user()->id,
            'post_id'=> $post->id,
            'email'=>$post->user->email,
            'message'=>$request->message,
            'reason'=>$request->reason
        ]); 
        return back();
    }
}
