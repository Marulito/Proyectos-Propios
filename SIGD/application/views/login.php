
<body>
    <div class="container">
        <div class="row">
            <div class="col-md-4 col-md-offset-4">
                <div class="login-panel panel panel-default">
                    <div class="panel-heading">
                        <h3 class="panel-title">Inicio de session</h3>
                    </div>
                    <div class="panel-body">
                        <form role="form">
                            <fieldset>
                                <div class="form-group">
                                    <input class="form-control" placeholder="Numero de documento" name="user" type="text" autofocus autocomplete="false" id="user">
                                </div>
                                <div class="form-group">
                                    <input class="form-control" placeholder="Contraseña" name="password" type="password" value="" autocomplete="off" id="password">
                                </div>
                                <!--<div class="checkbox">
                                    <label>
                                        <input name="remember" type="checkbox" value="Remember Me">Remember Me
                                    </label>
                                </div>-->
                                <!-- Change this to a button or input when using this as a form -->
                                <!-- <a >Ingresar</a> -->
                                <!-- href="<?php //echo base_url();?>cLogin/index1" -->
                                <input id="logueo" name="login" type="button" class="btn btn-lg btn-success btn-block" value="Ingresar">
                            </fieldset>
                        </form>
                    </div>
                </div>
                <span id="respuesta"></span>
                <!-- <h4><?php echo var_dump($session); ?></h4> esto queda pendiente
                <h4><?php echo var_dump($documento); ?></h4>-->
            </div>
        </div>
    </div>

<script type="text/javascript">
    
</script>

