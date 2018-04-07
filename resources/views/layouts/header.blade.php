<header class="main-header">
    <nav class="navbar navbar-static-top">
        <div class="container">
            <div class="navbar-header">
                <a href="{{ route('home') }}" class="navbar-brand">
                    <img style="width: 70px;" src="{{ asset('img/logo.png') }}" alt="STMIK Lamappapoleonro Soppeng">
                    <b>STMIK Lamappapoleonro Soppeng</b>
                </a>
                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar-collapse">
                    <i class="fa fa-bars"></i>
                </button>
            </div>

            <div class="collapse navbar-collapse" id="navbar-collapse">
                <ul class="nav navbar-nav navbar-right">
                    <li><a href="{{ route('home') }}">Home <span class="sr-only">(current)</span></a></li>
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown">Data Mahasiswa <span class="caret"></span></a>
                        <ul class="dropdown-menu" role="menu">
                            <li><a href="{{ route('jurusan') }}">Data Mahasiswa</a></li>
                            <li class="divider"></li>
                            @foreach($mhsMenu as $menu)
                                <li><a href="{{ route('mahasiswa', $menu->slug) }}">{{ $menu->name }}</a></li>
                            @endforeach
                        </ul>
                    </li>
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown">Data Alumni <span class="caret"></span></a>
                        <ul class="dropdown-menu" role="menu">
                            <li><a href="{{ route('alumni') }}">Data Alumni</a></li>
                            <li><a href="{{ route('alumni.job') }}">Pekerjaan Alumni</a></li>
                        </ul>
                    </li>
                    <li><a href="{{ route('beasiswa.info') }}">Informasi Baesiswa</a></li>
                    <li class="hidden-xs">
                        <div class="navbar-form">
                            <a href="{{ route('admin.home') }}" target="_blank" class="btn btn-success">Admin Area</a>
                        </div>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
</header>