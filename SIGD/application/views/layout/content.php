       
    <div id="wrapper" style="height: 100%;">

        <!-- Navigation -->
        
        <div id="page-wrapper">
            <div class="row">

                <div class="col-lg-12">
                    <!-- El boton solo lo mirara los administradores -->
                    <h1 class="page-header"><a href="" onclick="accionLicnk(event,this);" data-idcon="0" data-idtipo="1"><?= $nombreT ?></a> <small id="direccionamiento"></small><button id="agregar" type="button" class="btn btn-outline btn-primary pull-right" value="<?=$opProceso?>">+</button></h1>
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

    <!-- Modal de procesos -->
    <div class="modal fade" id="gestionarAccion">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <!-- Esto se convierte en una variable -->
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true" >&times;</button>
                    <h3 id="titulo">Gestiones</h3>
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

    <!-- Modal de documentos -->
    <div class="modal fade" id="gestionDocumentos">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <!-- Esto se convierte en una variable -->
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true" >&times;</button>
                    <h3 id="titulo">Documentos</h3>
                </div>
                <div class="modal-body">
                    <form id="formularioDoc" action="<?php echo base_url()?>cDocumento/do_upload" method="POST" enctype="multipart/form-data">
                        <!-- Primera fila -->
                        <div class="row">
                            <!-- primera columna  -->
                            <div class="col-sm-6 col-xs-12">
                                <label>Nombre:</label>
                                <input type="text" name="" id="nombreC" class="form-control" placeholder="Nombre de documento" maxlength="60">
                            </div>
                            <!-- segunda columna -->
                            <div class="col-sm-6 col-xs-12">
                                <label>Categoria:</label>
                                <select class="form-control" id="">
                                    <option value="0">Categoria</option>
                                    <option value="1">Categoria</option>
                                    <option value="2">Categoria</option>
                                    <option value="3">Categoria</option>
                                </select>
                            </div>
                        </div><br>
                        <!-- segunda fila -->
                        <div class="row">
                            <!-- primera columna  -->
                            <div class="col-sm-6 col-xs-12">
                                <label>Vigencia:</label>
                                <input type="text" name="" id="nombreC" class="form-control" placeholder="DD/MM/YYYY" maxlength="10">
                            </div>
                            <!-- segunda columna -->
                            <div class="col-sm-6 col-xs-12">
                                <label>Poseedor:</label>
                                <input type="text" name="" id="nombreC" class="form-control" placeholder="Nombre de documento" maxlength="45">
                            </div>
                        </div><br>
                        <!-- tercera fila -->
                        <div class="row">
                            <!-- primera columna  -->
                            <div class="col-sm-6 col-xs-12">
                                <label>Version:</label>
                                <input type="text" name="" id="nombreC" class="form-control" placeholder="Nombre de documento" maxlength="3">
                            </div>
                            <!-- segunda columna -->
                            <div class="col-sm-6 col-xs-12">
                                <label>Proteccion:</label>
                                <input type="text" name="" id="nombreC" class="form-control" placeholder="Nombre de documento" maxlength="60">
                            </div>
                        </div>
                        <br>
                        <div class="row">
                            <div class="col-sm-12 col-xs-12">
                                <label>Seleccione Documento...</label>
                                <input type="file" name="userfile" id="userfile" accept=".pdf">
                            </div>
                        </div>
                        <br>
                </div>
                <div class="modal-footer">
                    <!--  -->
                    <button type="submit" id="accionar" value="0" class="btn btn-primary">Registrar</button>
                </div>
                </form>
            </div>
        </div>
    </div>
</body>



    