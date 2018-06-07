@extends('layouts/afterlogin')
@section('judul','Tambah Data Obat')
@section('content')
    <div id="page-wrapper">
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">Tambah Data Obat</h1>
            </div>
            <!-- /.col-lg-12 -->
        </div>
        <div class="row">
            <div class="col-lg-12">
                <div class="panel panel-default">
                    <div class="panel-body">
                        <div class="row">
                            <div class="col-lg-12">
                                <form role="form" method="POST" action="{{url('/createobat')}}">
                                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                    <div class="form-group">
                                        <label>Nama Obat</label>
                                        <input class="form-control" name="nama" placeholder="Nama Obat" required>
                                    </div>
                                    <div class="form-group">
                                        <label>Kategori Obat</label>
                                        <select class="form-control" name="kategori">
                                            <option>Pilih Kategori</option>
                                            <option value="1">Obat</option>
                                            <option value="2">Vaksin</option>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label>Jumlah Per Pak</label>
                                        <input type="number" class="form-control" name="jumlahpak" placeholder="Jumlah Per Pak" required>
                                    </div>
                                    <div class="form-group">
                                        <label>Jumlah Pak Tersedia</label>
                                        <input type="number" class="form-control" name="tersedia" placeholder="Jumlah Pak Tersedia" required>
                                    </div>
                                    <button type="submit" class="btn btn-default">Submit</button>
                                    <button type="reset" class="btn btn-default">Reset</button>
                                </form>
                            </div>
                            <!-- /.col-lg-6 (nested) -->

                        </div>
                        <!-- /.row (nested) -->
                    </div>
                </div>
                <!-- /.panel -->
            </div>
            <!-- /.col-lg-12 -->
        </div>
    </div>
@endsection