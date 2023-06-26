<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>@yield('title', 'My App')</title>
    @vite('./resources/css/app.css')
</head>

<body>
    <header class=" shadow shadow-red-700">
        <div class="flex flex-row justify-between items-center container  mx-auto p-2">
            <a class="text-red-600 text-3xl" href="/">{{ config('app.name') }}</a>
            <div class="relative group">
                <p
                    class="p-2 border border-red-600 rounded text-red-900 hover:cursor-pointer max-w-[150px] whitespace-nowrap overflow-hidden text-ellipsis">
                    @auth
                        {{ auth()->user()->email }}
                    @else
                        Get Started
                    @endauth
                </p>
                <ul
                    class="w-full absolute top-[105%] rounded hidden group-hover:block group-active:block group-focus:block z-10 p-2 backdrop-blur-md bg-[#0003]">
                    @auth
                        <li><a class="inline-flex w-full" href="{{ route('profile.profile') }}">Profile</a></li>
                        <li><a class="inline-flex w-full" href="{{ route('post.my-post') }}">My Posts</a></li>
                        <li><a class="inline-flex w-full text-red-600" href="{{ route('auth.logout-user') }}">Logout</a>
                        </li>
                    @else
                        <li><a class="inline-flex w-full hover:underline" href="{{ route('auth.login') }}">Login</a></li>
                        <li><a class="inline-flex w-full hover:underline" href="{{ route('auth.register') }}">Register</a>
                        </li>
                    @endauth
                </ul>
            </div>
        </div>
    </header>

    <main class="container mx-auto p-2 my-3">
        @yield('content')
    </main>

    @stack('scripts')

</body>

</html>
