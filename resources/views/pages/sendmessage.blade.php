@extends('layouts.app')

@section('content')

  <div class="container">
      <div class="row d-flex justify-content-center">
          <div class="col-8 ">
                <div class="card-deck mb-3 text-center">
                    <div class="card mb-4 shadow-sm">
                    <div class="card-header">
                        <h4 class="my-0 font-weight-normal">Send Message to {{$user->name}}</h4>
                    </div>
                    <div class="card-body">
                        <form action="{{route('send.post')}}" method="post">
                            @csrf
                            <textarea class="form-control" name="body" cols="20" rows="5" placeholder="Type message here">
            
                            </textarea>
                            <input  type="hidden" value="{{$user->id}}" name="to_user" >
                            @error('body')
                                <div class="text-color-danger">
                                    {{ $message }}
                                </div>
                            @enderror
                            <button class="btn btn-primary mt-3" type="submit">Send It!</button>
                        </form>
                    
                        
                    </div>
                    </div>
                </div>
          </div>
      </div>

@endsection
