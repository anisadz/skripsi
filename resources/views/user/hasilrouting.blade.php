@extends('layouts/afterlogin')
@section('judul','Rute Terpendek')
@section('content')
    <script>
        function goBack() {
            window.history.back()
        }
    </script>
    <style>
        .controls {
            margin-top: 10px;
            border: 1px solid transparent;
            border-radius: 2px 0 0 2px;
            box-sizing: border-box;
            -moz-box-sizing: border-box;
            height: 32px;
            outline: none;
            box-shadow: 0 2px 6px rgba(0, 0, 0, 0.3);
        }


    </style>
    <section id="main-content">
        <section class="wrapper">
            <div class="row mt">
                <div class="showback">
                    <h4><i class="fa fa-angle-right"></i> Peta Pendistribusian</h4>

                    <div id="map_canvas" style="width:100%;height:400px;"></div>
                </div>
                <!--/showback -->
                <div class="col-lg-12 col-md-6 col-sm-12">
                    <! -- PETA PERSEBARAN PUSKESMAS -->
                    <div class="showback">
                        <h4><i class="fa fa-angle-right"></i> Rute</h4>

                        <div class="panel-body">
                            <form action="{{url('/createdistribusi/')}}" name="modal_popup"
                                  enctype="multipart/form-data" method="POST">
                                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                <?php $nomer = 1;?>
                                <div class="form-group input-group">
                                    <div id="directions-panel"></div>
                                </div>
                                <input type="hidden" name="puskesmas" id="anu">
                                <label>Total Jarak</label>

                                <div class="form-group input-group">

                                    <input class="form-control" id="jarakku" name="jarak" required>
                                    <span class="input-group-addon">km</span>
                                </div>
                                <div class="form-group input-group">
                                    <input type="hidden" class="form-control" name="idlevel"
                                           value="{{Auth::user()->id}}">
                                </div>
                                <div class="form-group input-group">
                                    <label>Tanggal</label>
                                    <input class="form-control" name="tanggal" value="{{$tanggal}}">
                                </div>
                                <div class="form-group input-group" id="puskesmas">
                                    {{--<div class="list-group" >--}}
                                    @foreach($hasilrute as $hasil)
                                        <li class="list-group-item" >
                                            {{$nomer++}}. {{$hasil}}
                                    @endforeach
                                </div>
                                <!-- /.list-group -->
                                <button class="btn btn-success" type="submit">
                                    Save
                                </button>
                                <button onclick="goBack()" class="btn btn-warning">
                                    Cancel
                                </button>
                            </form>
                        </div>
                    </div>
                    <!--/showback -->
                </div>
            </div>
        </section>
    </section>
    <script>
        function initMap() {
            var directionsService = new google.maps.DirectionsService;
            var directionsDisplay = new google.maps.DirectionsRenderer;
            var myLatlng = new google.maps.LatLng(-8.239383846027533, 113.6823472357595);
            var map = new google.maps.Map(document.getElementById('map_canvas'), {
                zoom: 10,
                center: myLatlng,
            });
            directionsDisplay.setMap(map);
            calculateAndDisplayRoute(directionsService, directionsDisplay);
        }
        function calculateAndDisplayRoute(directionsService, directionsDisplay) {
            var origin1 = null;
            var destinationA = null;
            var waypts = [];
//            var checkboxArray = [];
            <?php for($i=1;$i<count($markerlat)-1;$i++){?>
            origin1 = new google.maps.LatLng(parseFloat(<?php echo $markerlat[0];?>), parseFloat(<?php echo $markerlng[0];?>));
            destinationA = new google.maps.LatLng(parseFloat(<?php echo $markerlat[count($markerlat)-1];?>), parseFloat(<?php echo $markerlng[count($markerlat)-1];?>));

                    <?php }
                    $a = '';
                    ?>

            <?php for($i=1;$i<count($hasilrute);$i++){
                $a .= "new google.maps.LatLng(".$hasilrutelatlong[$i]."),";
            }?>
            var checkboxArray = [{!! $a !!}];
            for (var i = 0; i < checkboxArray.length; i++) {
                if (checkboxArray[i] != "") {
                    waypts.push({
                        location: checkboxArray[i],
                        stopover: true
                    });
                }
            }
            directionsService.route({
                origin: origin1,
                destination: origin1,
                waypoints: waypts,
                optimizeWaypoints: true,
                travelMode: 'DRIVING'
            }, function (response, status) {
                if (status === 'OK') {
                    directionsDisplay.setDirections(response);
                    var route = response.routes[0];

                    var summaryPanel = document.getElementById('directions-panel');
                    summaryPanel.innerHTML = '';
                    // For each route, display summary information.
                    var jarakTotal = 0;
                    for (var i = 0; i < route.legs.length; i++) {
                        var routeSegment = i + 1;
                        var jarak = route.legs[i].distance.text;
                        summaryPanel.innerHTML += '<b>Rute: ' + routeSegment +
                                '</b><br>';
                        summaryPanel.innerHTML += route.legs[i].start_address + ' ke ';
                        summaryPanel.innerHTML += route.legs[i].end_address + '<br>';
                        summaryPanel.innerHTML += route.legs[i].distance.text + '<br><br>';
                        jarak += route.legs[i].distance.text;
                        jarakTotal += parseFloat(jarak);
                    }
                    document.getElementById('jarakku').value = parseFloat(jarakTotal);
                    $('#anu').val($('#puskesmas').html());
                } else {
                    window.alert('Directions request failed due to ' + status);
                }
            });
        }

    </script>

    <script async defer
            src="https://maps.googleapis.com/maps/api/js?key=AIzaSyA3jIDo_wAITzOeoYrJfuBwSCL9hMe8InI&libraries=places&callback=initMap"
            type="text/javascript"></script>
@endsection