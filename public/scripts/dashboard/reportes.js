var map;
var latlon;

function initMap()
{
  map = new google.maps.Map(document.getElementById('map'), {
    center: {lat: -34.397, lng: 150.644},
    zoom: 8
  });
}

function buscar()
{
  latitud = $("#latitud").val();
  longitud = $("#longitud").val();

  $.ajax({
    method: "GET",
    url: "/reportes/" + latitud + "/" + longitud  ,
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
