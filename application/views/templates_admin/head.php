<!-- Vale -->
<!DOCTYPE html>
<html>
  <head>
    <meta charset="UTF-8">
    <title>Panel administrador</title>
    <meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>
    <!-- IE -->
    <link rel="shortcut icon" type="image/x-icon" href="<?= base_url(); ?>assets/img/images/favicon.ico" />
    <!-- other browsers -->
    <link rel="icon" type="image/x-icon" href="<?= base_url(); ?>assets/img/images/favicon.ico" />
    
    <link href="<?php echo base_url(); ?>assets/css/bootstrap.css" rel="stylesheet" type="text/css" />    
    <link href="<?php echo base_url(); ?>assets/css/fontawesome-all.css" rel="stylesheet" type="text/css" />

    <link href="<?=base_url()?>assets/css/rating.css" rel="stylesheet" type="text/css" />

    <link href="<?php echo base_url(); ?>assets/a_style/dist/css/AdminLTE.css" rel="stylesheet" type="text/css" />
    <link href="<?php echo base_url(); ?>assets/css/jquery-ui.css" rel="stylesheet" type="text/css" />
    
    <!-- Afecta al estilo basico de la página -->
    <link href="<?php echo base_url(); ?>assets/a_style/dist/css/skins/_all-skins.min.css" rel="stylesheet" type="text/css" />

    <link rel="stylesheet" href="<?=base_url()?>assets/css/dataTables.min.css">
    <link href="<?= base_url()?>assets/css/estilo.css" rel="stylesheet" type="text/css" />
    <link rel="stylesheet" href="<?=base_url()?>assets/css/tabs_vertical.css">
    <style>
      .error{
        color:red;
        font-weight: normal;
      }

    </style>
    <script src="<?php echo base_url(); ?>assets/js/jquery-3.1.1.js" type="text/javascript"></script>
    <script src="<?php echo base_url(); ?>assets/js/jquery-ui.js" type="text/javascript"></script>
    <script src="<?php echo base_url(); ?>assets/js/bootstrap.js" type="text/javascript"></script>
    <script type="text/javascript" src="<?=base_url()?>assets/js/cripto.js"></script>
    <!-- Esto controla el show/hide del sidebar -->
    <script src="<?php echo base_url(); ?>assets/a_style/dist/js/app.min.js" type="text/javascript"></script>
    
    <!--estilo y demas del sortTable-->
    <script type="text/javascript" src="<?=base_url()?>assets/js/sortTablesJquery.js"></script>
    
    <script type="text/javascript" src="<?=base_url()?>assets/js/datepicker-es.js"></script>
    <!--Necesarios para el sorteo de la lista-->
    <script type="text/javascript" src="<?=base_url()?>assets/js/datatables.js"></script>
    <script type="text/javascript" src="<?=base_url()?>assets/js/dataTables.jqueryui.js"></script>
    <script type="text/javascript" src="<?=base_url()?>assets/js/tabs_vertical.js"></script>
    
    <!-- Js para la votacion con estellas -->
    <script type="text/javascript" src="<?=base_url()?>assets/js/rating.js"></script>
    <!-- Cambia el estilo de los multiselects... mas info->select2 -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/css/select2.min.css" rel="stylesheet" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/js/select2.min.js"></script>
    

    <script>
        window.onload= function(){
            var sels = document.getElementsByTagName("select");
            for (var i = 0; i < sels.length; i++) {
                sels[i].style.width="auto";
            }
        }
    </script>
    <style type="text/css">
    #custom-handle {
    width: 8em;
    height: 1.8em;
    top: 50%;
    margin-top: -.8em;
    text-align: center;
    line-height: 1.6em;
  }
</style>

<script>
  $( function() {
    var handle = $( "#custom-handle" );
    $( "#slider" ).slider({
        value:100,
            min: 0,
            max: 5000000,
            step: 104,
      create: function() {
        handle.text( $( this ).slider( "value" ) +"k.");
      },
      slide: function( event, ui ) {
        handle.text( ui.value +"k.");
        $("#idPopularidad").val(ui.value+"k.");
      }
    });
  } );
</script>
  </head>
  <body class="skin-blue sidebar-mini">