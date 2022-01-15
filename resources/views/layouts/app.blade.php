<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <title>Posty</title>
        <link rel="stylesheet" href="{{ asset('css/app.css') }}"> <!-- The files must located in the public folder -->      
    </head>
    <body class="bg-gray-200">
        <nav class="p-6 bg-white flex justify-between mb-6">
            <ul class="flex items-center">
                <li>
                    <a href="/" class="p-3">Home</a>
                </li>
                <li>
                    <a href="{{ route('dashboard') }}" class="p-3">Dashboard</a>
                </li>
                <li>
                    <a href="{{ route('posts') }}" class="p-3">Post</a>
                </li>
            </ul>
            
            <div>
                <form action="{{ route('posts.search') }}" method="get">
                    
                    <label for="search" class="sr-only">Search</label>

                    <input type="text" name="search" id="search" placeholder="Search for a post or user..."
                    class="bg-gray-100 border-2 w-full p-2.5 rounded-lg" @if ($errors->has('search')) value="" @else value="{{ request('search') }}" @endif>
                </form>   
            </div> 

             <ul class="flex items-center">
                @auth {{-- @if (auth()->user()) --}}
                    <li>
                        <a href="" class="p-3">{{ auth()->user()->name }}</a> {{-- return  'user' obj->name --}}
                    </li>
                    <li>
                        <form action="{{ route('logout') }}" method="post" class="p-3 inline">
                            @csrf
                            <button type="submit">Logout</button>
                        </form>
                    </li>
                @endauth

                @guest  {{-- @else --}}
                    <li>
                        <a href="{{ route('login') }}" class="p-3">Login</a>
                    </li>
                    <li>
                        <a href="{{ route('register') }}" class="p-3">Register</a> <!-- referencia a route chamada 'register' route::get(~)->name('register') -->
                    </li>
                @endguest  {{-- @endif --}} 
            </ul>
        </nav>
        
        @if ($errors->has('search'))    {{-- receive error message from search --}}
            <div id="app">
                <modal-component>
                    @error('search')
                        {{ $message }} 
                    @enderror
                 </modal-component>
            </div>
        @endif 

        @yield('content')   
    </body>
    <script src="{{ asset('js/app.js') }}"></script>
</html>