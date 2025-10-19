<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Elfarida Online') }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
    <script src="https://cdn.tailwindcss.com"></script>
<script>
  tailwind.config = {
    theme: {
      extend: {
        colors: {
          beige: '#f5f5dc',
          brown: '#8b4513',
          lightbrown: '#a0522d',
        }
      }
    }
  }
</script>


    <!-- Custom CSS -->
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
</head>
<body>
    <div class="app-container">

        <!-- Header -->

        @isset($header)
            <header class="main-header">
                <div class="header-content">
                    {{ $header }}

                

                </div>
            </header>
        @endisset

        <!-- Page Content -->
        <main class="main-content">
<!-- Navbar -->
<nav class="bg-[#f5f0e6] border-b border-[#d6c6b8] shadow">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-16">
            
            <!-- Left Side -->
            <div class="flex items-center">
                <a href="{{ route('units.index') }}" class="flex items-center text-[#6b4f3f] font-extrabold text-xl">
                 <h2>الفريدة</h2>
                </a>
            </div>

            <!-- Center Links -->
            <div class="flex space-x-4 items-center">
                <a href="{{ route('units.index') }}" 
                   class="px-3 py-2 bg-[#e6d8c3] text-[#6b4f3f] rounded-md shadow hover:bg-[#d6c6b8] transition">
                   الوحدات
                </a>

                @if(auth()->check() && in_array(auth()->user()->role, ['admin','supervisor']))
                    <a href="{{ route('statistics.index') }}" 
                       class="px-3 py-2 bg-[#e6d8c3] text-[#6b4f3f] rounded-md shadow hover:bg-[#d6c6b8] transition">
                       الإحصائيات
                    </a>
                @endif

                @if(auth()->check() && auth()->user()->role === 'admin')
                    <a href="{{ route('units.bulk') }}" 
                       class="px-3 py-2 bg-[#e6d8c3] text-[#6b4f3f] rounded-md shadow hover:bg-[#d6c6b8] transition">
                       Bulk Control
                    </a>
                @endif
            </div>

            <!-- Right Side -->
            <div class="flex items-center space-x-3">
                @auth
                    <div class="flex items-center space-x-2 bg-[#e6d8c3] px-3 py-2 rounded-md shadow">
                        <span class="text-[#6b4f3f] font-semibold">
                            مرحباً، {{ auth()->user()->name }}
                        </span>
                    </div>
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit"
                                class="bg-[#6b4f3f] text-white px-3 py-2 rounded-md hover:bg-#5a3e30 transition shadow">
                                تسجيل خروج
                        </button>
                    </form>
                @else
                    <a href="{{ route('login') }}"
                       class="bg-[#6b4f3f] text-white px-3 py-2 rounded-md hover:bg-[#5a3e30] transition shadow">
                       تسجيل دخول
                    </a>
                @endauth
            </div>
        </div>
    </div>
</nav>

            @yield('content')
        </main>
    </div>
</body>
</html>
        <!-- Scripts -->
        <script src="{{ asset('js/app.js') }}" defer></script>  