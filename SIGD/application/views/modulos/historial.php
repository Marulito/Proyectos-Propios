    <div id="wrapper">
        <!-- Navigation -->
        <div id="page-wrapper">
            <div class="row">
                <div class="col-lg-12">
                    <!-- El boton solo lo mirara los administradores -->
                    <h1 class="page-header"><i class="fas fa-history"></i> Historial de descargas</h1>
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- Formulario de ususarios -->
            <div class="row">
                <div class="col-lg-12">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            Historial de descarga de documentos...
                        </div>
                        <div class="panel-body">
                          <div class="row">
                             <!-- Inputs de fecha -->
                             <div class="col-sm-4">
                               <label for="fechaI">Fecha Inicio:</label>
                               <div class="input-group date fh-date">
                                 <div class="input-group-addon">
                                   <i class="fa fa-calendar"></i>
                                 </div>
                                 <input type="text" class="form-control pull-right fecha" data-input="1" id="fechaI" placeholder="DD-MM-YYYY" maxlength="10" readonly="true">
                               </div>
                             </div>
                             <!--  -->
                             <div class="col-sm-4">
                               <label for="fechaI">Fecha Fin:</label>
                               <div class="input-group date fh-date">
                                 <div class="input-group-addon">
                                   <i class="fa fa-calendar"></i>
                                 </div>
                                 <input type="text" class="form-control pull-right fecha" data-input="1" id="fechaF" placeholder="DD-MM-YYYY" maxlength="10" readonly="true">
                               </div>
                             </div>

                             <div class="col-sm-4">
                                 <br>
                                 <button class="btn btn-outline btn-primary" type="button" id="consultarHistorial" name="accionBuscar">Consultar</button>
                             </div>
                          </div>
                          <br>
                          <div class="row">
                            <div class="col-sm-12">
                              <div class="table-responsive" id="contenido">
                                 <!-- Contenido de la tabla -->
 
                              </div>
                            </div>
                          </div>
                        </div>
                        <!-- /.panel-body -->
                    </div>
                    <!-- /.panel -->
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->
        </div>
        <!-- /#page-wrapper -->
    </div>

    