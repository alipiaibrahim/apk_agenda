@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <h1 class="text-center text-bold" style="font-family:Arial, Helvetica, sans-serif">APLIKASI AGENDA TK</h1>
@stop

@section('content')
    @if ($user->roles_id == 1)
        Anda Login Sebagai Admin
    @else
        Anda Login Sebagai User
    @endif
    {{-- @stop --}}
    <section class="content" id="dw">
        <div class="container-fluid">

            <div class="row">
                <div class="col-lg-3 col-6">
                    <div class="small-box bg-info">
                        <div class="inner">
                            <h3>0</h3>
                            <p>Agenda</p>
                        </div>
                        <div class="icon">
                            <i class="ion ion-bag"></i>
                        </div>

                    </div>
                </div>
                ​ <div class="col-lg-3 col-6">
                    <div class="small-box bg-success">
                        <div class="inner">
                            <h3>0</h3>
                            <p>Topik</p>
                        </div>
                        <div class="icon">
                            <i class="ion ion-stats-bars"></i>
                        </div>

                    </div>
                </div>
                <div class="col-lg-3 col-6">
                    <div class="small-box bg-warning">
                        <div class="inner">
                            <h3>0</h3>
                            <p>Tema</p>
                        </div>
                        <div class="icon">
                            <i class="ion ion-person-add"></i>
                        </div>
                    </div>
                </div>
            </div>
            <br />
            <div>
                <img src="{{ '../vendor/adminlte/dist/img/apotekna.jpg' }}" class="img-fluid"
                    style="width:950px;height:500px;">
            </div>
            <div class="row">
                <!-- CHART.JS MEMINTA ELEMENT YANG MEMILIKI ID dw-chart -->
                <canvas id="dw-chart"></canvas>
            </div>
        </div>
    </section>
    </div>
@endsection

@section('footer')

@stop

@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
@stop

@section('js')
    <!-- LOAD FILE dashboard.js -->
    <script src="{{ asset('js/dashboard.js') }}"></script>
@endsection

@section('js')
    <script>
        console.log('Hi!')
    </script>
@stop
