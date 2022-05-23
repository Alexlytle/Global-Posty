@extends('layouts.app')

@section('content')

{{-- <div class="wrapper bg-light" style="min-height: 95vh">
    <div class="container p-4">
        <div class="row d-flex justify-content-center">
            <div class="col-8 p-4 bg-white">
               
          
            </div>
        </div>
    </div>
</div> --}}



<div class="wrapper bg-light" style="min-height: 95vh">
    <div class="container p-4">
        <div class="row d-flex justify-content-center">

            <div class="col-md-4">
                <div class="card p-4">
                    <h3>{{$user->name}}</h3>    
                    <p>Posted {{ $posts->count() }} {{ Str::plural('post', $posts->count()) }} and received {{ $user->receivedLikes->count() }} likes</p>
                    <p>Been a member for :  <span>{{ $user->created_at->diffForHumans() }}</span></p> 
                    <p>Country: {{$user->country}}</p>
                    <p>State: {{$user->state}}</p>
                    <p>City:{{$user->placename}} </p>
                    @if (auth()->user()->id !== $user->id)
                        <a href="{{route('send',$user)}}"> Message Me!</a>
                    @endif
                </div>
            </div>
            <div class="col-md-8">
                    <!-- Modal -->
                 
                @foreach ($posts as $index=>$post)
            
                            <x-post :post="$post" :index="$index" :blocked="$blocked" />

                 @endforeach
                 <div class="d-flex">
                    {!! $posts->links() !!}
                </div>
        </div>
     
        </div>
      

       
  
    </div>
</div>
 

 
@endsection
