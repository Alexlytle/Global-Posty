<?php

namespace App\Http\Livewire;

use App\Models\Post;
use Livewire\Component;
use App\Models\BlockUser;

use App\Models\ReportPost;
use Livewire\WithPagination;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;


class PostShow extends Component
{   
    
    use WithPagination;
    protected $paginationTheme = 'bootstrap';
    public $body = '';



    public function submit($formData)
    {

        $this->validate([
            'body' => 'required'
        ]);


        Post::create([
            'user_id'=>auth()->user()->id,
            'body'=> $formData['body']
        ]);
         $this->body = '';
    
        return back();
       

    }

    public function like(Post $post)
    {
        $post->likes()->create([
            'user_id' => auth()->user()->id,
        ]);
        return back();
        # code...
    }
    public function unLike(Post $post)
    {
        # code...
        auth()->user()->likes()->where('post_id', $post->id)->delete();
        return back();
    }
    public function deletePost(Post $post)
    {   
       $post->delete();
       return back();
    }

    public function editPost($request)
    {
        $post=json_decode($request['post']);

        $posts = Post::find($post->id);


        Validator::make($request, [
            'message' => 'required',
        ])->validate();
      
        $posts->update([
            'body'=>$request['message']
        ]);

        $this->dispatchBrowserEvent('close-modal');

    }

    public function reportPost($data)
    {
       $post=json_decode($data['post']);

     
        ReportPost::create([
            'user_id' => auth()->user()->id,
            'post_id'=> $post->id,
            'email'=> $post->user->email,
            'message'=> $data['message'],
            'reason'=> $data['reason']
        ]); 

        BlockUser::create([
            'user_id' => auth()->user()->id,
            'block_user_id'=>$post->user->id
        ]);
        $this->dispatchBrowserEvent('close-modal');
        // return back();
    }

    public function blockPost($request)
    {
        $post=json_decode($request['post']);
       
        BlockUser::create([
            'user_id' => auth()->user()->id,
            'block_user_id'=>$post->user->id
        ]);
    }
    public function render()
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

             
                return view('livewire.post-show', [
                    'posts' => $posts,
                    'blocked'=>$blockIds 
                ]);
            }else{
                 return view('backend.admin.index');
            }
           
        }else{
            // dd($posts);
            return view('livewire.post-show', [
                'posts' => $posts,
                'blocked'=>null 
            ]);
        }
     
    }
}
