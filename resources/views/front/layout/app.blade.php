<!DOCTYPE html>
<html lang="en">

    @include('front.layout.partials.head')

    <body>

        <!-- ======= Top Bar ======= -->
        @include('front.layout.partials.topnav')
        <!-- ======= End Top Bar ======= -->

        <!-- ======= Header ======= -->
        @include('front.layout.partials.navbar')
        <!-- End Header -->

        @yield('content')

        <!-- ======= Footer ======= -->
        @include('front.layout.partials.footer')
        <!-- End Footer -->

        <div id="preloader"></div>
        <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i
                class="bi bi-arrow-up-short"></i></a>

        @include('front.layout.partials.script')

    </body>

</html>
