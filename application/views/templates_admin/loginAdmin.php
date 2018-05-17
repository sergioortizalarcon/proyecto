<!DOCTYPE html>
<html>
  <head>
    <meta charset="UTF-8">
    <title>Admin System Login page</title>
    <meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>
    <link href="<?php echo base_url(); ?>assets/css/bootstrap.css" rel="stylesheet" type="text/css" />
    <link href="<?= base_url()?>assets/css/fontawesome-all.css" rel="stylesheet" type="text/css" />
    <link href="<?php echo base_url(); ?>assets/a_style/dist/css/AdminLTE.min.css" rel="stylesheet" type="text/css" />
    <script type="text/javascript" src="<?=base_url()?>assets/js/cripto.js"></script>
    <script src="<?php echo base_url(); ?>assets/js/jquery-3.1.1.js"></script>
    <script src="<?php echo base_url(); ?>assets/js/bootstrap.js" type="text/javascript"></script>
    <?php if (isset($_GET['n'])):?>
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
    <script type="text/javascript">
      function validarAlias(alias) {
        if(alias!="") {
          expresion = /^[a-zA-ZáéíóúÁÉÍÓÚàèìòùÀÈÌÒÙñÑçÇ\d]{0,4}[a-zA-ZáéíóúÁÉÍÓÚàèìòùÀÈÌÒÙñÑçÇ]{1,4}[a-zA-ZáéíóúÁÉÍÓÚàèìòùÀÈÌÒÙñÑçÇ\d]{1,6}$/;
          if (expresion.test(alias)) {
            return true;
          } else {
              return false;
          }
        } else  {
          return false;
        }
      }

      function validarCorreo(correo) {
          if (correo!="") {
          expresion =/^(([^<>()[\]\.,;:\s@\"]+(\.[^<>()[\]\.,;:\s@\"]+)*)|(\".+\"))@(([^<>()[\]\.,;:\s@\"]+\.)+[^<>()[\]\.,;:\s@\"]{2,4})$/i;
              if (expresion.test(correo)) {
                return true;
              } else {
                  return false;
              }
          } else {
              return false;
          }
        }

      function validarPass() {
        var pwd = document.getElementById("idPwd").value;
          if (pwd!="") {
          expresion = /^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[$@$!%*?&])[A-Za-z\d$@$!%*?&]{8,15}$/;
            if (expresion.test(pwd)) {
                return true;
            } else {
                return false;
            }
          } else {
              return false;
          }
        }

        function logearse(){
          alias = document.getElementById("nUsuario").value;
          pwd = document.getElementById("pwd").value;
          c1 = validarAlias(alias);
          c2 = validarCorreo(alias);
          if (c1 || c2) {
            enviar();
          }
        }

          function enviar(){
            pwd = document.getElementById("pwd").value;
            pcripto = sha256(pwd);
            idFormulario.hash_passwrd.value=pcripto;
            idFormulario.submit();
          }

          function avisoError(){
              
          }
  </script>
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
              <h3><strong>¡Atención!</strong></h3>
            </div>
            <div class="modal-body">
              <p class="alert alert-danger">El usuario o la contraseña introducida no son correctas.</p>
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
        <p class="login-box-msg">Sign In</p>
                <div class="row">
            <div class="col-md-12">
                            </div>
        </div>
        
        <form action="<?= base_url()?>login/loginPost" method="post" id="idFormulario">
          <div class="form-group has-feedback">
            <input type="email" class="form-control" placeholder="Email" name="nUsuario" id="nUsuario" required />
            <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
          </div>
          <div class="form-group has-feedback">
            <input type="password" class="form-control" placeholder="Password" id="pwd" required />
            <input type="hidden" name="hash_passwrd"/>
            <span class="glyphicon glyphicon-lock form-control-feedback"></span>
          </div>
          <div class="row">
            <div class="col-xs-8">    
              <!-- <div class="checkbox icheck">
                <label>
                  <input type="checkbox"> Remember Me
                </label>
              </div>  -->                       
            </div>
            <div class="col-xs-4">
              <input type="hidden" name="tken" value="tken">
             <input type="button" class="btn btn-primary btn-block" value="Ingresar" onclick="logearse()"/>
            </div>
          </div>
        </form>
       <a href="<?= base_url()?>administrador/forgetPwdAd">Recuperar contraseña</a><br>
      </div>
    </div>
  </body>
</html>