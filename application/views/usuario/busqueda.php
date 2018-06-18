<script>
function verInfo(idd){
  console.log(idd);
  var a = document.getElementById(idd).value;
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
    <?php if(isset($peliculas) &&($peliculas!= 0)): ?>
      <?php foreach ($peliculas as $value): ?>
      <li> 
        <a href="javascript:void(0);" onclick="verInfo('id_pelicula');">
        <div class="contenido">
          <form id="idFormulario" name="idFormulario" action="<?=base_url()?>pelicula/abrirFicha" method="GET">
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
    <?php elseif(isset($repartos) && $repartos!=0):?>
       <?php foreach ($repartos as $value): ?>
    <li> 
      <a href="javascript:void(0);" onclick="verInfo('id_reparto');">
      <div class="contenido">
        <form id="idFormulario" name="idFormulario" action="<?=base_url()?>reparto/abrirFicha" mehotd="GET">
      <input type="hidden" name="id_reparto" id="id_reparto" value="<?=$value['id']?>">
      </form>
        <img src="<?=$value['ruta_foto']?>"/>
        <div style="text-align: center;">
            <div class="titlefondo">
              <span style="font-weight: 600;color: black;"><?=$value['nombre']?> <?=$value['apellido1']?> <?=$value['apellido2']?></span>
            </div>
        </div>
      </div>
      </a>
    </li>
    <?php endforeach ?>
    <?php else: ?>
          <h3 style="text-align: center;">NO SE HA ENCONTRADO NINGÚN RESULTADO</h3>
        <?php endif;?>
  </ul>
  <!-- navigation holder -->
  <div class="holder">
      </div>
</div>