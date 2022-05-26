<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\User;
use App\Models\BlockUser;
use Illuminate\Http\Request;

class AdminControllerAllUsers extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = User::whereNotIn('id',[1])->paginate(10);

        return view('backend.user.index',compact('users'));
        
    }

    public function admin()
    {
        if(auth()->user()->id === 1){
            return view('backend.admin.index');
        }else{
            $posts = Post::latest()->paginate(10);
            $blockUsers = BlockUser::where('user_id',auth()->user()->id)->get();
            // dd($blockUsers);
            $blockIds = array();
    
            foreach ($blockUsers as $value) {
                array_push($blockIds,$value->block_user_id);
            }
            return view('posts.index', [
                'posts' => $posts,
                'blocked'=>$blockIds 
            ]);
        }
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
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        return view('backend.user.edit',compact('user'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,User $user)
    {
       
        
        $request->validate([
            'name'=>'required',
            'email'=>'required'
        ]);

        
        $user->update([
            'name'=>$request->name,
            'email'=>$request->email
        ]);
 

        return back()->with('message','User has been updated');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        
        $user->delete();

        return back()->with('message','User has been deleted');
    }
}
