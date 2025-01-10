{{-- Layout Template --}}
<!DOCTYPE html>
<html>

<head>
    <title>Laravel 10 Task List App</title>
    @yield('styles')
</head>

<body>
    <h1>@yield('title')</h1>
    <div>
        @if (session()->has('success'))
            <div>{{ session('success') }}</div> {{-- pega valor da sessao --}}
        @endif

        @yield('content')
    </div>
</body>

</html>