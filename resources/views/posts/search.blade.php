@extends('layouts.app')

@section('content')


@auth
<div class="wrapper bg-light" style="min-height: 95vh">
    <div class="container p-4">
        <div class="row d-flex justify-content-center">
            <div class="col-8 p-4 ">
            <h1>
            
                @if ($locationType ==='city')
                     <h1 class="fw-light">
                        City: {{$location}}
                     </h1>
                @endif

                @if ($locationType ==='state')
                    <h1 class="fw-light">
                    State: {{$location}}
                    </h1>
                 @endif

                 @if ($locationType ==='country')
                    <h1 class="fw-light">
                    Country: {{$location}}
                    </h1>
                @endif
            </h1>
               @forelse ($users as $user)
                    @foreach ($user->posts as $index=>$post)
            
                    <x-post :post="$post" :index="$index" :blocked="$blocked"/>

      
        
                    @endforeach
               @empty
                   User is empty
               @endforelse
        </div>
    </div>
    </div>
 
@endauth


@endsection
