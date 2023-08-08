<div class="navigation">
    <ul>
        @auth
            <li><a href="{{ url('/') }}">Index</a></li>
            <li><a href="{{ url('/about') }}">About me</a></li>
            <li><a href="{{ url('/docs') }}">Documenation</a></li>
            <li><a href="{{ url('/donate') }}">Donate</a></li>
            <li><a href="{{ url('/logout') }}">Logout</a></li>
        @endauth
        {{-- @guest
            <li><a href="{{ url('/login') }}">Login</a></li>
        @endguest --}}
    </ul>
</div>