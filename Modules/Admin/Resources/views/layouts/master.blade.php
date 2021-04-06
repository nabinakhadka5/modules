
<!DOCTYPE html>
<html lang="en">
<head>
        @include('admin::elements.meta')
        @include('admin::elements.style')
</head>

<body class="fixed-navbar">
        @include('admin::elements.header')
        @include('admin::elements.sidebar')
        @yield('content')
        @include('admin::elements.footer')
        @include('admin::elements.script')
        @yield('javascript')
</body>
</html>
