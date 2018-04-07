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
            </h1>
            <ol class="breadcrumb">
                <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
                <li class="active">Beasiswa</li>
            </ol>
        </section>

        {{-- Page Content --}}
        <section class="content">
            <div class="row">
                <div class="col-md-8">
                    <div class="box box-success">
                        <div class="box-header with-border">
                            <h3 class="box-title">Data Beasiswa</h3>
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
                            <table class="table table-hovered">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Beasiswa</th>
                                        <th>Jenis</th>
                                        {{-- <th>Sumber</th> --}}
                                        <th>Syarat</th>
                                        <th>Tahun</th>
                                        <th class="text-right">Opsi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse ($beasiswas as $beasiswa)
                                    <tr>
                                        <td>{{ $loop->iteration }}.</td>
                                        <td>{{ $beasiswa->nama }}</td>
                                        <td>{{ $beasiswa->jenisBeasiswa->name }}</td>
                                        {{-- <td>{{ $beasiswa->sumber }}</td> --}}
                                        <td>
                                            <a href="{{ route('beasiswa.show', $beasiswa->id) }}" class="btn-show">Klik untuk lihat syarat.</button>
                                        </td>
                                        <td>{{ $beasiswa->tahun->tahun }}</td>
                                        <td class="text-right">
                                            <a href="{{ route('beasiswa.edit', $beasiswa->id) }}" class="btn btn-xs btn-success">
                                                <i class="fa fa-fw fa-pencil"></i>
                                            </a>
                                            <form action="{{ route('beasiswa.destroy', $beasiswa->id) }}" method="POST" style="display: inline;">
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
                                {{ $beasiswas->links() }}
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="box box-success">
                        <div class="box-header with-border">
                            <h3 class="box-title">Beasiswa</h3>
                        </div>
                        <form action="{{ route('beasiswa.store') }}" method="POST">
                            {{ csrf_field() }}
                            <div class="box-body">
                                <div class="form-group{{ $errors->has('nama') ? ' has-error' : '' }}">
                                    <label>Nama</label>
                                    <input type="text" class="form-control" name="nama" value="{{ old('nama') }}" placeholder="Nama beasiswa" required>
                                    @if ($errors->has('nama'))
                                        <span class="help-block">{{ $errors->first('nama') }}</span>
                                    @endif
                                </div>
                                <div class="form-group{{ $errors->has('jenis') ? ' has-error' : '' }}">
                                    <label>Jenis</label>
                                    <input type="text" name="jenis" class="form-control" value="{{ old('jenis') }}" list="jenis" placeholder="Jenis Beasiswa" required>
                                    <datalist id="jenis">
                                        @foreach($jenisBeasiswa as $jenis)
                                        <option value="{{ $jenis->name }}">
                                        @endforeach
                                    </datalist>
                                    @if ($errors->has('jenis'))
                                        <span class="help-block">{{ $errors->first('jenis') }}</span>
                                    @endif
                                </div>
                                <div class="form-group{{ $errors->has('sumber') ? ' has-error' : '' }}">
                                    <label>Sumber</label>
                                    <input type="text" class="form-control" name="sumber" value="{{ old('sumber') }}" placeholder="Sumber beasiswa" required>
                                    @if ($errors->has('sumber'))
                                        <span class="help-block">{{ $errors->first('sumber') }}</span>
                                    @endif
                                </div>
                                <div class="form-group{{ $errors->has('tahun') ? ' has-error' : '' }}">
                                    <label>Tahun</label>
                                    <input type="text" name="tahun" class="form-control" value="{{ old('tahun') }}" list="tahun" placeholder="Tahun Beasiswa" onkeypress="return hanyaAngka(event)" maxlength="4" required>
                                    <datalist id="tahun">
                                        @foreach($tahunBeasiswa as $tahun)
                                        <option value="{{ $tahun->tahun }}">
                                        @endforeach
                                    </datalist>
                                    @if ($errors->has('tahun'))
                                        <span class="help-block">{{ $errors->first('tahun') }}</span>
                                    @endif
                                </div>
                                <div class="form-group{{ $errors->has('syarat') ? ' has-error' : '' }}">
                                    <label>Syarat</label>
                                    <textarea name="syarat" id="syarat" placeholder="Syarat Beasiswa" class="form-control">{{ old('syarat') }}</textarea>
                                    @if ($errors->has('syarat'))
                                        <span class="help-block">{{ $errors->first('syarat') }}</span>
                                    @endif
                                </div>
                            </div>
                            <div class="box-footer text-right">
                                <button class="btn btn-success" type="submit">Tambahkan <i class="fa fa-fw fa-plus"></i></button>
                                <button class="btn btn-default" type="reset">Reset</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </section>

        <section>
            <div id="modalDetailBeasiswa" class="modal fade">
                <div class="modal-dialog">
                    <div class="box box-success">
                        <div class="box-header with-border">
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                            <h4 class="box-title"><i class="fa fa-fw fa-info"></i> Syarat Beasiswa</h4>
                        </div>
                        <div class="box-body">
                            <form class="form-horizontal">
                                <div class="form-group">
                                    <label class="control-label col-sm-2" for="email">Sumber :</label>
                                    <div class="col-sm-10">
                                        <p class="form-control-static"></p>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="control-label col-sm-2" for="email">Syarat :</label>
                                    <div class="col-sm-10">
                                        <p class="form-control-static"></p>
                                    </div>
                                </div>
                            </form>
                        </div>
                        <div class="box-footer text-right">
                            <button class="btn btn-default" data-dismiss="modal">Tutup</button>
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
                    "size": "xs",
                }
            });

            $('.btn-delete').click(function(event) {
                event.preventDefault();
                var konfirmasi = confirm('Anda akin ingin menghapus data beasiswa ini ?');
                if (konfirmasi === true) {
                    $(this).parent('form').submit();
                }
            });

            $('.btn-show').click(function(event) {
                event.preventDefault();
                var route = $(this).attr('href');
                console.log(route);
                $.get(route, function(data) {
                    $('#modalDetailBeasiswa .box-body').html(data);
                    $('#modalDetailBeasiswa').modal('show');
                });
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