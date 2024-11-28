<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Event Management</title>
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
        @if (file_exists(public_path('build/manifest.json')) || file_exists(public_path('hot')))
            @vite(['resources/css/app.css', 'resources/js/app.js'])
        @endif
    </head>
    <body>
        @include('partials.navigation')
        @if(session('success'))
                <div class="alert alert-success bg-green-100 text-green-700 p-3 rounded-md mb-4 text-center">
                    {{ session('success') }}
                </div>
        @endif

        @if ($errors->any())
                <div class="alert alert-danger bg-red-100 text-red-700 p-3 rounded-md mb-4 text-center">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
        @endif
        <main>
            @yield('content')
        </main>
        @include('partials.footer')
    </body>
</html>
