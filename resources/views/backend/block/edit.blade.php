@extends('backend.layouts.master')
@section('content')
    <div class="main-panel">
        <div class="content-wrapper">
            <div class="row justify-content-center">
                <div class="col-md-10">
                    <h4>Update User</h4>
                    @include('backend.inc.message')
                    <div class="card">

                        <div class="card-body">

                        <form class="forms-sample" action="{{route('users.update',[$user])}}" method="post" enctype="multipart/form-data">@csrf
                            @method('PUT')
                                <div class="form-group">
                                    <label for="name">Name</label>
                                <input type="text" name="name" value="{{$user->name}}" class="form-control @error('name') is-invalid @enderror"
                                        placeholder="name of user">
                                    @error('name')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>
                                                {{ $message }}
                                            </strong>

                                        </span>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="name">Email</label>
                                <input type="text" name="email" value="{{$user->email}}" class="form-control @error('email') is-invalid @enderror"
                                        placeholder="user email">
                                    @error('email')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>
                                                {{ $message }}
                                            </strong>

                                        </span>
                                    @enderror
                                </div>
                        
                                <div class="form-group">
                                    <button type="submit" class="btn btn-primary">Update</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
@endsection
