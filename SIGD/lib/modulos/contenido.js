// variables
var $name=$('#nombreC');
// 
$(document).ready(function($) {
	// Mostrar modal
	$('#agregar').click(function(event) {
		$('#gestionarAccion').modal('show');
	});
	// 
	$('#registrar').click(function(event) {
		op=0;
		if ($name.val()!='') {
			swal({
				  title: "¿Estas seguro?",
				  text: 'Se '+(op==0?'Registrara':'Modificara')+' la informacion del ususario',
				  icon: "warning",
				  buttons: true,
				  dangerMode: true,
				}).then((result) => {
					if (result) {
						$.ajax({
							url: baseurl+'cContenido/registrarModificarContenido',
							type: 'POST',
							data: {
								idCon: 1;//Variable del contenido
								nombre: $name.val(),
								tipoProceso: 1,//Variable global del contenido
								idProceso: 1,//Aplica solo para el contenido de procesos y sub procesos
								},
						})
						.done(function(dato) {
							console.log("success "+dato);
						})
						.fail(function() {
							console.log("error");
						});
					}
				});
		}else{
			$name.parent('div').addClass('has-error');
		}
	});
	// ToolTip
	$('[data-toggle="tooltip"]').tooltip();
});