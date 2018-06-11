<footer class="container">
	<div id="footer">
        <div class="wrap">
				<ul>
                    <li class="titulo">Información</li>
					<li><a href="#">FAQ</a></li>
					<li><a href="#">Contactanos</a></li>
				</ul>
				<ul>
                    <li class="titulo">Redes</li>
					<li>
						<a href="https://www.facebook.com/"><span class="fab fa-facebook"> Facebook</span></a>
					</li>
					<li>
    				<a href="https://www.twitter.com/"><span class="fab fa-twitter"> Twitter</span></a>
  					</li>
				</ul>
		</div>
    </div>


<!--//BLOQUE COOKIES-->


<div id="barraaceptacion" style="display: block;">
    <div class="inner">
        <h4 style="font-size:15px !important;line-height:15px !important">Uso de cookies</h4>
        SEste sitio web utiliza cookies para que usted tenga la mejor experiencia de usuario. Si continúa navegando está dando su consentimiento para la aceptación de las mencionadas cookies y la aceptación de nuestra <br/>
        <a href="#">política de cookies</a>
        <a href="javascript:void(0);" class="ok" onclick="PonerCookie();"><b>OK</b></a> | 
        <a href="http://youtube.com" target="_blank" class="info">Más información</a>
    </div>
</div>

 <!--¿Qué significa javascript:void(0)?

Para entender esto primeramente nos vamos a referir a qué significa 'javascript': en el contexto del atributo href cuando escribimos javascript: estamos indicando que en lugar de llevar a una dirección web, se ejecute el código javascript que vaya indicado a continuación de los dos puntos.

Equivalentes:

<a href="#" onclick="return false;"> Pulsa aquí por favor </a>
Otra alternativa como esta: <a href="javascript://"> Pulsa aquí por favor </a>

-->
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
        c_value = encodeURI(c_value.substring(c_start,c_end));
    }
    return c_value;
}
 
function setCookie(c_name,value,exdays,path){
    var exdate=new Date();
    exdate.setDate(exdate.getDate() + exdays);
    var c_value=escape(value) + ((exdays==null) ? "" : "; expires="+exdate.toUTCString())+ ";path=/";
    document.cookie=c_name + "=" + c_value;
}
 
if(getCookie('pruebaCookie')!="1"){
    document.getElementById("barraaceptacion").style.display="block";
} else{
     document.getElementById("barraaceptacion").style.display="none";
}
function PonerCookie(){
    setCookie('pruebaCookie','1',365,'/');
    document.getElementById("barraaceptacion").style.display="none";
}
</script>

<style>
	#barraaceptacion {
    position:fixed;
    left:0%;
    background-color: rgba(0, 0, 0, 0.5);
    bottom:0px;
    padding-bottom:0.8%;
    color:#fff;
    text-align:center;
    right:0%;
    
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