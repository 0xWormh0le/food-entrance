@extends('layouts.restaurants')

@section('content')
        
        @include('partials._hero')

         @include('partials._locationMatch') 


        <section class="popular">
            <div class="container">
                <div class="title text-xs-center m-b-30">
                    <h2>Our Handpicked Restaurants</h2>
                    <p class="lead">The easiest way to your favourite food</p>
                </div>
                <div class="row">

                   <div class="col-xs-12 col-sm-4 col-md-4 col-lg-3">

                     <div class="sidebar clearfix m-b-20">
                        <div class="main-block">
                           <div class="sidebar-title white-txt">
                              <h6>Filter Restaurants</h6>
                              <i class="fa fa-cutlery pull-right"></i> 
                           </div>
                           <ul>
                              <li><a href="#" class="scroll {{ request('cuisine') ==  '' }}">Most Popular</a></li>
                              <li><a href="#" class="scroll {{ request('cuisine') ==  '' }}">Veg restaurant</a></li>
                              <li><a href="#" class="scroll {{ request('cuisine') ==  '' }}">Non Veg Restaurant</a></li>
                              <li><a href="#" class="scroll {{ request('cuisine') ==  '' }}">Chinese</a></li>

                               <li><a href="#" class="scroll {{ request('cuisine') ==  '' }}">Biryani</a></li>
                              <li><a href="#" class="scroll {{ request('cuisine') ==  '' }}"> All Restaurant</a></li>
                              <li><a href="#" class="scroll {{ request('cuisine') ==  '' }}">Near by you</a></li>
                              <li><a href="#" class="scroll {{ request('cuisine') ==  '' }}">Price</a></li>

                           </ul>
                           <div class="clearfix"></div>
                        </div>
                        
                     </div>
                     
                  </div>

                  <div class="col-xs-12 col-sm-8 col-md-8 col-lg-9">
                    <!-- Each popular food item starts -->
                    @foreach($restaurants as $restaurant)
                       <div class="col-xs-12 col-sm-4 col-md-4 food-item">
                           @include('partials._foodItemBig')
                       </div>
                    @endforeach

                  </div>  
                    
                </div>
            </div>
        </section>

      

        
@endsection



@section('scripts')

  <script type="text/javascript">

  function getLocation() {
    if(navigator.geolocation) {
        navigator.geolocation.getCurrentPosition(geoSuccess, geoError, {maximumAge:60000, timeout:5000, enableHighAccuracy:true});
                } else {
                    alert("Geolocation is not supported by this browser.");
                }
    }

    function geoSuccess(position) {
          var lat = position.coords.latitude;
          var lng = position.coords.longitude;
          alert("lat:" + lat + " lng:" + lng);

          codeLatLng(lat, lng);
      }


      function geoError() {
    alert("Geocoder failed.");
}


function codeLatLng(lat, lng) {
   geocoder = new google.maps.Geocoder();
    var latlng = new google.maps.LatLng(lat, lng);
    geocoder.geocode({'latLng': latlng}, function(results, status) {
      if(status == google.maps.GeocoderStatus.OK) {
          console.log(results)
          if(results[1]) {
              //formatted address
              var address = results[0].formatted_address;
              alert("address = " + address);

              $('#userLocation').html(address);

                var userLocation = { 'lat' : lat, 'lng' : lng, 'address' : address, 'city' :  results[1].long_name};
             

                 localStorage.setItem("userLocation", JSON.stringify(userLocation));

          } else {
              alert("No results found");
          }
      } else {
          alert("Geocoder failed due to: " + status);
      }
    });
}

getLocation();
   
  </script>


@endsection