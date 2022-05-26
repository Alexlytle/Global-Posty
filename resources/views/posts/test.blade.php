@extends('layouts.app')

@section('content')


@foreach ($users as $user)
        {{-- {{$user->name}} --}}
        @livewire('test',['user'=>$user],key($user->id))
@endforeach



@endsection
