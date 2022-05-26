@extends('layouts.app')

@section('content')


@auth
<div class="wrapper bg-light" style="min-height: 95vh">
    <div class="container p-4">
        <div class="row d-flex justify-content-center">
            <div class="col-8 p-4 ">
      
       
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
          
      
 
            @livewire('search-post',['locationType'=>$locationType,'location'=>$location,'blocked'=>$blocked]) 

      
        
        </div>
    </div>
    </div>
 
@endauth

 
@guest 

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
            {{-- {{$locationType}} --}}
            @livewire('search-post',['locationType'=>$locationType,'location'=>$location])
        </div>
    </div>
    </div>
@endguest
@endsection
