@include('layouts.header')
<div class="container">
    <div class="row">
        <div class="col-lg-3">
            @include('layouts.login')
            @if (!(Request::path() == 'checkout'))
                @include('layouts.cart')
            @endif
            {{ menu('categories', 'menu.categories') }}
            <br>
        </div>
        <div class="col-lg-9">
            <div id="carouselExampleIndicators" class="carousel slide my-4" data-ride="carousel">
                @yield('slider')
            </div>
            <div class="row">
                @yield('products')
            </div>
            <br>
        </div>
    </div>
</div>
@include('layouts.footer')