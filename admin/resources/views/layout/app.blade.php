<!DOCTYPE html>
<html lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>@yield('title')</title>
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.2/css/all.css">
    <link rel="stylesheet" href="{{ asset('css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/mdb.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/sidenav.css') }}">
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <link rel="stylesheet" href="{{ asset('css/responsive.css') }}">
    <link rel="stylesheet" href="{{ asset('css/datatables.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/datatables-select.min.css') }}">
   

</head>
<body>

    @include('layout.menu') <!-- including side bar menu-->

    @yield('content') <!-- main content-->

    



</div> <!-- End of page-wrapper which begins in side bar menu-->
</div> <!-- End of main-wrapper which begins in side bar menu-->

<!-- Necessary Javascript -->
<script src="js/jquery-3.4.1.min.js"></script>
<script type="text/javascript" {{ asset('js/popper.min.js') }}></script>
<script type="text/javascript" {{ asset('js/bootstrap.js') }}></script>
<script type="text/javascript" {{ asset('js/mdb.min.js') }}></script>
<script {{ asset('js/jquery.slimscroll.js') }}></script>
<script {{ asset('js/sidebarmenu.js') }}></script>
<script {{ asset('js/sticky-kit.min.js') }}></script>
<script {{ asset('js/custom.min-2.js') }}></script>
<script {{ asset('js/datatables.min.js') }}></script>
<script {{ asset('js/datatables-select.min.js') }}></script>
<script {{ asset('js/custom.js') }}></script>
<script {{ asset('js/axios.min.js') }}></script>
</body>
</html>