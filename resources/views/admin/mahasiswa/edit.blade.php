@extends('layouts.admin.app')

@section('content')
    <div class="content-wrapper">
        {{-- Page Header --}}
        <section class="content-header">
            <h1>
                Mahasiswa
                <small>Edit Data</small>
            </h1>
            <ol class="breadcrumb">
                <li><a href="{{ route('admin.home') }}"><i class="fa fa-dashboard"></i> Home</a></li>
                <li><a href="{{ route('mahasiswa.jurusan', $mahasiswa->jurusan->slug) }}"> Mahasiswa</a></li>
                <li class="active">Edit Data</li>
            </ol>
        </section>

        {{-- Page Content --}}
        <section class="content">
            <div class="row">
                <div class="col-md-8 col-md-offset-2">
                    <div class="box box-success">
                        <div class="box-header with-border">
                            <a href="{{ route('mahasiswa.jurusan', $mahasiswa->jurusan->slug) }}" class="btn btn-sm btn-default pull-left"><i class="fa fa-fw fa-arrow-left"></i> Kembali</a>
                            <div class="text-center" style="padding-top: 6px">
                                <h3 class="box-title">Edit data</h3>
                            </div>
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
                            <div class="row">
                                <div class="col-md-8 col-md-offset-2">
                                    <form action="{{ route('mahasiswa.update', $mahasiswa->id) }}" method="POST" class="form-horizontal">
                                        {{ csrf_field() }}
                                        {{ method_field('PUT') }}
                                        <div class="form-group{{ $errors->has('stambuk') ? ' has-error' : '' }}">
                                            <label class="control-label col-sm-3">Stambuk</label>
                                            <div class="col-sm-9">
                                                <input type="text" class="form-control" name="stambuk" value="{{ old('stambuk') ? old('stambuk') : $mahasiswa->stambuk }}" onkeypress="return hanyaAngka(event)" maxlength="10" required autofocus>
                                                @if ($errors->has('stambuk'))
                                                    <span class="help-block">{{ $errors->first('stambuk') }}</span>
                                                @endif
                                            </div>
                                        </div>
                                        <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                                            <label class="control-label col-sm-3">Nama</label>
                                            <div class="col-sm-9">
                                                <input type="text" class="form-control" name="name" value="{{ old('name') ? old('name') : $mahasiswa->name }}" required>
                                                @if ($errors->has('name'))
                                                    <span class="help-block">{{ $errors->first('name') }}</span>
                                                @endif
                                            </div>
                                        </div>
                                        <div class="form-group{{ $errors->has('jk') ? ' has-error' : '' }}">
                                            <label class="control-label col-sm-3">Jenis Kelamin</label>
                                            <div class="col-sm-9">
                                                <label class="radio-inline"><input type="radio" name="jk" value="0" {{ $mahasiswa->jk === 0 ? 'checked' : '' }}>Pria</label>
                                                <label class="radio-inline"><input type="radio" name="jk" value="1" {{ $mahasiswa->jk === 1 ? 'checked' : '' }}>Wanita</label>
                                                @if ($errors->has('jk'))
                                                    <span class="help-block">{{ $errors->first('jk') }}</span>
                                                @endif
                                            </div>
                                        </div>
                                        <div class="form-group{{ $errors->has('jurusan_id') ? ' has-error' : '' }}">
                                            <label class="control-label col-sm-3">Jurusan</label>
                                            <div class="col-sm-9">
                                                <select name="jurusan_id" class="form-control" required>
                                                    @foreach($mhsMenu as $menu)
                                                    <option value="{{ $menu->id }}" {{ $mahasiswa->jurusan_id === $menu->id ? 'selected' : '' }}>
                                                        {{ $menu->name }}
                                                    </option>
                                                    @endforeach
                                                </select>
                                                @if ($errors->has('jurusan_id'))
                                                    <span class="help-block">{{ $errors->first('jurusan_id') }}</span>
                                                @endif
                                            </div>
                                        </div>
                                        <div class="form-group{{ $errors->has('tahun') ? ' has-error' : '' }}">
                                            <label class="control-label col-sm-3">Tahun Masuk</label>
                                            <div class="col-sm-9">
                                                <input type="text" class="form-control" name="tahun" list="tahun" value="{{ old('tahun') ? old('tahun') : $mahasiswa->tahun->tahun }}" onkeypress="return hanyaAngka(event)" maxlength="4" required>
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
                                        <div class="form-group{{ $errors->has('status') ? ' has-error' : '' }}">
                                            <label class="control-label col-sm-3">Status</label>
                                            <div class="col-sm-9">
                                                <select name="status" class="form-control" required>
                                                    <option value="1" {{ $mahasiswa->status === 1 ? 'selected' : '' }}>Aktif</option>
                                                    <option value="0" {{ $mahasiswa->status === 0 ? 'selected' : '' }}>Cuti</option>
                                                </select>
                                                @if ($errors->has('status'))
                                                    <span class="help-block">{{ $errors->first('status') }}</span>
                                                @endif
                                            </div>
                                        </div>
                                        <hr>
                                        <div class="form-group">
                                            <div class="col-md-9 col-md-offset-3">
                                                <button type="submit" class="btn btn-success">Simpan perubahan <i class="fa fa-fw fa-check"></i></button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
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
    </script>
@endsection