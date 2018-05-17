<!-- Vale -->
<!DOCTYPE html>
<html>
  <head>
    <meta charset="UTF-8">
    <title>Panel administrador</title>
    <meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>

    <link href="<?php echo base_url(); ?>assets/css/bootstrap.css" rel="stylesheet" type="text/css" />    
    <link href="<?php echo base_url(); ?>assets/css/fontawesome-all.css" rel="stylesheet" type="text/css" />

    <link href="<?php echo base_url(); ?>assets/a_style/dist/css/AdminLTE.css" rel="stylesheet" type="text/css" />
    <link href="<?php echo base_url(); ?>assets/css/jquery-ui.css" rel="stylesheet" type="text/css" />
    <!-- Afecta al estilo basico de la página -->
    <link href="<?php echo base_url(); ?>assets/a_style/dist/css/skins/_all-skins.min.css" rel="stylesheet" type="text/css" />

    <link rel="stylesheet" href="<?=base_url()?>assets/css/datatables.css">
    <link href="<?= base_url()?>assets/css/estilo.css" rel="stylesheet" type="text/css" />
    <link rel="stylesheet" href="<?=base_url()?>assets/css/tabs_vertical.css">
    <style>
      .error{
        color:red;
        font-weight: normal;
      }

    </style>
    <!--  afecta a app.min.js-> al estilo, revisar -->
    <!-- <script src="<php echo base_url(); ?>assets/a_style/js/jQuery-2.1.4.min.js"></script> -->
    <script src="<?php echo base_url(); ?>assets/js/jquery-3.1.1.js" type="text/javascript"></script>
    <script src="<?php echo base_url(); ?>assets/js/jquery-ui.js" type="text/javascript"></script>
    <script src="<?php echo base_url(); ?>assets/js/bootstrap.js" type="text/javascript"></script>

    <!-- Esto controla el show/hide del sidebar -->
    <script src="<?php echo base_url(); ?>assets/a_style/dist/js/app.min.js" type="text/javascript"></script>
    
    <script type="text/javascript" src="<?=base_url()?>assets/js/sortTablesJquery.js"></script>

    <!--Necesarios para el sorteo de la lista-->
    <script type="text/javascript" src="<?=base_url()?>assets/js/datatables.js"></script>
    <script type="text/javascript" src="<?=base_url()?>assets/js/tabs_vertical.js"></script>
    <!-- 
    <script src="php echo base_url(); ?>assets/a_style/js/jquery.validate.js" type="text/javascript"></script>
    <script src="php echo base_url(); ?>assets/a_style/js/validation.js" type="text/javascript"></script>
    <script type="text/javascript">
        var windowURL = window.location.href;
        pageURL = windowURL.substring(0, windowURL.lastIndexOf('/'));
        var x= $('a[href="'+pageURL+'"]');
            x.addClass('active');
            x.parent().addClass('active');
        var y= $('a[href="'+windowURL+'"]');
            y.addClass('active');
            y.parent().addClass('active');
    </script> -->
    <script>
    
    $(document).ready(function(){
        //$("#idFecha").datepicker("option",$.datepicker.regional["es"]);
        $("#idFecha").datepicker({
        changeMonth: true,
        changeYear: true,
        regional: "es",
        yearRange: '1918:2018',
        showAnim: 'clip',
        });
    });
    </script>

    <script>
        window.onload= function(){
            var sels = document.getElementsByTagName("select");
            for (var i = 0; i < sels.length; i++) {
                sels[i].className="form-control";
            }
        }
    </script>
  </head>
  <body class="skin-blue sidebar-mini">