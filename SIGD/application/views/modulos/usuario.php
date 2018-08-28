    <div id="wrapper">

        <!-- Navigation -->
        <style type="text/css">
            td{
                text-transform: capitalize;
            }
        </style>
        <div id="page-wrapper">
            <div class="row">

                <div class="col-lg-12">
                    <!-- El boton solo lo mirara los administradores -->
                    <h1 class="page-header"><i class="fas fa-user"></i> Formulario de usuarios</h1>
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- Formulario de ususarios -->
            <div class="row">
                <div class="col-lg-12">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            Formulario
                        </div>
                        <div class="panel-body">
                            <div class="row">
                                <!-- Primera columan -->
                              <form role="form" action="" id="formularioUsuario" method="POST">
                                <div class="col-lg-6 col-xs-12">
                                        <!-- Numero de documento-->
                                        <div class="form-group">
                                            <label>Documento:</label>
                                            <input class="form-control" placeholder="ejm: 123456789" id="documento" data-toggle="tooltip" data-placement="top" title="Campo obligatorio">
                                            <!--<p class="help-block">Example block-level help text here.</p>-->
                                        </div>
                                        <!-- Contraseña del usuario -->
                                        <div class="form-group">
                                            <label>Contraseña:</label>
                                            <input type="password" class="form-control" placeholder="" autocomplete="false" id="contraseña" data-toggle="tooltip" data-placement="top" title="Campo obligatorio">
                                            <!--<p class="help-block">Example block-level help text here.</p>-->
                                        </div>
                                        <!-- Repetir contraseña del usuario -->
                                        <div class="form-group">
                                            <label>Repetir contraseña:</label>
                                            <input type="password" class="form-control" placeholder="" autocomplete="false" id="repetirContraseña" data-toggle="tooltip" data-placement="top" title="Campo obligatorio">
                                            <!--<p class="help-block">Example block-level help text here.</p>-->
                                        </div>      
                                </div>
                                <!-- Segunda columan -->
                                <div class="col-sm-6 col-xs-12">
                                    <!-- Nombre -->
                                    <div class="form-group">
                                        <label>Nombres:</label>
                                        <input class="form-control" placeholder=" ejm: Juan david" id="nombres" data-toggle="tooltip" data-placement="top" title="Campo obligatorio">
                                        <!--<p class="help-block">Example block-level help text here.</p>-->
                                    </div>
                                    <!-- Apellidos -->
                                    <div class="form-group">
                                        <label>Apellidos:</label>
                                        <input class="form-control" placeholder="ejm: Marulanda Paniagua" id="apellidos" data-toggle="tooltip" data-placement="top" title="Campo obligatorio">
                                        <!--<p class="help-block">Example block-level help text here.</p>-->
                                    </div>
                                    <!-- Cargo del usuario -->
                                    <div class="form-group">
                                        <label>Rol</label>
                                        <select class="form-control" id="rol" data-toggle="tooltip" data-placement="top" title="Campo obligatorio">
                                            <option value="0">seleccione...</option>
                                            <option value="1">Administrador</option>
                                            <option value="2">Contribuyente(Profesor-Secretaria)</option>
                                        </select>
                                        <!--<p class="help-block">Example block-level help text here.</p>-->
                                    </div>
                                </div>
                              <!--  -->
                              <div class="col-sm-12">
                                  <!-- Correo electronico -->
                                  <label>E-mail:</label>
                                  <div class="form-group input-group">
                                      <span class="input-group-addon">@</span>
                                      <input type="email" class="form-control" placeholder="Ejem: Comercial0@corcircuitos.com" id="correo" data-toggle="tooltip" data-placement="top" title="Campo obligatorio">
                                  </div>
                                  <!--<p class="help-block">Example block-level help text here.</p>-->
                              </div>
                              <!--  -->
                              <div class="col-sm-12">

                                <button type="reset" class="btn btn-default" id="limpiar">Limpiar</button>
                                
                                <button type="submit" class="btn btn-default pull-right">Registrar</button>

                              </div>
                            </div>
                         </form>
                            <!-- /.row (nested) -->
                        </div>
                        <!-- /.panel-body -->
                    </div>
                    <!-- /.panel -->
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <br>
            <!-- Usuarios que hacen parte dil sistema de informacion -->
            <div class="row">
                <div class="col-sm-12">
                    <div id="content-tabla">
                        <!-- <table width="100%" class="table table-striped table-bordered table-hover" id="dataTableUsuario">
                            <thead>
                                <tr>
                                    <th>Documento</th>
                                    <th>Nombres</th>
                                    <th>Apellidos</th>
                                    <th>Rol</th>
                                    <th>Estado</th>
                                    <th>Acciones</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr class="odd gradeX">
                                    <td>Trident</td>
                                    <td>Internet Explorer 4.0</td>
                                    <td>Win 95+</td>
                                    <td class="center">4</td>
                                    <td class="center">X</td>
                                    <td class="center">botones</td>
                                </tr>
                                <tr class="even gradeC">
                                    <td>Trident</td>
                                    <td>Internet Explorer 5.0</td>
                                    <td>Win 95+</td>
                                    <td class="center">5</td>
                                    <td class="center">C</td>
                                    <td class="center">
                                        <button class="btn btn-primary btn-xs">
                                            <span><i class="fas fa-edit"></i>
                                            </span> Editar
                                        </button>
                                        <button class="btn btn-danger btn-xs">
                                            <span><i class="fas fa-user-times"></i>
                                            </span> Desactivar
                                        </button>
                                    </td>
                                </tr>
                            </tbody>
                        </table> -->
                    </div>
                    <!-- /.panel -->
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->
        </div>
        <!-- /#page-wrapper -->

    </div>

    