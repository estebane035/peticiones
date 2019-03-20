$(document).ready(function(){
  var latitud = parseInt($("#latitud").val());
  var longitud = parseInt($("#longitud").val());
  map = new google.maps.Map(document.getElementById('map'), {
    center: {lat: latitud, lng: longitud},
    zoom: 8
  });

  var marcador = new google.maps.Marker({
          position: {lat: latitud, lng: longitud},
          map: map,
          title: 'Lugar de la peticion'
        });
});
