<div id="layoutSidenav_nav">
    <nav class="sb-sidenav accordion sb-sidenav-dark" id="sidenavAccordion">
        <div class="sb-sidenav-menu">
            <div class="nav">
                <a class="nav-link" href="{{ route('admin_home') }}">
                    <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
                    Dashboard
                </a>
                <a class="nav-link" href="{{ route('admin_user_list') }}">
                    <div class="sb-nav-link-icon"><i class="fa fa-users"></i></div>
                    Users
                </a>
                <a class="nav-link" href="{{ route('brands.index') }}">
                    <div class="sb-nav-link-icon"><i class="fa fa-list"></i></div>
                    Brands
                </a>
                <a class="nav-link" href="{{ route('products.index') }}">
                    <div class="sb-nav-link-icon"><i class="fa fa-archive"></i></div>
                    Products
                </a>
                <a class="nav-link" href="{{ route('admin_order_list') }}">
                    <div class="sb-nav-link-icon"><i class="fa fa-truck"></i></div>
                    Orders
                </a>
                <a class="nav-link" href="">
                    <div class="sb-nav-link-icon"><i class="fa fa-tag"></i></div>
                    Discounts
                </a>
                <a class="nav-link" href="#">
                    <div class="sb-nav-link-icon"><i class="fa fa-credit-card"></i></div>
                    Transactions
                </a>
                <a class="nav-link" href="{{ route('home') }}">
                    <div class="sb-nav-link-icon"><i class="fa fa-link"></i></div>
                    Visit Site
                </a>
            </div>
        </div>
        <div class="sb-sidenav-footer">
            <div class="small">Logged in as:</div>
            E-Commerce Admin
        </div>
    </nav>
</div>
