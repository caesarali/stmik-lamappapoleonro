@extends('layouts.admin.app')

@section('style')
    
@endsection

@section('content')
    <div class="content-wrapper">
        {{-- Page Header --}}
        <section class="content-header">
            <h1>
                Alumni <small>Data Pekerjaan Alumni</small>
            </h1>
            <ol class="breadcrumb">
                <li><a href="{{ route('admin.home') }}"><i class="fa fa-dashboard"></i> Home</a></li>
                <li><a href="{{ route('alumni.jurusan') }}"> Alumni</a></li>
                <li class="active">Data Pekerjaan Alumni</li>
            </ol>
        </section>

        {{-- Page Content --}}
        <section class="content">
            <div class="box box-success">
                <div class="box-header with-border">
                    <h3 class="box-title">Data Pekerjaan Alumni</h3>
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
                    @if (session('success'))
                    <div class="alert alert-success alert-dismissible fade in">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                        <h4><i class="icon fa fa-check"></i> Berhasil!</h4>
                        {{ session('success') }}
                    </div>
                    @endif
                    <div class="row">
                        <div class="col-md-5">
                            <a href="{{ route('alumni.create') }}" class="btn btn-success">
                                <i class="fa fa-fw fa-plus"></i> Tambah Data Alumni
                            </a>
                        </div>
                        <div class="col-md-7">
                            <form action="{{ route('alumni.index') }}" class="form-inline text-right">
                                <div class="form-group">
                                    <div class="input-group">
                                        <input type="text" name="keyword" value="{{ $key or '' }}" class="form-control" placeholder="Nama alumni...">
                                        <div class="input-group-btn">
                                            <button class="btn btn-default" type="submit">
                                                <i class="glyphicon glyphicon-search"></i>
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                    <table class="table table-hovered">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Nama</th>
                                <th>Jurusan</th>
                                <th>Nama Instansi</th>
                                <th>Alamat Instansi</th>
                                <th>Jabatan</th>
                                <th>Tahun Masuk</th>
                                <th class="text-right">Opsi</th>
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
                                    <td>{{ $alumni->alumni->tahun->tahun }}</td>
                                    <td class="text-right">
                                        <a href="{{ route('alumni.edit', $alumni->stambuk) }}" class="btn btn-xs btn-success">
                                            <i class="fa fa-fw fa-pencil"></i>
                                        </a>
                                        <form action="{{ route('alumni.destroy', $alumni->alumni->id) }}" method="POST" style="display: inline;">
                                            {{ csrf_field() }}
                                            {{ method_field('DELETE') }}
                                            <button class="btn btn-xs btn-danger btn-delete"><i class="fa fa-fw fa-trash"></i></button>
                                        </form>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="8" class="text-center text-muted"><i>Data tidak ditemukan...</i></td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                    <div class="text-center">
                        {{ $alumnus->links() }}
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection

@section('scripts')
    <script>
        $(document).ready(function() {
            $('.btn-delete').click(function(event) {
                event.preventDefault();
                var konfirmasi = confirm('Anda yakin ingin menghapus data alumni ini ?');
                if (konfirmasi === true) {
                    $(this).parent('form').submit();
                }
            });

            $('input[name=key]').on('keyup', function(event) {
                event.preventDefault();
                if ($(this).val() === '') {
                    window.location.href = '#'
                }
            });
        });
    </script>
@endsection