@include('layout.header')
<div class="container-fluid">
    <div class="row flex-nowrap">
        @include('layout.sidebar')
        <div class="col py-3">
            @yield('content')
        </div>
    </div>
</div>
@include('layout.footer')
