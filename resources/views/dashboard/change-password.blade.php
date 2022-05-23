@extends('layouts.app')

@section('content')

<div class="wrapper bg-light" style="min-height: 94vh">
                <div class="container pt-5">
                    <div class="row">
                        <div class="col-md-4">
                            <div class="card">
                             
                                    <x-user-dashboard-nav/>
                              </div>
                        </div>
                        <div class="col-md-8">
                            @if (session('status') === 'password-updated')
                            <div class="alert alert-success">Your password has been updated</div>
                        @endif
                        <form action="{{ route('user-password.update') }}" method="post">@csrf
                            @method('PUT')
        
                            <div class="card">
                                <div class="card-header text-white" style="background-color: #a7a7a7">Change password</div>
                                <div class="card-body">
                                    <div class="mb-3">
                                        <label class="form-label">Current pasword</label>
                                        <input type="text" name="current_password" class="form-control">
                                        @error('current_password')
                                            <div>{{ $message }}</div>
                                        @enderror
        
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label">New pasword</label>
                                        <input type="text" name="password" class="form-control">
        
                                        @error('password')
                                            <div>{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label">Confirm pasword</label>
                                        <input type="text" name="password_confirmation" class="form-control">
                                        @error('password_confirmation')
                                            <div>{{ $message }}</div>
                                        @enderror
        
                                    </div>
                                    <div class="mb-3">
                                        <button class="btn btn-primary"  type="submit" >Update password</button>
                                    </div>
                                </div>
                            </div>
                        </form>

                      
                        </div>
                    </div>
                  
                </div>
  </div>
 
  
@endsection
