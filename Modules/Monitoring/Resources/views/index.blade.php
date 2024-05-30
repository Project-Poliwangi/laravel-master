@extends('layouts.master')

@section('content')
<!-- page-->
<div class="page-wrapper">
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

        <!-- page-->
        <div class="page-container2">
            <!-- header-->
            <header class="header-desktop2">
                <div class="section__content section__content--p30">
                    <div class="container-fluid">
                        <div class="header-wrap2">
                            <div class="logo d-block d-lg-none">
                                <a href="#">
                                    <img src="images/icon/logo-white.png" alt="CoolAdmin" />
                                </a>
                            </div>
                            <div class="header-button2">
                                <div class="header-button-item js-item-menu">
                                    <i class="zmdi zmdi-menu"></i>
                                    <div class="notifi-dropdown js-dropdown">
                                        <div class="notifi__item">
                                            <div class="bg-c1 img-cir img-40">
                                                <a href="#">
                                                <i class="zmdi zmdi-account-box"></i></a>
                                            </div>
                                            <div class="content">
                                                <p>Profil</p>
                                            </div>
                                        </div>
                                        <div class="notifi__item">
                                            <div class="bg-c2 img-cir img-40">
                                                <a href="#">
                                                <i class="fa-solid fa-address-card"></i></a>
                                            </div>
                                            <div class="content">
                                                <p>Hak Akses</p>
                                            </div>
                                        </div>
                                        <div class="notifi__item">
                                            <div class="bg-c3 img-cir img-40">
                                                <a href="#">
                                                <i class="fa-solid fa-right-from-bracket"></i></a>
                                            </div>
                                            <div class="content">
                                                <p>Logout</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </header>
            <!-- end-->

            <!-- label-->
            <section class="au-breadcrumb m-t-75">
                <div class="section__content section__content--p30">
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="au-breadcrumb-content">
                                    <div class="au-breadcrumb-left">
                                        <h2><b>Dashboard</b></h2>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
            <!-- label-->

            <!-- info box-->
            <section class="statistic">
                <div class="section__content section__content--p30">
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-md-6 col-lg-3">
                                <div class="statistic__item">
                                    <h2 class="number">10</h2>
                                    <span class="desc">KPA</span>
                                    <div class="icon">
                                        <i class="zmdi zmdi-account-o"></i>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6 col-lg-3">
                                <div class="statistic__item">
                                    <h2 class="number">20</h2>
                                    <span class="desc">PPK</span>
                                    <div class="icon">
                                        <i class="zmdi zmdi-account-o"></i>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6 col-lg-3">
                                <div class="statistic__item">
                                    <h2 class="number">30</h2>
                                    <span class="desc">Program</span>
                                    <div class="icon">
                                        <i class="zmdi zmdi-calendar-note"></i>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6 col-lg-3">
                                <div class="statistic__item">
                                    <h2 class="number">40</h2>
                                    <span class="desc">Kegiatan</span>
                                    <div class="icon">
                                        <i class="zmdi zmdi-calendar-note"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
            <!-- end-->

            <section>
                <div class="section__content section__content--p30">
                    <div class="container-fluid">
                        <div class="row equal-height">

                            <!-- chart-->
                            <div class="col-xl-8 mb-4">
                                <div class="recent-report2 h-100">
                                    <h3 class="title-3">Realisasi Keuangan</h3>
                                    <div class="chart-info-right">
                                        <div class="rs-select2--dark rs-select2--sm dropdown-left">
                                            <select class="js-select2 au-select-dark" name="time">
                                                <option selected="selected">Monitoring</option>
                                                <option value="">Bulan</option>
                                                <option value="">Tahun</option>
                                            </select>
                                            <div class="dropDownSelect2"></div>
                                        </div>
                                    </div>
                                    <div class="recent-report__chart">
                                        <canvas id="lineChart"></canvas>
                                    </div>
                                </div>
                            </div>
                            <!-- end-->

                            <!-- progres-->
                            <div class="col-xl-4 mb-4">
                                <div class="table-responsive table-data ">
                                    <table class="table table-striped table-earning">
                                        <thead>
                                            <tr>
                                                <th>Bulan</th>
                                                <th>TK</th>
                                                <th>RK</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td>Januari</td>
                                                <td>100</td>
                                                <td>100</td>
                                            </tr>
                                            <tr>
                                                <td>Februari</td>
                                                <td>200</td>
                                                <td>200</td>
                                            </tr>
                                            <tr>
                                                <td>Maret</td>
                                                <td>300</td>
                                                <td>300</td>
                                            </tr>
                                            <tr>
                                                <td>April</td>
                                                <td>400</td>
                                                <td>400</td>
                                            </tr>
                                            <tr>
                                                <td>Mei</td>
                                                <td>500</td>
                                                <td>500</td>
                                            </tr>
                                            <tr>
                                                <td>Juni</td>
                                                <td>600</td>
                                                <td>600</td>
                                            </tr>
                                            <tr>
                                                <td>Juli</td>
                                                <td>700</td>
                                                <td>700</td>
                                            </tr>
                                            <tr>
                                                <td>Agustus</td>
                                                <td>800</td>
                                                <td>800</td>
                                            </tr>
                                            <tr>
                                                <td>September</td>
                                                <td>900</td>
                                                <td>900</td>
                                            </tr>
                                            <tr>
                                                <td>Oktober</td>
                                                <td>1000</td>
                                                <td>1000</td>
                                            </tr>
                                            <tr>
                                                <td>November</td>
                                                <td>2000</td>
                                                <td>2000</td>
                                            </tr>
                                            <tr>
                                                <td>Desember</td>
                                                <td>3000</td>
                                                <td>3000r</td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            <!-- end-->

                            <!-- chart-->
                            <div class="col-xl-6">
                                <div class="recent-report2">
                                    <h3 class="title-3">Realisasi Keuangan</h3>
                                    <div class="recent-report__chart">
                                        <canvas id="doughutChart"></canvas>
                                    </div>
                                </div>
                            </div>
                            <!-- end-->

                            <!-- info anggaran-->
                            <div class="col-xl-6">
                                <div class="statistic__item">
                                    <span class="desc">Total Anggaran</span>
                                    <h2 class="number">$ 100.000.000</h2>
                                    <div class="icon">
                                        <i class="zmdi zmdi-money"></i>
                                    </div>
                                </div>
                                <div class="statistic__item">
                                    <span class="desc">Total Serapan</span>
                                    <h2 class="number">$ 50.000.000</h2>
                                    <div class="icon">
                                        <i class="zmdi zmdi-money"></i>
                                    </div>
                                </div>
                                <div class="statistic__item">
                                    <span class="desc">Sisa Anggaran</span>
                                    <h2 class="number">$ 50.000.000</h2>
                                    <div class="icon">
                                        <i class="zmdi zmdi-money"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- end-->

                        <!-- SKPD-->>
                        <div class="col-lg-12">
                            <div class="user-data m-b-30">
                                <div class="filters m-b-45">
                                    <div class="rs-select2--dark rs-select2--md m-r-10 rs-select2--border">
                                        <select class="js-select2" name="property">
                                            <option selected="selected">All Properties</option>
                                            <option value="">Tertinggi</option>
                                            <option value="">Terendah</option>
                                        </select>
                                        <div class="dropDownSelect2"></div>
                                    </div>
                                </div>
                                <div class="table-responsive table-data">
                                    <table class="table table-striped table-earning">
                                        <thead>
                                            <tr>
                                                <th>SKPD Serapan Tertinggi</th>
                                                <th>Fisik</th>
                                                <th>Persentase</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td>Kejuruan</td>
                                                <td>100</td>
                                                <td>100</td>
                                            </tr>
                                            <tr>
                                                <td>Kemahasiswaan</td>
                                                <td>200</td>
                                                <td>200</td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                        <!-- end-->>
                    </div>
                </div>
            </section>
        </div>
    </div>
    <!-- end page-->
@endsection