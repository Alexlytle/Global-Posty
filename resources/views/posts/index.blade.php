@extends('layouts.app')

@section('content')
@guest
<section class="p-5 mb-5 bg-light rounded text-center">
    <div class="container">
      <h1>Global Posty </h1>
      <p class="lead text-muted">
          A simple, easy to use social media to connect with people from your Country, State, and City. 
      </p>
      <p>
        <a href="{{route('register')}}" class="btn btn-primary my-2" >Sign Up today</a>

      </p>
    </div>
  </section>
  <div class="container">
    <div class="row mb-3 text-center">

            <div class="col-md-6">
                <div class="card mb-4 shadow-sm">
                    <div class="card-header">
                      <h4 class="my-0 font-weight-normal">Login</h4>
                    </div>
                    <div class="card-body">
                      <form style="width:100%" action="{{ route('login') }}" method="post">@csrf
            
            
                        <div class="row mb-3">
                            <label for="email" class="col-md-4 col-form-label text-md-right">
                                Email
                            </label>
                            <div class="col-md-6">
                                <input type="email" name="email"
                                    class="form-control @error('email') is-invalid @enderror">
                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>
                                            {{ $message }}
                                        </strong>
            
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="password" class="col-md-4 col-form-label text-md-right">
                                Password
                            </label>
                            <div class="col-md-6">
                                <input type="password" name="password"
                                    class="form-control @error('password') is-invalid @enderror">
                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>
                                            {{ $message }}
                                        </strong>
            
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="row">
            
                            <div class="col-md-6 offset-md-4">
                                <div class="form-check text-start">
                                    <input type="checkbox" class="form-check-input" name="remember" id="remember"
                                        {{ old('remember') ? 'checked' : '' }}>
                                    <label class="form-check-label text-start" for="label">Remember me</label>
                                    <p><a href="{{ route('password.request') }}">Forgotten a password?</a></p>
                                </div>
                            </div>
                        </div>
                        <div class="form-group row mb-0">
            
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-lg btn-block btn-primary" style="width:100%;">Login</button>
            
                               
                             
                            
                            </div>
                       
                        </div>
                    </form>
                    </div>
                  </div>
            
            </div>

        <div class="col-md-6">
            <div class="card mb-4 shadow-sm">
                <div class="card-header">
                  <h4 class="my-0 font-weight-normal">Key Features</h4>
                </div> 
                <div class="card-body card-register">
          
                  <ul class=" mb-4">
                    <li>Submit a post for all users to see</li>
                    <li>Like and unlike users</li>
                    <li>Filter subscribers by Country, State and cities</li>
                    <li>Realtime message system</li>
                    <li>Block and unblock users</li>
                    <li>Report offensive content to administration</li>
                    <li>Live search to find users based on name, country city </li>
                  </ul>
                  <a  style="width: 55%" href="{{route('register')}}" class="btn btn-lg btn-block btn-primary">Register</a>
                </div>
         
        </div>

      </div>
    </div>
@endguest

@auth
<div class="wrapper bg-light" style="min-height: 95vh">
    <div class="container p-4">
        <div class="row d-flex justify-content-center">
            <div class="col-8 p-4 ">
                @if (session('status'))
                <div class="alert alert-success">
                    {{ session('status') }}
                </div>
            @endif
            @auth
            <form action="{{ route('store') }}" method="post" class="mb-4 bg-white p-4 border">
                @csrf
                <div class="mb-4">
                    <label for="body" >Body</label>
                    <textarea name="body" id="body" class="form-control @error('body') border-danger @enderror" placeholder="Post something!"></textarea>

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

            @endauth
        
                
            </div>
            <div class="col-8">
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
 
@endauth


@endsection
