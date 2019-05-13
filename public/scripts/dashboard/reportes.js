var map;
var latlon;
var marcador;
var zoom = 12;

function initMap()
{
  map = new google.maps.Map(document.getElementById('map'), {
    center: {lat: 20.6570586, lng: -103.3271426},
    zoom: zoom
  });

  google.maps.event.addListener(map, 'click', function(event) {
   placeMarker(event.latLng);
	});
}



function placeMarker(location) {
	$("#latitud").val(location.lat);
	$("#longitud").val(location.lng);
  map.panTo(location);
  map.setZoom(zoom);
	if (!marcador)
   	{
   		marcador = new google.maps.Marker({
        	position: location,
        	map: map,
          title: "Tu seleccion",
          icon: {
            url: "http://maps.google.com/mapfiles/ms/icons/blue-dot.png"
          }
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
  rango = parseFloat($("#rango").val());
  rango_alerta = parseFloat($("#rango_alerta").val());

  $.ajax({
    method: "GET",
    url: "/reportes/" + latitud + "/" + longitud  + "/" + rango + "/" + rango_alerta ,
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    },
    success: function (response) {
      centro = {lat: parseFloat(latitud), lng: parseFloat(longitud)};
      peticiones = response.peticiones;
      alerta = response.alerta;
      peticiones.forEach(function(registro) {
         latlon = {lat: parseFloat(registro.latitud), lng: parseFloat(registro.longitud)};

         icono = "";
         switch (registro.tipo) {
           case "Seguridad Publica":
              icono = "http://maps.google.com/mapfiles/ms/icons/pink-dot.png"
              break;
           case "Proteccion Civil":
              icono = "http://maps.google.com/mapfiles/ms/icons/yellow-dot.png"
              break;
           case "Asistencia Medica":
              icono = "http://maps.google.com/mapfiles/ms/icons/purple-dot.png"
              break;
         }
         var marker = new google.maps.Marker({
          position: latlon,
          map: map,
          title:  registro.tipo + "\n" + registro.estatus,
          icon: {
            url: icono
          }
        });

      });
      map.panTo(latlon);

      var cityCircle = new google.maps.Circle({
            strokeColor: '#00FFFF',
            strokeOpacity: 0.8,
            strokeWeight: 2,
            fillColor: '#00FFFF',
            fillOpacity: 0.10,
            map: map,
            center: centro,
            radius: rango * 1609
          });

      alerta.forEach(function(registro) {
        var cityCircle = new google.maps.Circle({
              strokeColor: '#FF0000',
              strokeOpacity: 0.8,
              strokeWeight: 2,
              fillColor: '#FF0000',
              fillOpacity: 0.10,
              map: map,
              center: {lat: parseFloat(registro.latitud), lng: parseFloat(registro.longitud)},
              radius: registro.rango * 1609
            });
      });

    },
    error: function(xhr, ajaxOptions, thrownError){
      alert("error");
    }
  });
}
