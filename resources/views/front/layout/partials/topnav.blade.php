<div id="topbar" class="d-flex align-items-center fixed-top">
    <div class="container d-flex justify-content-center justify-content-md-between">
        <div class="contact-info d-flex align-items-center">
            <i class="bi bi-phone d-flex align-items-center"><span>+1 5589 55488 55</span></i>
            <i class="bi bi-clock d-flex align-items-center ms-4"><span> Mon-Sat: 11AM - 23PM</span></i>
        </div>
        <div class="languages d-none d-md-flex align-items-center">
            <div class="info nav d-flex align-items-center">
                @guest
                    <li class="nav-link" href="#menu">
                        <a href="{{ route('signin') }}" class="btn btn-success btn-sm mx-2">log in</a>
                    </li>
                @endguest
                @auth
                    <a class="px-3 py-2" href="{{ route('cart.index') }}">cart</a>
                    {{ Auth::user()->name }}
                    <li class="nav-link" href="#menu">
                        <form action="{{ route('logout') }}" method="POST">
                            @csrf
                            <button class="btn btn-danger btn-sm">log out</button>
                        </form>
                    </li>
                @endauth
            </div>
            <ul>
                <li>En</li>
                <li><a href="#">De</a></li>
            </ul>
        </div>
    </div>
</div>
