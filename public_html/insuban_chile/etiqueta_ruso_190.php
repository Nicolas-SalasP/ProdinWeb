<?
ini_set('memory_limit', '-1');
require "lib/conexion.php";
$link = mysql_connect("$localhost","$user","$pass");
mysql_select_db("$db");
require "lib/funciones.php";
?>
<meta charset="utf-8">
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
$sql2="SELECT *	FROM paking AS p, etiquetados_folios As ef, calibre AS c, producto AS pro, medidas_productos AS mp where 
		p.id_paking_relacion=$id_paking_relacion 
		and ef.id_calibre=c.id_calibre
		and ef.id_producto = pro.id_producto
		and	ef.id_medidas_productos = mp.id_medidas_productos
		and	p.id_etiquetados_folios= ef.id_etiquetados_folios
		order by  ef.nombre_alt, ef.calibre_alt,mp.medidas_productos, ef.id_etiquetados_folios asc
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

<table width="600" border="0">
  <tr> <td height="19"><b> PROCESADORA INSUBAN SPA </b></td> </tr>
  <tr> <td height="19">Antillanca Norte 391 (Chile)</td></tr>
  <tr><td></td></tr>
    <tr><td></td></tr>
  <tr> <td height="19"><b>NATURAL SALTED HOG CASINGS</b> </td> </tr>
  <tr> <td height="19"><b>НАТУРАЛЬНОЕ МОКРОСОЛЕНОЕ СВИНОЕ КИШЕЧНОЕ СЫРЬЕ</b> </td> </tr>
 <tr><td></td></tr>
   <tr><td></td></tr>
  <tr> <td height="19"><b>MADE IN CHILE/СДЕЛАНО В ЧИЛИ</b> </td> </tr>
 <tr><td></td></tr>
   <tr><td></td></tr>
  <tr> <td height="19"><b>MANUFACTURER/ПРОИЗВОДИТЕЛЬ:</b></td> </tr>
  <tr> <td height="19"><b>PROCESADORA INSUBAN SPA</b></td> </tr>
  <tr> <td height="19"><b>Antillanca Norte 391 (Chile)</b></td><td width="166" rowspan="3"><img src="jpg/NR1362.jpg" width="140" height="78" /></td> </tr>
  <tr> <td height="19"><b>CONSIGNEE/ПОЛУЧАТЕЛЬ:</b></td> </tr>
  <tr> <td height="19"><b>OOO <? echo $destinos;?> <? echo $domicilio;?> <? echo $ciudad;?>-<? echo $pais;?>.</b></td> </tr>
  <tr> <td height="19"><b>ООО ТОЛЕОН Рязанский проспект, д. 24, корп. 1 109428 Москва, Россия.</b></td></tr>
 <tr><td></td></tr>
   <tr><td></td></tr>
  <tr>
    <td height="19"><b>PRODUCTION DATE/ДАТА ПРОИЗВОДСТВА:</b></td>
    <td><b><? 
   $dat2=split(" ",$f_termino);
      $dat=split("-",$dat2[0]);
      $f_termino="$dat[2]-$dat[1]-$dat[0]";
    echo "  $dat[1] - $dat[2]";
  ?></b></td>
  </tr>
  <tr>
    <td height="21"><b>DATE OF VALIDITY/СРОК ХРАНЕНИЯ:</b></td>
    <td><b><? 
   $dat3=split(" ",$f_vencimiento);
      $dat=split("-",$dat3[0]);
      $f_vencimiento="$dat[2]-$dat[1]-$dat[0]";
    echo "  $dat[1] - $dat[2]";
   ?></b></td>
  </tr>
  <tr><td height="19">STORAGE CONDITIONS: without special condition</td><td width="166" rowspan="3"><img src="jpg/EAC.jpg" width="90" height="78" /></td></tr>
  <tr><td height="19">УСЛОВИЯ ХРАНЕНИЯ: без особых условий</td></tr>
  <tr><td height="19">GROSS WEIGHT  285 kg  NET WEIGHT 270  kg</td></tr>
 <tr><td></td></tr>
   <tr><td></td></tr>
  <tr><td height="19"><b>Barrel number/Номер бочки №</b></td>
  <td rowspan="3"><table width="101" border="0" align="right" cellpadding="1" cellspacing="1">
      <tr>
        <td width="97"><div align="left" class="style8"><b><? echo $num;?></b></div>
            <div align="right"></div></td>
  </tr>
      </table></td>
  </tr>
</table>
<br>
<? 
}
}
} //fin del for
?>