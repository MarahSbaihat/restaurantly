<div id="layoutSidenav_nav">
    <nav class="sb-sidenav accordion sb-sidenav-dark" id="sidenavAccordion">
        <div class="sb-sidenav-menu">
            <div class="nav">
                <div class="container mt-3 text-light d-flex justify-content-between">
                    {{ Auth::user()->name }}
                    <form action="{{ route('logout') }}" method="POST">
                        @csrf
                        <button class="btn btn-danger btn-sm">log out</button>
                    </form>
                </div>
                {{-- <div class="m-auto mt-3 text-light">{{ auth()->user()->name }}</div> --}}
                <div class="sb-sidenav-menu-heading">Pages</div>
                <ul class="ms-3">
                    <li class="me-2 py-2 px-3 rounded text-decoration-none {{ request()->routeis('dashboard.index') ? 'active bg-primary' : '' }}"><a class="text-light" href="{{ route('dashboard.index') }}">Home</a></li>
                    <li class="me-2 py-2 px-3 rounded text-decoration-none {{ request()->routeis('dashboard.products.*') ? 'active bg-primary' : '' }}"><a class="text-light" href="{{ route('dashboard.products.index') }}">Products</a></li>
                    <li class="me-2 py-2 px-3 rounded text-decoration-none {{ request()->routeis('dashboard.categories.*') ? 'active bg-primary' : '' }}"><a class="text-light" href="{{ route('dashboard.categories.index') }}">categories</a></li>
                </ul>
            </div>
        </div>
        <div class="sb-sidenav-footer">
            <div class="small">Logged in as:</div>
            Start Bootstrap
        </div>
    </nav>
</div>
