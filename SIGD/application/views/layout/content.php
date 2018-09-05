       
    <div id="wrapper" style="height: 100%;">

        <!-- Navigation -->
        
        <div id="page-wrapper">
            <div class="row">

                <div class="col-lg-12">
                    <!-- El boton solo lo mirara los administradores -->
                    <h1 class="page-header"><?= $nombreT ?><small> Gestiones>Proceso>Sub-Proceso</small><button id="agregar" type="button" class="btn btn-outline btn-primary pull-right" value="<?=$opProceso?>">+</button></h1>
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->
            <div id="contenido">
            <!-- Contenido de la pagina -->
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
                            <input type="text" name="" id="nombreC" class="form-control" placeholder="Nombre gestion" maxlength="45">
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <!--  -->
                    <button id="accionar" value="<?= $opProceso ?>" data-idcon="0" data-idproc="0" class="btn btn-primary">Registrar</button>
                </div>
            </div>
        </div>
    </div>
</body>

    