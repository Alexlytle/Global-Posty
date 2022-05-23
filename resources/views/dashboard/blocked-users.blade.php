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
                                <div class="col-md-6">

                                    <table class="table">
                                        <thead>
                                          <tr>
                                     
                                            <th scope="col">Name</th>
                                            <th scope="col">City</th>
                                            <th scope="col">State</th>
                                            <th scope="col">Country</th>
                                            <th scope="col">Unblock</th>
                                      
                                          </tr>
                                        </thead>
                                        <tbody>

                                          @forelse ($blockUsers as $block)
                                          <tr>
                                          
                                            <td>{{$block->user->name}}</td>
                                            <td>{{$block->user->placename}}</td>
                                            <td>{{$block->user->state}}</td>
                                            <td>{{$block->user->country}}</td>
                                            <td>
                                              <form action="{{route('delete_block',$block->id)}}" method="post">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit">Unblock</button>
                                              </form>
                                            </td>
                                         
                                          </tr>
                                          @empty
                                                <p>No block users</p>
                                          @endforelse
                                       
                                        
                                        </tbody>
                                      </table>

                                </div>

                        </div>
                    </div>
                  
                </div>
  </div>
 
  
@endsection
