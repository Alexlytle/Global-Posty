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

            

                         
                        <form action="{{ route('update_location') }}" method="post">@csrf
                            
                            <div class="card">
                                <div class="card-header text-white" style="background-color: #a7a7a7">Update Location</div>
                                <div class="card-body">
                      
                            @foreach ($errors->all() as $errorMessage)
                                <li>{{ $errorMessage }}</li>
                            @endforeach
                      
                                    <div class="d-flex justify-content-center flex-column align-items-center">
                                        <h4>Current Location: </h4>
                                        <p>Country: {{$user->country}}</p>
                                        <p>City: {{$user->placename}}</p>
                                        <p>State: {{$user->state}}</p>
                                    </div>
                              
                                    <Country></Country>
                                
                                    <div class="form-group"  style="text-align: center">
                                        <button class="btn btn-primary" type="submit" >Update Location</button>
                                    </div>
                                </div>
                            </div>
                        </form>

                      
                        </div>
                    </div>
                  
                </div>
  </div>
 
  
@endsection
