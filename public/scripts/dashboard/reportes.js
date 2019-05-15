var map;
var latlon;
var marcador;
var zoom = 12;
var markers = [];
var circulos = [];
var marker;
var cityCircle;

$(document).ready(function(){
  $('#datepicker-range').datepicker({ format: 'yyyy-mm-dd' });
});

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
  start = $("#start").val();
  end = $("#end").val();
  rango = parseFloat($("#rango").val());
  rango_alerta = parseFloat($("#rango_alerta").val());
  limpiarMapa();

  $.ajax({
    method: "GET",
    url: "/reportes/" + latitud + "/" + longitud  + "/" + rango + "/" + rango_alerta + "/" + start + "/" + end ,
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
         marker = new google.maps.Marker({
          position: latlon,
          map: map,
          title:  registro.tipo + "\n" + registro.estatus,
          icon: {
            url: icono
          }
        });
        markers.push(marker);

      });
      map.panTo(latlon);

      cityCircle = new google.maps.Circle({
            strokeColor: '#00FFFF',
            strokeOpacity: 0.8,
            strokeWeight: 2,
            fillColor: '#00FFFF',
            fillOpacity: 0.10,
            map: map,
            center: centro,
            radius: rango * 1609
          });
      circulos.push(cityCircle);    

      alerta.forEach(function(registro) {
        cityCircle = new google.maps.Circle({
              strokeColor: '#FF0000',
              strokeOpacity: 0.8,
              strokeWeight: 2,
              fillColor: '#FF0000',
              fillOpacity: 0.10,
              map: map,
              center: {lat: parseFloat(registro.latitud), lng: parseFloat(registro.longitud)},
              radius: registro.rango * 1609
            });
        circulos.push(cityCircle);
      });

    },
    error: function(xhr, ajaxOptions, thrownError){
      alert("error");
    }
  });
}

function limpiarMapa()
{
  for (var i = 0; i < markers.length; i++) {
    markers[i].setMap(null);
  }
  markers = [];

  for (var i = 0; i < circulos.length; i++) {
    circulos[i].setMap(null);
  }
  circulos = [];
}
