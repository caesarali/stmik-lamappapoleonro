@extends('layouts.admin.app')

@section('style')
    <!-- bootstrap wysihtml5 - text editor -->
    <link rel="stylesheet" href="{{ asset('assets/admin/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css') }}">
@endsection

@section('content')
    <div class="content-wrapper">
        {{-- Page Header --}}
        <section class="content-header">
            <h1>
                Beasiswa
                <small>Edit Data</small>
            </h1>
            <ol class="breadcrumb">
                <li><a href="{{ route('admin.home') }}"><i class="fa fa-dashboard"></i> Home</a></li>
                <li><a href="{{ route('beasiswa.index') }}">Beasiswa</a></li>
                <li class="active">{{ $beasiswa->nama }}</li>
            </ol>
        </section>

        {{-- Page Content --}}
        <section class="content">
            <div class="row">
                <div class="col-md-10 col-md-offset-1">
                    <div class="box box-success">
                        <div class="box-header with-border">
                            <a href="{{ route('beasiswa.index') }}" class="btn btn-sm btn-default pull-left"><i class="fa fa-fw fa-arrow-left"></i> Kembali</a>
                            <div class="text-center" style="padding-top: 6px">
                                <h3 class="box-title">Edit data beasiswa</h3>
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
                                <div class="col-md-10 col-md-offset-1">
                                    <form action="{{ route('beasiswa.update', $beasiswa->id) }}" method="POST" class="form-horizontal">
                                        {{ csrf_field() }}
                                        {{ method_field('PUT') }}
                                        <div class="form-group{{ $errors->has('nama') ? ' has-error' : '' }}">
                                            <label class="control-label col-sm-3">Beasiswa</label>
                                            <div class="col-sm-7">
                                                <input type="text" class="form-control" name="nama" value="{{ old('nama') ? old('nama') : $beasiswa->nama }}" placeholder="Nama beasiswa" required>
                                                @if ($errors->has('nama'))
                                                    <span class="help-block">{{ $errors->first('nama') }}</span>
                                                @endif
                                            </div>
                                        </div>
                                        <div class="form-group{{ $errors->has('jenis') ? ' has-error' : '' }}">
                                            <label class="control-label col-sm-3">Jenis</label>
                                            <div class="col-sm-7">
                                                <input type="text" name="jenis" class="form-control" value="{{ old('jenis') ? old('jenis') : $beasiswa->jenisBeasiswa->name }}" list="jenis" placeholder="Jenis Beasiswa" required>
                                                <datalist id="jenis">
                                                    @foreach($jenisBeasiswa as $jenis)
                                                    <option value="{{ $jenis->name }}">
                                                    @endforeach
                                                </datalist>
                                                @if ($errors->has('jenis'))
                                                    <span class="help-block">{{ $errors->first('jenis') }}</span>
                                                @endif
                                            </div>
                                        </div>
                                        <div class="form-group{{ $errors->has('sumber') ? ' has-error' : '' }}">
                                            <label class="control-label col-sm-3">Sumber</label>
                                            <div class="col-sm-7">
                                                <input type="text" class="form-control" name="sumber" value="{{ old('sumber') ? old('sumber') : $beasiswa->sumber }}" placeholder="Sumber beasiswa" required>
                                                @if ($errors->has('sumber'))
                                                    <span class="help-block">{{ $errors->first('sumber') }}</span>
                                                @endif
                                            </div>
                                        </div>
                                        <div class="form-group{{ $errors->has('tahun') ? ' has-error' : '' }}">
                                            <label class="control-label col-sm-3">Tahun</label>
                                            <div class="col-sm-7">
                                                <input type="text" name="tahun" class="form-control" value="{{ old('tahun') ? old('tahun') : $beasiswa->tahun->tahun }}" list="tahun" placeholder="Tahun Beasiswa" maxlength="4" onkeypress="return hanyaAngka(event)" required>
                                                <datalist id="tahun">
                                                    @foreach($tahunBeasiswa as $tahun)
                                                    <option value="{{ $tahun->tahun }}">
                                                    @endforeach
                                                </datalist>
                                                @if ($errors->has('tahun'))
                                                    <span class="help-block">{{ $errors->first('tahun') }}</span>
                                                @endif
                                            </div>
                                        </div>
                                        <div class="form-group{{ $errors->has('syarat') ? ' has-error' : '' }}">
                                            <label class="control-label col-sm-3">Syarat</label>
                                            <div class="col-sm-7">
                                                <textarea name="syarat" id="syarat" placeholder="Syarat Beasiswa" class="form-control">{{ $beasiswa->syarat }}</textarea>
                                                @if ($errors->has('syarat'))
                                                    <span class="help-block">{{ $errors->first('syarat') }}</span>
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
    <!-- Bootstrap WYSIHTML5 -->
    <script src="{{ asset('assets/admin/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js') }}"></script>
    <script>
        function hanyaAngka(evt) {
            var charCode = (evt.which) ? evt.which : event.keyCode
            if (charCode > 31 && (charCode < 48 || charCode > 57))
                return false;
            return true;
        }

        $(document).ready(function() {
            $('#syarat').wysihtml5({
                toolbar: {
                    "font-styles": false,
                    "image": false,
                    "link": false,
                    "size": "sm",
                }
            });
        });
    </script>
@endsection