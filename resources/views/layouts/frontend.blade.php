<!DOCTYPE html>
<html>
@include('partials.head')
<body>
    <div class="container-fluid">
        <div class="row">
            @include('partials.header')
        </div>
    </div>
    <div class="container">

        @yield('content')

        @include('partials.footer')
    </div>
    @yield('scripts')
</body>

</html>