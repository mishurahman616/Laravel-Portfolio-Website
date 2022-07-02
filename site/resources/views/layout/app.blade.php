<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>@yield('title')</title>
    <meta name="google-site-verification" content="J2K-awrLm--LtTSkUGmFsRpFFTU0W1V5PqZTQp0b6pg" />
    <meta name="description" content="Mishu is an Expert Web Developer in Bangladesh. Expert Mobile App Developer in Bangladesh.He is highly talented, experienced, professional and cooperative software engineer, working in programming and web world for more than 4 years. ">
    <meta name="keywords" content="Expert Web Developer in Bangladesh, Expert Mobile App Developer in Bangladesh, Android App Developer in Bangladesh">
    <meta name="author" content="Mishu Rahman">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://fonts.googleapis.com/css2?family=Hind+Siliguri:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link {{ asset('css/bootstrap.min.css') }} rel="stylesheet" >
    <link {{ asset('css/custom.css') }} rel="stylesheet" >
    <link {{ asset('css/responsive.css') }} rel="stylesheet" >
    <link {{ asset('css/owl.carousel.min.css') }} rel="stylesheet" >
    <link {{ asset('css/fontawesome.css') }} rel="stylesheet">
    <link {{ asset('css/animate.css') }} rel="stylesheet">
</head>
<body>
    <!-- Yield content section-->
    @yield('content')


    <!--Necessary  Javascript  -->
<script type="text/javascript" {{ asset('js/jquery-3.4.1.min.js') }}></script>
<script type="text/javascript" {{ asset('js/popper.min.js') }}></script>
<script type="text/javascript" {{ asset('js/bootstrap.min.js') }}></script>
<script type="text/javascript" {{ asset('js/owl.carousel.min.js') }}></script>
<script type="text/javascript" {{ asset('js/axios.min.js') }}></script>
<script type="text/javascript" {{ asset('js/custom.js') }}></script>
</body>
</html>