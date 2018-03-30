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
<!--Iconos sociales...-->
<link rel="stylesheet" href="<?=base_url()?>assets/css/fontawesome-all.css">
<link rel="stylesheet" href="<?=base_url()?>assets/css/fa-brands.min.css">
<!--Esto es opcional:
	se debería poner para que saliesen los tooltips pero funcionan sin ello, por la librería online
	de jquery presupongo, igual lo dejo para evitar problemas mientras
-->
<script>
	  $(document).ready(function(){
	  	$('[data-toggle="tooltip"]').tooltip();
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
</style>

<link rel="stylesheet" href="<?=base_url()?>assets/css/estilo.css">
<title>CRUD EMPLEADOS</title>
</head>
<body class="custom-background">