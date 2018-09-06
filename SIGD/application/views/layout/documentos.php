    <!-- Hasta acá se llego el día 06/09/2018 -->
    <div class="row">
        <table width="100%" class="table table-striped table-bordered table-hover" id="dataTableCategoria">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nombre</th>
                    <th>Estado</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody id="cuerpo">
            <tr>
                <td>Hola</td>
                <td>Mundo</td>
                <td>Todo Bien</td>
                <td></td>
            </tr>
            </tbody>
        </table>
    </div>
    <!-- Modal de registrar nuevo documento -->
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
                    <button id="accionar" value="" class="btn btn-primary">Registrar</button>
                </div>
            </div>
        </div>
    </div>


    