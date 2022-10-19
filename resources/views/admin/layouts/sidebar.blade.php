  <div id="layoutSidenav_nav">
        <nav class="sb-sidenav accordion sb-sidenav-dark" id="sidenavAccordion">
            <div class="sb-sidenav-menu">
                <div class="nav">
                    <div class="sb-sidenav-menu-heading">Core</div>
                    <a class="nav-link" href="{{ route('home')}}">
                        <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
                        Trang chủ
                    </a>
                    <div class="sb-sidenav-menu-heading">Interface</div>
                    
                    <a class="nav-link collapsed" href="{{ route('users.index')}}">
                        <div class="sb-nav-link-icon"></div>
                        Danh Sách Người Dùng
                        <div class="sb-sidenav-collapse-arrow"></div>
                    </a>
                    <a class="nav-link collapsed" href="{{ route('products.index')}}">
                        <div class="sb-nav-link-icon"></div>
                        Danh Sách Sản Phẩm
                        <div class="sb-sidenav-collapse-arrow"></div>
                    </a>
                    <a class="nav-link collapsed" href="{{ route('list_orders')}}">
                        <div class="sb-nav-link-icon"></div>
                        Danh Sách Đơn Hàng
                        <div class="sb-sidenav-collapse-arrow"></div>
                    </a>
                </div>
            </div>
        </nav>
    </div>