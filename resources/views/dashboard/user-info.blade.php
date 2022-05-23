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
                            {{-- {{$user}} --}}

    
                            <form action="{{ route('update_user_info',auth()->user()->id) }}" method="post">@csrf
                         
            
                                <div class="card">
                                    <div class="card-header text-white" style="background-color: #a7a7a7">Change Information</div>
                                    <div class="card-body">
                                   
                                        <div class="mb-3">
                                            <label class="form-label" >Name</label>
                                            <input type="text" value="{{$user->name}}" name="name" class="form-control @error('name') is-invalid @enderror">
                                            @error('name')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>
                                                        {{ $message }}
                                                    </strong>
        
                                                </span>
                                            @enderror
            
                                  
                                        </div>
                                        <div class="mb-3">
                                            <label class="form-label">Email</label>
                                            <input type="text" value="{{$user->email}}" name="email" class="form-control @error('email') is-invalid @enderror">
                                            @error('name')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>
                                                        {{ $message }}
                                                    </strong>
        
                                                </span>
                                            @enderror
            
                                  
                                        </div>
                                    
                                        <div class="form-group">
                                            <button class="btn btn-primary"  type="submit" >Update </button>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                  
                </div>
  </div>
 
  
@endsection
