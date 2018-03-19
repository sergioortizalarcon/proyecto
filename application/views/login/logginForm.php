<div class="container">
	<form action="<?=base_url()?>login/loginPost" class="form col-sm-4" method="post">
		<fieldset>
			<legend>Datos del empleado</legend>
			<div class="form-group">
				<label for="idNombre">Nombre</label>
				<input class="form-control" type="text" id="idNombre" name='nombre' <?=$valor['usuario']?> />
			<!-- 
			<input class="form-control" type="text" id="idNombre" name='nombre' <?php //echo isset($_SESSION["user"])?"value=\"".$_SESSION["user"]."\"":""?>/>
			-->
			
			</div>
			
			<div class="form-group">
				<label for="idPwd">Contraseña</label>
				<input class="form-control" type="password" id="idPwd" name="pwd" <?=$valor['pwd']?> />
			<!-- 
				<input class="form-control" type="password" id="idPwd" name="pwd" <?php //echo isset($_SESSION["pwd"])?"value=\"".$_SESSION["pwd"]."\"":""?>/>
			-->
			
			</div>

			<div class="form-check">
				<input class="form-check-input" type="checkbox" id="idR" name="recordar" value="recordar" checked="checked" />
				<label class="form-check-label" for="idR">Recordar:</label>
			</div>
			<div class="form-group">
				<input type="submit" class="btn btn-default"/>
			</div>
		</fieldset>
	</form>
</div>
</div>