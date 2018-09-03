// Variables
var $doc=$('#documento');
var $nombres=$('#nombres');
var $apellidos=$('#apellidos');
var $contraseña1=$('#contraseña');
var $contraseña2=$('#repetirContraseña');
var $selectRol=$('#rol');
var $correo=$('#correo');
// Modal
var $docM=$('#documentoM');
var $nombresM=$('#nombresM');
var $apellidosM=$('#apellidosM');
var $contraseña1M=$('#contraseñaM');
var $contraseña2M=$('#repetirContraseñaM');
var $selectRolM=$('#rolM');
var $correoM=$('#correoM');
// .-.-.-.-.-.--.-.-.-.-.-.-.
$(document).ready(function($) {
    // swal('Listo!','Alertas instaladas','success');
    $('#formularioUsuario').submit(function(event) {
        // Validacion formulario
        realizarAccion(0);//Registrar
    });

    $('#formularioUsuarioModal').submit(function(event) {
        // Validacion formulario
        realizarAccion(1);//Modificar
    });

    // 
    consultarUsuarios('');
    // 
    $('[data-toggle="tooltip"]').tooltip();
});

function realizarAccion(op) {// 0 registrar 1 modificar
    if (form_validate(op)) {
        event.preventDefault();
        // 
    swal({
     title: "¿Estas seguro?",
     text: 'Se '+(op==0?'Registrara':'Modificara')+' la informacion del ususario',
     icon: "warning",
     buttons: true,
     dangerMode: true,
   }).then((result) => {
        if (result) {
            registrarModificarUsuario({
                documento: (op==0?$doc:$docM).val(),
                names: (op==0?$nombres:$nombresM).val(),
                lastNames: (op==0?$apellidos:$apellidosM).val(),
                password: (op==0?$contraseña1:$contraseña1M).val(),
                cargo: (op==0?$selectRol:$selectRolM).children('option:selected').val(),
                email: (op==0?$correo:$correoM).val(),
                opcion: op
            });
            swal('Listo!','Se '+(op==0?'Registro':'Modifico')+' la informacion del ususario','success');
            // $(this).reset();
            $('#editUsuario').modal('hide');
            $('#formularioUsuarioModal').trigger("reset");
            $('#limpiar').click();
        }
   });
    }else{
        // 
        event.preventDefault();
    }
}
// 
function registrarModificarUsuario(datos) {
    $.ajax({
        url: baseurl+'cUsuario/registrarModificarUsuario',
        type: 'POST',
        dataType: 'json',
        data: datos,
    })
    .done(function(res) {
        // console.log("success "+res);
        consultarUsuarios('');
    })
    .fail(function() {
        console.log("error");
    });
}
// 
function form_validate(op) {//Falta colocar el toltip
    var res = true;
    // ...
    if ((op==0?$doc:$docM).val()=='') {
        (op==0?$doc:$docM).parent().addClass('has-error');
        res=false;
    }else{
        (op==0?$doc:$docM).parent().removeClass('has-error');
    }
    // ...
    // ...
    if ((op==0?$nombres:$nombresM).val()=='') {
        (op==0?$nombres:$nombresM).parent().addClass('has-error');
        res=false;
    }else{
        (op==0?$nombres:$nombresM).parent().removeClass('has-error');
    }
    // ...
    // ...
    if ((op==0?$apellidos:$apellidosM).val()=='') {
        (op==0?$apellidos:$apellidosM).parent().addClass('has-error');
        res=false;
    }else{
        (op==0?$apellidos:$apellidosM).parent().removeClass('has-error');
    }
    // ...
    // ...
    if ((op==0?$contraseña1:$contraseña1M).val()=='') {
        (op==0?$contraseña1:$contraseña1M).parent().addClass('has-error');
        res=false;
    }else{
        (op==0?$contraseña1:$contraseña1M).parent().removeClass('has-error');
    }
    // ...
    // ...
    if ((op==0?$contraseña2:$contraseña2M).val()=='') {
        (op==0?$contraseña2:$contraseña2M).parent().addClass('has-error');
        res=false;
    }else{
        (op==0?$contraseña2:$contraseña2M).parent().removeClass('has-error');
    }
    // ...
    // ...
    if ((op==0?$selectRol:$selectRolM).children('option:selected').val()==0) {
        (op==0?$selectRol:$selectRolM).parent().addClass('has-error');
        res=false;
    }else{
        (op==0?$selectRol:$selectRolM).parent().removeClass('has-error');
    }
    // ...
    // ...
    if ((op==0?$correo:$correoM).val()=='') {
        (op==0?$correo:$correoM).parent().addClass('has-error');
        res=false;
    }else{
        (op==0?$correo:$correoM).parent().removeClass('has-error');
    }
    // ...    
    return res;
}

function mostrarInformacionUsuarioModal(documento) {
    consultarUsuarios(documento);
    $('#editUsuario').modal('show');
    // console.log(documento);
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
        if (doc=='') {
            // Tabla
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
                if (row.documento!=doc) {
                    if (row.estado!=2) {
                        $('#cuerpo').append('<tr class="even gradeC">'+
                                                '<td>'+row.documento+'</td>'+
                                                '<td>'+row.nombres+'</td>'+
                                                '<td>'+row.apellidos+'</td>'+
                                                '<td class="center">'+row.rol+'</td>'+
                                                '<td class="center">'+clasificarEstado(row.estado)+'</td>'+
                                                '<td class="center">'+
                                                    '<button class="btn btn-primary btn-xs" onclick="mostrarInformacionUsuarioModal('+row.documento+')">'+
                                                        '<span><i class="fas fa-edit"></i>'+
                                                        '</span> Editar'+
                                                    '</button>&nbsp;'+
                                                    '<button class="btn btn-'+(row.estado==1?'danger':'success')+' btn-xs" onclick="cambiarEstadoUsuario('+row.documento+')">'+
                                                        '<span><i class="'+(row.estado==1?'fas fa-user-times':'fas fa-user-check')+'"></i>'+
                                                        '</span> '+(row.estado==1?'Desactivar':'Activar')+''+
                                                    '</button>'+
                                                '</td>'+
                                            '</tr>');
                    }
                }
            });
            // 
            $('#dataTableUsuario').DataTable({
                responsive: true
            });
        }else{
            // Modal
            $.each(result,function(index, row) {  
               $docM.val(row.documento);
               $nombresM.val(row.nombres);
               $apellidosM.val(row.apellidos);
               $contraseña1M.val(row.contraseña);
               $contraseña2M.val(row.contraseña);
               $selectRolM.children('option[value="'+row.rol+'"]').prop('selected', true);
               $correoM.val(row.correo);
            });
            $('#editUsuario').modal('show');
        }     
        // 
    })
    .fail(function() {
        console.log("error");
    });
    
}

// function clasificarEstado(estado) {
//     if (estado==1) {
//         return '<span><small class="label label-success">Activo</small></span>';
//     }else{
//         return '<span><small class="label label-danger">Desactivado</small></span>';
//     }
// }

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