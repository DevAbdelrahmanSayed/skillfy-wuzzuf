@include('layout.admin.header')
<body class="sb-nav-fixed">
@include('layout.admin.nav')
<div id="layoutSidenav">
    @include('layout.admin.sidebar')
    <div id="layoutSidenav_content">
            @yield('content')
@include('layout.admin.footer')
    </div>
</div>
</body>
</html>
