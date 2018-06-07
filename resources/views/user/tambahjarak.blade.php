@extends('layouts/afterlogin')
@section('judul','Tambah Pendistribusian')
@section('content')
    <script>
    function setDataHapus($value1,$value2)
    {
        $("#id1").val($value1);
        $("#id2").val($value2);
    }
    </script>

    <section id="main-content">
        <section class="wrapper">
            <!-- BASIC FORM ELELEMNTS -->
            <div class="row mt">
                <div class="col-lg-12">
                    <div class="form-panel">
                        <h4 class="mb"><i class="fa fa-angle-right"></i> Tambah Perhitungan Jarak</h4>
                            <div class="form-group">
                                <label class="col-sm-2 col-sm-2 control-label">Puskesmas Awal</label>
                                <div class="col-sm-10">
                                    <select class="col-lg-12 form-control" name="awal" id="awal" style="margin-bottom: 10px"  required>
                                        <option value="" selected>--- Pilih satu ---</option>
                                        <?php
                                        foreach ($data as $row) {
                                        ?>
                                        <option value="<?php echo $row->Lat . ', ' . $row->Lng . ', ' .$row->IdPuskesmas; ?>"><?php echo $row->NamaPuskesmas; ?></option>
                                        <?php
                                        }
                                        ?>

                                    </select>
                                    <span class="help-block">Puskesmas Awal dan Tujuan tidak boleh sama</span>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-2 col-sm-2 control-label">Puskesmas Tujuan</label>
                                <div class="col-sm-10">
                                    <select class="col-lg-12 form-control" name="tujuan" id="tujuan" style="margin-bottom: 10px" required>
                                        <option value="" selected>--- Pilih satu ---</option>
                                        <?php
                                        foreach ($data as $row) {
                                        ?>
                                        <option value="<?php echo $row->Lat . ', ' . $row->Lng . ', ' .$row->IdPuskesmas; ?>"><?php echo $row->NamaPuskesmas; ?></option>
                                        <?php
                                        }
                                        ?>
                                    </select>
                                </div>
                            </div>
                        <button type="submit" id="submit" class="btn btn-success" data-toggle="modal" data-target="#ModalJarak" >Hitung</button>
                        </div>
                    </div>
                </div>
            <div class="modal fade" id="ModalJarak" role="dialog">
                <div class="modal-dialog">

                    <!-- Modal content-->
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                            <h4 class="modal-title">Perhitungan Jarak</h4>
                        </div>
                        <div class="modal-body">
                            <form action="{{url('/createjarak/')}}" name="modal_popup" enctype="multipart/form-data" method="POST">
                                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                <div class="form-group">
                                    <label>Peta</label>
                                    <div id="map_canvas" style="width:100%;height:400px;"></div>
                                </div>
                                <div class="form-group">
                                    <label>Puskesmas Awal</label>
                                    <input type="hidden" name="idpuskesmas1" id="no1">
                                    <input class="form-control" id="awal2" name="awal2" required>
                                </div>
                                <div class="form-group">
                                    <label>Puskesmas Tujuan</label>
                                    <input type="hidden" name="idpuskesmas2" id="no2">
                                    <input class="form-control" id="tujuan2" name="tujuan2" required>
                                </div>
                                <div id="directions-panel"></div>
                                <div class="form-group"  id="hitungjarak">
                                    <label>jarak</label>
                                    <div class="form-group input-group">
                                        <input class="form-control" id="jarakku" name="jarak" required>
                                        <span class="input-group-addon">km</span>
                                    </div>
                                </div>
                                <button class="btn btn-success" type="submit">
                                    Save
                                </button>
                                <button type="reset" class="btn btn-danger"  data-dismiss="modal" aria-hidden="true">
                                    Tidak
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            </section>
        </section>
    <script>
        var origin1 = null;
        var destinationA = null;

        //mengubah id atm menjadi longlat, di masukan pada variabel origin1
        $("#awal").change(function() {
        var coba = $("#awal").val();
        var tmp = coba.split(', ');
        document.getElementById('no1').value=parseInt(tmp[2]);
        origin1 = new google.maps.LatLng(parseFloat(tmp[0]), parseFloat(tmp[1]));
        });
        //mengubah id atm menjadi longlat, di masukan pada variabel destinationA
        $("#tujuan").change(function() {
        var coba = $("#tujuan").val();
        var tmp = coba.split(', ');
        document.getElementById('no2').value=parseInt(tmp[2]);
        destinationA = new google.maps.LatLng(parseFloat(tmp[0]), parseFloat(tmp[1]));
        });
        function initMap() {
            var directionsService = new google.maps.DirectionsService;
            var directionsDisplay = new google.maps.DirectionsRenderer;
            var myLatlng = new google.maps.LatLng(-8.239383846027533, 113.6823472357595);
            var map = new google.maps.Map(document.getElementById('map_canvas'), {
                zoom: 10,
                center: myLatlng,
            });
            directionsDisplay.setMap(map);

            document.getElementById('submit').addEventListener('click', function() {
                calculateAndDisplayRoute(directionsService, directionsDisplay);
            });
        }

        function calculateAndDisplayRoute(directionsService, directionsDisplay) {
            directionsService.route({
                origin: origin1,
                destination: destinationA,
//                origins: [origin1],
//                destinations: [destinationA],
//                waypoints: waypts,
//                optimizeWaypoints: true,
                travelMode: 'DRIVING'
            }, function(response, status) {
                if (status === 'OK') {
                    directionsDisplay.setDirections(response);
                    var route = response.routes[0];
                    var summaryPanel = document.getElementById('directions-panel');
                    summaryPanel.innerHTML = '';
                    // For each route, display summary information.
                    for (var i = 0; i < route.legs.length; i++) {
                        var routeSegment = i + 1;
                        summaryPanel.innerHTML += '<b>Rute: ' + routeSegment +
                                '</b><br>';
                        summaryPanel.innerHTML += route.legs[i].start_address + ' ke ';
                        summaryPanel.innerHTML += route.legs[i].end_address + '<br>';
                        summaryPanel.innerHTML += route.legs[i].distance.text + '<br><br>';

                        document.getElementById('jarakku').value=parseFloat(route.legs[i].distance.text);
                    }

                } else {
                    window.alert('Directions request failed due to ' + status);
                }
            });
        }
    </script>
    <script async defer
            src="https://maps.googleapis.com/maps/api/js?key=AIzaSyA3jIDo_wAITzOeoYrJfuBwSCL9hMe8InI&callback=initMap">
    </script>
    <script>
        //pemanggilan atm pada modal
        $(document).ready(function() {
            $('#awal').change(function() {
                filter();
            });

            $('#tujuan').change(function() {
                filter();
            });

            function filter() {
                var puskesmas1 = $("#awal option:selected").text();
                var puskesmas2 = $("#tujuan option:selected").text();
                    document.getElementById('awal2').value = puskesmas1;
                    document.getElementById('tujuan2').value = puskesmas2;
            }
        });

    </script>
@endsection
