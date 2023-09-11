<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

@include('includes.layout.head')

<body>
    <div id="app">

        @include('includes.layout.navbar')

        <main>
            <div class="container">
                @include('includes.layout.modal')
                @include('includes.layout.alerts')
                @yield('content')
            </div>
        </main>
    </div>
    @yield('scripts')
</body>

</html>
