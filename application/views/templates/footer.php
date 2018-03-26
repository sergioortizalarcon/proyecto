<footer class="container">

<?php
	$enlace_actual = 'http://'.$_SERVER['HTTP_HOST'];
	$refer = isset($_SERVER['HTTP_REFERER'])?$_SERVER['HTTP_REFERER']:"no refer.";
	$resto = $_SERVER['REQUEST_URI'];
    /*
        Redirecciona a una página diferente en el mismo directorio el cual se hizo la petición
        $host  = $_SERVER['HTTP_HOST'];
        $uri   = rtrim(dirname($_SERVER['PHP_SELF']), '/\\');
        $extra = 'mypage.php';
        header("Location: http://$host$uri/$extra");
        exit;
    */
?>
	<hr/>
revisar footer <!-- sin collapse pierde el fondo y la lista solo va en pc -->
			<div id="footer" class="collapse navbar-collapse">
				<ul>
						<li><a href="#">FAQ</a></li>
						<li><a href="#">Contactanos</a></li>
				</ul>
				<ul>
					<li>
						<a href="https://www.facebook.com/"><span class="fab fa-facebook"> Facebook</span></a>
					</li>
					<li>
    				<a href="https://www.twitter.com/"><span class="fab fa-twitter"> Twitter</span></a>
  					</li>
				</ul>
			</div>


<!--//BLOQUE COOKIES-->


<div id="barraaceptacion" style="display: block;">
    <div class="inner">
        <h4 style="font-size:15px !important;line-height:15px !important">Uso de cookies</h4>
        SEste sitio web utiliza cookies para que usted tenga la mejor experiencia de usuario. Si continúa navegando está dando su consentimiento para la aceptación de las mencionadas cookies y la aceptación de nuestra
            <a href="#">política de cookies</a>
        <a href="javascript:void(0);" class="ok" onclick="PonerCookie();"><b>OK</b></a> | 
        <a href="http://youtube.com" target="_blank" class="info">Más información</a>
    </div>
</div>
 
<script>
function getCookie(c_name){
    var c_value = document.cookie;
    var c_start = c_value.indexOf(" " + c_name + "=");
    if (c_start == -1){
        c_start = c_value.indexOf(c_name + "=");
    }
    if (c_start == -1){
        c_value = null;
    }else{
        c_start = c_value.indexOf("=", c_start) + 1;
        var c_end = c_value.indexOf(";", c_start);
        if (c_end == -1){
            c_end = c_value.length;
        }
        c_value = unescape(c_value.substring(c_start,c_end));
    }
    return c_value;
}
 
function setCookie(c_name,value,exdays){
    var exdate=new Date();
    exdate.setDate(exdate.getDate() + exdays);
    var c_value=escape(value) + ((exdays==null) ? "" : "; expires="+exdate.toUTCString());
    document.cookie=c_name + "=" + c_value;
}
 
if(getCookie('pruebaCookie')!="1"){
    document.getElementById("barraaceptacion").style.display="block";
}
function PonerCookie(){
    setCookie('pruebaCookie','1',365);
    document.getElementById("barraaceptacion").style.display="none";
}
</script>

<style>
	#barraaceptacion {
    position:fixed;
    left:0px;
    background-color: rgba(0, 0, 0, 0.5);
    bottom:0px;
    padding-bottom:20px;
    color:#fff;
    text-align:center;
    /*
    width:100%;
    min-height:40px;
    display:none;
    right:0px;
    z-index:99999;
    */
}
 
.inner {
    /*
    width:100%;
    position:absolute;
    padding-left:5px;
    font-family:verdana;
    top:30%;
    */
    font-size:12px;
}
 
.inner a.ok {
    padding:4px;
    color:#00ff2e;
    text-decoration:none;
}
 
.inner a.info {
    padding-left:5px;
    text-decoration:none;
    color:#faff00;
}
</style>
</footer>