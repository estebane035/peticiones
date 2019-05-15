$(document).ready(function(){
  var latitud = parseFloat($("#latitud").val());
  var longitud = parseFloat($("#longitud").val());
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

function agregarComentario(id_peticion)
{
  _mostrarFormulario("/comentarios/create/" + id_peticion, //Url solicitud de datos
                    "#modal_1", //Div que contendra el modal
                    "#modal-crear", //Nombre modal
                    "#contenido", //Elemento al que se le dara focus
                    function(){
                    }, //Funcion para el success
                    "#form-agregar", //ID del Formulario
                    "#carga-agregar", //Loading de guardar datos de formulario
                    "#div-notificacion", //Div donde mostrara el error en caso de, vacio lo muestra en toastr
                    function(){
                      $('#modal-crear').modal('hide');
                    });//Funcion en caso de guardar correctamente);
}
