@extends('layouts/afterlogin')
@section('content')
@section('judul','Puskesmas')
    <script>
        function setData($value1,$value2,$value3,$value4,$value5,$value6,$value7,$value8,$value9,$value10){
            $("#id").val($value1);
            $("#nama").val($value2);
            $("#alamat").val($value3);
            $("#kel").val($value4);
            $("#kec").val($value5);
            $("#pos").val($value6);
            $("#telp").val($value7);
            $("#fax").val($value8);
            $("#lat").val($value9);
            $("#lng").val($value10);
        }
        function setDataHapus($value1)
        {
            $("#id1").val($value1);
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

    #pac-input {
        background-color: #fff;
        font-family: Roboto;
        font-size: 15px;
        font-weight: 300;
        margin-left: 12px;
        padding: 0 11px 0 13px;
        text-overflow: ellipsis;
        width: 300px;
    }

    #pac-input:focus {
        border-color: #4d90fe;
    }

    .pac-container {
        font-family: Roboto;
    }
    #type-selector {
        color: #fff;
        background-color: #4d90fe;
        padding: 5px 11px 0px 11px;
    }

    #type-selector label {
        font-family: Roboto;
        font-size: 13px;
        font-weight: 300;
    }
    #target {
        width: 345px;
    }
</style>

    <section id="main-content">
        <section class="wrapper">
            <div class="row mt">
                <div class="col-md-12">
                    <div class="content-panel">
                        <table class="table table-striped table-advance table-hover">
                            <h4><i class="fa fa-angle-right"></i> Tabel Puskesmas</h4>
                            <?php
                            if(Auth::user()->IdLevel == 1 ) { ?>
                            <button type="button" class="btn btn-round btn-default pull-right" style="margin-top: -35px;margin-right: 40px"><a href="/tambahpuskesmas">Tambah Puskesmas</a></button>
                            <?php
                            }else if(Auth::user()->IdLevel == 2 ) { ?>
                            <?php } ?>
                            <hr>
                            <thead>
                            <tr>
                                <th>No</th>
                                <th>Nama Puskesmas</th>
                                <th>Alamat</th>
                                <th>Kelurahan</th>
                                <th>Kecamatan</th>
                                <th>Kode Pos</th>
                                <th>Telp</th>
                                <th>Fax</th>
                                <?php
                                if(Auth::user()->IdLevel == 1 ) { ?>
                                <th>Aksi</th>
                                <?php
                                }else if(Auth::user()->IdLevel == 2 ) { ?>
                            <?php } ?>
                            </tr>
                            </thead>
                            </thead>
                            <tbody>
                            @php($i=1)
                            @foreach($data as $value)
                                <tr>
                                    <th scope="row">{{$i++}}</th>
                                    <td>{{$value->NamaPuskesmas}}</td>
                                    <td>{{$value->AlamatPuskesmas}}</td>
                                    <td>{{$value->Kelurahan}}</td>
                                    <td>{{$value->Kecamatan}}</td>
                                    <td>{{$value->KodePos}}</td>
                                    <td>{{$value->Telp}}</td>
                                    <td>{{$value->Fax}}</td>
                                    <?php
                                    if(Auth::user()->IdLevel == 1 ) { ?>
                                    <td>
                                        <button class="btn btn-primary btn-xs"  data-toggle="modal"
                                                data-target="#myModal" onClick="setData({{$value->IdPuskesmas}},'{{$value->NamaPuskesmas}}','{{$value->AlamatPuskesmas}}','{{$value->Kelurahan}}','{{$value->Kecamatan}}','{{$value->KodePos}}','{{$value->Telp}}','{{$value->Fax}}','{{$value->Lat}}','{{$value->Lng}}');"><i class="fa fa-pencil"></i></button>
                                        <button class="btn btn-danger btn-xs" data-toggle="modal" data-target="#ModalHapus" onClick="setDataHapus({{$value->IdPuskesmas}});"><i class="fa fa-trash-o "></i></button>
                                    </td>
                                    <?php
                                    }else if(Auth::user()->IdLevel == 2 ) { ?>
                            <?php } ?>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div><!-- /content-panel -->
                </div><!-- /col-md-12 -->
            </div><!-- /row -->
            </section>
            <div class="modal fade" id="myModal" role="dialog">
                <div class="modal-dialog">
                    <!-- Modal content-->
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                            <h4 class="modal-title">Edit Data Puskesmas</h4>
                        </div>
                        <div class="modal-body">
                            <form action="{{url('/updatepuskesmas/')}}" name="modal_popup" enctype="multipart/form-data" method="POST">
                                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                <input type="hidden" name="idpuskesmas" id="id">
                                <div class="form-group">
                                    <label>Nama Puskesmas</label>
                                    <input class="form-control" id="nama" name="namapuskesmas" placeholder="Nama Puskesmas" required>
                                </div>
                                <div class="form-group">
                                    <label>Alamat</label>
                                    <input class="form-control" id="alamat" name="alamatpuskesmas" placeholder="Alamat" required>
                                </div>
                                <div class="form-group">
                                    <label>Kelurahan</label>
                                    <input class="form-control" id="kel" name="kelurahan" placeholder="Kelurahan" required>
                                </div>
                                <div class="form-group">
                                    <label>Kecamatan</label>
                                    <input class="form-control" id="kec" name="kecamatan" placeholder="Kecamatan" required>
                                </div>
                                <div class="form-group">
                                    <label>Kode Pos</label>
                                    <input class="form-control" id="pos" name="kodepos" placeholder="Kode Pos" required>
                                </div>
                                <div class="form-group">
                                    <label>No. Telp</label>
                                    <input id="telp" class="form-control" name="telp" placeholder="No. Telp">
                                </div>
                                <div class="form-group">
                                    <label>Fax</label>
                                    <input id="fax" class="form-control" name="fax" placeholder="Fax">
                                </div>
                                <div class="form-group">
                                    <label>Peta</label>
                                    <input id="pac-input" class="controls" type="text" placeholder="Search Box">
                                    <div id="map_canvas" style="width:100%;height:400px;"></div>
                                </div>
                                <div class="form-group">
                                    <label>Latitude</label>
                                    <input type="text" name="lat" id="lat" class="form-control" >
                                </div>
                                <div class="form-group">
                                    <label>Longitude</label>
                                    <input type="text" name="lng" id="lng" class="form-control"  >
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
                            <form action="{{url('/deletepuskesmas/')}}" name="modal_popup" enctype="multipart/form-data" method="POST">
                                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                <input type="hidden" name="idpuskesmas1" id="id1">
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
            </div>
            </div>
    </section><!-- /MAIN CONTENT -->



<script>
    function initMap() {
        var myLatlng = new google.maps.LatLng(-8.239383846027533, 113.6823472357595);
        var myOptions = {
            zoom: 10,
            center: myLatlng,
            mapTypeId: google.maps.MapTypeId.ROADMAP};

        map = new google.maps.Map(document.getElementById("map_canvas"), myOptions);
        geocoder = new google.maps.Geocoder();
        var marker = new google.maps.Marker({
            position: myLatlng,
            map: map
        });
        marker.setMap(map);
        //event listener click pada peta
        google.maps.event.addListener(map,'click',function(e){
            //mengambil latitude dan longitude tempat yang di click
            myLatlng=e.latLng;
            //merubah posisi center peta
            map.setCenter(myLatlng);
            //memanggil fungsi geocode
            geocode(myLatlng);


        });
        google.maps.event.addListener(map,'click',function(event) {
            document.getElementById('lat').value = event.latLng.lat()
            document.getElementById('lng').value =  event.latLng.lng()
        });

//
//        google.maps.event.addListener(map,'mousemove',function(event) {
//            document.getElementById('latspan').innerHTML = event.latLng.lat()
//            document.getElementById('lngspan').innerHTML = event.latLng.lng()
//        });
// Create the search box and link it to the UI element.
        var input = document.getElementById('pac-input');
        var searchBox = new google.maps.places.SearchBox(input);
        map.controls[google.maps.ControlPosition.TOP_LEFT].push(input);

        // Bias the SearchBox results towards current map's viewport.
        map.addListener('bounds_changed', function() {
            searchBox.setBounds(map.getBounds());
        });

        var markers = [];
        // Listen for the event fired when the user selects a prediction and retrieve
        // more details for that place.
        searchBox.addListener('places_changed', function() {
            var places = searchBox.getPlaces();

            if (places.length == 0) {
                return;
            }

            // Clear out the old markers.
            markers.forEach(function(marker) {
                marker.setMap(null);
            });
            markers = [];

            // For each place, get the icon, name and location.
            var bounds = new google.maps.LatLngBounds();
            places.forEach(function(place) {
                if (!place.geometry) {
                    console.log("Returned place contains no geometry");
                    return;
                }
                var icon = {
                    url: place.icon,
                    size: new google.maps.Size(71, 71),
                    origin: new google.maps.Point(0, 0),
                    anchor: new google.maps.Point(17, 34),
                    scaledSize: new google.maps.Size(25, 25)
                };

                // Create a marker for each place.
                markers.push(new google.maps.Marker({
                    map: map,
                    icon: icon,
                    title: place.name,
                    position: place.geometry.location
                }));

                if (place.geometry.viewport) {
                    // Only geocodes have viewport.
                    bounds.union(place.geometry.viewport);
                } else {
                    bounds.extend(place.geometry.location);
                }
            });
            map.fitBounds(bounds);
        });
    }

    function geocode(myLatlng){
        //melakukan reverse geocode dari posisi yang telah di click
        geocoder.geocode({'latLng': myLatlng},function(results, status){
            if(status==google.maps.GeocoderStatus.OK){
                if(results[1]){
                    var alamat=results[1].formatted_address;
                }
            }
        });
    }


</script>

<script async defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyA3jIDo_wAITzOeoYrJfuBwSCL9hMe8InI&libraries=places&callback=initMap"
        type="text/javascript"></script>
@endsection