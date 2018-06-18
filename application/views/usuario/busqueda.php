<script>
function verInfo(){
  var a = document.getElementById('id_pelicula').value;
  if (a !='') {  
  document.getElementById('idFormulario').submit();
  }
}
</script>
<script>
  /* when document is ready */
  $(function() {
    /* initiate plugin */
    $("div.holder").jPages({
      containerID: "itemContainer"
    });
  });
  </script>
<style>
div.contenido{
	border:3px solid black;
	height: 345px;
	width: 200px;
  background: white;
}

ul#itemContainer{
	float: left;
}

ul#itemContainer > li{
	width: min-content;
    list-style: none;
    float: left;
    margin-right: 5%;
    margin-bottom: 3%;
}

img{
  width: 100%;
  height: 82%;
}
a:link { 
  text-decoration:none; 
} 
</style>
<div id="content" class="defaults container">
  <ul id="itemContainer" style="position: relative;left: 4%;">
  <?php if($peliculas != 0): ?>
    <?php foreach ($peliculas as $value): ?>
    <li> 
      <a href="javascript:void(0);" onclick="verInfo();">
      <div class="contenido">
        <form id="idFormulario" name="idFormulario" action="<?=base_url()?>pelicula/abrirFicha" mehotd="GET">
      <input type="hidden" name="id_pelicula" id="id_pelicula" value="<?=$value['id']?>">
      </form>
        <img src="<?=$value['ruta_cartel']?>"/>
        <div style="text-align: center;">
            <div class="titlefondo">
              <span style="font-weight: 600;color: black;"><?=$value['titulo_original']?></span>
            </div>
        </div>
      </div>
      </a>
    </li>
    <?php endforeach ?>
    <?php else: ?>
      <?php print_r($peliculas) ?>
          <h3 style="text-align: center;">NO SE HA ENCONTRADO NINGÚN RESULTADO</h3>
        <?php endif;?>
  </ul>
  <!-- navigation holder -->
  <div class="holder">
      </div>
</div>