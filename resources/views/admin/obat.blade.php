@extends('layouts/afterlogin')
@section('judul','Obat')
@section('content')
    <div id="page-wrapper">
        <div class="row">
            <div class="col-lg-12">
                <div class="panel panel-default">
                    <br>
                    <button type="button" class="btn btn-gold"><a href="/tambahobat" >Tambah Obat</a></button>
                    <br>
                    <div class="panel-heading">
                        Tabel Persediaan Obat
                    </div>
                    <!-- /.panel-heading -->
                    <div class="panel-body">
                        <table width="100%" class="table table-striped table-bordered table-hover" id="dataTables-example">
                            <thead>
                            <tr>
                                <th>No</th>
                                <th>Nama Obat</th>
                                <th>Jenis Obat</th>
                                <th>Jumlah per Pak</th>
                                <th>Jumlah Pak Tersedia</th>
                                <th>Aksi</th>
                            </tr>
                            </thead>
                            <tbody>
                            @php($i = 1)
                            @foreach($data as $value)
                                <tr>
                                    <th scope="row">{{$i++}}</th>
                                    <td>{{$value->NamaBarang}}</td>
                                    <td>{{$value->Kategori->Kategori}}</td>
                                    <td>{{$value->JumlahPerPak}}</td>
                                    <td>{{$value->JumlahPakTersedia}}</td>
                                    <td><button class="btn btn-green" data-toggle="modal" data-target="#myModal"
                                                onClick="setData({{$value->IdBarang}},'{{$value->NamaBarang}}',
                                                {{$value->JumlahPerPak}},{{$value->JumlahPakTersedia}});">Edit</button></a>
                                        <button class="btn btn-green" data-toggle="modal" data-target="#ModalHapus"
                                                onClick="setDataHapus({{$value->IdBarang}});">
                                            <a href=""></a>Hapus</button></td></a></td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                        <!-- /.table-responsive -->
                    </div>
                    <!-- /.panel-body -->
                </div>
                <!-- /.panel -->
            </div>
            <!-- /.col-lg-12 -->
        </div>
    </div>
    <div class="modal fade" id="myModal" role="dialog">
        <div class="modal-dialog">
            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">Edit Data Obat</h4>
                </div>
                <div class="modal-body">
                    <form action="{{url('/updateobat/')}}" name="modal_popup" enctype="multipart/form-data" method="POST">
                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                        <input type="hidden" name="idbarang" id="id">
                        <div class="form-group">
                            <label>Nama Obat</label>
                            <input class="form-control" id="namaBarang" name="namaobat" placeholder="Nama Obat" required>
                        </div>
                        <div class="form-group">
                            <label>Kategori Obat</label>
                            <select class="form-control" id="kategori" name="kategori">
                                <option>Pilih Kategori</option>
                                <option value="1">Obat</option>
                                <option value="2">Vaksin</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label>Jumlah Per Pak</label>
                            <input type="number" class="form-control" id="jumlahpak" name="jumlahpak" placeholder="Jumlah Per Pak" required>
                        </div>
                        <div class="form-group">
                            <label>Jumlah Pak Tersedia</label>
                            <input type="number" class="form-control" id="tersedia" name="tersedia" placeholder="Jumlah Pak Tersedia" required>
                        </div>
                        <div class="modal-footer">
                            <button class="btn btn-success" type="submit">
                                Update
                            </button>
                            <button type="reset" class="btn btn-danger"  data-dismiss="modal" aria-hidden="true">
                                Cancel
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="ModalHapus" role="dialog">
        <div class="modal-dialog">
            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">Yakin ingin menghapus?</h4>
                </div>
                <div class="modal-body">
                    <form action="{{url('/deleteobat/')}}" name="modal_popup" enctype="multipart/form-data" method="POST">
                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                        <input type="hidden" name="idobat" id="idobat">
                        <button class="btn btn-success" type="submit">
                            Ya
                        </button>
                        <button type="reset" class="btn btn-danger"  data-dismiss="modal" aria-hidden="true">
                            Tidak
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <script>
        function setData($value1,$value2,$value3,$value4){
            $("#id").val($value1);
            $("#namaBarang").val($value2);
            $("#jumlahpak").val($value3);
            $("#tersedia").val($value4);
        }
        function setDataHapus($value1){
            $("#idobat").val($value1);
        }
    </script>
@endsection