<nav>
    <div class="logo">
        <img src="{{asset('template2/assets/img/logo-dishub.png')}}">
        <h1>ANDALALIN</h1>
    </div>

    <ul>
        <li><a href="#">Beranda</a></li>
        <li><a href="#tentang-kami">Tentang Kami</a></li>
        <li><a href="#panduan">Panduan</a></li>
        @auth
            <li><a href="{{ route('dashboard.index') }}" class="btn btn-yellow-border">Dashboard</a></li>
            <li><a href="{{ route('logout') }}" class="btn btn-yellow-border" onclick="event.preventDefault();document.getElementById('logout-form').submit();">Sign Out</a></li>
            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                @csrf
            </form>
        @else
            <li><a href="{{ route('sign-up.index') }}" class="btn btn-yellow-border">Sign Up</a></li>
            <li><a href="{{ route('login') }}" class="btn btn-yellow-border">Sign In</a></li>
        @endauth
    </ul>
</nav>