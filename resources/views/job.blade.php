@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            
            <section class="content-header">
                <h1>
                    Alumni <small>Data Pekerjaan Alumni</small>
                </h1>
                <ol class="breadcrumb">
                    <li><a href="{{ route('home') }}"><i class="fa fa-home"></i> Home</a></li>
                    <li><a href="{{ route('alumni') }}"> Alumni</a></li>
                    <li class="active">Data Pekerjaan Alumni</li>
                </ol>
            </section>
            <section class="content">
                <div class="box box-success">
                    <div class="box-header with-border">
                        <h3 class="box-title">Data Pekerjaan Alumni</h3>

                        <div class="box-tools pull-right">
                            <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                            </button>
                            <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
                        </div>
                    </div>
                    <div class="box-body">
                        <form action="{{ route('alumni.job') }}" class="form-inline text-right">
                            <div class="form-group">
                                <div class="input-group">
                                    <input type="text" name="keyword" class="form-control" placeholder="Nama alumni...">
                                    <div class="input-group-btn">
                                        <button class="btn btn-default" type="submit">
                                            <i class="glyphicon glyphicon-search"></i>
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </form>
                        <table class="table table-hovered">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Nama</th>
                                    <th>Jurusan</th>
                                    <th>Nama Instansi</th>
                                    <th>Alamat Instansi</th>
                                    <th>Jabatan</th>
                                    <th class="text-center">Tahun Masuk</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($alumnus as $alumni)
                                    <tr>
                                        <td>{{ $loop->iteration }}.</td>
                                        <td>{{ $alumni->name }}</td>
                                        <td>{{ $alumni->jurusan->jenjang .' '. $alumni->jurusan->name }}</td>
                                        <td>{{ $alumni->alumni->nama_inst }}</td>
                                        <td>{{ $alumni->alumni->alamat_inst }}</td>
                                        <td>{{ $alumni->alumni->jabatan->name }}</td>
                                        <td class="text-center">{{ $alumni->alumni->tahun->tahun }}</td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="7" class="text-center text-muted"><i>Data tidak ditemukan...</i></td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </section>
        </div>
    </div>
</div>
@endsection
