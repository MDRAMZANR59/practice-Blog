<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    {{-- css --}}
    @include('backend.partials.style')

    <title>Admin Dashboard Panel</title>
</head>

<body class="dashboard-body">
    {{-- Auth --}}
    @if (Route::has('login'))
        <div class="sm:fixed sm:top-0 sm:right-0 p-6 text-right z-10">
            @auth
                <a href="{{ url('/dashboard') }}"
                    class="font-semibold text-gray-600 hover:text-gray-900 dark:text-gray-400 dark:hover:text-white focus:outline focus:outline-2 focus:rounded-sm focus:outline-red-500">Dashboard</a>
            @else
                <a href="{{ route('login') }}"
                    class="font-semibold text-gray-600 hover:text-gray-900 dark:text-gray-400 dark:hover:text-white focus:outline focus:outline-2 focus:rounded-sm focus:outline-red-500">Log
                    in</a>

                @if (Route::has('register'))
                    <a href="{{ route('register') }}"
                        class="ml-4 font-semibold text-gray-600 hover:text-gray-900 dark:text-gray-400 dark:hover:text-white focus:outline focus:outline-2 focus:rounded-sm focus:outline-red-500">Register</a>
                @endif
            @endauth
        </div>
    @endif
    {{-- end auth --}}
    @if (session('success'))
        <div class="message success">
            <h1 class="text-center">{{ session('success') }}</h1>
        </div>
    @endif

    @if (session('update'))
        <div class="message update">
            <h1 class="text-center">{{ session('update') }}</h1>
        </div>
    @endif
    @if (session('delete'))
        <div class="message deleted">
            <h1 class="text-center">{{ session('delete') }}</h1>
        </div>
    @endif

    @include('backend.partials.header');

    @yield('Content');

    @include('backend.partials.script')
    @stack('script')
    <script type="text/javascript">
        $(document).ready(function() {

            $('.summernote').summernote();

        });
    </script>
</body>

</html>
