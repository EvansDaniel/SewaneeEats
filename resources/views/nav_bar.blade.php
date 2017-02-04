<link rel="stylesheet" href="{{asset('css/nav_bar.css')}}">
<nav class="navbar navbar-default navbar-custom navbar-fixed-top row">
    <button type="button" id="collapse-button" class="navbar-toggle" data-toggle="collapse"
            data-target="#navDiv">
        <span class="sr-only">Toggle navigation</span>
        Menu </button>
    <div class="collapse navbar-collapse" id="navDiv">
        <ul id="navV" class="nav navbar-nav">
            <li><a class="active nav-links" href="{{ route('home') }}">MOUNTAIN EATS</a></li>
            <li><a class="nav-links" href="{{ route('list_restaurants') }}">ORDER ONLINE</a></li>
            <li><a class="nav-links" href="{{ route('about') }}">ABOUT</a></li>
            <li><a class="nav-links" href="{{ route('showShoppingCart') }}">CART</a></li>
            @if(!empty(Session::get('cart')))
                <li><a class="nav-links" href="{{ route('checkout') }}">CHECKOUT</a></li>
            @endif
            @if(Auth::check() && Auth::user()->hasRole('admin'))
                <li><a class="nav-links" href="{{ route('showAdminDashboard') }}">ADMIN DASHBOARD</a></li>
            @endif
        </ul>
    </div>
</nav>