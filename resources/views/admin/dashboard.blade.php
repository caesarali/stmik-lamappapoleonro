@extends('layouts.admin.app')

@section('content')
    <div class="content-wrapper">
        {{-- Page Header --}}
        <section class="content-header">
            <h1>
            STMIK Lamappapoleonro Soppeng
            <small>Sistem Informasi Kemahasiswaan dan Alumni</small>
            </h1>
            <ol class="breadcrumb">
                <li><a href="#"><i class="fa fa-dashboard"></i> Dashboard</a></li>
                <li class="active">Home</li>
            </ol>
        </section>

        {{-- Page Content --}}
        <section class="content">
            <div class="row">
                <div class="col-lg-3 col-xs-6">
                    <div class="small-box bg-aqua">
                        <div class="inner">
                            <h3>{{ $jurusanCount }}</h3>
                            <p>Jurusan</p>
                        </div>
                        <div class="icon">
                            <i class="ion ion-bookmark"></i>
                        </div>
                        <a href="{{ route('jurusan.index') }}" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
                    </div>
                </div>
                <div class="col-lg-3 col-xs-6">
                    <div class="small-box bg-green">
                        <div class="inner">
                            <h3>{{ $mahasiswaCount }}</h3>
                            <p>Mahasiswa</p>
                        </div>
                        <div class="icon">
                            <i class="ion ion-person-stalker"></i>
                        </div>
                        <a href="{{ route('jurusan.index') }}" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
                    </div>
                </div>
                <div class="col-lg-3 col-xs-6">
                    <div class="small-box bg-yellow">
                        <div class="inner">
                            <h3>{{ $alumniCount }}</h3>
                            <p>Alumni</p>
                        </div>
                        <div class="icon">
                            <i class="ion ion-person-stalker"></i>
                        </div>
                        <a href="{{ route('alumni.index') }}" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
                    </div>
                </div>
                <div class="col-lg-3 col-xs-6">
                    <div class="small-box bg-red">
                        <div class="inner">
                            <h3>{{ $beasiswaCount }}</h3>
                            <p>Informasi Beasiswa</p>
                        </div>
                        <div class="icon">
                            <i class="ion ion-social-usd"></i>
                        </div>
                        <a href="{{ route('beasiswa.index') }}" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
                    </div>
                </div>
            </div>
            <div class="row">
                {{-- Content nya disini Pak --}}
            </div>
        </section>
    </div>
@endsection