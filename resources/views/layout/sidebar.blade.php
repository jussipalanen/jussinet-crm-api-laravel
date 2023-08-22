<div class="col-auto col-md-3 col-xl-2 px-sm-2 px-0 bg-dark">
    <div class="d-flex flex-column flex-shrink-0 p-3 text-white min-vh-100">
        <a href="/" class="d-flex align-items-center mb-3 mb-md-0 me-md-auto text-white text-decoration-none">
            <svg class="bi me-2" width="40" height="32">
                <use xlink:href="#bootstrap"></use>
            </svg>
            <span class="fs-4">JussiNet</span>
        </a>
        <hr>
        <ul class="nav nav-pills flex-column mb-auto">
            <li class="nav-item">
                <a href="{{ url('/') }}" class="nav-link {{ request()->is('/') ? 'active' : 'text-white' }}"
                    aria-current="page">
                    <svg class="bi me-2" width="16" height="16">
                        <use xlink:href="{{ url('/') }}"></use>
                    </svg>
                    Home
                </a>
            </li>
            <li class="nav-item">
                <a href="{{ url('/about') }}" class="nav-link {{ request()->is('about') ? 'active' : 'text-white' }}">
                    <svg class="bi me-2" width="16" height="16">
                        <use xlink:href="{{ url('/about') }}"></use>
                    </svg>
                    About
                </a>
            </li>
            <li class="nav-item">
                <a href="{{ url('/docs') }}" class="nav-link {{ request()->is('docs') ? 'active' : 'text-white' }}">
                    <svg class="bi me-2" width="16" height="16">
                        <use xlink:href="{{ url('/docs') }}"></use>
                    </svg>
                    Documentations
                </a>
            </li>
            <li class="nav-item">
                <a href="{{ url('/donate') }}"
                    class="nav-link {{ request()->is('donate') ? 'active' : 'text-white' }}">
                    <svg class="bi me-2" width="16" height="16">
                        <use xlink:href="{{ url('/donate') }}"></use>
                    </svg>
                    Donate
                </a>
            </li>

            {{-- <li>
                <a href="{{ url('/customers') }}"
                    class="nav-link {{ request()->is('customers') ? 'active' : 'text-white' }}">
                    <svg class="bi me-2" width="16" height="16">
                        <use xlink:href="{{ url('/customers') }}"></use>
                    </svg>
                    Customers
                </a>
            </li> --}}
            <li class="nav-item">
                <a href="{{ url('/products') }}"
                    class="nav-link {{ request()->is('products') ? 'active' : 'text-white' }}">
                    <svg class="bi me-2" width="16" height="16">
                        <use xlink:href="{{ url('/products') }}"></use>
                    </svg>
                    Products
                </a>

                <ul class="submenu show text-small">
                    <li class="nav-item"><a class="nav-link {{ request()->is('product_cats') ? 'active' : 'text-white' }}" href="{{ url('/product_cats') }}">Categories</a></li>
                </ul>

            </li>

            
        </ul>
        <hr>
        <div class="dropdown">
            <a href="#" class="d-flex align-items-center text-white text-decoration-none dropdown-toggle"
                id="dropdownUser1" data-bs-toggle="dropdown" aria-expanded="false">
                <img src="https://github.com/PLACEHOLDER.png" alt="" width="32" height="32"
                    class="rounded-circle me-2">
                <strong>{{ Auth::user()->name }}</strong>
            </a>
            <ul class="dropdown-menu dropdown-menu-dark text-small shadow" aria-labelledby="dropdownUser1">
                <li><a class="dropdown-item" href="{{ url('profile') }}">Profile</a></li>
                <li>
                    <hr class="dropdown-divider">
                </li>
                <li><a class="dropdown-item" href="{{ url('logout') }}">Sign out</a></li>
            </ul>
        </div>
    </div>
</div>
