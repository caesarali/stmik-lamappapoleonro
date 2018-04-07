@extends('layouts.admin.app')

@section('content')
    <div class="content-wrapper">
        {{-- Page Header --}}
        <section class="content-header">
            <h1>
                Jurusan
            </h1>
            <ol class="breadcrumb">
                <li><a href="{{ route('admin.home') }}"><i class="fa fa-dashboard"></i> Home</a></li>
                <li class="active">Jurusan</li>
            </ol>
        </section>

        {{-- Page Content --}}
        <section class="content">
            <div class="row">
                <div class="col-md-9">
                    <div class="box box-success">
                        <div class="box-header with-border">
                            <h3 class="box-title">Semua Jurusan</h3>
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
                            @if (session('error'))
                                <div class="alert alert-danger alert-dismissible fade in">
                                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                                    <h4><i class="icon fa fa-ban"></i> Kesalahan!</h4>
                                    {{ session('error') }}
                                </div>
                            @endif
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
                                        <th class="text-right">Opsi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse($jurusans as $jurusan)
                                    <tr>
                                        <td>{{ $loop->iteration }}.</td>
                                        <td>{{ $jurusan->name }}</td>
                                        <td>{{ $jurusan->jenjang }}</td>
                                        <td>{{ $jurusan->mahasiswa->where('status', '<', 2)->where('jk', 0)->count() }}</td>
                                        <td>{{ $jurusan->mahasiswa->where('status', '<', 2)->where('jk', 1)->count() }}</td>
                                        <td>{{ $jurusan->mahasiswa->where('status', '<', 2)->count() }}</td>
                                        <td>{{ date('Y') }}</td>
                                        <td class="text-right">
                                            <a href="{{ route('jurusan.edit', $jurusan->slug) }}" class="btn btn-xs btn-success btn-edit">
                                                <i class="fa fa-fw fa-pencil"></i>
                                            </a>
                                            <form action="{{ route('jurusan.destroy', $jurusan->id) }}" method="POST" style="display: inline;">
                                                {{ csrf_field() }}
                                                {{ method_field('DELETE') }}
                                                <button type="button" class="btn btn-xs btn-danger btn-delete">
                                                    <i class="fa fa-fw fa-trash"></i>
                                                </button>
                                            </form>
                                        </td>
                                    </tr>
                                    @empty
                                    <tr>
                                        <td class="text-center text-muted" colspan="7"><i>Belum ada data...</i></td>
                                    </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="box box-success box-edit box-form" style="display: none">
                        <div class="box-header with-border">
                            <h3 class="box-title">Edit Jurusan</h3>
                        </div>
                        <form></form>
                    </div>
                    <div class="box box-success box-add box-form">
                        <div class="box-header with-border">
                            <h3 class="box-title">Tambah Jurusan</h3>
                            <div class="box-tools pull-right">
                                <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="" data-original-title="Collapse">
                                    <i class="fa fa-minus"></i>
                                </button>
                                <button type="button" class="btn btn-box-tool" data-widget="remove" data-toggle="tooltip" title="" data-original-title="Remove">
                                    <i class="fa fa-times"></i>
                                </button>
                            </div>
                        </div>
                        <form action="{{ route('jurusan.store') }}" method="POST">
                            {{ csrf_field() }}
                            <div class="box-body">
                                <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                                    <label>Jurusan</label>
                                    <input type="text" class="form-control" value="{{ old('name') }}" placeholder="Nama Jurusan" name="name" required {{ $errors->has('name') ? ' autofocus' : '' }}>
                                    @if ($errors->has('name'))
                                        <span class="help-block">{{ $errors->first('name') }}</span>
                                    @endif
                                </div>
                                <div class="form-group{{ $errors->has('jenjang')  ? ' has-error' : '' }}">
                                    <label>Jenjang</label>
                                    <select name="jenjang" class="form-control" required>
                                        <option value="">-- Pilih --</option>
                                        <option value="D3">D3</option>
                                        <option value="S1">S1</option>
                                        <option value="S2">S2</option>
                                        <option value="S3">S3</option>
                                    </select>
                                    @if ($errors->has('jenjang'))
                                        <span class="help-block">{{ $errors->first('jenjang') }}</span>
                                    @endif
                                </div>
                            </div>
                            <div class="box-footer text-right">
                                <button class="btn btn-success" type="submit">
                                    Tambah Jurusan <i class="fa fa-fw fa-plus"></i>
                                </button> 
                                <button class="btn btn-default" type="reset">
                                    Batal
                                </button> 
                            </div>
                        </form>
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
                var konfirmasi = confirm('Anda yakin akan menghapus data jurusan ini ?');
                if (konfirmasi === true) {
                    $(this).parent('form').submit();
                }
            });
        });
    </script>
@endsection