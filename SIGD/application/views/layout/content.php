    <div id="wrapper" style="height: 100%;">
        <!-- Navigation --> 
        <div id="page-wrapper">
            <div class="row">
                <div class="col-lg-12">
                    <!-- El boton solo lo mirara los administradores -->
                    <h1 class="page-header"><a id="contenidoG" href="" onclick="accionLicnk(event,this);" data-idcon="0" data-idtipo="1"><?= $nombreT ?></a> <small id="direccionamiento"></small><?= ($tipoUser==1?'<button id="agregar" type="button" class="btn btn-outline btn-primary pull-right" value="<?=$opProceso?>">+</button>':'') ?></h1>
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->
            <div id="contenido">
            <!-- Contenido de la pagina -->
            </div>
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
    
    <!-- Modal de confirmacion -->
    <div class="modal fade" id="confirmarDescarga">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <!-- Esto se convierte en una variable -->
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true" >&times;</button>
                    <h3 id="titulo">Confirmación de descarga</h3>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-sm-2">
                            <label>contraseña:</label>
                        </div>
                        <div class="col-sm-10">
                            <input type="password" name="" id="contraseñaD" class="form-control" placeholder="Contraseña" maxlength="45" autocomplete="off">
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <!--  -->
                    <button id="accionarDescarga" value="0" class="btn btn-primary">Confirmar</button>
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
                    <form id="formularioDoc" method="POST" enctype="multipart/form-data" action="<?= base_url()?>cDocumento/do_upload">
                        <!-- Primera fila -->
                        <div class="row">
                            <!-- primera columna  -->
                            <div class="col-sm-6 col-xs-12">
                                <label>Nombre:</label>
                                <input type="text" name="nombreD" id="nombreD" class="form-control" placeholder="Nombre de documento" maxlength="60" autocomplete="false">
                            </div>
                            <!-- segunda columna -->
                            <div class="col-sm-6 col-xs-12">
                                <label>Categoria:</label>
                                <select class="form-control" id="categoria" name="categoria">
                                    <option value="0">Seleccione...</option>
                                    <?php foreach ($categorias as $cat) {
                                        echo "<option value=".$cat->idCategoria.">".$cat->Categoria."</option>";
                                    } ?> 
                                </select>
                            </div>
                        </div><br>
                        <!-- segunda fila -->
                        <div class="row">
                            <!-- primera columna  -->
                            <div class="col-sm-6 col-xs-12">
                                <label>Vigencia:</label>
                                <input type="text" name="vigencia" id="vigencia" class="form-control" placeholder="DD-MM-YYYY" maxlength="10" autocomplet="">
                            </div>
                            <!-- segunda columna -->
                            <div class="col-sm-6 col-xs-12">
                                <label>Poseedor:</label>
                                <input type="text" name="poseedor" id="poseedor" class="form-control" placeholder="Nombre del poseedor" maxlength="45" autocomplet="">
                            </div>
                        </div><br>
                        <!-- tercera fila -->
                        <div class="row">
                            <!-- primera columna  -->
                            <div class="col-sm-6 col-xs-12">
                                <label>Version:</label>
                                <input type="text" name="version" id="version" class="form-control" placeholder="1" maxlength="3" autocomplet="">
                            </div>
                            <!-- segunda columna -->
                            <div class="col-sm-6 col-xs-12">
                                <label>Proteccion:</label>
                                <input type="text" name="proteccion" id="proteccion" class="form-control" placeholder="Nombre de documento" maxlength="60" autocomplet="">
                            </div>
                        </div>
                        <br>
                        <div class="row">
                            <div class="col-sm-6 col-xs-12">
                                <label>Seleccione Documento...</label>
                                <input type="file" name="userfile" id="userfile" accept=".pdf" size="400">
                            </div>
                            <div class="col-sm-6 col-xs-12" id="nameFile" hidden="true">
                                <label>Documento Guardado:</label>
                                <p id="nombreFile"></p>
                            </div>
                        </div>
                        <br>
                </div>
                <div class="modal-footer">
                    <!--  -->
                    <button type="submit" id="accionarDocumentos" value="0" class="btn btn-primary">Registrar</button>
                </div>
                </form>
            </div>
        </div>
    </div>
</body>