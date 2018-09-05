       
    <div id="wrapper" style="height: 100%;">

        <!-- Navigation -->
        
        <div id="page-wrapper">
            <div class="row">

                <div class="col-lg-12">
                    <!-- El boton solo lo mirara los administradores -->
                    <h1 class="page-header">Gestiones <button id="agregar" type="button" class="btn btn-outline btn-primary pull-right">+</button></h1>
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->
            <div class="row">
                <div class="col-lg-3 col-md-6">
                    <!-- <div class="panel panel-green"> -->
                    <!-- <div class="panel panel-yellow"> -->
                    <div class="panel panel-primary">
                        <div class="panel-heading">
                            <div class="row">
                                <div class="col-xs-3">
                                    <!-- <i class="fa fa-comments fa-5x"></i> -->
                                    <i class="fa fa-tasks fa-5x"></i>
                                </div>
                                <div class="col-xs-9 text-right">
                                    <!-- Cantidad de Procesos -->
                                    <div><span><i class="fas fa-check-square" style="color: ; width: 30; "></i></span></div>
                                    <div class="huge">26</div>
                                    <div>Nombre Gestion</div>
                                </div>
                            </div>
                        </div>
                        <a href="#">
                            <div class="panel-footer">
                                <span class="pull-left">Ingresar</span>
                                <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                                <div class="clearfix"></div>
                            </div>
                        </a>
                    </div>
                </div>
            </div>
            <!-- /.row -->

            <!-- /.row -->
        </div>
        <!-- /#page-wrapper -->
    </div>

    <!-- Modal -->
    <div class="modal fade" id="gestionarAccion">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <!-- Esto se convierte en una variable -->
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true" >&times;</button>
                    <h3>Gestiones</h3>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-sm-2">
                            <label>Nombre:</label>
                        </div>
                        <div class="col-sm-10">
                            <input type="text" name="" id="nombreC" class="form-control" placeholder="Nombre gestion">
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button id="registrar" class="btn btn-primary">Registrar</button>
                </div>
            </div>
        </div>
    </div>
</body>

    