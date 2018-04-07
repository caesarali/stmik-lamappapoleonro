@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            
            <section class="content-header">
                <h1>
                    Alumni
                    <small>Jumlah Alumni Per Jurusan</small>
                </h1>
                <ol class="breadcrumb">
                    <li><a href="#"><i class="fa fa-home"></i> Home</a></li>
                    <li class="active">Data Alumni</li>
                </ol>
            </section>
            <section class="content">
                <div class="box box-success">
                    <div class="box-header with-border">
                        <h3 class="box-title">Data Alumni</h3>

                        <div class="box-tools pull-right">
                            <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                            </button>
                            <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
                        </div>
                    </div>
                    <div class="box-body">
                        <table class="table table-hovered">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Jurusan</th>
                                    <th class="text-center">Jenjang</th>
                                    <th class="text-center">Pria</th>
                                    <th class="text-center">Wanita</th>
                                    <th class="text-center">Jumlah</th>
                                    <th class="text-center">Tahun Akamedik</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($mhsMenu as $jurusan)
                                    <tr>
                                        <td>{{ $loop->iteration }}.</td>
                                        <td>{{ $jurusan->name }}</td>
                                        <td class="text-center">{{ $jurusan->jenjang }}</td>
                                        <td class="text-center">{{ $jurusan->mahasiswa->where('status', 2)->where('jk', 0)->count() }}</td>
                                        <td class="text-center">{{ $jurusan->mahasiswa->where('status', 2)->where('jk', 1)->count() }}</td>
                                        <td class="text-center">{{ $jurusan->mahasiswa->where('status', 2)->count() }}</td>
                                        <td class="text-center">{{ date('Y') }}</td>
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
