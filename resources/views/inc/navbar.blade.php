<nav class="navbar navbar-inverse">
        <div class="container">
            <div class="navbar-header">

                <!-- Collapsed Hamburger -->
                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#app-navbar-collapse">
                    <span class="sr-only">Toggle Navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>

                <!-- Branding Image -->
                <a class="navbar-brand" href="{{ url('/') }}">
                    <span class="glyphicon glyphicon-leaf" style="font-size:1em;color:green"></span><b>{{ config('app.name', 'LongLifeMicro') }}</b>
                </a>
            </div>

            <div class="collapse navbar-collapse" id="app-navbar-collapse">
                <!-- Left Side Of Navbar -->
                <ul class="nav navbar-nav">
                    &nbsp;
                </ul>
                <ul class="nav navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link" href="/">Home <span class="sr-only">(current)</span></a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="/blogview">Blog </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="/services">Services </a>
                        </li>
                    <li class="nav-item">
                        <a class="nav-link" href="/store">Store </a>
                    </li>
                    
                </ul> 

                <!-- Right Side Of Navbar -->
                
                <ul class="nav navbar-nav navbar-right">
                    @if (Session::has('cart'))
                        <li>
                            <a href = "/getCart" class="" style="text-decoration: none;">
                                Shopping Cart : <span class="glyphicon glyphicon-shopping-cart" style="font-size: 1em"></span><span class="badge" style="padding-bottom: 5px"><b>{{ Session::has('cart') ? Session::get('cart')->totalQuantity : ''}}</b></span>
                            </a>
                        </li>
                    @endif
                    <!-- Authentication Links -->
                    @if (Auth::guest())
                        <li><a href="{{ route('login') }}">Login</a></li>
                        <li><a href="{{ route('register') }}">Register</a></li>
                    @else
                        <li class="dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                                {{ Auth::user()->name }} <span class="caret"></span>
                            </a>

                            <ul class="dropdown-menu" role="menu">
                                <li><a href="/dashboard">Dashboard</a></li>
                                <li>
                                    <a href="{{ route('logout') }}"
                                        onclick="event.preventDefault();
                                                 document.getElementById('logout-form').submit();">
                                        Logout
                                    </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                        {{ csrf_field() }}
                                    </form>
                                </li>
                            </ul>
                        </li>
                    @endif
                </ul>
            </div>
        </div>
    </nav>