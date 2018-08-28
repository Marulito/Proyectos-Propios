var $doc=$('#documento');
var $nombres=$('#nombres');
var $apellidos=$('#apellidos');
var $contraseña1=$('#contraseña');
var $contraseña2=$('#repetirContraseña');
var $selectRol=$('#rol');
var $correo=$('#correo');

// Variables
$(document).ready(function($) {
    // swal('Listo!','Alertas instaladas','success');
    $('#formularioUsuario').submit(function(event) {
        // Validacion formulario
        if (form_validate()) {
            event.preventDefault();
            // 
            registrarModificarUsuario({
                documento: $doc.val(),
                names: $nombres.val(),
                lastNames: $apellidos.val(),
                password: $contraseña1.val(),
                cargo: $selectRol.val(),
                email: $correo.children('option:selected').val(),
                opcion: 0
            });
            swal('Listo!','se puede ejecutar','success');
            // $(this).reset();
            $('#limpiar').click();
        }else{
            // 
            event.preventDefault();
        }
    });
    // 
    consultarUsuarios('');
    // 
    $('[data-toggle="tooltip"]').tooltip();
});
// 
function registrarModificarUsuario(datos) {
    $.ajax({
        url: baseurl+'cUsuario/registrarModificarUsuario',
        type: 'POST',
        dataType: 'json',
        data: datos,
    })
    .done(function(res) {
        console.log("success "+res);
    })
    .fail(function() {
        console.log("error");
    });
}
// 
function form_validate() {//Falta colocar el toltip
    var res = true;
    // ...
    if ($doc.val()=='') {
        $doc.parent().addClass('has-error');
        res=false;
    }else{
        $doc.parent().removeClass('has-error');
    }
    // ...
    // ...
    if ($nombres.val()=='') {
        $nombres.parent().addClass('has-error');
        res=false;
    }else{
        $nombres.parent().removeClass('has-error');
    }
    // ...
    // ...
    if ($apellidos.val()=='') {
        $apellidos.parent().addClass('has-error');
        res=false;
    }else{
        $apellidos.parent().removeClass('has-error');
    }
    // ...
    // ...
    if ($contraseña1.val()=='') {
        $contraseña1.parent().addClass('has-error');
        res=false;
    }else{
        $contraseña1.parent().removeClass('has-error');
    }
    // ...
    // ...
    if ($contraseña2.val()=='') {
        $contraseña2.parent().addClass('has-error');
        res=false;
    }else{
        $contraseña2.parent().removeClass('has-error');
    }
    // ...
    // ...
    if ($selectRol.children('option:selected').val()==0) {
        $selectRol.parent().addClass('has-error');
        res=false;
    }else{
        $selectRol.parent().removeClass('has-error');
    }
    // ...
    // ...
    if ($correo.val()=='') {
        $correo.parent().addClass('has-error');
        res=false;
    }else{
        $correo.parent().removeClass('has-error');
    }
    // ...    
    return res;
}

function consultarUsuarios(doc) {
    $.ajax({
        url: baseurl+'cUsuario/consultarUsuarios',
        type: 'POST',
        dataType: 'json',
        data: {documento: doc},
    })
    .done(function(result) {
        // ...
        $('#content-tabla').empty();
        $('#content-tabla').html('<table width="100%" class="table table-striped table-bordered table-hover" id="dataTableUsuario">'+
                            '<thead>'+
                                '<tr>'+
                                    '<th>Documento</th>'+
                                    '<th>Nombres</th>'+
                                    '<th>Apellidos</th>'+
                                    '<th>Rol</th>'+
                                    '<th>Estado</th>'+
                                    '<th>Acciones</th>'+
                                '</tr>'+
                            '</thead>'+
                            '<tbody id="cuerpo">'+

                            '</tbody>'+
                        '</table>');
        $.each(result,function(index, row) {
            $('#cuerpo').append('<tr class="even gradeC">'+
                                    '<td>'+row.documento+'</td>'+
                                    '<td>'+row.nombres+'</td>'+
                                    '<td>'+row.apellidos+'</td>'+
                                    '<td class="center">'+row.rol+'</td>'+
                                    '<td class="center">'+clasificarEstado(row.estado)+'</td>'+
                                    '<td class="center">'+
                                        '<button class="btn btn-primary btn-xs" onclick="consultarUsuarios('+row.documento+')">'+
                                            '<span><i class="fas fa-edit"></i>'+
                                            '</span> Editar'+
                                        '</button>&nbsp;'+
                                        '<button class="btn btn-'+(row.estado==1?'danger':'success')+' btn-xs" onclick="cambiarEstadoUsuario('+row.documento+')">'+
                                            '<span><i class="'+(row.estado==1?'fas fa-user-times':'fas fa-user-check')+'"></i>'+
                                            '</span> '+(row.estado==1?'Desactivar':'Activar')+''+
                                        '</button>'+
                                    '</td>'+
                                '</tr>');
        });
        // 
        $('#dataTableUsuario').DataTable({
            responsive: true
        });
        // 
    })
    .fail(function() {
        console.log("error");
    });
    
}

function clasificarEstado(estado) {
    if (estado==1) {
        return '<span><small class="label label-success">Activo</small></span>';
    }else{
        return '<span><small class="label label-danger">Desactivado</small></span>';
    }
}

function cambiarEstadoUsuario(doc) {
   swal({
     title: "¿Estas seguro?",
     text: "Se cambiara el estado de este empleado",
     icon: "warning",
     buttons: true,
     dangerMode: true,
   }).then((result) => {
        if (result) {
            $.ajax({
                url: baseurl+'cUsuario/cambiarEstadoUsuario',
                type: 'POST',
                dataType: 'json',
                data: {documento: doc},
            })
            .done(function(result) {
                swal('Realizado!','El usuario fue '+(result==1?'desactivado':'Activado')+' Correctamente','success',{buttons: false,timer: 2000});
                // console.log("success");
                consultarUsuarios('');
            })
            .fail(function() {
                console.log("error");
            });
        }
    });
    
}