<!DOCTYPE html>
<html>
  <head>
    <meta name="viewport" content="initial-scale=1.0, user-scalable=no">
    <meta charset="utf-8">
    <link rel="stylesheet" href="stylesheet.css">
    <link rel="icon" href="img/maine.png">
    <title>Find Restaurants in Portland!</title>
    
  </head>
  <body>

      
         
      
<?php

/* Alert when you open the page. */      
      
alert("Welcome to Portland, Maine Restaurant Finder! Click OK and use the search bar in the upper right to find a restaurant in the area.");

function alert($msg) {
    echo "<script type='text/javascript'>alert('$msg');</script>";
}

?>     
      
      
      
      
      
<!-- Structure for the fixed header, aligning the text on the left, and the input box on the right.  -->       
      
<div id="map"></div>

 
<div id="header">
    <div id="header-content">
        <h1><span style=float:left>
                Where do you want to eat?
            </span>    
            
            <span style="float:right">
                <div id=input_container>
                    <input id="pac-input" class="controls" type="text" placeholder="e.g. Taqueria">
                </div>
            </span>
        </h1>     
    </div>
</div>     

      
      
      
      
<!-- Google Maps API -->       


<script>
  function initAutocomplete() {
    var map = new google.maps.Map(document.getElementById('map'), {
      center: {lat:43.660368, lng: -70.2795078},
      zoom: 14,
      mapTypeId: 'roadmap'
    });

      
    // Create the search box and link it to the UI element.
    var input = document.getElementById('pac-input');
    var searchBox = new google.maps.places.SearchBox(input);


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

        
        
      // Clear out the old markers with a new search
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

</script>

<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyA-FI5AYR6Care6oVbkFJhIsVxEBlFRgWA&libraries=places&callback=initAutocomplete"
     async defer>
</script>
      
  </body>
</html>