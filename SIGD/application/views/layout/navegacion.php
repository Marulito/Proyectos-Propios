<body style="height: 100%;">
<nav class="navbar navbar-default navbar-static-top" role="navigation" style="margin-bottom: 0">
            <div class="navbar-header col-sm-5">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="<?= base_url();?>cContenido">S.I.G.D</a>
            </div>
            <!-- /.navbar-header -->

            <ul class="nav navbar-top-links navbar-right">
                <!-- /.dropdown -->
                <li><a href="<?php echo base_url();?>cLogin/cerrarSession" id="cerrarSession"><i class="fas fa-sign-out-alt fa-fw"></i> Salir</a>
                </li>
                <!-- /.dropdown -->
            </ul>
            <!-- /.navbar-top-links -->
           <!-- .-.-.-.- -->
            <div class="navbar-default sidebar" role="navigation">
                <div class="sidebar-nav navbar-collapse">
                  <?php if($tipoUser==1){ ?>
                    <!-- Esto solo lo veran los administradores -->
                    <ul class="nav" id="side-menu">
                        <li>
                            <a href="<?php echo base_url();?>cUsuario"><i class="fas fa-users fa-fw"></i> Usuarios</a>
                        </li>
                        <li>
                            <a href="<?php echo base_url();?>cCategoria""><i class="fas fa-calendar-alt fa-fw"></i> Categorias</a>
                        </li>
                        <li>
                            <a href="<?php echo base_url();?>cHistorial""><i class="fas fa-history"></i> Historial</a>
                        </li>
                    </ul>
                  <?php } ?>
                </div>
                <!-- /.sidebar-collapse -->
            </div>
            <!-- /.navbar-static-side -->
        </nav>
