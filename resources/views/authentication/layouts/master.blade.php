<!doctype html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <meta name="description" content="">
        <meta name="author" content="">

        <title>Kool Form Pack | Login page</title>

        <!-- CSS FILES -->
        <link rel="preconnect" href="https://fonts.googleapis.com">

        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>

        <link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,200;0,400;0,700;1,200&family=Unbounded:wght@400;700&display=swap" rel="stylesheet">

        <link href="{{ asset('authentication/css/bootstrap.min.css') }}" rel="stylesheet">

        <link href="{{ asset('authentication/css/bootstrap-icons.css') }}" rel="stylesheet">

        <link href="{{ asset('authentication/css/tooplate-kool-form-pack.css') }}" rel="stylesheet">

    </head>

    <body>

        <main>

            <section class="hero-section d-flex justify-content-center align-items-center">
                @yield('content')

                {{-- <div class="video-wrap">
                    <video autoplay="" loop="" muted="" class="custom-video" poster="">
                        <source src="{{ asset('authentication/videos/video.mp4') }}" type="video/mp4">

                        Your browser does not support the video tag.
                    </video>
                </div> --}}
            </section>

        </main>

        <!-- JAVASCRIPT FILES -->
        <script src="{{ asset('authentication/js/jquery.min.js') }}"></script>
        <script src="{{ asset('authentication/js/bootstrap.bundle.min.js') }}"></script>
        <script src="{{ asset('authentication/js/countdown.js') }}"></script>
        <script src="{{ asset('authentication/js/init.js') }}"></script>

    </body>
</html>
