    </body>
    <!-- jQuery 3-->
    <script src="<?php echo base_url();?>lib/vendor/jquery/jquery.min.js"></script>

    <!-- Bootstrap 3 Core JavaScript -->
    <script src="<?php echo base_url();?>lib/vendor/bootstrap/js/bootstrap.min.js"></script>

    <!-- File-Input Bootstrap  Esta libreria me genera problemas -->
    <!-- <script src="<?php //echo baseurl();?>lib/js/File-input/bootstrap-filestyle.js"></script> -->

    <!-- Metis Menu Plugin JavaScript -->
    <script src="<?php echo base_url();?>lib/vendor/metisMenu/metisMenu.min.js"></script>

    <!-- Custom Theme JavaScript -->
    <script src="<?php echo base_url();?>lib/dist/js/sb-admin-2.js"></script>
    
    <!-- Funciones Generales -->
    <!-- <script src="https://use.fontawesome.com/releases/v5.2.0/js/all.js" data-auto-replace-svg="nest"></script> -->
    <script src="https://use.fontawesome.com/releases/v5.2.0/js/all.js" integrity="sha256-l1iMQ6f0+8aFBzSNRxgklLlYMqu5S4b/LpaST2s+gog= sha384-4oV5EgaV02iISL2ban6c/RmotsABqE4yZxZLcYMAdG7FAPsyHYAPpywE9PJo+Khy sha512-3dlGoFoY39YEcetqKPULIqryjeClQkr2KXshhYxFXNZAgRFZElUW9UQmYkmQE1bvB8tssj3uSKDzsj8rA04Meg==" crossorigin="anonymous"></script>
    <!-- Morris Charts JavaScript -->
    <script src="<?php echo base_url();?>lib/vendor/raphael/raphael.min.js"></script>
    <script src="<?php echo base_url();?>lib/vendor/morrisjs/morris.min.js"></script>
    <script src="<?php echo base_url();?>lib/data/morris-data.js"></script>

    <!-- DataTables JavaScript -->
    <script src="<?php echo base_url();?>lib/vendor/datatables/js/jquery.dataTables.min.js"></script>
    <script src="<?php echo base_url();?>lib/vendor/datatables-plugins/dataTables.bootstrap.min.js"></script>
    <script src="<?php echo base_url();?>lib/vendor/datatables-responsive/dataTables.responsive.js"></script>

    <!-- SweetAlert -->
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js" integrity="sha256-FSEeC+c0OJh+0FI23EzpCWL3xGRSQnNkRGV2UF5maXs= sha384-UQsTmaPFDZmoSs+C5muZerOkn3H9/UibH1bDNhuzxtDQNJ7bEKJtW7swm78LgNCh sha512-orJ/OcUhrhNkg8wgNre5lGcUJyhj1Jsot/QSnRKKiry8ksGvApbHBEbq7AbMsTSv4LnnfR3NSajCQFFsEGe8ig==" crossorigin="anonymous"></script>
    <!-- https://sweetalert.js.org/guides/ -->
    <!-- .-.-.-.-.-.--.-.-.-.- -->
    <script type="text/javascript">
        //Base
        var baseurl="<?php echo base_url();?>";
        // ...
        // Funciones Generales-------------------------------------------->
        function clasificarEstado(estado) {
            if (estado==1) {
                return '<span><small class="label label-success">Activo</small></span>';
            }else{
                return '<span><small class="label label-danger">Desactivado</small></span>';
            }
        }
        // Tool tips
        $('[data-toggle="tooltip"]').tooltip();
    </script>

    <!-- Loguin -->
    <?php if ($this->uri->segment(1)=='' || $this->uri->segment(1)=='cLogin') { ?>
        <script type="text/javascript">
          //
          localStorage.clear();
          var user= $('#user');
          var pass= $('#password');
          $(document).ready(function($) {   
            // console.log('Ingreso al script');
              $('#logueo').click(function(event) {
                if ($.trim(user).length > 0 && $.trim(pass).length > 0) {
                  $.ajax({
                      url: baseurl+'cLogin/iniciarSession',
                      type: 'POST',
                      data: {user:user.val() ,pass: pass.val()},
                      cache: "false",
                      beforeSend:function(){
                         $('#logueo').val('Conectando...');
                      },
                      success:function(data){
                       if (data==1) {
                           // var tipoP="<?= $this->session->userdata('tipo_Usuario'); ?>";
                           // idContenidoTipoProceso=tipoP;
                           localStorage.setItem('Contenido',0);
                           localStorage.setItem('idTipoP',1);
                           // 
                           window.location.href=baseurl+'cContenido';
                       }else{
                        $('#logueo').val("Ingresar");
                         $('#respuesta').empty();
                         $('#respuesta').html("<div class='alert alert-dismissible alert-danger'><button type='button' class='close' data-dismiss='alert'>&times;</button><strong>¡Error!</strong> las credenciales son incorrectas.</div>");
                       }
                      }
                  }); 
                }        
              });  
          });
        </script>
    <?php } ?> 

    <!-- Contenido -->
    <?php if ($this->uri->segment(1)=='cContenido') {?>
        <script src="<?php echo base_url();?>lib/modulos/contenido.js"></script>
    <?php } ?>

    <!-- Formulario de ususarios -->
    <?php if ($this->uri->segment(1)=='cUsuario') {?>
        <script src="<?php echo base_url();?>lib/modulos/usuario.js"></script>
    <?php } ?>

    <!-- Formulario de Categorias -->
    <?php if ($this->uri->segment(1)=='cCategoria') {?>
        <script src="<?php echo base_url();?>lib/modulos/categoria.js"></script>
    <?php } ?>

    <!--  -->
   <!--  <script type="text/javascript">
      localStorage.setItem('Contenido',0);
      localStorage.setItem('idTipoP',1);
    </script> -->
</body>

</html>