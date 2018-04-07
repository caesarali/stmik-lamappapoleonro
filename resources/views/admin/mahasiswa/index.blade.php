@extends('layouts.admin.app')

@section('content')
    <div class="content-wrapper">
        {{-- Page Header --}}
        <section class="content-header">
            <h1>
                Mahasiswa <small>{{ $jurusan->name }}</small>
            </h1>
            <ol class="breadcrumb">
                <li><a href="{{ route('admin.home') }}"><i class="fa fa-dashboard"></i> Home</a></li>
                <li class="active">Mahasiswa</li>
            </ol>
        </section>

        {{-- Page Content --}}
        <section class="content">
            <div class="row">
                <div class="col-md-9">
                    <div class="box box-success">
                        <div class="box-header with-border">
                            <h3 class="box-title">{{ $jurusan->name }}</h3>
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
                                <div class="col-md-offset-5 col-md-7">
                                    <form action="{{ route('mahasiswa.jurusan', $jurusan->slug) }}" class="form-inline text-right" method="GET">
                                        <div class="form-group">
                                            <div class="input-group">
                                                <input type="text" name="stambuk" value="{{ $key or '' }}" class="form-control" placeholder="Stambuk..." onkeypress="return hanyaAngka(event)" maxlength="10">
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
                                        <th>Stambuk</th>
                                        <th>Nama</th>
                                        <th>Jenis Kelamin</th>
                                        <th>Tahun Masuk</th>
                                        <th>Status</th>
                                        <th class="text-right">Opsi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse ($mahasiswas as $mahasiswa)
                                    <tr>
                                        <td>{{ $loop->iteration }}.</td>
                                        <td><b>{{ $mahasiswa->stambuk }}</b></td>
                                        <td>{{ $mahasiswa->name }}</td>
                                        <td>{{ $mahasiswa->jk === 0 ? 'Pria' : 'Wanita' }}</td>
                                        <td>{{ $mahasiswa->tahun->tahun }}</td>
                                        <td>{!! $mahasiswa->status === 1 ? '<label class="label label-primary">Aktif</label>' : '<label class="label label-warning">Cuti</label>' !!}</td>
                                        <td class="text-right">
                                            <a href="{{ route('mahasiswa.edit', $mahasiswa->stambuk) }}" class="btn btn-xs btn-success">
                                                <i class="fa fa-fw fa-pencil"></i>
                                            </a>
                                            <form action="{{ route('mahasiswa.destroy', $mahasiswa->id) }}" method="POST" style="display: inline;">
                                                {{ csrf_field() }}
                                                {{ method_field('DELETE') }}
                                                <button class="btn btn-xs btn-danger btn-delete"><i class="fa fa-fw fa-trash"></i></button>
                                            </form>
                                        </td>
                                    </tr>
                                    @empty
                                    <tr>
                                        <td class="text-muted text-center" colspan="7"><i>Data tidak ditemukan...</i></td>
                                    </tr>
                                    @endforelse
                                </tbody>
                            </table>
                            <div class="text-center">
                                {{ $mahasiswas->links() }}
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="box box-success">
                        <div class="box-header with-border">
                            <h3 class="box-title">Mahasiswa</h3>
                        </div>
                        <form action="{{ route('mahasiswa.store') }}" method="POST">
                            {{ csrf_field() }}
                            <input type="hidden" name="jurusan_id" value="{{ $jurusan->id }}">
                            <div class="box-body">
                                <div class="form-group{{ $errors->has('stambuk') ? ' has-error' : '' }}">
                                    <label>Stambuk</label>
                                    <input type="text" name="stambuk" class="form-control" placeholder="Stambuk / NIM / NPM" value="{{ old('stambuk') }}" onkeypress="return hanyaAngka(event)" maxlength="10" required>
                                    @if ($errors->has('stambuk'))
                                        <span class="help-block">{{ $errors->first('stambuk') }}</span>
                                    @endif
                                </div>
                                <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                                    <label>Nama</label>
                                    <input type="text" name="name" class="form-control" value="{{ old('name') }}" placeholder="Nama Lengkap" required>
                                    @if ($errors->has('name'))
                                        <span class="help-block">{{ $errors->first('name') }}</span>
                                    @endif
                                </div>
                                <div class="form-group{{ $errors->has('jk') ? ' has-error' : '' }}">
                                    <label>Jenis Kelamin</label>
                                    <div class="radio">
                                        <label>
                                          <input type="radio" name="jk" value="0" checked> Pria
                                        </label>
                                    </div>
                                    <div class="radio">
                                        <label>
                                          <input type="radio" name="jk" value="1"> Wanita
                                        </label>
                                    </div>
                                    @if ($errors->has('jk'))
                                        <span class="help-block">{{ $errors->first('jk') }}</span>
                                    @endif
                                </div>
                                <div class="form-group{{ $errors->has('tahun') ? ' has-error' : '' }}">
                                    <label>Tahun Masuk</label>
                                    <input type="text" name="tahun" class="form-control" value="{{ old('tahun') }}" list="tahun" maxlength="4" onkeypress="return hanyaAngka(event)" placeholder="20xx" required>
                                    <datalist id="tahun">
                                        @foreach ($tahun as $thn)
                                        <option value="{{ $thn->tahun }}">
                                        @endforeach
                                    </datalist>
                                    @if ($errors->has('tahun'))
                                        <span class="help-block">{{ $errors->first('tahun') }}</span>
                                    @endif
                                </div>
                            </div>
                            <div class="box-footer text-right">
                                <button class="btn btn-success" type="submit">Simpan <i class="fa fa-fw fa-check"></i></button>
                                <button class="btn btn-default" type="reset">Reset</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </section>

        <section>
            <div id="modalConfirm" class="modal fade">
                <div class="modal-dialog modal-sm">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body text-center">
                            <i class="fa fa-3x fa-trash text-danger"></i>
                            <h4><i>Yakin ingin menghapus data ini ?</i></h4>
                        </div>
                        <div class="modal-footer">
                            <button class="btn btn-success">Ya, hapus!</button>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection

@section('scripts')
    <script>
        function hanyaAngka(evt) {
            var charCode = (evt.which) ? evt.which : event.keyCode
            if (charCode > 31 && (charCode < 48 || charCode > 57))
                return false;
            return true;
        }

        $(document).ready(function() {
            $('.btn-delete').click(function(event) {
                event.preventDefault();
                var konfirmasi = confirm('Yakin ingin menghapus data ini ?');
                if (konfirmasi === true) {
                    $(this).parent('form').submit();
                }
            });

            $('input[name=key]').on('keyup', function(event) {
                event.preventDefault();
                if ($(this).val() === '') {
                    window.location.href = '{{ route('mahasiswa.index') }}'
                }
            });
        });
    </script>
@endsection