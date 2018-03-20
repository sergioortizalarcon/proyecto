<!DOCTYPE html >
<html>
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">

<link
	href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css"
	rel="stylesheet">
<script
	src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js">
</script>
<script
	src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js">
</script>
<script type="text/javascript" src="<?=base_url()?>assets/js/cripto.js"></script>
<script type="text/javascript" src="<?=base_url()?>assets/js/serialize.js"></script>


<!-- Esto contiene la función jquery que da el estilo a las listas que contiene una id especificada en el archivo-->
<script type="text/javascript" src="<?=base_url()?>assets/js/sortTablesJquery.js"></script>

<!--Necesarios para el sorteo de la lista-->
<script type="text/javascript" src="<?=base_url()?>assets/js/datatables.js"></script>
<link rel="stylesheet" href="<?=base_url()?>assets/css/datatables.css">

<!--Esto es opcional:
	se debería poner para que saliesen los tooltips pero funcionan sin ello, por la librería online
	de jquery presupongo, igual lo dejo para evitar problemas mientras
-->
<script>
	  $(document).ready(function(){
	  	$('[data-toggle="tooltip"]').tooltip();
	  });
  </script>


<link rel="stylesheet" href="<?=base_url()?>assets/css/estilo.css">
<title>CRUD EMPLEADOS</title>
</head>
<body class="custom-background">