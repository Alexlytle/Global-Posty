@extends('layouts.app')
@section('content')
<div class="wrapper bg-light pt-2" style="min-height: 87vh">
    <div class="container">
        <div class="row justify-content-center mt-5">
            <div class="col-md-8">
                <div class="card">
                    <div class="text-center mt-2">
                        <h4>Register</h4>
                    </div>
                    <div class="card-body">
                        @if ($errors->any())
                        <div class="alert alert-danger">
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
    
                            </button>
                            @foreach ($errors->all() as $errorMessage)
                                <li>{{ $errorMessage }}</li>
                            @endforeach
                        </div>
                    @endif
                        <form action="{{ route('register') }}" method="post" style="width: 100%">@csrf
                            <div class="row mb-3">
                                <label for="name" class="col-md-4 col-form-label text-end">
                                    Display Name
                                </label>
                                <div class="col-md-6">
                                    <input placeholder="Display Name" type="text" name="name" class="form-control @error('name') is-invalid @enderror">
                                    @error('name')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>
                                                {{ $message }}
                                            </strong>

                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row mb-3">
                                <label for="email" class="col-md-4 col-form-label text-end">
                                    Email
                                </label>
                                <div class="col-md-6">
                                    <input placeholder="Email" type="email" name="email"
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
                            <Country></Country>
                     
                            
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
                            <div class="form-group row mb-3">
                                <label for="password_confirmation" class="col-md-4 col-form-label text-end">
                                    Confirm password
                                </label>
                                <div class="col-md-6">
                                    <input type="password" name="password_confirmation"
                                        class="form-control @error('password_confirmation') is-invalid @enderror">
                                    @error('password_confirmation')

                                    @enderror
                                </div>
                            </div>
                            <div class="form-group row mb-0">

                                <div class="col-md-6 offset-md-4">
                                    <button type="submit" class="btn btn-primary" style="width: 100%;">Register</button>
                                
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
