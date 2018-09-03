var $nombreCategoria= $('#categoria');
var $buttonA= $('#accion');

$(document).ready(function($) {
	//Tabla
	$('#dataTableUsuario').DataTable({
	    responsive: true
	});
	// Liampiar
	$('#limpiar').click(function(event) {
		limpiarFormulario();
	});
	//Consultar
	consultarCategorias(0);
	//Formulario
	$('#formularioCategoria').submit(function(event) {
		event.preventDefault();
		var op= $buttonA.val();
		if (validarFormulario()) {
			 swal({
			  title: "¿Estas seguro?",
			  text: 'Se '+(op==0?'Registrara':'Modificara')+' la informacion del ususario',
			  icon: "warning",
			  buttons: true,
			  dangerMode: true,
			}).then((result) => {
				if (result) {
					registrarModificarCategoria({idC: $buttonA.val(), 
						                         nombre: $nombreCategoria.val()});
				}
			});
		}
	});
	// Toltip
	$('[data-toggle="tooltip"]').tooltip();
});

function validarFormulario() {
	var res=true;
	if ($nombreCategoria.val()=='') {
		res=false;
		$nombreCategoria.parent('div').addClass('has-error');
	}
	return res;
}

function registrarModificarCategoria(datos) {
	$.ajax({
		url: baseurl+'cCategoria/registrarModficarcategoria',
		type: 'POST',
		data: datos,
	})
	.done(function(dato) {
		swal('Realizado!','Se '+(dato==1?'Registro':'modifico')+' la categoria.','success',{buttons: false, timer:2000});
		limpiarFormulario();
		consultarCategorias(0);
	})
	.fail(function(error) {
		console.log(error);
	});	
}

function consultarCategorias(idC) {
    $.ajax({
        url: baseurl+'cCategoria/consultarCategorias',
        type: 'POST',
        dataType: 'json',
        data: {id: idC},
    })
    .done(function(result) {
        // ...
        if (idC==0) {
            // Tabla
            $('#content-tabla').empty();
            $('#content-tabla').html('<table width="100%" class="table table-striped table-bordered table-hover" id="dataTableCategoria">'+
                                '<thead>'+
                                    '<tr>'+
                                        '<th>ID</th>'+
                                        '<th>Nombre</th>'+
                                        '<th>Estado</th>'+
                                        '<th>Acciones</th>'+
                                    '</tr>'+
                                '</thead>'+
                                '<tbody id="cuerpo">'+

                                '</tbody>'+
                            '</table>');
            $.each(result,function(index, row) {
                        $('#cuerpo').append('<tr class="even gradeC">'+
                                                '<td>'+row.idCategoria+'</td>'+
                                                '<td>'+row.Categoria+'</td>'+
                                                '<td class="center">'+clasificarEstado(row.estado)+'</td>'+
                                                '<td class="center">'+
                                                    '<button class="btn btn-primary btn-xs" onclick="colocarInfoForm('+row.idCategoria+')">'+
                                                        '<span><i class="fas fa-edit"></i>'+
                                                        '</span> Editar'+
                                                    '</button>&nbsp;'+
                                                    '<button class="btn btn-'+(row.estado==1?'danger':'success')+' btn-xs" onclick="cambiarEstadoCategoria('+row.idCategoria+')">'+
                                                        '<span><i class="'+(row.estado==1?'fas fa-trash-alt':'fas fa-check')+'"></i>'+
                                                        '</span> '+(row.estado==1?'Desactivar':'Activar')+''+
                                                    '</button>'+
                                                '</td>'+
                                            '</tr>');   
            });
            // 
            $('#dataTableCategoria').DataTable({
                responsive: true,
                "columns": [
                    { "width": "8%" },
                    { "width": "35%" },
                    { "width": "5%" },
                    { "width": "15%" }
                  ]
            });
        }else{
            // Modal
            $.each(result,function(index, row) {  
               $nombreCategoria.val(row.Categoria);
               $buttonA.val(row.idCategoria);
               $buttonA.text('Modificar');
            });
        }     
        // 
    })
    .fail(function() {
        console.log("error");
    });
    
}

function colocarInfoForm(idCategoria) {
	$('html, body').animate({scrollTop: 0}, 'fast');
	consultarCategorias(idCategoria);
}

function cambiarEstadoCategoria(idC) {
	swal({
	  title: "¿Estas seguro?",
	  text: "Se cambiara el estado de la categoria",
	  icon: "warning",
	  buttons: true,
	  dangerMode: true,
	}).then((result) => {
	     if (result) {
	         $.ajax({
	             url: baseurl+'cCategoria/cambiarEstadoCategoria',
	             type: 'POST',
	             data: {id: idC}
	         })
	         .done(function(result) {
	             swal('Realizado!','La categoria fue '+(result==1?'Desactivada':'Activada')+' Correctamente','success',{buttons: false,timer: 2000});
	             consultarCategorias(0);
	         })
	         .fail(function() {
	             console.log("error");
	         });
	     }
	 });
}

function limpiarFormulario() {
// 
	$buttonA.val(0);
	$buttonA.text('Registrar');
	$nombreCategoria.val('');
// 
}