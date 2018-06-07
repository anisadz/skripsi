@extends('layouts/afterlogin')
@section('judul','Pendistribusian')
@section('content')
    <section id="main-content">
        <section class="wrapper">
            <div class="row mt">
                <div class="col-md-12">
                    <div class="content-panel">
                        <table class="table table-striped table-advance table-hover">
                            <h4><i class="fa fa-angle-right"></i> Tabel Jarak</h4>
                            <button type="button" class="btn btn-round btn-default pull-right" style="margin-top: -35px;margin-right: 40px"><a href="/tambahjarakpuskesmas">Tambah Perhitungan Jarak</a></button>
                            <hr>
                            <thead>
                            <tr>
                                <th>No</th>
                                <th>Puskesmas Awal</th>
                                <th>Puskesmas Tujuan</th>
                                <th>Jarak</th>
                            </tr>
                            </thead>
                            <tbody>
                            @php($i=1)
                            @foreach($data as $value)
                                <tr>
                                    <th scope="row">{{$i++}}</th>
                                    <td>{{$value->Puskesmasawal->NamaPuskesmas}}</td>
                                    <td>{{$value->Puskesmastujuan->NamaPuskesmas}}</td>
                                    <td>{{$value->Jarak}} km</td>
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