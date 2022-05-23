@extends('layouts.app')

@section('content')

  <div class="container">
    <div class="card-deck mb-3 text-center">
      <div class="card mb-4 shadow-sm">
        <div class="card-header">
          <h4 class="my-0 font-weight-normal">Messenger</h4>
        </div>
        <div class="card-body">
      
          <Chatapp :user="{{auth()->user()}}"></Chatapp>
            
        </div>
      </div>

  
    </div>
@endsection
