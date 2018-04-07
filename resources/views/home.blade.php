@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        {{-- <div class="col-md-10 col-md-offset-1"> --}}
            <section class="content">
                <div id="myCarousel" class="carousel slide" data-ride="carousel">
                    <!-- Indicators -->
                    <ol class="carousel-indicators">
                        <li data-target="#myCarousel" data-slide-to="0"></li>
                        <li data-target="#myCarousel" data-slide-to="1" class="active"></li>
                        <li data-target="#myCarousel" data-slide-to="2"></li>
                    </ol>

                    <!-- Wrapper for slides -->
                    <div class="carousel-inner">
                        <div class="item">
                            <img src="{{ asset('img/slider/3.jpg') }}" style="width:100%; border-radius: 10px;">
                            <div class="carousel-caption">
                                <h1 class="hidden-xs">STMIK LAMAPPAPOLEONRO SOPPENG</h1>
                                <p>Sistem Informasi Kemahasiswaan dan Alumni</p>
                            </div>
                        </div>
                        <div class="item active">
                            <img src="{{ asset('img/slider/1.jpg') }}" style="width:100%; border-radius: 10px;">
                            <div class="carousel-caption">
                                <div class="row hidden-xs">
                                    <div class="col-md-4 col-md-offset-4 text-center">
                                        <img src="{{ asset('img/logo.png') }}" alt="" class="img-responsive" style="margin-bottom: 30px">
                                    </div>
                                </div>
                                <h2 class="hidden-xs">Sistem Informasi Kemahasiswaan dan Alumni</h2>
                                <p>STMIK LAMAPPAPOLEONRO SOPPENG</p>
                            </div>
                        </div>
                        <div class="item">
                            <img src="{{ asset('img/slider/2.jpg') }}" style="width:100%; border-radius: 10px;">
                            <div class="carousel-caption">
                                <h1 class="hidden-xs">YAYASAN LAMAPPAPOLEONRO SOPPENG</h1>
                                <p>Sistem Informasi Kemahasiswaan dan Alumni</p>
                            </div>
                        </div>
                    </div>

                    <!-- Left and right controls -->
                    <a class="left carousel-control" href="#myCarousel" data-slide="prev">
                        <span class="glyphicon glyphicon-chevron-left"></span>
                        <span class="sr-only">Previous</span>
                    </a>
                    <a class="right carousel-control" href="#myCarousel" data-slide="next">
                        <span class="glyphicon glyphicon-chevron-right"></span>
                        <span class="sr-only">Next</span>
                    </a>
                </div>
            </section>
        {{-- </div> --}}
    </div>
</div>
@endsection
