    <div id="wrapper">

        <!-- Navigation -->
        
        <div id="page-wrapper">
            <div class="row">

                <div class="col-lg-12">
                    <!-- El boton solo lo mirara los administradores -->
                    <h1 class="page-header">Formulario de usuarios <button type="button" class="btn btn-outline btn-primary pull-right">+</button></h1>
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
                              <form role="form" action="" method="POST">
                                <div class="col-lg-6 col-xs-12">
                                        <!-- Numero de documento-->
                                        <div class="form-group">
                                            <label>Documento:</label>
                                            <input class="form-control" placeholder="ejm: 123456789">
                                            <!--<p class="help-block">Example block-level help text here.</p>-->
                                        </div>
                                        <!-- Contraseña del usuario -->
                                        <div class="form-group">
                                            <label>Contraseña:</label>
                                            <input type="password" class="form-control" placeholder="" autocomplete="false">
                                            <!--<p class="help-block">Example block-level help text here.</p>-->
                                        </div>
                                        <!-- Repetir contraseña del usuario -->
                                        <div class="form-group">
                                            <label>Repetir contraseña:</label>
                                            <input type="password" class="form-control" placeholder="" autocomplete="false">
                                            <!--<p class="help-block">Example block-level help text here.</p>-->
                                        </div>
                                        <button type="reset" class="btn btn-default">Limpiar</button>
                                        
                                </div>
                                <!-- Segunda columan -->
                                <div class="col-sm-6 col-xs-12">
                                    <!-- Nombre -->
                                    <div class="form-group">
                                        <label>Nombres:</label>
                                        <input class="form-control" placeholder=" ejm: Juan david">
                                        <!--<p class="help-block">Example block-level help text here.</p>-->
                                    </div>
                                    <!-- Apellidos -->
                                    <div class="form-group">
                                        <label>Apellidos:</label>
                                        <input class="form-control" placeholder="ejm: Marulanda Paniagua">
                                        <!--<p class="help-block">Example block-level help text here.</p>-->
                                    </div>
                                    <!-- Cargo del usuario -->
                                    <div class="form-group">
                                        <label>Rol</label>
                                        <select class="form-control">
                                            <option value="0">seleccione...</option>
                                            <option value="1">Administrador</option>
                                            <option value="2">Contribuyente(Profesor-Secretaria)</option>
                                        </select>
                                    </div>

                                    <button type="submit" class="btn btn-default pull-right">Registrar</button>
                                </div>
                              </form>
                            </div>
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
                    <div class="">
                        <table width="100%" class="table table-striped table-bordered table-hover" id="dataTableUsuario">
                            <thead>
                                <tr>
                                    <th>Rendering engine</th>
                                    <th>Browser</th>
                                    <th>Platform(s)</th>
                                    <th>Engine version</th>
                                    <th>CSS grade</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr class="odd gradeX">
                                    <td>Trident</td>
                                    <td>Internet Explorer 4.0</td>
                                    <td>Win 95+</td>
                                    <td class="center">4</td>
                                    <td class="center">X</td>
                                </tr>
                                <tr class="even gradeC">
                                    <td>Trident</td>
                                    <td>Internet Explorer 5.0</td>
                                    <td>Win 95+</td>
                                    <td class="center">5</td>
                                    <td class="center">C</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    <!-- /.panel -->
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->
        </div>
        <!-- /#page-wrapper -->

    </div>

    