@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <section class="content-header">
                <h1>
                    Mahasiswa
                    <small>{{ $jurusan->name }}</small>
                </h1>
                <ol class="breadcrumb">
                    <li><a href="{{ route('home') }}"><i class="fa fa-home"></i> Home</a></li>
                    <li><a href="{{ route('jurusan') }}"> Mahasiswa</a></li>
                    <li class="active">{{ $jurusan->name }}</li>
                </ol>
            </section>
            <section class="content">
                <div class="box box-success">
                    <div class="box-header with-border">
                        <h3 class="box-title">{{ $jurusan->jenjang .' '. $jurusan->name }}</h3>
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
                            <div class="col-md-offset-5 col-md-7">
                                <form action="{{ route('mahasiswa', $jurusan->slug) }}" class="form-inline text-right" method="GET">
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
                                    <th class="text-center">Jenis Kelamin</th>
                                    <th class="text-center">Tahun Masuk</th>
                                    <th class="text-right">Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($mahasiswas as $mahasiswa)
                                <tr>
                                    <td>{{ $loop->iteration }}.</td>
                                    <td><b>{{ $mahasiswa->stambuk }}</b></td>
                                    <td>{{ $mahasiswa->name }}</td>
                                    <td class="text-center">{{ $mahasiswa->jk === 0 ? 'Pria' : 'Wanita' }}</td>
                                    <td class="text-center">{{ $mahasiswa->tahun->tahun }}</td>
                                    <td class="text-right">{!! $mahasiswa->status === 1 ? '<label class="label label-primary">Aktif</label>' : '<label class="label label-warning">Cuti</label>' !!}</td>
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
            </section>
        </div>
    </div>
</div>
@endsection

@section ('scripts')
    <script>
        function hanyaAngka(evt) {
            var charCode = (evt.which) ? evt.which : event.keyCode
            if (charCode > 31 && (charCode < 48 || charCode > 57))
                return false;
            return true;
        }

        $(document).ready(function() {
            $('input[name=stambuk]').on('keyup', function(event) {
                event.preventDefault();
                if ($(this).val() === '') {
                    window.location.href = '{{ route('mahasiswa', $jurusan->slug) }}'
                }
            });   
        });
    </script>
@endsection