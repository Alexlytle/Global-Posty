<div>
    {{-- Close your eyes. Count to one. That is how long forever feels. --}}
 @auth
     
    <div class="wrapper bg-light" style="min-height: 95vh">
        <div class="container">
            <div class="row d-flex justify-content-center">
                <div class="col-8 p-4 ">
                    @if (session('status'))
                    <div class="alert alert-success">
                        {{ session('status') }}
                    </div>
                @endif
    
             
                <form wire:submit.prevent="submit(Object.fromEntries(new FormData($event.target)))" class="mb-4 bg-white p-4 border">
                    @csrf
                    <div class="mb-4">
                        <label for="body" >Body</label>

                        <textarea  id="body" name="body" wire:model="body" class="form-control @error('body') border-danger @enderror" placeholder="Post something!"></textarea>
                        @error('body')
                            <div class="text-danger">
                                {{ $message }}
                            </div>
                        @enderror
                       
                       
                    </div>
    
                    <div>
                        <button type="submit" class="btn btn-primary">Post</button>
                    </div>
                </form>
        
            
                    
                </div>
<div class="col-8">
                        <!-- Modal -->
                     
    @foreach ($posts as $index=>$post)
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
                                        <div class="modal fade" id="exampleModal{{$post->id}}" tabindex="-1" data-target="#closeModal" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                            
                                            <div class="modal-dialog">
                                                <form  wire:submit.prevent="reportPost(Object.fromEntries(new FormData($event.target)))" >
                                                    @csrf
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                            <h5 class="modal-title" id="exampleModalLabel">Report {{$post->user->name}}</h5>
                                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                            </div>
                                                            <div class="modal-body">
                                                            
                                                                    @csrf
                                                                    <input type="hidden" name="post" value="{{$post}}">
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
                                        <div class="modal fade" id="editModal{{$post->id}}" tabindex="-1" data-target="#closeModal" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                            
                                            <div class="modal-dialog">
                                                <form  wire:submit.prevent="editPost(Object.fromEntries(new FormData($event.target)))" >
                                                    @csrf
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                            <h5 class="modal-title" id="exampleModalLabel">Edit Post</h5>
                                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                            </div>
                                                            <div class="modal-body">
                                                            
                                                                    @csrf
                                                                    <input type="hidden" name="post" value="{{$post}}">
                                                                    <div class="mb-3">
                                                                        <label class="mb-2" for="message">Message</label>
                                                                        <input class="form-control" value="{{$post->body}}" type="text" name="message">
                                                                    </div>        
                                                            </div>
                                                            <div class="modal-footer">
                                                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                                                <button type="submit" class="btn btn-primary"><small>Post</small></button>
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
                                      
                                            <form  wire:submit.prevent="blockPost(Object.fromEntries(new FormData($event.target)))" >
                                                @csrf
                                                <input type="hidden" name="post" value="{{$post}}">
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
                                <a href="/location/{{$post->user->placename}}/city"class=""> {{$post->user->placename}}, </a>
                                <a href="/location/{{$post->user->state}}/state" class=""> {{$post->user->state}}</a>
                                <a href="/location/{{$post->user->country}}/country" class=""> {{$post->user->country}}</a>
                                <br>
                            
                                {{-- @dump($blocked) --}}
                        
                                <p class="pt-3"> {{$post->body}}</p>
                        
                            
                            @auth
                                        @if (!$post->likes->contains('user_id',auth()->user()->id))
                                        {{-- @if (!$post->likedBy(auth()->user())) --}}
                                            <form wire:submit.prevent="like({{$post}})" method="post" class="mr-1">
                                                @csrf
                                                <input type="hidden" name="index" value="{{$index}}">
                                                <button class="plain-button" type="submit">
                                                    Like
                                                    <i class="fa-regular fa-thumbs-up text-primary "></i>
                                                </button>
                                            </form>
                                        @else
                                            <form wire:submit.prevent="unLike({{$post}})" method="post" class="mr-1">
                                                @csrf
                                                
                                                <input type="hidden" name="index" value="{{$index}}">
                                                <button class="plain-button" type="submit">
                                                    Like
                                                    <i class="fa-solid fa-thumbs-up text-primary "></i>
                                                </button>
                                            </form>
                                        @endif
                                        @if ($post->ownedBy(auth()->user()->id))
                                                <div class="d-flex">
                                                    <form wire:submit.prevent="deletePost({{$post}})" method="post" class="mr-1">
                                                        @csrf
                                                        <button class="plain-button" type="submit">
                                                            <i class="fa-solid fa-trash-can"></i>
                                                        </button>
                                                    </form>
                                                    
                                                       
                                                        <button class="plain-button" type="submit">
                                                            <button type="button" class="button-none" data-bs-toggle="modal" data-bs-target="#editModal{{$post->id}}">
                                                                <i class="fas fa-edit"></i>
                                                            </button>
                                                         
                                                        </button>
                                                
                                                </div>
                                                


                                        @endif  
                            @endauth
                                


                                    <span>{{ $post->likes->count() }} {{ Str::plural('like', $post->likes->count()) }}</span>
                            
                            
                            </div>
                        </div>

                @endif


                     @endforeach
                     <div class="d-flex">
                        {!! $posts->links() !!}
                    </div>
              
          
            </div>
            </div>
          
    
           
      
        </div>
    </div>
     
 
</div>

 @endauth

 

 @guest
 <div class="wrapper bg-light" style="min-height: 95vh">
    <div class="container">
        <div class="row d-flex justify-content-center">
            <div class="col-8">
                @foreach ($posts as $index=>$post)

                        <div class="card mb-4" id="post{{$index}}">

                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col-8">
                                                <span class="font-weight-bold me-2">
                                                    <a href="{{ route('users.posts', $post->user->id) }}" class="font-bold">{{ $post->user->name }}</a> 
                                                </span>
                                                <span>{{ $post->created_at->diffForHumans() }}</span>
                                            
                                            </div>
                                            
                                        </div>

                                        From:
                                    <a href="/location/{{$post->user->placename}}/city"class=""> {{$post->user->placename}}, </a>
                                       <a href="/location/{{$post->user->state}}/state" class=""> {{$post->user->state}}</a>
                                       <a href="/location/{{$post->user->country}}/country" class=""> {{$post->user->country}}</a>
                                        {{-- <a href="{{route('location',$post->user->country)}}"class=""> {{$post->user->country}}</a>  --}}
                                        <br>
                                    
                                        {{-- @dump($blocked) --}}

                                        <p class="pt-3"> {{$post->body}}</p>

                                        <span>{{ $post->likes->count() }} {{ Str::plural('like', $post->likes->count()) }}</span>
                                    
                                    
                                    </div>
                        </div>



                @endforeach
                        <div class="d-flex">
                        {!! $posts->links() !!}
                        </div>
                            
                
                </div>
        </div>
    </div>
</div>
 

 @endguest

 @push('scripts')

 <script>

    //  alert()
       window.addEventListener('close-modal', event =>{
            document.querySelector('.modal-backdrop').remove()
            document.querySelector('body').classList.remove('modal-open');
            document.querySelector("[data-target='#closeModal']").remove();
            document.querySelector('body').style.overflow = 'unset'
            document.querySelector('body').style.paddingRight = '0px'
        });

 </script>
 @endpush
