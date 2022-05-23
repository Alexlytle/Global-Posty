@extends('backend.layouts.master')
@section('content')
    <div class="main-panel">
        <div class="content-wrapper">

            <div class="container">
                <div class="row">
                    <div class="col-md-3">
                        <div class="card" style="background-color: blue;color:#fff;">
                            <div class="card-body text-center">
                               <i class="mdi mdi-account-multiple-outline" ></i>
                               <p class="lead">Users</p>
                            {{-- <p class="lead">{{App\Models\User::count()}}</p> --}}

                            </div>
                        </div>
                    </div>
              
               

                </div>
            </div>            


                        
                 
        </div>
    </div>
@endsection
