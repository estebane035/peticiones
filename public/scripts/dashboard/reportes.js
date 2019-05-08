var map;
var latlon;
var marcador;

function initMap()
{
  map = new google.maps.Map(document.getElementById('map'), {
    center: {lat: 20.6570586, lng: -103.3271426},
    zoom: 8
  });

  google.maps.event.addListener(map, 'click', function(event) {
   placeMarker(event.latLng);
	});
}



function placeMarker(location) {
	$("#latitud").val(location.lat);
	$("#longitud").val(location.lng);
   	map.panTo(location);
   	map.setZoom(8);
	if (!marcador)
   	{
   		marcador = new google.maps.Marker({
        	position: location, 
        	map: map
    	});
   	}
   	else
   	{
   		marcador.setPosition(location);
   	}
}

function buscar()
{
  latitud = $("#latitud").val();
  longitud = $("#longitud").val();
  rango = $("#rango").val();

  $.ajax({
    method: "GET",
    url: "/reportes/" + latitud + "/" + longitud  + "/" + rango ,
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    },
    success: function (response) {
      response.forEach(function(registro) {
         latlon = {lat: registro.latitud, lng: registro.longitud};
         var marker = new google.maps.Marker({
          position: latlon,
          map: map,
          title:  registro.tipo + "\n" + registro.estatus
        });

      });
      map.panTo(latlon);
    },
    error: function(xhr, ajaxOptions, thrownError){
      alert("error");
    }
  });
}
