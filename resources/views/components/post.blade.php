@props(['post'=>$post,'index'=>$index,'blocked'=>$blocked])


@if (!in_array($post->user->id,$blocked))


<div class="card mb-4" id="post{{$index}}">
  
    <div class="card-body">
        <div class="row">
            <div class="col-8">
                <span class="font-weight-bold me-2">
                    <a href="{{ route('users.posts', $post->user->id) }}" class="font-bold">{{ $post->user->name }}</a> 
                </span>
                <span>{{ $post->created_at->diffForHumans() }}</span>
              
            </div>
            <div class="col-4 d-flex justify-content-end">
              
                        
         
                <div class="modal fade" id="exampleModal{{$post->id}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <form action="{{ route('posts.report', $post) }}" method="post" class="mr-1">
                                <div class="modal-content">
                                    <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel">Report {{$post->user->name}}</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                    
                                            @csrf
                                            <div class="mb-3">
                                                <label class="mb-2" for="message">Message</label>
                                                <input class="form-control" type="text" name="message">
                                            </div>
                                            <div class="mb-3">
                                                <label  class="mb-2" for="reason">Reason</label>
                                                <select class="form-control" name="reason" id="">
                                                    <option value="Offensive">Offensive</option>
                                                    <option value="Spam">Spam</option>
                                                    <option value="Other">Other</option>
                                                </select>
                                            </div>
                                    
                                           
                                                
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                        <button type="submit" class="btn btn-danger"><small>Report</small></button>
                                    </div>
                                </div>
                         </form>
                    </div>
                </div>

        
            @if (auth()->user()->id !== $post->user->id)
                <div class="dropdown">
                    <button class="plain-button " type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">
                        <i class="fa-solid fa-ellipsis-vertical"></i>
                    </button>
               
                    <ul class="dropdown-menu text-center" aria-labelledby="dropdownMenuButton1">
                      <li class="mb-2">
                  
                        <form action="{{ route('posts.block', $post) }}" method="post" class="mr-1">
                            @csrf
                            <button type="submit" class="btn btn-danger"><small>Block</small></button>
                                </form>
                         
                      </li>
                      <li>
                        @if (count($post->reported) !== 0)
                            <p>You have reported this add</p>
                          
                        @else
                                <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#exampleModal{{$post->id}}">
                                    <small>Report</small>  
                                </button>
                        @endif
                       
                      </li>
                    </ul>
                  </div>
                  @endif
            </div>
        </div>
    
        From:
        <a href="{{route('placename',$post->user->placename)}}"class=""> {{$post->user->placename}}, </a>
        <a href="{{route('state',$post->user->state)}}"class=""> {{$post->user->state}}</a>
        <a href="{{route('country',$post->user->country)}}"class=""> {{$post->user->country}}</a>
        <br>
     
        {{-- @dump($blocked) --}}
   
        <p class="pt-3"> {{$post->body}}</p>
 
    

    {{-- {{auth()->user()->id}} --}}
       
            @if (!$post->likes->contains('user_id',auth()->user()->id))
            {{-- @if (!$post->likedBy(auth()->user())) --}}
                <form action="{{ route('posts.likes', $post) }}" method="post" class="mr-1">
                    @csrf
                    <input type="hidden" name="index" value="{{$index}}">
                    <button class="plain-button" type="submit">
                        Like
                        <i class="fa-regular fa-thumbs-up text-primary "></i>
                    </button>
                </form>
            @else
                <form action="{{ route('posts.likes.delete', $post) }}" method="post" class="mr-1">
                    @csrf
                    @method('DELETE')
                    <input type="hidden" name="index" value="{{$index}}">
                    <button class="plain-button" type="submit">
                        Like
                        <i class="fa-solid fa-thumbs-up text-primary "></i>
                    </button>
                </form>
            @endif
            <span>{{ $post->likes->count() }} {{ Str::plural('like', $post->likes->count()) }}</span>
      
      
    </div>
</div>

@endif

