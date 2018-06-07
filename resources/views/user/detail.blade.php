@extends('layouts/afterlogin')
@section('judul','Tambah Pendistribusian')
@section('content')
    <section id="main-content">
        <section class="wrapper">
            <!-- BASIC FORM ELELEMNTS -->
            <div class="row mt">
                <div class="col-lg-12">
                    <div class="form-panel">
                        <h4 class="mb"><i class="fa fa-angle-right"></i> Tambah Pendistribusian</h4>
                        @foreach ($iduser as $user)
                            <form class="form-horizontal style-form" role="form" method="POST" action="{{url('/creatependistribusian')}}">
                                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                {{--<input type="hidden" name="iduser" value="{{$user->id}}">--}}
                                @endforeach
                                <div class="form-group">
                                    <label class="col-sm-2 col-sm-2 control-label">Tanggal</label>
                                    <div class="col-sm-10">
                                    <input type="date" class="form-control" name="tanggal" required>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-2 col-sm-2 control-label">Jumlah Puskesmas</label>
                                    <div class="col-sm-10">
                                    <span class="help-block">Pilihan pertama adalah Gudang Farmasi Kabupaten Jember dan pilihan terakhir adalah tujuan akhir pendistribusian</span>
                                    <input type="number" class="form-control" name="jumlah" id="jumlah" placeholder="Jumlah Puskesmas"  onchange="jumlahpuskesmasfunction()"  required>
                                    </div>
                                </div>
                                <div id="namapuskesmas" class="form-group"></div>
                                <button type="submit" class="btn btn-default">Hitung Rute</button>
                                <button type="reset" class="btn btn-default">Reset</button>
                            </form>
                    </div>
                </div>
            </div>
        </section>
    </section>

    <script>
        function jumlahpuskesmasfunction(){

            var jumlah_puskesmas = parseInt($("#jumlah").val());
            var puskesmas='';
            for (i = 0; i < jumlah_puskesmas; i++) {
                puskesmas+=
//                        '<dd>' +
                        '<select class="col-sm-10 form-control" name="namapuskesmas[]" id="namapuskesmas" style="margin-bottom: 10px" required>' +
                        '<option value="" selected>--- Pilih salah satu ---</option>' +
                        <?php
                        foreach ($data as $row) {

                            ?>
                        '<option value="<?php echo $row->IdPuskesmas; ?>"><?php echo $row->NamaPuskesmas; ?></option>' +
                        <?php

                    }
                    ?>
                        '</select>'
                ;
            }
//            $('#namapuskesmas').innerHTML(puskesmas);
            document.getElementById('namapuskesmas').innerHTML = puskesmas;
        }
    </script>
@endsection
