@include('includes.f-head')
<body>
<!-- header -->
@include('includes.f-header')
<!-- header-end -->
<!-- offcanvas-area -->
@include('includes.f-offcanvas')
<!-- offcanvas-end -->
<!-- main-area -->
<main>
    @yield('content')
</main>
<!-- main-area-end -->
<!-- footer -->
@include('includes.f-footer')
<!-- footer-end -->
<!-- JS here -->
@include('includes.f-foot')
</body>
</html>
