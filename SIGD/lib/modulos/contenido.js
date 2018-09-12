// variables idCon=ID del proceso y idProc=ID del sub-proceso > tabla de proceso
var $name=$('#nombreC');
var $btnAccion1= $('#accionar');//Registrar cuando no tiene atributos data es registrar pero cuando si los tiene es modificar
var $btnAccion2= $('.modificar');//Mostrar modal modificar-->Ya no es necesaria esta variable
var $modal1=$('#gestionarAccion');
var $modal2=$('#gestionDocumentos');
var $PosicionActual=$('#direccionamiento');
// 
$(document).ready(function($) {
	// Consultar Contenidos
	consultarContenidos(localStorage.getItem('idTipoP'),localStorage.getItem('Contenido'));//ID tipo proceso e ID Contendio

	//Registrar o Modificar Documentos
	$('#formularioDoc').submit(function(event) {
		event.preventDefault();
		// Validar formulario esta pendiente
		if ($('#userfile').val()=='') {
			console.log('Porfavor carga un documento');
		}else{
			// cargar el documento
			$.ajax({
				url: baseurl+'cDocumento/registrarModificarInfoDocumento',
				type: 'POST',
				data: new FormData(this),
				contentType: false,
				cache: false,
				processData: false,
				success:function (data) {
					console.log(data);
				}
			})
			.fail(function() {
				console.log("error");
			});
		}
	});

	// Mostrar modal Registrar
	$('#agregar').click(function(event) {
		$btnAccion1.text('Registrar');
		$btnAccion1.data('idcon', 0);//Listo para registrar gestiones
		$btnAccion1.data('idproc', localStorage.getItem('Contenido'));
		$btnAccion1.val(localStorage.getItem('idTipoP'));
		// $btnAccion1.data('parent', 0);
		if (localStorage.getItem('idTipoP')==4) {
			// Documentos
			$modal2.modal('show');
			$('#accionar').val('0');
		}else{
			// Carpetas
			modificarModal();
			$name.val('');
			$modal1.modal('show');
			// Cambiar valores del boton del modal para registrar
		}
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

	// Mensaje de confirmacion
	window.onbeforeunload =reguntarAntesDeSalir;

	function reguntarAntesDeSalir() {
		return 'Seguro quieres salir de esta pagina';
	}
});

// Accion de link de los titulos
function accionLicnk(event,elemento) {
	event.preventDefault();
	// console.log($(elemento).data('idcon')+' '+$(elemento).data('idtipo'));
	localStorage.setItem('Contenido',$(elemento).data('idcon'));
	localStorage.setItem('idTipoP',($(elemento).data('idtipo')));
	consultarContenidos($(elemento).data('idtipo'),$(elemento).data('idcon'));
}

// Mostrar modal editar Contenido
function mostrarModalEditar(idCon,idProc,nombre,event) {
	event.preventDefault();
	modificarModal();//Clasificar...
	$btnAccion1.text('Modificar');
	$btnAccion1.data('idcon', idCon);
	$btnAccion1.data('idproc', idProc);
	$btnAccion1.val(localStorage.getItem('idTipoP'));
	$name.val(nombre);
	$modal1.modal('show');
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
	op=0;//Pendiente colocar esta variable a funcionar
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
						$modal1.modal('hide');
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
function cambiarContenidoVista(idTipoP,idCon,event,nombre) {
	event.preventDefault();
	if (idTipoP==3) {
		// Consultar Documentos...
		$('#contenido').children('div').hide('fast', function() {
			// $(this).remove();
			$(this).empty();
		});
		localStorage.setItem('idTipoP',(idTipoP+1));
		// Hasta acá se llego el 06/09/2018
		$.post(baseurl+'cContenido/documentos', function(data) {
			console.log(data);
			$('#contenido').append(data);
		});
		// Mostrar modal de documentos...
	}else{
		// Consultar contenedores
		localStorage.setItem('Contenido',idCon);
		localStorage.setItem('idTipoP',(idTipoP+1));
		$PosicionActual.append('<a href="" onclick="accionLicnk(event,this);" data-idcon="'+idCon+'" data-idtipo="'+(idTipoP+1)+'">'+nombre+'</a>>');
		// Guardar El nombre!!
		// <a href="">Gestion</a>><a href="">Proceso</a>><a href="">Sub-Proceso</a>
		consultarContenidos((idTipoP+1),idCon);
	}
}

function consultarContenidos(tipo,idcon) {//ID Tipo proceso y ID del proceso
	$.post(baseurl+'cContenido/consultarContendio', {idCon: idcon, tipoP: tipo}, function(data) {
		var result= JSON.parse(data);
		/*optional stuff to do after success */
		var con=0;
		var i=0;
		$('#contenido').children('div').hide('fast', function() {
			// $(this).remove();
			$(this).empty();
		});
		var mensaje='';
		$.post(baseurl+'cLogin/recuperarRol', function(data) {//La plantila se deforma cuando se agregan muchos componenetes
					//
					var tipo=data;
					$.each(result,function(index, item) {
						i++;
						// 
						if (con==0) {//Inicio de fila
							$('#contenido').append('<div class="row">');//Filas del contenido
							// mensaje+='<div class="row" hidden>';
						}
						// Contenido-....mensaje+=
						$('#contenido').append('<div class="col-lg-3 col-md-6">'+
								// Clasificar el color del componenete con el idtipo_proceso
			                    '<div class="panel panel-'+clasificarColorContenido(Number(item.idtipo_proceso))+'" hidden>'+
			                        '<div class="panel-heading">'+
			                            '<div class="row">'+
			                                '<div class="col-xs-3">'+
			                                    '<i class="'+clasificarIconoDelContenido(Number(item.idtipo_proceso))+'"></i>'+
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
			                        '<a href="#" onclick="cambiarContenidoVista('+item.idtipo_proceso+','+item.idProceso+',event,'+'\''+item.nombre_proceso+'\')">'+
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
					// 
					if (i==0) {
						$('#contenido').append('<div><h2>Vacio...</h2></div>');
					}
					// $('#contenido').append($(mensaje));
					$('#contenido').children('div').children('div').show('slow');
					// 
		});
	});
}
// Se encarga de clasificar el color del contenido...
function clasificarColorContenido(idTipo) {
	switch(idTipo){
		case 1:
			return 'primary';
			break;
		case 2:
			return 'yellow';
			break;
		case 3:
			return 'green';
			break;
	}
}
// Se encarga de clasificar el icono del contenido...
function clasificarIconoDelContenido(idTipo) {
	switch(idTipo){
		case 1:
			return 'fa fa-tasks fa-5x';
			break;
		case 2:
			return 'fa fa-comments fa-5x';
			break;
		case 3:
			return 'fa fa-shopping-cart fa-5x'; 
			break;
	}
}

// Se encarga de modificar la vista del modal del contenido
function modificarModal() {
	// Titulo del modal...
	var titulo='';
	var placeholder='';
	switch(Number(localStorage.getItem('idTipoP'))){
		case 1:
			titulo= 'Gestion';
			placeholder= 'Nombre de la gestion';
			break;
		case 2:
			titulo= 'Proceso';
			placeholder= 'Nombre del proceso';
			break;
		case 3:
			titulo= 'Sub-Proceso'; 
			placeholder= 'Nombre del sub-proceso';
			break;
	}
	$name.attr('placeholder',placeholder);
	$('#titulo').text(titulo);
	// Modificar el valor del boton del modal...
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