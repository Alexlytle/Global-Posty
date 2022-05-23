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
                        <div class="row">
                            <div class="col-md-4">
                                <div class="box box-1">
                                    <a href="">
                                        User Information
                                    </a>
                                   
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class=" box box-2">
                                    <a href="">
                                        Change Password
                                    </a>
                                    
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="box box-3">
                                    <a href="">
                                        Blocked Users 
                                    </a>                                                                                
                             </div>
                            </div>
                            <div class="col-md-4">
                                <div class="box box-4">
                                    <a href="">
                                        Deactivate Account
                                    </a>
                              
                                </div>
                            </div>
                          
                        </div>
                </div>
            </div>
          
        </div>

</div>
  
 
  
@endsection
