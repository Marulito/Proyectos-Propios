    <!-- jQuery 3-->
    <script src="<?php echo base_url();?>lib/vendor/jquery/jquery.min.js"></script>

    <!-- Bootstrap 3 Core JavaScript -->
    <script src="<?php echo base_url();?>lib/vendor/bootstrap/js/bootstrap.min.js"></script>

    <!-- Metis Menu Plugin JavaScript -->
    <script src="<?php echo base_url();?>lib/vendor/metisMenu/metisMenu.min.js"></script>

    <!-- Custom Theme JavaScript -->
    <script src="<?php echo base_url();?>lib/dist/js/sb-admin-2.js"></script>

    <!-- Morris Charts JavaScript -->
    <script src="<?php echo base_url();?>lib/vendor/raphael/raphael.min.js"></script>
    <script src="<?php echo base_url();?>lib/vendor/morrisjs/morris.min.js"></script>
    <script src="<?php echo base_url();?>lib/data/morris-data.js"></script>

    <!-- DataTables JavaScript -->
    <script src="<?php echo base_url();?>lib/vendor/datatables/js/jquery.dataTables.min.js"></script>
    <script src="<?php echo base_url();?>lib/vendor/datatables-plugins/dataTables.bootstrap.min.js"></script>
    <script src="<?php echo base_url();?>lib/vendor/datatables-responsive/dataTables.responsive.js"></script>

    <script type="text/javascript">
        var baseurl="<?php echo base_url();?>";
        var controller= "<?php echo $this->uri->segment(1);?>";
    </script>
    
    <?php if ($this->uri->segment(1)=='cUsuario') {?>
    <script type="text/javascript">
        $('#dataTableUsuario').DataTable({
            responsive: true
        });
    </script>
    <?php } ?>

</body>

</html>