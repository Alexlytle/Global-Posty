@extends('layouts.app')
@section('content')
<div class="wrapper bg-light pt-2" style="min-height: 87vh">
    <div class="container">
        <div class="row justify-content-center mt-5">
            <div class="col-md-8">
                <div class="card">
                    <div class="text-center mt-2">
                        <h4>Login</h4>
                        @if (session('status'))
                            <div class="alert alert-success">
                                {{ session('status') }}
                            </div>
                        @endif

                    </div>
                    <div class="card-body">
                        <form action="{{ route('login') }}" method="post">@csrf


                            <div class="row mb-3">
                                <label for="email" class="col-md-4 col-form-label text-end">
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
                                <label for="password" class="col-md-4 col-form-label text-end">
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
                                    <button type="submit" class="btn btn-primary" style="width:100%;">Login</button>

                                   
                                 
                                
                                </div>
                           
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
