<!DOCTYPE html>
<html class="no-js" lang="zh-TW">
<head>
    @include('admin.include.meta')
    @yield('style')

</head>
<body class="bg-light">

    @yield('content')


    @include('admin.include.js')

    @yield('javascript')
</body>
</html>