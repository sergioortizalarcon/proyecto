<script type="text/javascript">
	/*
	window.onload=function(){
		var head = document.getElementsByTagName("head")[0];
		var meta = document.createElement("meta");
		meta.setAttribute("http-equiv","Refresh");
    	meta.setAttribute("content","10");
  		meta.setAttribute("URL","//base_url()");
		head.appendChild(meta);
	}
	*/
</script>

<div class="container">
	<?php if ($mensaje["nivel"] == "ok"): ?>
	<div class="alert alert-success">
<?php else: ?>
		<div class="alert alert-danger">
<?php endif; ?>
<?=$mensaje["texto"] ?>
		</div>
	</div>
</div>