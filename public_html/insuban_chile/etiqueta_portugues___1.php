<?
ini_set('memory_limit', '-1');
require "lib/conexion.php";
$link = mysql_connect("$localhost","$user","$pass");
mysql_select_db("$db");
require "lib/funciones.php";





?>

<style type="text/css">
<!--
.cajas {
	font-family: Arial, Helvetica, sans-serif;
	
	font-size: 11px;
}
.titulo {font-family: Verdana, Arial, Helvetica, sans-serif; font-size: 10px; font-weight: bold; }
.numero {font-family: Verdana, Arial, Helvetica, sans-serif;
	font-size: 14px;
	
	font-weight: bold;
}
body {
	margin-left: 0px;
	margin-top: 0px;
}
.style7 {font-family: Verdana, Arial, Helvetica, sans-serif; font-size: 12px; font-weight: bold; }
.style9 {font-family: Verdana, Arial, Helvetica, sans-serif; font-size: 20px; font-weight: bold; }
-->


</style>


<script language="JavaScript" type="text/javascript">
window.print();
</script>

<?
 





$sql2="SELECT *	FROM paking AS p, etiquetados_folios As ef, calibre AS c, producto AS pro, medidas_productos AS mp, especie AS esp where 
		p.id_paking_relacion=$id_paking_relacion 
		and ef.id_calibre=c.id_calibre
		and ef.id_producto = pro.id_producto
		and	ef.id_medidas_productos = mp.id_medidas_productos
		and	p.id_etiquetados_folios= ef.id_etiquetados_folios
		and ef.id_especie = esp.id_especie
		order by ef.nombre_alt, ef.calibre_alt,mp.medidas_productos, ef.id_etiquetados_folios asc
		";
		
		$rest2=mysql_query($sql2);
		$cuantos=mysql_num_rows($rest2);



/*
for ($i=1; $i <= $hasta ; $i++){
$num++;
echo "NUM $num";

$ree=mysql_fetch_array($rest2);
$ree[id_etiquetados_folios];

if($num == $hasta)
echo $ree[id_etiquetados_folios];

}
*/

if($desde){
$desde=$desde;
}else{
$desde=1;
}
if($hasta){
$hasta=$hasta;
}else{
$hasta=$bultos;
}

if($fin){
$hasta=$fin;
}


for ($i=$desde; $i <= $hasta ; $i++){



$sql="SELECT * FROM destinos where id_destinos='$id_destinos'";
$result=mysql_query($sql);

$row=mysql_fetch_array($result);
$destinos=$row[destinos];
$domicilio=$row[domicilio];
$ciudad=$row[ciudad];
$pais=$row[pais];
$enviadopor=$row[enviadopor];

$num=$i;
$ciclo++;

$r=mysql_fetch_array($rest2);

?>
<?
if($ini == $i){
$ini++;
//if($desde == $hasta){
for ($j=1; $j <= 2 ; $j++){
	  $f_termino=format_fecha_sin_hora($r[f_termino]);
	  $f_vencimiento =format_fecha_sin_hora($r[f_vencimiento]);
?>
<table width="393" height="421" border="0" cellpadding="0" cellspacing="0">
  <tr>
    <td height="19" colspan="4" class="style7">
    <div align="center">
    <span class="style15 style5">
    <? if($id_destinos != 130){?>
  ENVOLT&Oacute;RIO NATURAL SALGADO DE <?
	//echo "$r[id_especie]";
	if($r[id_especie] == 1)
	echo "SUÍNO";
	if($r[id_especie] != 1){
	$resultado = strtoupper($r[especie]);
	echo " $resultado "; 
	}
	?><br />
    (TRIPA)</span></div>
    <?
    }else{
	echo "MUCOSA FRESCA DE SUINO";	
	}
	?>
      </span>
    </div>
    </td>
  </tr>
  <tr>
    <td width="123" height="20">Cont&eacute;m</td> <td>:</td> <td height="20" colspan="2">
    <? if($id_destinos != 130){?>
    Envolt&oacute;rio Natural Salgado de Su&iacute;no<?
	//echo "$r[id_especie]";
	if($r[id_especie] == 1)
	//echo "Suino";
	if($r[id_especie] != 1){
	$cadena = ucwords(strtolower($r[especie]));
	//$resultado = strtoupper($r[especie]);
	echo " $cadena "; 
	}
	?>   
    <? }else{
    
	echo "Mucosa Fresca de Suino";
    
    }?>
    </td>
  </tr>
  <tr>
    <td height="20">Composi&ccedil;&atilde;o</td>
    <td>:</td>
    <td height="20" colspan="2"> <? if($id_destinos != 130){?>Envolt&oacute;rio Natural de Su&iacute;no e Sal<? }else{?> <? }?> </td>
  </tr>
  <tr>
    <td height="20">&nbsp;</td>
    <td>&nbsp;</td>
    <td height="20" colspan="2">Procesadora Insuban Ltda </td>
  </tr>
  <tr>
    <td height="20">&nbsp;</td>
    <td>&nbsp;</td>
    <td height="20" colspan="2">Av. Antillanca Norte 391 </td>
  </tr>
  <tr>
    <td height="20">&nbsp;</td>
    <td>&nbsp;</td>
    <td height="20" colspan="2">Zona Industrial Lo Boza/Pudahuel </td>
  </tr>
  <tr>
    <td height="20">&nbsp;</td>
    <td>&nbsp;</td>
    <td height="20" colspan="2">Santiago - Chile.</td>
  </tr>
  <tr>
    <td height="20">Estabelecimento</td>
    <td>:</td>
    <td height="20" colspan="2">N&ordm; 13-62</td>
  </tr>
  <tr>
    <td height="20">Importador</td>
    <td>:</td>
    <td height="20" colspan="2"><? echo $destinos?></td>
  </tr>
  <tr>
    <td height="20">&nbsp;</td>
    <td>&nbsp;</td>
    <td height="20" colspan="2"><? echo $domicilio;?></td>
  </tr>
  <tr>
    <td height="20"><div id="gt-res-content">
      <div dir="ltr"><span id="result_box"><span onmouseover="this.style.backgroundColor='#ebeff9'" title="numeracion" onmouseout="this.style.backgroundColor='#fff'">Numera&ccedil;&atilde;o</span></span></div>
    </div></td>
    <td>:</td>
    <td height="20" colspan="2"><? echo $num;?></td>
  </tr>
  <tr>
    <td height="20">Pais de Origem </td>
    <td>:</td>
    <td height="20" colspan="2">Chile</td>
  </tr>
  <tr>
    <td height="20">Pais de Proced&ecirc;ncia </td>
    <td>:</td>
    <td height="20" colspan="2">Chile</td>
  </tr>
  <tr>
    <td height="20" colspan="4">Registro No Ministerio Da Agricultura </td>
  </tr>
  <tr>
    <td height="20" colspan="4">
    
    <? 
	
    if($id_destinos != 130 and $id_destinos != 14 and $id_destinos != 5 and $id_destinos != 132)
	{
    echo "SIF/DIPOA Sob n 002/13-62";
	}else{
	echo "SIF/DIPOA Sob n 003/13-62";	
	}
	
	?>
	
    
    </td>
  </tr>
  <tr>
    <td height="20">Data de Fabrica&ccedil;&atilde;o</td>
    <td>:</td>
    <td width="83" height="20"><? 
	 $dat2=split(" ",$f_termino);
      $dat=split("-",$dat2[0]);
      $f_termino="$dat[2]-$dat[1]-$dat[0]";
	  echo " $dat[0] - $dat[1] - $dat[2]";
	?></td>
    <td width="166" rowspan="3"><div align="center">
      <table width="101" border="0" align="right" cellpadding="1" cellspacing="1">
        <tr>
          <td width="97">
          <div align="center" class="style9">
		    <? 
			if($id_destinos == 144)
			echo $otro;
			else
			echo $num;
			
		?>
          </div>
          </td>
        </tr>
      </table>
    </div></td>
  </tr>
  <tr>
    <td height="20">Data de Validade</td>
    <td>:</td>
    <td height="20"><? $dat3=split(" ",$f_vencimiento);
      $dat=split("-",$dat3[0]);
      $f_vencimiento="$dat[2]-$dat[1]-$dat[0]";
	  echo " $dat[0] - $dat[1] - $dat[2]";
	 ?></td>
  </tr>
  <tr>
    <td height="20" colspan="3">Ind&uacute;stria Do Chile</td>
  </tr>
  <tr>
    <td height="15" colspan="4">Mantenha Em Local Seco e Arejado <br> Conservar a Temperatura Ambiente (Até 35º C)</td>
  </tr>
  <tr>
    <td height="16" colspan="4">&nbsp;</td>
  </tr>
</table>
<? 
}
$otro++;
}
} //fin del for
?>