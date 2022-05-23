@extends('layouts.app')

@section('content')
<section class="jumbotron text-center">
    <div class="container">
      <h1>Global Postyss </h1>
      <p class="lead text-muted">
          A simple easy social media to connect with people from your Country, State, and City. 
      </p>
      <p>
        <a href="{{route('register')}}" class="btn btn-primary my-2" >Sign Up today</a>

      </p>
    </div>
  </section>
  <div class="container">
    <div class="row mb-3 text-center">
      <div class="card mb-4 shadow-sm">
        <div class="card-header">
          <h4 class="my-0 font-weight-normal">Login</h4>
        </div>
        <div class="card-body">
          <form action="{{ route('login') }}" method="post">@csrf


            <div class="form-group row">
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
            <div class="form-group row">
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
            <div class="form-group row">

                <div class="col-md-6 offset-md-4">
                    <div class="form-check">
                        <input type="checkbox" class="form-check-input" name="remember" id="remember"
                            {{ old('remember') ? 'checked' : '' }}>
                        <label class="form-check-label" for="label">Remember me</label>
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

      <div class="card mb-4 shadow-sm">
        <div class="card-header">
          <h4 class="my-0 font-weight-normal">How it works</h4>
        </div> 
        <div class="card-body">
          
          <ul class="list-unstyled mt-3 mb-4">
            <li>Submit a post get likes</li>
            <li>Filter subscribers by Country, State and cities</li>
            <li>Connect with Users</li>
          </ul>
          <a href="{{route('register')}}" class="btn btn-lg btn-block btn-primary">Register</a>
        </div>
      </div>
    </div>
@endsection
