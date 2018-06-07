@extends('layouts/afterlogin')
@section('judul','Tambah Data Puskesmas')
@section('content')
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
            <!-- BASIC FORM ELELEMNTS -->
            <div class="row mt">
                <div class="col-lg-12">
                    <div class="form-panel">
                        <h4 class="mb"><i class="fa fa-angle-right"></i> Tambah Data Puskesmas</h4>
                        <form class="form-horizontal style-form" role="form" method="POST" action="{{url('/createpuskesmas')}}">
                            <input type="hidden" name="_token" value="{{ csrf_token() }}">
                            <div class="form-group">
                                <label class="col-sm-2 col-sm-2 control-label">Nama Puskesmas</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" name="namapuskesmas" placeholder="Nama Puskesmas" required>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-2 col-sm-2 control-label">Alamat</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" name="alamatpuskesmas" placeholder="Alamat" required>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-2 col-sm-2 control-label">Kelurahan</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" name="kelurahan" placeholder="Kelurahan" required>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-2 col-sm-2 control-label">Kecamatan</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" name="kecamatan" placeholder="Kecamatan" required>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-2 col-sm-2 control-label">Kode Pos</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" name="kodepos" placeholder="Kode Pos" required>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-2 col-sm-2 control-label">No Telp</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" name="telp" placeholder="No. Telp">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-2 col-sm-2 control-label">Fax</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" name="fax" placeholder="Fax">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-2 col-sm-2 control-label">Peta</label>
                                <div class="col-sm-10">
                                    <span class="help-block">Cari nama puskesmas pada Search Box di peta. Kemudian klik icon kotak pada peta untuk mengisi latitude dan longitude secara otomatis</span>
                                    <input id="pac-input" class="controls" type="text" placeholder="Search Box">
                                    <div id="map_canvas" style="width:100%;height:400px;"></div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-2 col-sm-2 control-label">Latitude</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" name="lat" id="lat">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-2 col-sm-2 control-label">Longitude</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" name="lng" id="lng">
                                </div>
                            </div>
                            <button type="reset" class="btn btn-info">Reset</button>
                            <button type="submit" class="btn btn-success pull-right">Submit</button>
                        </form>
                    </div>
                </div>
            </div>
        </section>
    </section>

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
        google.maps.event.addListener(map,'click',function(event){
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