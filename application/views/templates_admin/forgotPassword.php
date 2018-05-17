<!DOCTYPE html>
<html>
  <head>
    <meta charset="UTF-8">
    <title>CodeInsect | Admin System Log in</title>
    <meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>
    <link href="<?php echo base_url(); ?>assets/css/bootstrap.css" rel="stylesheet" type="text/css" />
    <link href="<?php echo base_url(); ?>assets/css/fontawesome-all.css" rel="stylesheet" type="text/css" />
    <link href="<?php echo base_url(); ?>assets/a_style/dist/css/AdminLTE.min.css" rel="stylesheet" type="text/css" />
    <script src="<?php echo base_url(); ?>assets/js/jquery-3.1.1.js"></script>
    <script src="<?php echo base_url(); ?>assets/js/bootstrap.js" type="text/javascript"></script>
    <?php if (isset($mensaje)):?>
      <script>
          $(document).ready(function(){
          // id de nuestro modal
            $("#myModal").modal("show");
          });
        </script>
    <?php else:?>
       <script>
          $(document).ready(function(){
          // id de nuestro modal
            $("#myModal").modal("hide");
          });
        </script>
    <?php endif;?>
    

  </head>
  <body class="login-page">
<div class="container" id="avisoError">
      <!-- Modal -->
      <div class="modal fade" id="myModal" role="dialog">
        <div class="modal-dialog">
        
          <!-- Modal content-->
          <div class="modal-content">
            <div class="modal-header alert alert-info alert-dismissible">
              <button type="button" class="close" data-dismiss="modal">&times;</button>
              <h3><strong><?= isset($mensaje['nivel'])?$mensaje['nivel']:'¡Atención!'?></strong></h3>
            </div>
            <div class="modal-body">
              <p class="alert alert-danger"><?= isset($mensaje['texto'])?$mensaje['texto']:'Algo ha salido mal.'?></p>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            </div>
          </div>
          
        </div>
      </div>
    </div>

    <div class="login-box">
      <div class="login-logo">
        <a href="#"><b>CodeInsect</b><br>Admin System</a>
      </div><!-- /.login-logo -->
      <div class="login-box-body">
        <p class="login-box-msg">Recuperar contraseña</p>
        <form action="<?= base_url()?>administrador/resetPasswordUser" method="post">
          <div class="form-group has-feedback">
            <input type="email" class="form-control" placeholder="Email" name="login_email" required />
            <input type="hidden" name="tken">
            <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
          </div>
          
          <div class="row">
            <div class="col-xs-8">
            </div><!-- /.col -->
            <div class="col-xs-4">
              <input type="submit"class="btn btn-primary btn-block" value="Submit" />
            </div><!-- /.col -->
          </div>
        </form>
        <a href="<?= base_url()?>login/vista_login_administrador">Login</a><br>
      </div><!-- /.login-box-body -->
    </div><!-- /.login-box -->

    
  </body>
</html>