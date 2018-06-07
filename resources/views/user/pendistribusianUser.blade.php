@extends('layouts/afterlogin')
@section('judul','Pendistribusian')
@section('content')
    <section id="main-content">
        <section class="wrapper">
            <div class="row mt">
                <div class="col-md-12">
                    <div class="content-panel">
                        <table class="table table-striped table-advance table-hover">
                            <h4><i class="fa fa-angle-right"></i> Tabel Pendistribusian</h4>
                            <button type="button" class="btn btn-round btn-default pull-right" style="margin-top: -35px;margin-right: 40px"><a href="/tambahpendistribusian">Tambah Pendistribusian</a></button>
                            <hr>
                            <thead>
                            <tr>
                                <th>No</th>
                                <th>Tanggal Pendistribusian</th>
                                <th>Rute</th>
                                <th>Total Perjalanan</th>
                                <?php if(Auth::user()->IdLevel == 1 ) { ?>
                                <th>Penanggung Jawab</th>
                                <?php } ?>
                            </tr>
                            </thead>
                            <tbody>
                            @php($i=1)
                            @foreach($data as $value)
                                <tr>
                                    <th scope="row">{{$i++}}</th>
                                    <td>{{$value->TanggalPengiriman}}</td>
                                    <td>{{$value->Rute}}</td>
                                    <td>{{$value->TotalJarak}}</td>
                                    <?php if(Auth::user()->IdLevel == 1 ) { ?>
                                    <td>{{$value->User->id}}</td>
                                    <?php } ?>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </section>
    </section>
@endsection