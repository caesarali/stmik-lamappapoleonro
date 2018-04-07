@extends('layouts.admin.app')

@section('content')
    <div class="content-wrapper">
        {{-- Page Header --}}
        <section class="content-header">
            <h1>
                Jurusan
                <small>Edit Data</small>
            </h1>
            <ol class="breadcrumb">
                <li><a href="{{ route('admin.home') }}"><i class="fa fa-dashboard"></i> Home</a></li>
                <li><a href="{{ route('jurusan.index') }}"><i class="fa fa-tags"></i> Jurusan</a></li>
                <li class="active">{{ $jurusan->name }}</li>
            </ol>
        </section>

        {{-- Page Content --}}
        <section class="content">
            <div class="row">
                <div class="col-md-8 col-md-offset-2">
                    <div class="box box-success">
                        <div class="box-header with-border">
                            <a href="{{ route('jurusan.index') }}" class="btn btn-sm btn-default pull-left"><i class="fa fa-fw fa-arrow-left"></i> Kembali</a>
                            <div class="text-center" style="padding-top: 6px">
                                <h3 class="box-title">Edit data jurusan</h3>
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
                                    <form action="{{ route('jurusan.update', $jurusan->slug) }}" method="POST" class="form-horizontal">
                                        {{ csrf_field() }}
                                        {{ method_field('PUT') }}
                                        <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                                            <label class="control-label col-sm-3">Nama Jurusan</label>
                                            <div class="col-sm-9">
                                                <input type="text" class="form-control" value="{{ old('name') ? old('name') : $jurusan->name }}" placeholder="Nama Jurusan" name="name" required {{ $errors->has('name') ? ' autofocus' : '' }}>
                                                @if ($errors->has('name'))
                                                    <span class="help-block">{{ $errors->first('name') }}</span>
                                                @endif
                                            </div>
                                        </div>
                                        <div class="form-group{{ $errors->has('jenjang') ? ' has-error' : '' }}">
                                            <label class="control-label col-sm-3">Jenjang</label>
                                            <div class="col-sm-9">
                                                <select name="jenjang" class="form-control" required>
                                                    <option value="">-- Pilih --</option>
                                                    <option value="D3" {{ $jurusan->jenjang === 'D3' ? 'selected' : '' }}>D3</option>
                                                    <option value="S1" {{ $jurusan->jenjang === 'S1' ? 'selected' : '' }}>S1</option>
                                                    <option value="S2" {{ $jurusan->jenjang === 'S2' ? 'selected' : '' }}>S2</option>
                                                    <option value="S3" {{ $jurusan->jenjang === 'S3' ? 'selected' : '' }}>S3</option>
                                                </select>
                                                @if ($errors->has('jenjang'))
                                                    <span class="help-block">{{ $errors->first('jenjang') }}</span>
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