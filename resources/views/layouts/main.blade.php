<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name', 'Laravel') }}</title>
</head>
    @vite(['resources/sass/app.scss', 'resources/js/app.js'])
</head>

<header>
    <div class="dashboard_main">
        <div class="header__inner">
            <div class="header__wrapper">

                <div class="header__item header__logo">
                    Logo
                </div>

                <div class="header__menu">
                    @auth

                        <a href="{{route('home')}}">Home</a>
                        <a href="{{route('profile.edit')}}">My Profile</a>
                        <a href="{{ route('users') }}" class=>Users</a>
                        <a href="{{ route('post_list') }}" class=>Posts</a>
                    @endauth
                </div>
                <div class="header__item header__right-menu">
                    @auth
                        <a href="{{ url('/logout') }}" class=>Logout</a>
                    @else
                        <div class="f-login-nav">
                            <a href="{{ route('login') }}" >Log in</a>
                            <a href="{{ route('register') }}">Register</a>
                        </div>
                    @endauth
                </div>
            </div>
        </div>
    </div>
</header>

<body class="font-sans antialiased">
<!-- Page Heading -->
    @if (isset($header))
        <header class="bg-white dark:bg-gray-800 shadow">
            <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                {{ $header }}
            </div>
        </header>
    @endif

<!-- Page Content -->
    <main>
        <div class="app-container">
            <x-popup_error/>
        {{ $slot }}
        </div>
    </main>
</div>
</body>

<footer>
</footer>

</html>
