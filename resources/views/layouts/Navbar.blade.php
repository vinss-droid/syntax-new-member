
@php
    $settings = DB::table('settings')->orderBy('created_at', 'ASC')->first();
@endphp

<nav class="navbar navbar-expand-lg bg-light">
    <div class="container">
        <a class="navbar-brand" href="{{ Request::is('/') ? 'https://syntx.id/' : '/' }}">
            <img src="{{ asset('img/syntax-navbar.png') }}" alt="syntax-navbar.png" width="100" height="40">
        </a>
        <i class="fa-solid fa-code text-white" id="login"></i>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent"
            aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
                @guest
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="https://syntx.id/">Halaman Utama</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="https://wa.me/{{ $settings->admin_contact }}" target="_blank">Hubungi Admin</a>
                    </li>
                @else
                    <li class="nav-item">
                        <a class="nav-link {{ Request::is('dashboard') ? 'active' : '' }}" aria-current="page" href="{{ route('dashboard') }}">New Member</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ Request::is('website-settings') ? 'active' : '' }}" aria-current="page" href="{{ route('websiteSettings') }}">Website Settings</a>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle active fw-bold text-primary" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                          {{ ucwords(Auth::user()->name); }}
                        </a>
                        <ul class="dropdown-menu mt-2" aria-labelledby="navbarDropdown">
                          <li>
                            <a class="dropdown-item" href="{{ route('logout'); }}">Logout</a>
                        </li>
                        </ul>
                      </li>

                @endguest
            </ul>
        </div>
    </div>
</nav>