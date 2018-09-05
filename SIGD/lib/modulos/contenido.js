// variables
var $name=$('#nombreC');
var $btnAccion1= $('#accionar');//Registrar cuando no tiene atributos data es registrar pero cuando si los tiene es modificar
var $btnAccion2= $('.modificar');//Mostrar modal modificar-->Ya no es necesaria esta variable
var $modal=$('#gestionarAccion');
// 
$(document).ready(function($) {
	// Consultar Contenidos
	consultarContenidos(localStorage.getItem('idTipoP'),localStorage.getItem('Contenido'));//ID tipo proceso e ID Contendio

	// Mostrar modal Registrar
	$('#agregar').click(function(event) {
		$btnAccion1.text('Registrar');
		$btnAccion1.data('idcon', 0);
		$btnAccion1.data('idproc', 0);
		$name.val('');
		$modal.modal('show');
		// Cambiar valores del boton del modal para registrar
	});

	// Registrar Gestiones, Procesos o sub-procesos
	$btnAccion1.click(function(event) {
		registrarModificarContenido($(this).data('idcon'),$(this).data('idproc'));
	});

	// Modificar Gestiones, Procesos o sub-procesos
	$btnAccion2.click(function(event) {
		registrarModificarContenido();
	});

	// ToolTip
	$('[data-toggle="tooltip"]').tooltip();
});

// Mostrar modal editar Contenido
function mostrarModalEditar(idCon,idProc,nombre,event) {
	event.preventDefault();
	$btnAccion1.text('Modificar');
	$btnAccion1.data('idcon', idCon);
	$btnAccion1.data('idproc', idProc);
	$name.val(nombre);
	$modal.modal('show');
}
// Cambiar estado del contenido que este visible o no visible
function cambiarEstadoContenido(idCon,idProc,event) {
	event.preventDefault();
	swal({
      title: "¿Estas seguro?",
      text: 'Se cambiara el estado...',
      icon: "warning",
      buttons: true,
      dangerMode: true,
    }).then((result) => {
		if (result) {
			$.post(baseurl+'cContenido/cambiarEstadoContenido', {idCon: idCon, idProceso: idProc}, function(data) {
				consultarContenidos(localStorage.getItem('idTipoP'),localStorage.getItem('Contenido'));//ID de tipo de proceso
				swal('Realizado!','Se cambio el estado correctamente.','success',{buttons: false, timer: 2000});
			});
		}
    });	
}

function registrarModificarContenido(idCon,idProc) {
	op=0;
	if ($name.val()!='') {
		swal({
			  title: "¿Estas seguro?",
			  text: 'Se '+(op==0?'Registrara':'Modificara')+' la gestion.',
			  icon: "warning",
			  buttons: true,
			  dangerMode: true,
			}).then((result) => {
				if (result) {
					$.ajax({
						url: baseurl+'cContenido/registrarModificarContenido',
						type: 'POST',
						// dataType: 'json',
						data: {
							// Es el id de la tabla de procesos en la base de datos
							idCon: idCon,//Variable del contenido, va a ser una variable data del contenedor de la gestion
							nombre: $name.val(),//Nombre del proceso
							tipoProceso: $btnAccion1.val(),//Variable global del contenido
							idProceso: idProc,//Aplica solo para el contenido de procesos y sub procesos el de gestiones se calcula en la base de datos
							// Va a ser una variable data en el componente
							},
					})
					.done(function(dato) {
						// console.log("success "+dato);
						consultarContenidos(localStorage.getItem('idTipoP'),localStorage.getItem('Contenido'));
						$modal.modal('hide');
						swal('Realizado!','La gestion fue '+dato==1?'Registrada':'Modificar'+'Correctamente','success',{buttons: false, timer: 2000});
					})
					.fail(function() {
						console.log("error");
					});
				}
			});
	}else{
		$name.parent('div').addClass('has-error');
	}
}
// No hace falta utilizarlo
function cambiarContenidoVista(idCon,idTipoP,event) {
	event.preventDefault();
	localStorage.setItem('Contenido',idCon);
	localStorage.setItem('idTipoP',(idTipoP+1));
	consultarContenidos(idCon,(idTipoP+1));
}

function consultarContenidos(tipo,idcon) {
	$.post(baseurl+'cContenido/consultarContendio', {idCon: idcon, tipoP: tipo}, function(data) {
		var result= JSON.parse(data);
		/*optional stuff to do after success */
		var con=0;
		$('#contenido').children('div').hide('fast', function() {
			// $(this).remove();
			$(this).empty();
		});
		var mensaje='';
		$.post(baseurl+'cLogin/recuperarRol', function(data) {//La plantila se deforma cuando se agregan muchos componenetes
					//
					var tipo=data;
					$.each(result,function(index, item) {
						// 
						if (con==0) {//Inicio de fila
							$('#contenido').append('<div class="row">');//Filas del contenido
							// mensaje+='<div class="row" hidden>';
						}
						// Contenido-....mensaje+=
						$('#contenido').append('<div class="col-lg-3 col-md-6">'+
								// Clasificar el color del componenete con el idtipo_proceso
			                    '<div class="panel panel-primary" hidden>'+
			                        '<div class="panel-heading">'+
			                            '<div class="row">'+
			                                '<div class="col-xs-3">'+
			                                    '<i class="fa fa-tasks fa-5x"></i>'+
			                                '</div>'+
			                                '<div class="col-xs-9 text-right">'+
			                                    '<!-- Cantidad de Procesos -->'+
			                                    (tipo==1?'<div>'+
			                                        '<!-- Editar -->'+
			                                        '<a href="" data-toggle="tooltip" data-placement="top" title="Editar" onclick="mostrarModalEditar('+item.idProceso+','+item.idProceso_sub+',\''+item.nombre_proceso+'\',event)" class="modificar" data-idcon="'+item.idProceso+'" data-idproc="'+item.idProceso_sub+'"><span><i class="fas fa-edit" style="color: #0048A2; width: 30; "></i></span></a>'+
			                                        '<!-- Cambiar estado esta pendiente por hacer -->'+
			                                        // Clasificar el estado del boron
			                                        '<a href="" data-toggle="tooltip" data-placement="top" title="'+(item.estado_visibilidad==1?'Visible':'No visible')+'" onclick="cambiarEstadoContenido('+item.idProceso+','+item.idProceso_sub+',event)" class="cambiarEstado" data-idcon="'+item.idProceso+'" data-idproc="'+item.idProceso_sub+'"><span><i '+(item.estado_visibilidad==1?'class="fas fa-eye " style="color:#12FF00; width: 30;"':'class="fas fa-eye-slash" style="color:#FF0000; width: 30;"')+'></i></span></a>'+
			                                    '</div>':'<br>')+
			                                    '<!-- Numero de documentos que tiene este componenete -->'+
			                                    '<div class="huge">'+item.cantidad+'</div>'+
			                                    '<div>'+item.nombre_proceso+'</div>'+
			                                '</div>'+
			                            '</div>'+
			                        '</div>'+
			                        '<a href="#" onclick="cambiarContenidoVista('+item.idProceso+','+item.idtipo_proceso+',event)">'+
			                            '<div class="panel-footer">'+
			                                '<span class="pull-left">Detalles</span>'+
			                                '<span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>'+
			                                '<div class="clearfix"></div>'+
			                            '</div>'+
			                        '</a>'+
			                    '</div>'+
			                 '</div>');
						// Fin del contenido-...
						con++;
						if (con==4) {//Fin de fila
						  $('#contenido').append('</div>');//Fin de la fila de contenido
						  // mensaje+='</div>';
						  con=0;
						}
					});
					if (con>0 && con<4) {
						$('#contenido').append('</div>');//Fin de la fila de contenido
						// mensaje+='</div>';
					}
					// $('#contenido').append($(mensaje));
					$('#contenido').children('div').children('div').show('slow');
					// setTimeout(function () {
					// 	height
					// 	$('#contenido').children('div').children('div').show('slow');
					// },200);
		});
	});
}
// Contenido de la vista
// <div class="row">
//    <div class="col-lg-3 col-md-6">
//       <!-- <div class="panel panel-green"> -->
//       <!-- <div class="panel panel-yellow"> -->
//       <div class="panel panel-primary">
//           <div class="panel-heading">
//               <div class="row">
//                   <div class="col-xs-3">
//                       <!-- <i class="fa fa-comments fa-5x"></i> -->
//                       <i class="fa fa-tasks fa-5x"></i>
//                   </div>
//                   <div class="col-xs-9 text-right">
//                       <!-- Cantidad de Procesos -->
//                       <div>
//                           <!-- Editar -->
//                           <a href="" id="modificar" data-idcon="1" data-idproc="1"><span><i class="fas fa-edit" style="color: #12FF00 ; width: 30; "></i></span></a>
//                           <!-- Cambiar estado esta pendiente por hacer -->
//                           <a href="" id="cambiarEstado" data-idcon="1" data-idproc="1"><span><i class="fas fa-check-square" style="color: #12FF00 ; width: 30; "></i></span></a>
//                       </div>
//                       <!-- Numero de documentos que tiene este componenete -->
//                       <div class="huge">26</div>
//                       <div>Nombre Gestion</div>
//                   </div>
//               </div>
//           </div>
//           <a href="#">
//               <div class="panel-footer">
//                   <span class="pull-left">Detalles</span>
//                   <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
//                   <div class="clearfix"></div>
//               </div>
//           </a>
//       </div>
//    </div>
// </div>