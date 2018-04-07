<aside class="main-sidebar">
    <section class="sidebar">
        <div class="user-panel">
            <div class="pull-left image">
                <img src="{{ asset('img/logo.png') }}" class="img-circle" alt="User Image">
            </div>
            <div class="pull-left info">
                <p>{{ Auth::user()->name }}</p>
                <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
            </div>
        </div>
        <ul class="sidebar-menu" data-widget="tree">
            <li class="header">MAIN NAVIGATION</li>
            <li class="treeview">
                <a href="#">
                    <i class="fa fa-dashboard"></i> <span>Dashboard</span>
                    <span class="pull-right-container">
                        <i class="fa fa-angle-left pull-right"></i>
                    </span>
                </a>
                <ul class="treeview-menu">
                    <li><a href="{{ url('/admin') }}"><i class="fa fa-circle-o"></i> Home</a></li>
                </ul>
            </li>
            <li><a href="{{ route('jurusan.index') }}"><i class="fa fa-tags"></i> <span>Jurusan</span></a></li>
            <li class="treeview">
                <a href="#">
                    <i class="fa fa-users"></i> <span>Data Mahasiswa</span>
                    <span class="pull-right-container">
                        <i class="fa fa-angle-left pull-right"></i>
                    </span>
                </a>
                <ul class="treeview-menu">
                    @foreach($mhsMenu as $menu)
                    <li><a href="{{ route('mahasiswa.jurusan', $menu->slug) }}"><i class="fa fa-circle-o"></i> {{ $menu->name }}</a></li>
                    @endforeach
                </ul>
            </li>
            <li class="treeview">
                <a href="#">
                    <i class="fa fa-graduation-cap"></i> <span>Data Alumni</span>
                    <span class="pull-right-container">
                        <i class="fa fa-angle-left pull-right"></i>
                    </span>
                </a>
                <ul class="treeview-menu">
                    <li><a href="{{ route('alumni.jurusan') }}"><i class="fa fa-circle-o"></i> Jumlah Alumni</a></li>
                    <li><a href="{{ route('alumni.index') }}"><i class="fa fa-circle-o"></i> Pekerjaan Alumni</a></li>
                </ul>
            </li>
            <li><a href="{{ route('beasiswa.index') }}"><i class="fa fa-money"></i> <span>Beasiswa</span></a></li>

            <li class="header">LAINNYA</li>
            <li><a href="{{ url('/') }}" target="_blank"><i class="fa fa-circle-o text-aqua"></i> <span>Lihat Halaman Utama</span></a></li>
            <li><a href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();"><i class="fa fa-circle-o text-red"></i> <span>Log Out</span></a></li>
        </ul>
    </section>
</aside>