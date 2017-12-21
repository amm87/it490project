<!DOCTYPE html>
<html>
  <head>
    <title>Place searches</title>
    <meta name="viewport" content="initial-scale=1.0, user-scalable=no">
    <meta charset="utf-8">
    <style>
      /* Always set the map height explicitly to define the size of the div
       * element that contains the map. */
      #map {
        height: 0%;
      }
      /* Optional: Makes the sample page fill the window. */
      html, body {
        height: 0%;
        margin: 0;
        padding: 0;
      }
    </style>
    <script>
      // This example requires the Places library. Include the libraries=places
      // parameter when you first load the API. For example:
      // <script src="https://maps.googleapis.com/maps/api/js?key=YOUR_API_KEY&libraries=places">

      var infowindow;

      function initMap() {
        var pyrmont = {lat: 40.747007, lng: -74.186586};

        var service = new google.maps.places.PlacesService(map);
        service.nearbySearch({
          location: pyrmont,
          radius: 10000,
          type: ['movie_theater']
        }, callback);
      }
 
      function callback(results, status) {
        if (status === google.maps.places.PlacesServiceStatus.OK) {
          for (var i = 0; i < results.length; i++) {
            document.getElementById("demo").innerHTML =  document.getElementById("demo").innerHTML + results[i].name + '<br>';
          }
        }
      }

      function createMarker(place) {
        var placeLoc = place.geometry.location;
      }
    </script>
  </head>
  <body>
    <div id="map"></div>
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCUTH6sC1_-D0NS9DkQiCueLq6TTMLilmo&libraries=places&callback=initMap" async defer></script>
  </body>
</html>