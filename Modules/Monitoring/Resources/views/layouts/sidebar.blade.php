<!-- sidebar-->
<aside class="menu-sidebar2">
    <div class="logo">
        <a href="#">
            <img src="images/icon/logo-white.png" alt="Cool Admin" />
        </a>
    </div>
    <div class="menu-sidebar2__content js-scrollbar2">
        <div class="account2">
            <div class="image img-cir img-120">
                <img src="images/icon/avatar-big-01.jpg" alt="John Doe" />
            </div>
            <h4 class="name">Username</h4>
        </div>
        <div class="menu-sidebar2__content js-scrollbar1">
            <nav class="navbar-sidebar2">
                <ul class="list-unstyled navbar__list">
                    <li>
                        <a class="js-arrow" href="#">
                            <i class="fas fa-tachometer-alt"></i>Dashboard
                        </a>
                    </li>
                    <li>
                        <a class="js-arrow" href="#">
                            <i class="fas fa-solid fa-tv"></i>Monitoring
                            <span class="arrow">
                                <i class="fas fa-angle-down"></i>
                            </span>
                        </a>
                        <ul class="list-unstyled navbar__sub-list js-sub-list">
                            <li>
                                <a href="{{route('perencanaan.index')}}">
                                    <i class="fas fa-solid fa-chart-line"></i>Perencanaan</a>
                            </li>
                            <li>
                                <a href="{{route('realisasi.index')}}">
                                    <i class="fas fa-regular fa-list-check"></i>Realisasi</a>
                            </li>
                            <li>
                                <a href="{{route('laporan.index')}}">
                                    <i class="fas fa-regular fa-note-sticky"></i>Laporan</a>
                            </li>
                        </ul>
                    </li>
                </ul>
            </nav>
        </div>
    </div>
</aside>
<!-- end-->
