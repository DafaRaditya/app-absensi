<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    {{-- Sweet Alert --}}
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    

    {{-- ajax & axios --}}
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.6.0/dist/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>


    {{-- Font Awesome --}}
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=Nunito" rel="stylesheet">

    <!-- Scripts -->
    @vite(['resources/sass/app.scss', 'resources/js/app.js'])
</head>
<body>
    <div id="app" class="d-flex">
        {{-- sidebar --}}
        @auth
        <div class="d-flex flex-column flex-shrink-0 p-3 bg-body-tertiary" style="width: 230px; height: 100vh;">
            <a href="/" class="d-flex align-items-center mb-3 mb-md-0 me-md-auto link-body-emphasis text-decoration-none">
              <svg class="bi pe-none me-2" width="40" height="32"><use xlink:href="#bootstrap"></use></svg>
              <span class="fs-4">{{ config('app.name', 'Laravel') }}</span>
            </a>
            <hr>
            <ul class="nav nav-pills  flex-column mb-auto">
              <li class="nav-item">
                <a href="{{ route('karyawan.index') }}" class="nav-link {{ Request::routeIs('karyawan.index') ? 'active ' : 'link-body-emphasis' }} " aria-current="page">
                  <svg class="bi pe-none me-2" width="16" height="16"><use xlink:href="#home"></use></svg>
                  Home
                </a>
              </li>
              <li>
                <a href="{{ route("absensi.index") }}" class="nav-link {{ Request::routeIs('absensi.index') ? 'active' : 'link-body-emphasis' }}
                "
                aria-current="page"
                >
                  <svg class="bi pe-none me-2" width="16" height="16"><use xlink:href="#speedometer2"></use></svg>
                  Data Absen
                </a>
              </li>
              <li>
                <a href="{{ route('absensi.data-bulanan') }}" class="nav-link {{ Request::routeIs('absensi.data-bulanan') ? 'active' : 'link-body-emphasis' }} "
                aria-current="page"
                >
                  <svg class="bi pe-none me-2" width="16" height="16"><use xlink:href="#table"></use></svg>
                  Data Bulanan
                </a>
              </li>
            </ul>
            <hr>
          </div>
        @endauth
        {{-- end of sidebar --}}

        {{-- content --}}
        <div class="w-full">
            <header class="navbar navbar-expand-md navbar-light ">
                <div class="container">
                   
                    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                        <span class="navbar-toggler-icon"></span>
                    </button>
    
                    <div class="collapse navbar-collapse" id="navbarSupportedContent">
                        <ul class="navbar-nav ms-auto">
                            @guest
                            @else
                          
                                <li class="nav-item dropdown">
                                    <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                        {{ Auth::user()->name }}
                                    </a>
    
                                    <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                                        <a class="dropdown-item" href="{{ route('logout') }}"
                                           onclick="event.preventDefault();
                                                         document.getElementById('logout-form').submit();">
                                            {{ __('Logout') }}
                                        </a>
    
                                        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                            @csrf
                                        </form>
                                    </div>
                                </li>
                            @endguest
                        </ul>
                    </div>
                </div>
            </header>
    
            <main class="py-4">
                @yield('content')
            </main>
            
        </div>
    </div>

<script src="{{ asset('js/karyawan.js') }}"></script>
</body>
</html>
