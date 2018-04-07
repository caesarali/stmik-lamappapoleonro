@extends('layouts.admin.app')

@section('style')
    
@endsection

@section('content')
    <div class="content-wrapper">
        {{-- Page Header --}}
        <section class="content-header">
            <h1>
                Alumni <small>Per Jurusan</small>
            </h1>
            <ol class="breadcrumb">
                <li><a href="{{ route('admin.home') }}"><i class="fa fa-dashboard"></i> Home</a></li>
                <li class="active">Alumni</li>
            </ol>
        </section>

        {{-- Page Content --}}
        <section class="content">
            <div class="box box-success">
                <div class="box-header with-border">
                    <h3 class="box-title">Data Alumni</h3>
                    <div class="box-tools pull-right">
                        <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="" data-original-title="Collapse">
                            <i class="fa fa-minus"></i>
                        </button>
                        <button type="button" class="btn btn-box-tool" data-widget="remove" data-toggle="tooltip" title="" data-original-title="Remove">
                            <i class="fa fa-times"></i>
                        </button>
                    </div>
                </div>
                <div class="box-body">
                    <table class="table table-hovered">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Jurusan</th>
                                <th>Jenjang</th>
                                <th>Pria</th>
                                <th>Wanita</th>
                                <th>Jumlah</th>
                                <th>Tahun</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($mhsMenu as $jurusan)
                                <tr>
                                    <td>{{ $loop->iteration }}.</td>
                                    <td>{{ $jurusan->name }}</td>
                                    <td>{{ $jurusan->jenjang }}</td>
                                    <td>{{ $jurusan->mahasiswa->where('status', 2)->where('jk', 0)->count() }}</td>
                                    <td>{{ $jurusan->mahasiswa->where('status', 2)->where('jk', 1)->count() }}</td>
                                    <td>{{ $jurusan->mahasiswa->where('status', 2)->count() }}</td>
                                    <td>{{ date('Y') }}</td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="8" class="text-center text-muted"><i>Data tidak ditemukan...</i></td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                    <div class="text-center">
                        {{-- paginate --}}
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection