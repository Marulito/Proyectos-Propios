    <div id="wrapper">

        <!-- Navigation -->
        
        <div id="page-wrapper">
            <div class="row">

                <div class="col-lg-12">
                    <!-- El boton solo lo mirara los administradores -->
                    <h1 class="page-header">Formulario de Categorias</h1>
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
                              <form id="formularioCategoria" role="form" action="" method="POST">
                                <div class="col-sm-12 col-xs-12">
                                    <div class="form-group">
                                        <label for="categoria">Nombre de la categoria:</label>
                                        <div class="input-group">
                                            <span class="input-group-addon"><i class="fas fa-certificate"></i></span>
                                            <input id="categoria" class="form-control" placeholder="ejm: Formatos" data-toggle="tooltip" data-placement="top" title="Campo obligatorio">
                                        </div>
                                        <!--<p class="help-block">Example block-level help text here.</p>-->
                                    </div>
                                </div>
                              <!--  -->
                              <div class="col-sm-12">

                                <button type="reset" id="limpiar" class="btn btn-default">Limpiar</button>
                                
                                <button type="submit" id="accion" value="0" class="btn btn-default pull-right">Registrar</button>

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
                      <!--  -->
                    </div>
                    <!-- /.panel -->
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->
        </div>
        <!-- /#page-wrapper -->

    </div>

    