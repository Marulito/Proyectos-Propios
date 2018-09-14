    <!-- Consultar todos los documentos que estan asociado a este proceso -->
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
              <?php foreach ($Documentos as $document):
                    echo "<tr>
                           <td>".$document->idDocumento."</td>
                           <td>".$document->nombre."</td>
                           <td>".$document->estado."</td>
                           <td></td>
                        </tr>";
               endforeach ?>
            </tbody>
        </table>
    </div>


    