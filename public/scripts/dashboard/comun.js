$(document).ready(() => {
  // Se debe configurar primero todos los loader con la clase 'widget-loader-bar'
  var bars = $('.widget-loader-bar')
  bars.each(function() {
      var elem = $(this);
      elem.card({
          progress: 'bar',
          onRefresh: function() {
              console.log('onRefresh')
          }
      });
  });
})
$(document).on('show.bs.modal', '.modal', function () {
    $('body').tooltip({
      selector: "[data-tooltip=tooltip]",
      container: "body"
      });
  });

/**
 * [Función _mostrarFormulario: muestra en front un modal que se llama con ajax a una ruta en específico]
 * @param       {[String]}    url              [Url donde se realiza la petición, ésta debe devolver el html del modal]
 * @param       {[String]}    modal            [ID del div donde se mostrará el modal]
 * @param       {[String]}    nombreModal      [ID del modal que se devuelve en la petición]
 * @param       {[String]}    elementoFocus    [ID del elemento donde se hará el focus luego de abrir el modal]
 * @param       {[Function]}  funcionCargaForm [Función que se ejecuta luego de abrir el modal (para configurar elementos, etc.)]
 * @param       {[String]}    form             [ID del formulario contenido en el modal]
 * @param       {[String]}    progress         [ID de la barra de progreso que se mostrará cuando se envíe el formulario]
 * @param       {[String]}    notificacion     [ID del div donde se mostrará la respuesta]
 * @param       {[Function]}  funcionExito     [Función ejecutada después del éxito en la petición]
 */
function _mostrarFormulario(
  url,
  modal,
  nombreModal,
  elementoFocus,
  funcionCargaForm,
  form,
  progress,
  notificacion,
  funcionExito) {
    $.ajax({
        type: "GET",
        url: url,
        success: function(html){
            $(modal).html(html);
            $(modal).on('shown.bs.modal', function () {
              setTimeout(function(){ $(elementoFocus).focus(); }, 500);
            });
            if( $(nombreModal).length<=0){
               $("#modal-error").modal('show');
            }else{
               $(nombreModal).modal('show');
            }
            funcionCargaForm();
            _formAjax(form,progress,notificacion,funcionExito);
        },
        error: function(xhr, ajaxOptions, thrownError){
            errorEjecucion(xhr,notificacion,form,progress);
        }
    })
}

/**
 * [Función _formAjax: Función para enviar un formulario por ajax, utilizando validate y enviando todo el formulario]
 * @param       {[String]}    formulario   [ID del formulario a enviar]
 * @param       {[String]}    progress     [ID de la barra de progreso que se mostrará cuando se envíe el formulario]
 * @param       {[String]}    notificacion [ID del div donde se mostrará la respuesta]
 * @param       {[Function]}  funcionExito [Función ejecutada después del éxito en la petición]
 */
function _formAjax(formulario, progress, notificacion, funcionExito) {
  console.log("formulario: "+formulario);
  $(formulario).validate({
  submitHandler: function(form){
    $(form).ajaxSubmit({
      beforeSend: function() {
        console.log('beforeSend');
        //Desactiva formulario
        $(notificacion).html('');
        $(progress).removeClass('hidden');
        $(formulario).find('input, textarea, button, select').attr('disabled',true);
      },
      success: function(respuesta){
        // console.log(respuesta)
        $(formulario).find('input, textarea, button, select').not(".disabled").attr('disabled',false);
        $(progress).addClass('hidden');
        estandarRespuesta(respuesta,notificacion,funcionExito);
      },
      error: function(xhr, ajaxOptions, thrownError){
        console.log(thrownError)
        errorEjecucion(xhr,notificacion,formulario,progress);
      }
    })
    }
  })
  $(formulario).each(function () {
    if ($(this).data('validator'))
        $(this).data('validator').settings.ignore = ".note-editor *";
});
}

/**
 * [Función estandarRespuesta: Función ejecutada en _formAjax luego del success]
 * @param       {[String]}   respuesta    [Respuesta de la petición]
 * @param       {[String]}   notificacion [ID del div donde se mostrará la respuesta]
 * @param       {[Function]} funcionExito [Función ejecutada después del éxito en la petición]
 */
function estandarRespuesta(respuesta,notificacion,funcionExito) {
  if(isNaN(respuesta)){
      if(respuesta.hasOwnProperty('message')) _notification('success', 'Mensaje', respuesta.message, 'top-right');
      if(respuesta.hasOwnProperty('url')) location.assign(respuesta.url)
      else funcionExito(respuesta)
  }else{
    //La respuesta no cumple con estandar de codigos de ejecucion
    //Mostramos Toastr con el mensaje: La respuesta no tiene el formato correcto
    _notification('danger', 'error', respuesta.message, 'top-right');
  }
}

/**
 * [Función errorEjecucion: Se ejecuta cuando ocurre un error en la función _formAjax]
 * @param       {[Object]} xhr          [Respuesta de error]
 * @param       {[String]} notificacion [ID del div donde se mostrará la respuesta]
 * @param       {[String]} formulario   [ID del formulario]
 * @param       {[String]} progress     [ID de la barra de progreso que se mostrará cuando se envíe el formulario]
 */
function errorEjecucion(xhr,notificacion,formulario,progress) {
  console.log(xhr)
  //Hubo un error en la ejecucion
  //Mostramos Toastr con la respuesta
  //xhr.responseText
  //Aqui hay que mandarla en modal lateral
  var string = 'Algo salió mal:<br/>';
  if(xhr.status==422){
      var errors = xhr.responseJSON.errors;
      $.each(errors, function(index2, item2){
        $.each(item2, function(index3, item3){
          string+='-'+item3+"<br/>";
          i++;
        });

      });
      _notificationDiv(notificacion,'alerta',string);
      $(formulario).find('input, textarea, button, select').attr('disabled',false);
      $(progress).addClass('hidden');
      return false;
  }
  try {
      json = $.parseJSON(xhr.responseText);
      var i=0;
      $.each(xhr.responseJSON, function(index, item) {
        console.log(typeof(item));
        if(index == 'error' && item=='Unauthenticated.') {
          Unauthenticated("El usuario ha perdido la sesión. Se cerrará la pagina en 3 segundos.");
        } else {
            string+='-'+item+"<br/>";
        }
        i++;
      });
      _notificationDiv(notificacion,'alerta',string);
      $(formulario).find('input, textarea, button, select').attr('disabled',false);
      $(progress).addClass('hidden');
  } catch (e) {
      $(formulario).find('input, textarea, button, select').attr('disabled',false);
      $(progress).addClass('hidden');
      $('#modal-error-contenido').html(xhr.responseText);
      $('#modal-error').modal('show');
  }
}

/**
 * [Función _cargarTabla: Función para realizar la carga de una tabla datatables y configurarla]
 * @param       {[String]}  tableId  [ID del div que contiene la tabla]
 * @param       {[String]}  urlData  [Url a donde se hace la petición]
 * @param       {[String]}  progress [ID de la barra de progreso que se mostrará cuando se envíe el formulario]
 * @param       {[Array]}   columnas  [Array que contiene el nombre de las columnas y su tamaño]
 * @param       {[Integer]} sorting
 * @param       {[String]}  typeSorting [Order ascending or descending]
 * @param       {[Array]}   columnDefs  [Definiciones para las columnas]
 */
function _cargarTabla(tableId, urlData, progress, columnas, sorting=0, typeSorting='desc', columnDefs = []) {
  // Se activa el refresh
  $(progress).data('pg.card') && $(progress).card({
      refresh: true
  })
  $(tableId).DataTable({
      dom: 'Bfrtip',
      processing: false,
      serverSide: true,
      order: [[sorting, typeSorting]],
      ajax:{
          url :urlData,
          type: "get",
          beforeSend: function() {
            //$(progress).removeClass('hidden');
          },
          complete: function() {
            //$(progress).addClass('hidden');
            setTimeout(() => {
              $(progress).card({
                  refresh: false
              })
            }, 1000)
            $('[data-toggle="tooltip"]').tooltip();
          },
          error: function(xhr, ajaxOptions, thrownError){
              //Hubo un error en la ejecucion
              //Mostramos Toastr con la respuesta
              //xhr.responseText
              //_toast('alerta',xhr.responseText);
              setTimeout(() => {
                $(progress).card({
                    refresh: false
                })
              }, 1000)
              alert(xhr.responseText);
          }
      },
      columns: columnas,
      columnDefs: columnDefs
  });
  $(tableId).dataTable().fnFilterOnReturn();
}

/**
 * [Función _recargarTabla: Función para volver a cargar la tabla con los datos desde la base de datos]
 * @param       {[String]} div [D del div que contiene la tabla]
 */
function _recargarTabla(div){
    $(div).DataTable().ajax.reload();
}

/**
 * [Función _llenarSelect: Función para llenar dinámicamente un select desde una url]
 * @param       {[String]} id        [ID del select]
 * @param       {[String]} urlData   [Url donde se hará la petición de los datos]
 * @param       {[String]} condicion [Condición para la petición]
 */
function _llenarSelect(id, urlData, condicion) {
  $(id).select2({
    ajax: {
      type: "POST",
      url: urlData,
      dataType: 'json',
      allowClear: true,
      placeholder: "Select an attribute",
      delay: 250,
      data: function (params) {
           return {
               q: params.term,
               condicion: condicion,
               _token:$('[name="_token"]').val()
           };
       },
       processResults: function (data) {
           return {
               results: data
           };
       },
       cache: true
   },
   minimumInputLength: 2
  });
}

/**
 * [Función _recargarSelect: Función para recargar un select]
 * @param       {[String]} url    [Url donde se hará la petición de los datos]
 * @param       {[String]} select [ID del select]
 * @constructor
 * @return      {[type]}        [description]
 */
function _recargarSelect(url, select) {
  $.ajax({
      method: "GET",
      url: url,
      headers: {
          'X-CSRF-TOKEN': $('#_token').val()
      },
      success: function (response) {
          $(select).select2('destroy');
          $(select).html(response);
          $(select).select2();
      },
      error: function(xhr, ajaxOptions, thrownError){
        errorEjecucion(xhr,"","","");
      }
    });
}

/**
 * [Función _notificationDiv: Función que muestra una respuesta en un div en específico, mostrando un alert de bootstrap]
 * @param       {[String]} div   [ID del div donde se mostrará el mensaje]
 * @param       {[String]} tipo  [Tipo de mensaje (clases de bootstrap)]
 * @param       {[String]} texto [Texto de dicho mensaje]
 */
function _notificationDiv(div,tipo,texto) {
  //Tipos error, alerta, exito, info
  var titulo,icono,clase;
  switch(tipo) {
      case "error":
          titulo="Error";
          icono="frown-o";
          clase='danger';
          break;
      case "alerta":
          titulo="Alerta";
          icono="meh-o";
          clase='warning';
          break;
      case "exito":
          titulo="Exito";
          icono="smile-o";
          clase='success';
          break;
      default:
          titulo="Info";
          icono="commenting";
          clase='info';
  }
  $(div).html('<div class="alert alert-'+clase+' bordered" role="alert"><button style="margin-right: -11px;margin-top: -7px;" class="close" data-dismiss="alert"></button><p class="pull-left"><strong><i class="fa fa-'+icono+'" aria-hidden="true"></i> '+titulo+':</strong> '+texto+'</p><div class="clearfix"></div></div>');
      //alerta success info warning danger
}

/**
 * [Función _notification: Función para uso de las notificaciones de la plantilla Pages]
 * @param       {[String]}  type       [Tipo de notificación (clases de bootstrap)]
 * @param       {[String]}  title      [Título de la notificación]
 * @param       {[String]}  message    [Mensaje de la notificación]
 * @param       {[String]}  position   [Posición en la pantalla donde se mostrará la notificación
 *                                     Existen 4: 'top-right', 'top-left', 'bottom-right', 'bottom-left']
 * @param       {[Integer]} timeout    [Tiempo de espera hasta que desaparezca la notificación]
 */
function _notification(type, title, message, position = 'bottom-right', style = 'circle', timeout = 4000) {
  if(style == 'circle') {
    $('body').pgNotification({
        style: 'circle',
        title: title,
        message: message,
        position: position,
        timeout: timeout,
        type: type,
        thumbnail: '<img width="40" height="40" style="display: inline-block;" src="/img/users/no-avatar.png" data-src="assets/img/profiles/avatar.jpg" data-src-retina="assets/img/profiles/avatar2x.jpg" alt="">'
    }).show()
  }
  else {
    $('body').pgNotification({
        style: style,
        title: title,
        message: message,
        position: position,
        timeout: timeout,
        type: type,
    }).show()
  }
}

/**
 * [Función _cargarVista: Función para cargar una vista html en un div]
 * @param       {[String]}    div                   [ID del div donde se cargará la vista]
 * @param       {[String]}    url                   [Url de la petición]
 * @param       {[Object]}    data                  [Objeto que se enviará en la petición de ser necesario]
 * @param       {[Function]}  customFunctionSuccess [Función a ejecutar en éxito]
 * @param       {[Function]}  customFunctionError   [Función a ejecutar en error]
 * @param       {[String]}    progress              [ID de la barra de progreso que se mostrará cuando se envíe la petición]
 */
function _cargarVista(div, url, data, customFunctionSuccess, customFunctionError, progress) {
  console.log($('#_token').val());
  var dat;
  if(data !== 'undefined')
    dat = data;
  $.ajax({
    type: "POST",
    url: url,
    headers: {
        'X-CSRF-TOKEN': $('#_token').val()
    },
    data: dat,
    beforeSend: function() {
      console.log('beforeSend');
      $(progress).removeClass('hidden');
    },
    success: function(html){
      $('#'+div).html(html);
      $(progress).addClass('hidden');
      if(typeof customFunctionSuccess !== 'undefined')
        customFunctionSuccess();
    },
    error: function(xhr, ajaxOptions, thrownError){
      $(progress).addClass('hidden');
      errorEjecucion(xhr,'#'+div,"","");
      if(typeof customFunctionError !== 'undefined')
        customFunctionError();
    }
  });
}

/**
 * [Función _cargarVistaLoader: Función para cargar una vista html en un div, utilizando un loader en progress]
 * @param       {[String]}    div                   [ID del div donde se cargará la vista]
 * @param       {[String]}    url                   [Url de la petición]
 * @param       {[Object]}    data                  [Objeto que se enviará en la petición de ser necesario]
 * @param       {[Function]}  customFunctionSuccess [Función a ejecutar en éxito]
 * @param       {[Function]}  customFunctionError   [Función a ejecutar en error]
 * @param       {[String]}    progress              [ID de la barra de progreso que se mostrará cuando se envíe la petición]
 */
function _cargarVistaLoader(div, url, data, customFunctionSuccess, customFunctionError, progress) {
  let bar = $(progress)
  bar.card({
      progress: 'bar',
      onRefresh: function() {
      }
  })
  var dat;
  if(data !== 'undefined')
    dat = data;
  $.ajax({
    type: "POST",
    url: url,
    headers: {
        'X-CSRF-TOKEN': $('#_token').val()
    },
    data: dat,
    beforeSend: function() {
      console.log('beforeSend')
    },
    success: function(html){
      console.log('Success')
      setTimeout(() => {
        bar.card({
            refresh: false
        })
      }, 500)
      $('#'+div).html(html);
      if(typeof customFunctionSuccess !== 'undefined')
        customFunctionSuccess();
    },
    error: function(xhr, ajaxOptions, thrownError){
      setTimeout(() => {
        bar.card({
            refresh: false
        })
      }, 500)
      errorEjecucion(xhr,'#'+div,"","");
      if(typeof customFunctionError !== 'undefined')
        customFunctionError();
    }
  });
}

function _llamadaAjax(url, data, divRespuesta, funcionExito, metodo = "POST") {
  $.ajax({
    method: metodo,
    url: url,
    headers: {
        'X-CSRF-TOKEN': $('#_token').val()
    },
    data: data,
    success: function (response) {
        estandarRespuesta(response,divRespuesta,funcionExito);
    },
    error: function(xhr, ajaxOptions, thrownError){
      errorEjecucion(xhr,divRespuesta,"","");
    }
  });
}

function _llamadaAjaxWithResponse(url, data, metodo = "POST") {
  return $.ajax({
    method: metodo,
    url: url,
    headers: {
        'X-CSRF-TOKEN': $('#_token').val()
    },
    data: data,
    success: function (response) {
      return response;
    },
    error: function(xhr, ajaxOptions, thrownError){
      // console.log(xhr)
      return xhr;
    }
  })
}

function permiteNumerosConDecimalN(evt, obj) {
  var charCode = (evt.which) ? evt.which : event.keyCode
  var value = obj.value;

  var dotcontains = value.indexOf(".") != -1;
  var dotcontains2 = value.indexOf("-") >0;
  if (charCode == 45) return false;

    if (dotcontains)
        if (charCode == 46) return false;
  if(dotcontains2)
    if (charCode == 45) return false;
    if (charCode == 46 && value!='') return true;
  if (charCode == 45 && value=='') return true;
    if (charCode > 31 && (charCode < 48 || charCode > 57))
        return false;
    return true;

}

function permiteNumerosConDecimal(evt, obj) {
    var charCode = (evt.which) ? evt.which : event.keyCode
    var value = obj.value;

    var dotcontains = value.indexOf(".") != -1;
    if (dotcontains)
        if (charCode == 46) return false;
    if (charCode == 46 && value!='') return true;
    if (charCode > 31 && (charCode < 48 || charCode > 57))
        return false;
    return true;

}

function permiteNumerosSinDecimal(evt, obj) {
    var charCode = (evt.which) ? evt.which : event.keyCode
    var value = obj.value;
    var dotcontains = value.indexOf(".") != 1;
    if (dotcontains)
        if (charCode == 46) return false;
    if (charCode == 46) return true;
    if (charCode > 31 && (charCode < 48 || charCode > 57))
        return false;
    return true;

}

function _cargarGrafica(type, url, data, labels, graph, successFunction, total1, total2) {
  $.ajax({
    type: 'POST',
    url: url,
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    },
    data: data,
    success: function(response) {
      if(type == 'lineChart') {
        var total = 0;
        var totalExpended = 0;
        income = [0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0];
        expenses = [0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0];
        successFunction(response, income, expenses);
        var lineData = {
            labels: labels,
            datasets: [
              {
                  label: "Expenses",
                  backgroundColor: 'rgba(220, 220, 220, 0.5)',
                  pointBorderColor: "#fff",
                  data: expenses
              },
              {
                  label: "Income",
                  backgroundColor: "rgba(26,179,148,0.5)",
                  borderColor: "rgba(26,179,148,0.7)",
                  pointBackgroundColor: "rgba(26,179,148,1)",
                  pointBorderColor: "#fff",
                  data: income
              }
            ]
        };
      }
      var lineOptions = {
          responsive: true
      };

      var ctx = document.getElementById(graph).getContext("2d");
      if(type == 'lineChart') {
        $('#' + total1).html('$ ' + parseFloat(total).formatMoney(2, '.', ','));
        $('#' + total2).html('$ ' + parseFloat(totalExpended).formatMoney(2, '.', ','));
        new Chart(ctx, {type: 'line', data: lineData, options:lineOptions});
      }
    },
    error: function(error) {
      console.log(error);
    }
  });
}

Number.prototype.formatMoney = function(c, d, t) {
    var n = this,
    c = isNaN(c = Math.abs(c)) ? 2 : c,
    d = d == undefined ? "." : d,
    t = t == undefined ? "," : t,
    s = n < 0 ? "-" : "",
    i = String(parseInt(n = Math.abs(Number(n) || 0).toFixed(c))),
    j = (j = i.length) > 3 ? j % 3 : 0;
   return s + (j ? i.substr(0, j) + t : "") + i.substr(j).replace(/(\d{3})(?=\d)/g, "$1" + t) + (c ? d + Math.abs(n - i).toFixed(c).slice(2) : "");
 };

function copiarContenido(de, hacia) {
  $(hacia).val($(de).val());
}

function misDatos() {
  _mostrarFormulario("/dashboard/misDatos/edit", //Url solicitud de datos
                    "#modal_1", //Div que contendra el modal
                    "#modal-crear", //Nombre modal
                    "#nombre", //Elemento al que se le dara focus
                    function(){
                    }, //Funcion para el success
                    "#form-agregar", //ID del Formulario
                    "#carga-agregar", //Loading de guardar datos de formulario
                    "#div-notificacion", //Div donde mostrara el error en caso de, vacio lo muestra en toastr
                    function(){
                      $('#modal-crear').modal('hide');
                      location.reload();
                    });//Funcion en caso de guardar correctamente);
}
