@extends('layouts/afterlogin')
@section('judul','Monitoring User')
@section('content')
    <section id="main-content">
        <section class="wrapper">
            <div class="row mt">
                <div class="col-md-12">
                    <div class="content-panel">
                        <table class="table table-striped table-advance table-hover">
                            <h4><i class="fa fa-angle-right"></i> Tabel Monitoring User</h4>
                            <hr>
                            <thead>
                            <tr>
                                <th>No</th>
                                <th>Nama</th>
                                <th>Email</th>
                                <th>Tanggal Register</th>
                                <th>Aksi</th>
                            </tr>
                            </thead>
                            <tbody>
                            @php($i=1)
                            @foreach($data as $value)
                                <tr>
                                    <th scope="row">{{$i++}}</th>
                                    <td>{{$value->name}}</td>
                                    <td>{{$value->email}}</td>
                                    <td>{{$value->created_at}}</td>
                                    @if($value->IdLevel==0)
                                        <td><a href="{{url('/verifikasiuser/')."/".$value->id}}"><button class="btn btn-green" type="submit">Verifikasi</button></a></td>
                                    @else <td>Terverifikasi</td>
                                    @endif
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