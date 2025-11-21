<?
ini_set('memory_limit', '-1');
require "lib/conexion.php";
$link = mysql_connect("$localhost","$user","$pass");
mysql_select_db("$db");
require "lib/funciones.php";

 if($hoa){
	 //echo "hoa $hoa";
	
	$dat=split(";",$hoa);
	$c=count($dat);
	//echo "c $c";
	
	 for ($i=0; $i<$c;$i++)
	  { 
	   if ($dat[$i] != "")
	   {
	    $id_f=$dat[$i];
		//echo "$id_f <br>";
		
		 $sql3="SELECT *
		 FROM etiquetados_folios AS ef, producto AS p, calibre AS c, medidas_productos AS mp 
		 where ef.id_etiquetados_folios = ef.id_etiquetados_folios 
		 and ef.id_producto = p.id_producto 
		 and ef.id_calibre=c.id_calibre 
		 and ef.id_medidas_productos = mp.id_medidas_productos 
		 and ef.borrado != 1
		 and id_etiquetados_folios = $id_f";
         $rest3=mysql_query($sql3);
		 $cuantos_folios=mysql_num_rows($rest3);
		 $cuantos_folios2++;
		 echo "sql $sql<br>";
	   }
	  
 }
 }

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

//echo "desde $desde - hasta $hasta - ";

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



$sql="SELECT * from destinos where id_destinos='$id_destinos'";
$result=mysql_query($sql);

$row=mysql_fetch_array($result);
$destinos=$row[destinos];
$domicilio=$row[domicilio];
$ciudad=$row[ciudad];
$pais=$row[pais];
$enviadopor=$row[enviadopor];

$num=$i;
$ciclo++;

$r=mysql_fetch_array($rest3);

?>
<?
if($ini == $i){
$ini++;
//if($desde == $hasta){
for ($j=1; $j <= 1 ; $j++){
	  $f_termino=format_fecha_sin_hora($r[f_termino]);
	  $f_vencimiento =format_fecha_sin_hora($r[f_vencimiento]);
?>

<table width="393" height="379" border="0">
  <tr>
    <td width="123" height="19" class="style7">Consignor</td>
    <td width="3">:</td>
    <td colspan="2" class="style7">PROCESADORA INSUBAN LTDA </td>
  </tr>
  <tr>
    <td height="19">&nbsp;</td>
    <td>&nbsp;</td>
    <td colspan="2">Antillanca Norte 391 (Chile) </td>
  </tr>
  <tr>
    <td height="19">Export Country </td>
    <td>:</td>
    <td colspan="2">Santiago Chile </td>
  </tr>
  <tr>
    <td height="19">Destination Country </td>
    <td>:</td>
    <td colspan="2"><? 
	
 	echo "$ciudad - $pais";
	
	?></td>
  </tr>
  <tr>
    <td height="19">Consignee</td>
    <td>:</td>
    <td colspan="2"><? echo $destinos?></td>
  </tr>
  <tr>
    <td height="19">Address</td>
    <td>:</td>
    <td colspan="2"><? echo $domicilio;?></td>
  </tr>
  <tr>
    <td height="19">N&ordm; of Cask </td>
    <td>:</td>
    <td><? echo $bultos?></td>
    <td rowspan="3"><table width="101" border="0" align="right" cellpadding="1" cellspacing="1">
      <tr>
        <td width="97"><div align="center" class="style9"><? echo $num;?></div>
            <div align="right"></div></td>
      </tr>
    </table></td>
  </tr>
  <tr>
    <td height="19">Transport</td>
    <td>:</td>
    <td><? echo $enviadopor;?></td>
  </tr>
  <tr>
    <td height="19">Quantity</td>
    <td>:</td>
    <td><?
   if($r[contenido_alt]){
		echo  $contenido_alt=$r[contenido_alt];
	  }else{
		echo  $contenido_unidades=$r[contenido_unidades];
	  }
	?></td>
  </tr>
  <tr>
    <td height="19">Tipe</td>
    <td>:</td>
    <td colspan="2"><?
	     if ($r[nombre_alt] != '')
		  {
		  echo "$r[nombre_alt]";
	      }else{
		   echo "$r[producto]";
		  }
		/*if ($r[nombre_alt] != '') {
		  $i++;
		  $nombre=$r[nombre_alt];
		}
		else
		$nombre=$r[nombre_pro];
		echo $nombre;*/
		?></td>
  </tr>
  <tr>
    <td height="19">Calibre</td>
    <td>:</td>
    <td colspan="2"><?
		if ($r[calibre_alt] != '') 
		  $calibre=$r[calibre_alt];
		else
		  $calibre=$r[calibre];
		echo $calibre;
		?></td>
  </tr>
  <tr>
    <td height="19">Metraje</td>
    <td>:</td>
    <td width="83"><?echo $r[medidas_productos]?></td>
    <td width="166" rowspan="3"><img src="jpg/NR1362.jpg" width="140" height="78" /></td>
  </tr>
  <tr>
    <td height="19">Production date</td>
    <td>:</td>
    <td><? 
	 $dat2=split(" ",$f_termino);
      $dat=split("-",$dat2[0]);
      $f_termino="$dat[2]-$dat[1]-$dat[0]";
	  echo "  $dat[1] - $dat[2]";
	?></td>
  </tr>
  <tr>
    <td height="21">Experiration date</td>
    <td>:</td>
    <td><? 
	 $dat3=split(" ",$f_vencimiento);
      $dat=split("-",$dat3[0]);
      $f_vencimiento="$dat[2]-$dat[1]-$dat[0]";
	  echo "  $dat[1] - $dat[2]";
	 ?></td>
  </tr>
  <tr>
    <td height="40" colspan="4" class="cajas">Keep In Fresh and Dry Place at Temperature Not  
    More Than 25&ordm;C</td>
  </tr>
</table>
<? 
}
}
} //fin del for
?>