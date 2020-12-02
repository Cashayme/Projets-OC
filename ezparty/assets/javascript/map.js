function initMap() {
    if(document.getElementById('map')) {
        let map = new google.maps.Map(document.getElementById('map'), {
            zoom: 16,
          });
        
          let geocoder = new google.maps.Geocoder();
        
          window.addEventListener("load", function() {
            geocodeAddress(geocoder, map);
          });
        }
        
        function geocodeAddress(geocoder, resultsMap) {
          let address = document.getElementById('city-address').innerHTML.concat(' ', document.getElementById('address').innerHTML);
          //Address contient la ville et l'adresse exacte de l'event, c'est elle qui sera geocodé par gMap
          geocoder.geocode({'address': address}, function(results, status) {
            if (status === 'OK') {
              document.getElementById("itinerary").href = "https://maps.google.com/?q=" + results[0].geometry.location.lat() + "," + results[0].geometry.location.lng();
              //Ci-dessus, créer le lien vers gMap du lieu selon la lattitude et longitude renvoyé par le geocoder
              resultsMap.setCenter(results[0].geometry.location);
              let marker = new google.maps.Marker({
                map: resultsMap,
                position: results[0].geometry.location
              });
            } else {
              alert('Geocode was not successful for the following reason: ' + status);
            }
          });
    }
  }