    <!-- Consultar todos los documentos que estan asociado a este proceso -->
    <div class="row" hidden="true" id="contenedor">
        <table width="100%" class="table table-striped table-bordered table-hover" id="dataTableDocumentos">
            <thead>
                <tr>
                    <th>Nombre</th>
                    <th>Formato</th>
                    <th>Versión</th>
                    <th>Estado</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody id="cuerpo">
              <?php foreach ($Documentos as $document):
                    echo "<tr>
                           <td>".$document->nombre."</td>
                           <td>".$document->Categoria."</td>
                           <td>".$document->varsion."</td>
                           <td>".clasificarEstado($document->estado)."</td>
                           <td>
                             ".
                             ($tipo_ususario==1?"<button class=\"btn btn-primary btn-xs\" onclick=\"editarDocumento(this.value);\" value=".$document->idDocumento."><span><i class=\"fas fa-edit\"></i></span> Editar</button>
                             <button class=\"".($document->estado==1?"btn btn-danger":"btn btn-success")." btn-xs\"  onclick=\"cambiarEstado(this.value)\" value=".$document->idDocumento.">".($document->estado==1?'<span><i class="fas fa-eye-slash"></i></span> Desactivar':'<span><i class="fas fa-eye"></i></span> Activar')."</button>":"<button target=\"_blank\" class=\"btn btn-primary btn-xs\" onclick=\"modalD(".$document->idDocumento.");\">Descargar <span><i class=\"fas fa-download\"></i></span></button>")
                             ."
                           </td>
                        </tr>";
               endforeach ?>
            </tbody>
        </table>
    </div>
<!-- <a href="" target="_blank"></a> -->
<!-- http://localhost:9090/Proyectos-Propios/SIGD/lib/uploads/Piano.pdf  onclick=\"download(this);\"-->
  <?php function clasificarEstado($estado)
    {
       if ($estado==1) {
          return "<span class=\"label label-success\">Activo</span>";
       }else{
          return "<span class=\"label label-danger\">Desactivado</span>";
       }
    }
    base_url()
  ?>