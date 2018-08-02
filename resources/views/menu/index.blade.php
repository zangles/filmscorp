<nav class="navbar-default navbar-static-side" role="navigation">
    <div class="sidebar-collapse">
        <ul class="nav" id="side-menu">
            <li class="nav-header">
                <div class="dropdown profile-element"> <span>
                            <img alt="image" class="img-circle" src="{{ asset('img/profile_small.jpg') }}" />
                             </span>
                    <a data-toggle="dropdown" class="dropdown-toggle" href="#">
                            <span class="clear"> <span class="block m-t-xs"> <strong class="font-bold">{{ Auth::user()->name }}</strong>
                    <ul class="dropdown-menu animated fadeInRight m-t-xs">
                        <li><a href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">Logout</a></li>
                    </ul>
                </div>
                <div class="logo-element">
                    IN+
                </div>
            </li>
            <li>
                <a href="index.html"><i class="fa fa-th-large"></i> <span class="nav-label">Dashboards</span> <span class="fa arrow"></span></a>
                <ul class="nav nav-second-level">
                    <li ><a href="index.html">Dashboard v.1</a></li>
                    <li ><a href="dashboard_2.html">Dashboard v.2</a></li>
                    <li ><a href="dashboard_3.html">Dashboard v.3</a></li>
                    <li ><a href="dashboard_4_1.html">Dashboard v.4</a></li>
                </ul>
            </li>
            <li>
                <a href="{{ route('products.index') }}"><i class="fa fa-bar-chart-o"></i> <span class="nav-label">Productos</span></a>
            </li>
            <li>
                <a href="{{ route('categories.index') }}"><i class="fa fa-bar-chart-o"></i> <span class="nav-label">Categorias</span></a>
            </li>
            <li>
                <a href="{{ route('sales.index') }}"><i class="fa fa-bar-chart-o"></i> <span class="nav-label">Ventas</span></a>
            </li>
            <li>
                <a href="{{ route('search') }}"><i class="fa fa-bar-chart-o"></i> <span class="nav-label">Busqueda</span></a>
            </li>
        </ul>
    </div>
</nav>