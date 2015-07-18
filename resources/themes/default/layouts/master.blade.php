<!DOCTYPE html>
<html lang="en">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        {!! Meta::render() !!}


        @section('meta.socials')
            @include('partials.socials')
        @show

        @section('assets.top')
            <link rel="stylesheet" href="{!! Theme::asset('css/styles.css', null, true) !!}"/>
            <script src="{!! asset('/assets/components/jquery/dist/jquery.min.js') !!}"></script>
            <script src="http://cdnjs.cloudflare.com/ajax/libs/gsap/latest/TweenMax.min.js"></script>
        @show

        <link rel="shortcut icon" href="{!! asset('/favicon.png') !!}" type="image/x-icon">
    </head>

    <!--[if lt IE 8]>
        <p class="browsehappy">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> to improve your experience.</p>
    <![endif]-->

    <body>

        @include('partials.header')

        @yield('content')

        @include('partials.footer')

        @section('assets.bottom')
            <script src="{!! Theme::asset('js/main.js', null, true) !!}"></script>
        @show

    </body>
</html>
