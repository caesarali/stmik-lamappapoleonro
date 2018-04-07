@extends('layouts.admin.app')

@section('style')
    
@endsection

@section('content')
    <div class="content-wrapper">
        {{-- Page Header --}}
        <section class="content-header">
            <h1>
                Alumni <small>Tambah / Edit data</small>
            </h1>
            <ol class="breadcrumb">
                <li><a href="{{ route('admin.home') }}"><i class="fa fa-dashboard"></i> Home</a></li>
                <li><a href="{{ route('alumni.index') }}"> <i class="fa fa-graduation-cap"></i> Alumni</a></li>
                <li class="active">Tambah / edit data</li>
            </ol>
        </section>

        {{-- Page Content --}}
        <section class="content">
            <div class="box box-success">
                <div class="box-header with-border">
                    <a href="{{ route('alumni.index') }}" class="btn btn-sm btn-default pull-left">
                        <i class="fa fa-fw fa-arrow-left"></i> Kembali
                    </a>
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
                        <div class="col-md-5">
                            <h3 class="page-header">Data Alumni</h3>
                            <form action="{{ route('alumni.create') }}" method="GET" class="form-horizontal">
                                <div class="form-group{{ $errors->has('stambuk') ? ' has-error' : '' }}">
                                    <label class="control-label col-sm-4">Stambuk</label>
                                    <div class="col-sm-8">
                                        <div class="input-group">
                                            <input type="text" class="form-control" name="stambuk" value="{{ $mahasiswa->stambuk or '' }}" placeholder="Stambuk saat berstatus mahasiswa" onkeypress="return hanyaAngka(event)" maxlength="10" required {{ isset($mahasiswa) ? '' : 'autofocus' }}>
                                            <div class="input-group-btn">
                                                <button class="btn btn-default btn-search" type="submit">
                                                    <i class="glyphicon glyphicon-search"></i>
                                                </button>
                                            </div>
                                        </div>
                                        @if ($errors->has('stambuk'))
                                            <span class="help-block">{{ $errors->first('stambuk') }}</span>
                                        @endif
                                        @if (session('message'))
                                            <span class="help-block">{{ session('message') }}</span>
                                        @endif
                                    </div>
                                </div>
                                @if(isset($mahasiswa))
                                    <div class="form-group">
                                        <label class="control-label col-sm-4">Nama</label>
                                        <div class="col-sm-8">
                                            <p class="form-control-static">: {{ $mahasiswa->name }}</p>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="control-label col-sm-4">Jenis Kelamin</label>
                                        <div class="col-sm-8">
                                            <p class="form-control-static">: {{ $mahasiswa->jk === 0 ? 'Pria' : 'Wanita' }}</p>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="control-label col-sm-4">Jurusan</label>
                                        <div class="col-sm-8">
                                            <p class="form-control-static">: {{ $mahasiswa->jurusan->jenjang .' '. $mahasiswa->jurusan->name }}</p>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="control-label col-sm-4">Angkatan</label>
                                        <div class="col-sm-8">
                                            <p class="form-control-static">: {{ $mahasiswa->tahun->tahun }}</p>
                                        </div>
                                    </div>
                                @endif
                            </form>
                        </div>
                        <div class="col-md-7">
                            <h3 class="page-header">Data Pekerjaan</h3>
                            <form action="{{ route('alumni.store') }}" method="POST" class="form-horizontal">
                            {{ csrf_field() }}
                            <input type="hidden" name="stambuk" value="{{ $mahasiswa->id or '' }}">
                            <div class="form-group{{ $errors->has('nama_inst') ? ' has-error' : '' }}">
                                <label class="control-label col-sm-3">Instansi</label>
                                <div class="col-sm-8">
                                    <input type="text" class="form-control" name="nama_inst" value="{{ old('nama_inst') ? old('nama_inst') : isset($mahasiswa->alumni) ? $mahasiswa->alumni->nama_inst : '' }}" placeholder="Nama instansi" required  {{ isset($mahasiswa) ? 'autofocus' : 'disabled' }}>
                                    @if ($errors->has('nama_inst'))
                                        <span class="help-block">{{ $errors->first('nama_inst') }}</span>
                                    @endif
                                </div>
                            </div>
                            <div class="form-group{{ $errors->has('alamat_inst') ? ' has-error' : '' }}">
                                <label class="control-label col-sm-3">Alamat</label>
                                <div class="col-sm-8">
                                    <textarea class="form-control" name="alamat_inst" rows="3" required placeholder="Alamat instansi" {{ isset($mahasiswa) ? '' : 'disabled' }}>{{ old('alamat_inst') ? old('alamat_inst') : isset($mahasiswa->alumni) ? $mahasiswa->alumni->alamat_inst : '' }}</textarea>
                                    @if ($errors->has('alamat_inst'))
                                        <span class="help-block">{{ $errors->first('alamat_inst') }}</span>
                                    @endif
                                </div>
                            </div>
                            <div class="form-group{{ $errors->has('jabatan') ? ' has-error' : '' }}">
                                <label class="control-label col-sm-3" >Jabatan</label>
                                <div class="col-sm-8">
                                    <input type="text" class="form-control" name="jabatan" value="{{ old('jabatan') ? old('jabatan') : isset($mahasiswa->alumni) ? $mahasiswa->alumni->jabatan->name : '' }}" list="jabatan" placeholder="Jabatan pekerjaan" required {{ isset($mahasiswa) ? '' : 'disabled' }}>
                                    <datalist id="jabatan">
                                        @foreach ($jabatan as $jbtn)
                                        <option value="{{ $jbtn->name }}">
                                        @endforeach
                                    </datalist>
                                    @if ($errors->has('jabatan'))
                                        <span class="help-block">{{ $errors->first('jabatan') }}</span>
                                    @endif
                                </div>
                            </div>
                            <div class="form-group{{ $errors->has('tahun') ? ' has-error' : '' }}">
                                <label class="control-label col-sm-3">Tahun</label>
                                <div class="col-sm-8">
                                    <input type="text" class="form-control" name="tahun" list="tahun" placeholder="Tahun mulai bekerja" value="{{ old('tahun_kerja') ? old('jabatan') : isset($mahasiswa->alumni) ? $mahasiswa->alumni->tahun->tahun : '' }}" onkeypress="return hanyaAngka(event)" maxlength="4" required {{ isset($mahasiswa) ? '' : 'disabled' }}>
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
                        </div>
                    </div>
                </div>
                <div class="box-footer">
                    <div class="row">
                        <div class="col-md-offset-5 col-md-7 form-horizontal">
                            <div class="form-group">
                                <div class="col-sm-8 col-sm-offset-3">
                                    <button type="submit" class="btn btn-success">Simpan data <i class="fa fa-fw fa-check"></i></button>
                                    <a href="{{ route('alumni.index') }}" class="btn btn-default">Batal</a>
                                </div>
                            </form>
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