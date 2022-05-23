@extends('backend.layouts.master')
@section('content')
    <div class="main-panel">
        <div class="content-wrapper">
            @include('backend.inc.message')
            <h4>Manage Blocked Users</h4>
            <div class="row justify-content-center">


                <div class="col-lg-12 grid-margin stretch-card">
                    <div class="card">
                        <div class="card-body">
                            


                            <div class="table-responsive">
                                <table class="table">
                                    <thead>
                                        <tr>
                                     
                                            <th>User</th>
                                            <th>Blocked</th>
                                            <th>Time</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse($blockedUsers as $user)
                                            <tr>
                                                <td>{{ $user->userInfo($user->user_id)->name }}</td>
                                    
                                                <td>{{ $user->userInfo($user->block_user_id)->name }}</td>
                                       
                                                <td>{{ $user->userInfo($user->block_user_id)->created_at->diffForHumans() }}</td>
                                            </tr>
                                        @empty
                                            <td>No block users to display</td>
                                        @endforelse



                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>


        @endsection
