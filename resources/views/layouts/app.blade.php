<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" integrity="sha512-9usAa10IRO0HhonpyAIVpjrylPvoDwiPUiKdWk5t3PyolY1cOd4DSE0Ga+ri4AuTroPR5aQvXU9xC6qOPnzFeg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>
<body>
    <div id="app">
        <nav class="navbar navbar-expand-lg navbar-light bg-white">
            <div class="container">
                <a class="navbar-brand" href="/">Global Posty</a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarsExample02" aria-controls="navbarsExample02" aria-expanded="false" aria-label="Toggle navigation">
                  <span class="navbar-toggler-icon"></span>
                </button>
              
                <div class="collapse navbar-collapse justify-content-end" id="navbarsExample02">
                  <ul class="navbar-nav mr-auto">
                    
                    @guest
                    <li class="nav-item">
                        <a class="nav-link" href="{{route('login')}}">Login</a>
                      </li>
                      <li class="nav-item">
                          <a class="nav-link" href="{{route('register')}}">Register</a>
                        </li>
                    @endguest
             
    
                  </ul>
                  <ul class="navbar-nav  me-3">
                      @auth
                   
                      <li class="nav-item">
                        <a class="nav-link" href="{{route('dash-home')}}">Welcome, {{auth()->user()->name}}</a>
                      </li>
                      <li class="nav-item">
                        <a class="nav-link " href="{{route('chat')}}">Chat</a>
                      </li>
                      <li class="nav-item">
                        <a class="nav-link" href="{{route('search')}}">Search</a>
                      </li>
                      <li class="nav-item">
                        <form action="{{ route('logout') }}" method="post" >
                            @csrf
                            <button style="background: none;border:none;" class="nav-link" type="submit">Logout</button>
                        </form>
                    </li>
               
                 

                      @endauth
                    
                  </ul>
                </div>
            </div>
           
          </nav>

        <main >
            @yield('content')
        </main>

   
        
    </div>
    <div class="container">
      <footer class="py-3 my-4">
        
        </ul>
        <p class="text-center text-muted"> 2022 Example Application Created By WebField Design </p>
      </footer>
    </div>
   
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
</body>
</html>
