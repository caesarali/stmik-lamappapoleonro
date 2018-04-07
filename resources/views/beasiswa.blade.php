@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            
            <section class="content-header">
                <h1>
                    Informasi Beasiswa
                </h1>
                <ol class="breadcrumb">
                    <li><a href="{{ route('home') }}"><i class="fa fa-home"></i> Home</a></li>
                    <li class="active">Informasi Beasiswa</li>
                </ol>
            </section>
            <section class="content">
                <div class="box box-success">
                    <div class="box-header with-border">
                        <h3 class="box-title">Informasi Beasiswa</h3>

                        <div class="box-tools pull-right">
                            <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                            </button>
                            <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
                        </div>
                    </div>
                    <div class="box-body">
                        <form action="{{ route('beasiswa.info') }}" class="form-inline text-right">
                            <div class="form-group">
                                <div class="input-group">
                                    <input type="text" name="keyword" class="form-control" placeholder="Keyword...">
                                    <div class="input-group-btn">
                                        <button class="btn btn-default" type="submit">
                                            <i class="glyphicon glyphicon-search"></i>
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </form>
                        <table class="table table-hovered">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Beasiswa</th>
                                    <th>Jenis</th>
                                    <th>Sumber</th>
                                    <th>Syarat</th>
                                    <th>Tahun</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($beasiswas as $beasiswa)
                                <tr>
                                    <td>{{ $loop->iteration }}.</td>
                                    <td>{{ $beasiswa->nama }}</td>
                                    <td>{{ $beasiswa->jenisBeasiswa->name }}</td>
                                    <td>{{ $beasiswa->sumber }}</td>
                                    <td><a href="{{ route('beasiswa.detail', $beasiswa->id) }}" class="btn-show">Klik untuk melihat syarat.</a></td>
                                    <td>{{ $beasiswa->tahun->tahun }}</td>
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
    </div>
</div>
@endsection

@section('scripts')
    <script>
        $('.btn-show').click(function(event) {
            event.preventDefault();
            var route = $(this).attr('href');
            console.log(route);
            $.get(route, function(data) {
                $('#modalDetailBeasiswa .box-body').html(data);
                $('#modalDetailBeasiswa').modal('show');
            });
        });
    </script>
@endsection