<!DOCTYPE html>
<html lang="ar">
    <head>

        <meta charset="utf-8" />
        <title> @yield('title', get_setting('project_name'))</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="_token" content="{{ csrf_token() }}">
        <meta name="description" content="{{ get_setting('description') }}"/>
        <meta name="author" content="Hamdy Emad"/>
        <meta name="robots" content="index, follow">
        <meta name="keywords" content="{{ get_setting('keywords') }}">
        <!-- Schema.org markup for google -->
        <meta itemprop="name" content="{{ get_setting('project_name') }}">
        <meta itemprop="description" content="{{ get_setting('description') }}">
        <meta itemprop="image" content="{{ asset(get_setting('logo')) }}">
        <!-- twitter card data -->
        <meta name="twitter:card" content="product">
        <meta name="twitter:size" content="@publisher_handle">
        <meta name="twitter:title" content="{{ get_setting('project_name') }}">
        <meta name="twitter:description" content="description">
        <meta name="twitter:creator" content="@author_handle">
        <meta name="twitter:image" content="{{ asset(get_setting('logo')) }}">
        <!-- open graph data -->
        <meta property="og:title" content="{{ get_setting('project_name') }}">
        <meta property="og:type" content="website">
        <meta property="og:url" content="{{ asset('/') }}">
        <meta property="og:image" content="{{ asset(get_setting('logo')) }}">
        <meta property="og:description" content="{{ get_setting('description') }}">
        <meta property="og:site_name" content="{{ get_setting('project_name') }}">
        <meta property="fb:app_id" content="">
        <!-- App favicon -->
        @if (get_setting('logo'))
            <link rel="shortcut icon" href="{{ asset(get_setting('logo')) }}">
        @else
            <link rel="shortcut icon" href="{{ URL::asset('/media/default.png') }}">
        @endif

        <link href="{{ URL::asset('/libs/owl/owl.carousel.min.css') }}" rel="stylesheet" type="text/css" />

        <link href="{{ URL::asset('/css/app.css') }}" rel="stylesheet" type="text/css" />
        <link rel="stylesheet" href="{{ asset('/css/toastr.min.css') }}">
        <link rel="stylesheet" href="{{ asset('/css/font-awesome.min.css') }}">
        <link href="{{ URL::asset('/libs/xzoom/xzoom.min.css') }}" rel="stylesheet" type="text/css" />
        {{-- Nutu Kofi --}}
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Noto+Kufi+Arabic&display=swap" rel="stylesheet">
        {{-- Amiri --}}
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Amiri:wght@700&display=swap" rel="stylesheet">
        @yield('extra_css')

    </head>
<body>


    <div class="frontend">
        @include('frontend.inc.navbar')
        <div class="front-page-content">
            @yield('content')
        </div>
        @include('frontend.partials.footer')
    </div>

    <!-- Start preloader_all-->
    <div id="preloader_all" class="d-none">
        @include('inc.preloader')
    </div>
    <!-- END preloader_all-->

    <!-- JAVASCRIPT -->
    <script src="{{ URL::asset('/js/lib/jquery.min.js') }}"></script>
    <script src="{{ URL::asset('/js/lib/toastr.min.js') }}"></script>
    <script src="{{ URL::asset('/libs/xzoom/xzoom.min.js') }}"></script>
    <script src="{{ URL::asset('/libs/owl/owl.carousel.min.js') }}"></script>
    <script src="{{ URL::asset('/js/app.js') }}"></script>
    @if (Session::has('success'))
        <script>
            toastr.success("{{ Session::get('success') }}");
        </script>
    @endif
    @if (Session::has('info'))
        <script>
            toastr.info("{{ Session::get('info') }}");
        </script>
    @endif
    @if (Session::has('error'))
        <script>
            toastr.error("{{ Session::get('error') }}");
        </script>
    @endif
    @if (Session::has('info'))
        <script>
            toastr.info("{{ Session::get('info') }}");
        </script>
    @endif
    <script>
        var token = $("meta[name=_token]").attr('content');
        $("input:submit").on('click', function() {
            $("#preloader_all").removeClass('d-none');
        });
    </script>

    <!-- footerScript -->
    @yield('extra_script')
    <!-- App js -->
</body>
<style>
    .xzoom-preview {
        z-index: 2;
        border-radius: 10px;
        background-color: var(--primary);
    }
    .xzoom-preview img {
        width: 1200px !important;
        height: 800px !important;
    }
    .xzoom-preview img {
        border-radius: 10px;
    }
    .xzoom-lens {
        cursor: zoom-in;
        border-radius: 10px
    }
</style>
</html>
