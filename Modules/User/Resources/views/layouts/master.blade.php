<!DOCTYPE html>
<html lang="en">
<head>
    @include('user::elements.meta')
    @include('user::elements.style')
</head>
<body class="animsition">
    @include('user::elements.header')
    @include('user::elements.header_cart')
    @yield('content')

    @include('user::elements.footer')
    @include('user::elements.script')
    @yield('javascript')
</body>
</html>
