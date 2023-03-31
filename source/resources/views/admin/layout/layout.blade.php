<!DOCTYPE html>
<html class="no-js" lang="zh-TW">
<head>
    @include('admin.include.meta')
    @yield('style')

</head>
<body>
    @include('admin.include.admin-menu')

    @yield('content')
    

    @include('admin.include.js')

    @yield('javascript')
</body>
</html>