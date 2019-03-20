$(document).ready(function(){
  _cargarTabla('#dt-peticiones', '/peticiones/cargarTablaNoAtendidas', '#carga-dt',
                [{data:'id', width: '20%'},
                {data:'coordenadas', width: '30%'},
                {data:'tipo', width: '30%'},
                {data:'actions', width: '20%', orderable:false, sercheable:false}
              ]);
});

function atenderPeticion(id, latitud, longitud)
{
  _mostrarFormulario("/peticiones/" + id + "/atender", //Url solicitud de datos
                    "#modal_1", //Div que contendra el modal
                    "#modal-crear", //Nombre modal
                    "#nombre", //Elemento al que se le dara focus
                    function(){
                      $("#estatus").select2();
                      initMap(latitud, longitud);
                    }, //Funcion para el success
                    "#form-agregar", //ID del Formulario
                    "#carga-agregar", //Loading de guardar datos de formulario
                    "#div-notificacion", //Div donde mostrara el error en caso de, vacio lo muestra en toastr
                    function(){
                      $('#modal-crear').modal('hide');
                      _recargarTabla('#dt-peticiones');
                    });//Funcion en caso de guardar correctamente);
}

function initMap(latitud, longitud)
{
  map = new google.maps.Map(document.getElementById('mapa'), {
    center: {lat: latitud, lng: longitud},
    zoom: 8
  });

  var marcador = new google.maps.Marker({
          position: {lat: latitud, lng: longitud},
          map: map,
          title: 'Lugar de la peticion'
        });
}
