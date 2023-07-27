<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<x-guest-layout>

    <body class="antialiased">
        <div class="dashboard_main">
            @auth
                <a href="{{ url('/dashboard') }}" class=>Dashboard</a>
            @else
                <a href="{{ route('login') }}" >Log in</a>
                <a href="{{ route('register') }}">Register</a>

            @endauth
        </div>
    </body>








        @foreach ($data->withPath('/') as $posts)
            {{ $posts->name }}
        @endforeach





    {{ $data->links() }}
</x-guest-layout>
</html>

