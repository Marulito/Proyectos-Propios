// Variables cache
var $fechaInicio = $('#fechaI');
var $fechaFin = $('#fechaF');
var $contenidotabla = $('#contenido');
$(document).ready(function() {
    // Button consultar historial
    $('#consultarHistorial').click(function(event) {
        if ($fechaFin.val() != '' || $fechaInicio.val() != '') {
            // Consultar contenido
            $.post(baseurl + 'cHistorial/consultarHistorial', {
                fecha1: formatoFecha($fechaInicio.val()),
                fecha2: formatoFecha($fechaFin.val())
            }, function(data) {
                // ...
                var result = JSON.parse(data);
                // ...
                $contenidotabla.empty();
                $contenidotabla.html('<table width="100%" class="table table-striped table-bordered table-hover" id="dataTableHistorial">' + '<thead>' + '<tr>' + '<th>Documento</th>' + '<th>Nombres</th>' + '<th>Apellidos</th>' + '<th>Fecha descarga</th>' + '<th>Nombre del documento</th>' + '</tr>' + '</thead>' + '<tbody id="cuerpo">' + '</tbody>' + '</table>');
                $.each(result, function(index, row) {
                    $('#cuerpo').append('<tr class="even gradeC">' + '<td>' + row.documento + '</td>' + '<td>' + row.nombres + '</td>' + '<td>' + row.apellidos + '</td>' + '<td class="center">' + row.fechaDescarga + '</td>' + '<td class="center">' + row.nombre + '</td>' + '</tr>');
                });
                // 
                $('#dataTableHistorial').DataTable();
            });
        } else {
            // Mensaje de alerta
            swal('Alerta', 'Debe seleccionar minimo una fecha.', 'warning', {
                buttons: false,
                timer: 2000
            });
        }
    });
});