<!DOCTYPE html >
<html>
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<!-- IE -->
<link rel="shortcut icon" type="image/x-icon" href="<?= base_url(); ?>assets/img/images/favicon.ico" />
<!-- other browsers -->
<link rel="icon" type="image/x-icon" href="<?= base_url(); ?>assets/img/images/favicon.ico" />

<link rel="stylesheet" href="<?=base_url()?>assets/css/dataTables.min.css">
<link href="<?=base_url()?>assets/css/jquery-ui.css" rel="stylesheet" type="text/css" />

<link rel="stylesheet" href="<?=base_url()?>assets/css/fontawesome-all.css">
<link rel="stylesheet" href="<?=base_url()?>assets/css/fa-brands.min.css">
<link rel="stylesheet" href="<?=base_url()?>assets/css/vistaImagenActor.css">
<link rel="stylesheet" href="<?=base_url()?>assets/css/bootstrap.css">

<script type="text/javascript" src="<?=base_url()?>assets/js/jquery-3.1.1.js"></script>

<script type="text/javascript" src="<?=base_url()?>assets/js/cripto.js"></script>
<script type="text/javascript" src="<?=base_url()?>assets/js/serialize.js"></script>
<script type="text/javascript" src="<?=base_url()?>assets/js/bootstrap.js"></script>
<script type="text/javascript" src="<?=base_url()?>assets/js/jquery-ui.js"></script>
<script type="text/javascript" src="<?=base_url()?>assets/js/datepicker-es.js"></script>
<!-- Esto contiene la función jquery que da el estilo a las listas que contiene una id especificada en el archivo-->
<script type="text/javascript" src="<?=base_url()?>assets/js/sortTablesJquery.js"></script>

<!--Necesarios para el sorteo de la lista-->
<script type="text/javascript" src="<?=base_url()?>assets/js/datatables.js"></script>
<script type="text/javascript" src="<?=base_url()?>assets/js/dataTables.jqueryui.js"></script>

<script>
	  $(document).ready(function(){
	  	$('[data-toggle="tooltip"]').tooltip();
	  });
  </script>
<script>
  $(document).ready(function(){
    $("#tabs").tabs();
  });
</script>
<style>
	button.button2:hover {
    border-color: #3072b3;
    color: #fff;
    background-image: -webkit-gradient(linear, 0 0, 0 100%, from(#599bdc), to(#3072b3));
    cursor: pointer;
}
button.button2 {
    padding: 4px;
    margin-top: 4px;
    width: 34px;
    height: 34px;
    border: 1px solid #b4bac0;
    background-image: -webkit-gradient(linear, 0 0, 0 100%, from(#f4f4f4), to(#ececec));
}


.affix {
      top:0;
      width: 100%;
      z-index: 9999 !important;
  }
</style>

<link rel="stylesheet" href="<?=base_url()?>assets/css/estilo.css">
<title>CRUD EMPLEADOS</title>
</head>
<body class="custom-background" data-spy="scroll" data-target=".navbar" data-offset="50">