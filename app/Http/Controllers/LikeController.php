<?php

namespace App\Http\Controllers;

use App\Models\Like;
use App\Models\Post;
use Illuminate\Http\Request;
use App\Http\Requests\StoreLikeRequest;
use App\Http\Requests\UpdateLikeRequest;


class LikeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreLikeRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Post $post,Request $request)
    {
    
        $post->likes()->create([
            'user_id' => $request->user()->id,
        ]);

        return redirect(url()->previous().'#post'.$request->index);
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Like  $like
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, Post $post)
    {
        $request->user()->likes()->where('post_id', $post->id)->delete();

        return redirect(url()->previous().'#post'.$request->index);
    }
}
