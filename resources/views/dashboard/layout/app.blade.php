<!DOCTYPE html>
<html lang="en">

    @include('dashboard.layout.partial.head')

    <body class="sb-nav-fixed vh-100">

        @include('dashboard.layout.partial.navbar')

        <div id="layoutSidenav">

            @include('dashboard.layout.partial.sidenav' , ["name"=>"marah"])

            <div class="w-100 vh-100" id="layoutSidenav_content bg-danger">

                <main>
                    <div class="container-fluid px-4">
                        <div class="mt-5 pt-5 d-flex justify-content-between container">
                            <h1>@yield('pagename')</h1>
                            <ol class="breadcrumb mb-4">
                                @section('breadcrumb')
                                <li class="breadcrumb-item active"><a href="{{ route('dashboard.index') }}">Dashboard</a></li>
                                @show
                            </ol>
                        </div>


                        @yield('content')

                    </div>
                </main>

                @include('dashboard.layout.partial.footer')

            </div>

        </div>

        @include('dashboard.layout.partial.script')

    </body>
</html>
