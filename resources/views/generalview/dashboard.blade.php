@extends('layouts/afterlogin')
@section('judul','Dashboard')
@section('content')
    <style>
        /* Always set the map height explicitly to define the size of the div
         * element that contains the map. */

        /* Optional: Makes the sample page fill the window. */
        html, body {
            height: 100%;
            margin: 0;
            padding: 0;
        }
    </style>
    <section id="main-content">
        <section class="wrapper">
            <div class="row mt">
                <div class="col-lg-12 col-md-6 col-sm-12">
                    <! -- PETA PERSEBARAN PUSKESMAS -->
                    <div class="showback">
                        <h4><i class="fa fa-angle-right"></i> Peta Persebaran Puskesmas</h4>
                        <div id="map_canvas" style="width:100%;height:400px;"></div>
                    </div><!--/showback -->
                </div>
            </div>
        </section>
    </section>


    <script>
        function initMap() {
            var locations = [
                    <?php for($i=0;$i<count($markerlat);$i++){?>
                        [<?php echo $markerlat[$i];?>, <?php echo $markerlng[$i];?>],

                <?php }?>
                ];

            var myLatlng = new google.maps.LatLng(-8.239383846027533, 113.6823472357595);
            var myOptions = {
                zoom: 10,
                center: myLatlng,
                mapTypeId: google.maps.MapTypeId.ROADMAP};

            map = new google.maps.Map(document.getElementById("map_canvas"), myOptions);
            geocoder = new google.maps.Geocoder();
            for (i = 0; i < locations.length; i++) {

                var marker = new google.maps.Marker({
//                position: myLatlng,
                    position: new google.maps.LatLng(locations[i][0], locations[i][1]),
                    map: map
                });
            }
//                var marker = new google.maps.Marker({
//                    position: myLatlng,
//                    map: map
//                });
            marker.setMap(map);
            //event listener click pada peta
            google.maps.event.addListener(map,'click',function(e){
                //mengambil latitude dan longitude tempat yang di click
                myLatlng=e.latLng;
                //merubah posisi center peta
                map.setCenter(myLatlng);
                //memanggil fungsi geocode
//                    geocode(myLatlng);
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