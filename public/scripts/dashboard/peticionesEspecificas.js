var tipo = $("#_tipo").val();
$(document).ready(function(){
  _cargarTabla('#dt-datos', '/peticiones/cargarTabla/' + tipo , '#carga-dt',
                [{data:'id', width: '20%'},
                {data:'coordenadas', width: '30%'},
                {data:'estatus', width: '30%'},
                {data:'actions', width: '20%', orderable:false, sercheable:false}
              ]);
  //google.maps.event.addDomListener(window, 'load', initAutocomplete);
});

function agregar()
{
  _mostrarFormulario("/peticiones/create", //Url solicitud de datos
                    "#modal_1", //Div que contendra el modal
                    "#modal-crear", //Nombre modal
                    "#nombre", //Elemento al que se le dara focus
                    function(){
                      $("#tipo").select2();
                    }, //Funcion para el success
                    "#form-agregar", //ID del Formulario
                    "#carga-agregar", //Loading de guardar datos de formulario
                    "#div-notificacion", //Div donde mostrara el error en caso de, vacio lo muestra en toastr
                    function(){
                      $('#modal-crear').modal('hide');
                      _recargarTabla('#dt-datos');
                    });//Funcion en caso de guardar correctamente);
}

function editar(id)
{
  _mostrarFormulario("/peticiones/" + id + "/edit", //Url solicitud de datos
                    "#modal_1", //Div que contendra el modal
                    "#modal-crear", //Nombre modal
                    "#nombre", //Elemento al que se le dara focus
                    function(){
                      $("#tipo").select2();
                    }, //Funcion para el success
                    "#form-agregar", //ID del Formulario
                    "#carga-agregar", //Loading de guardar datos de formulario
                    "#div-notificacion", //Div donde mostrara el error en caso de, vacio lo muestra en toastr
                    function(){
                      $('#modal-crear').modal('hide');
                      _recargarTabla('#dt-datos');
                    });//Funcion en caso de guardar correctamente);
}

function eliminar(id)
{
  _mostrarFormulario("/peticiones/" + id + "/delete", //Url solicitud de datos
                    "#modal_1", //Div que contendra el modal
                    "#modal-eliminar", //Nombre modal
                    "#nombre", //Elemento al que se le dara focus
                    function(){
                    }, //Funcion para el success
                    "#form-eliminar", //ID del Formulario
                    "#carga-agregar", //Loading de guardar datos de formulario
                    "#div-notificacion", //Div donde mostrara el error en caso de, vacio lo muestra en toastr
                    function(){
                      $('#modal-eliminar').modal('hide');
                      _recargarTabla('#dt-datos');
                    });//Funcion en caso de guardar correctamente);
}
