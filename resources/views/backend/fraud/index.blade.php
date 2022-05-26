@extends('backend.layouts.master')
@section('content')
    <div class="main-panel">
        <div class="content-wrapper">
            @include('backend.inc.message')
            <h4>Reported Users</h4>
            <div class="row justify-content-center">


                <div class="col-lg-12 grid-margin stretch-card">
                    <div class="card">
                        <div class="card-body">


                            <div class="table-responsive">
                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th>User who reported</th>
                                            <th>Name</th>
                            
                                            <th>Reason</th>
                                            <th>Message</th>
                                            <th>Email of violated user</th>
                                            <th>View Users Profile</th>
                                            <th>Delete</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse($spams as $spam)
                                            <tr>
                                                <td>
                                                    {{$spam->userinfo($spam->user_id)->name}}
                                                 </td>
                                      
                                                <td>
                                                   {{$spam->userinfo($spam->post->user_id)->name}}
                                                </td>
                                              
                                                <td>
                                                    {{$spam->reason}}
                                                </td>
                                                <td>
                                                    {{$spam->message}}
                                                </td>
                                                <td>
                                                    {{$spam->userinfo($spam->post->user_id)->email}}
                                                 </td>

                                                <td>
                                                <a target="_blank" href="/users/{{$spam->post->user_id}}/posts">
                                                        <button class="btn btn-primary">
                                                            View
                                                        </button>
                                                    </a>
                                                </td>
                                            <td>
                                                    <!-- Button trigger modal -->
                                                    <button type="button" class="btn btn-danger" data-toggle="modal"
                                                        data-target="#exampleModal{{ $spam->post->user_id }}">
                                                        <i class="mdi mdi-delete"></i>
                                                    </button>

                                                    <!-- Modal -->
                                                    <div class="modal fade" id="exampleModal{{ $spam->post->user_id}}" tabindex="-1"
                                                        aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                        <div class="modal-dialog">
                                                            <form action="{{ route('spam.destroy', $spam->post->user_id) }}" method="post">
                                                                @csrf
                                                                @method('DELETE')
                                                                <div class="modal-content">
                                                                    <div class="modal-header">
                                                                        <h5 class="modal-title" id="exampleModalLabel">Delete
                                                                            confirmation</h5>
                                                                        <button type="button" class="close" data-dismiss="modal"
                                                                            aria-label="Close">
                                                                            <span aria-hidden="true">&times;</span>
                                                                        </button>
                                                                    </div>
                                                                    <div class="modal-body">
                                                                        <p> Are you sure you want to delete this item ?</p>

                                                                    </div>
                                                                    <div class="modal-footer">
                                                                        <button type="button" class="btn btn-secondary"
                                                                            data-dismiss="modal">Cancel</button>
                                                                        <button type="submit" class="btn btn-danger">Yes Delete
                                                                            it</button>
                                                                    </div>
                                                                </div>
                                                            </form>
                                                        </div>
                                                    </div>



                                                </td> 
                                          


                                            </tr>
                                        @empty
                                            <td>No  any reported ads to display</td>
                                        @endforelse
                                        <div class="d-flex">
                                            {!! $spams->links() !!}
                                        </div>


                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>

                </div>
                {{-- {{ $spams->links() }} --}}
            </div>


        @endsection
