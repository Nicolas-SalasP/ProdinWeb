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
 
$sql2="SELECT * FROM paking AS p, etiquetados_folios As ef, calibre AS c, producto AS pro, medidas_productos AS mp, caract_producto As cp, destinos As d
where p.id_paking_relacion=$id_paking_relacion
    and ef.id_calibre=c.id_calibre
    and ef.id_producto = pro.id_producto
    and ef.id_caract_producto = cp.id_caract_producto
    and ef.id_medidas_productos = mp.id_medidas_productos
    and ef.id_etiquetados_folios = p.id_etiquetados_folios
    and ef.id_destinos = d.id_destinos
    order by  ef.nombre_alt, ef.calibre_alt, mp.medidas_productos, ef.id_etiquetados_folios asc	";
		
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

    $calibre=$r[calibre];
    $caract_producto=$r[caract_producto];
    $calibre_alt=$r[calibre_alt];
    $peso1_alt=$r[peso1_alt];
    $peso2_alt=$r[peso2_alt];

//echo $peso1_alt; echo $peso2_alt;


    if ($calibre_alt == "")
      $calibre_alt=$calibre;
?>
<?
if($ini == $i){
$ini++;
//if($desde == $hasta){
for ($j=1; $j <= 2 ; $j++){
	  $f_termino=format_fecha_sin_hora($r[f_termino]);
	  $f_vencimiento =format_fecha_sin_hora($r[f_vencimiento]);
?>

<table width="550" border="0">
<!--  <tr> <td height="19"><b>NATURAL SALTED HOG CASINGS CAL. <? echo $calibre_alt;?> <? echo $caract_producto;?></b></td></tr> -->
  <tr> <td height="19"><b>MANUFACTURER/ПРОИЗВОДИТЕЛЬ:</b></td></tr>  
<!--  <tr> <td height="19"><b>НАТУРАЛЬНАЯ СОЛЕНАЯ СВИНАЯ ОБОЛОЧКА КАЛ. <? echo $calibre_alt;?> <? echo $caract_producto;?></b></td></tr> -->
  <tr> <td height="19"><b>PROCESADORA INSUBAN SPA</b></td></tr>
  <tr> <td height="19">Procesamiento, Producción y Comercialización de Tripas</td></tr>
  <tr> <td height="19">Antillanca Norte 391, Region Metropolitana. Pudahuel Santiago de Chile, Chile</td></tr>
  <tr> <td height="19">ПРОЦЕССАДОРА ИНСУБАН ЛТДА:</td> </tr>
  <tr> <td height="19">Переработка, Производство и Продажа оболочки</td> </tr>
  <tr> <td height="19">Северная Антийанка 391, регион Метрополитана. Пудауель Сантьяго-Чили, Чили</td> </tr>
  <tr> <td height="19">RECEIVER/ПОЛУЧАТЕЛЬ:</td></tr>
  <tr> <td height="19"><? echo $destinos;?></td></tr>
  <tr> <td height="19"> <? echo $domicilio;?><? echo $ciudad;?><? echo $pais;?>/</td></tr>
  <tr> <td height="19">NAME OF THE PRODUCT / НАИМЕНОВАНИЕ ТОВАРА:</td> </tr>
  <tr> <td height="19">NATURAL SALTED  HOG CASINGS ROUNDS <? echo $calibre_alt;?> / НАТУРАЛЬНАЯ СВИНАЯ ОБОЛОЧКА ЧЕРЕВА <? echo $calibre_alt;?> </td> </tr>  
  <tr> <td height="19">PRODUCTION PLANT / ЗАВОД ПРОИЗВОДИТЕЛЬ:  13-62</td> </tr>
  <tr> <td height="19">BARREL / БОЧКА №: <b><? echo $num;?></b></td> </tr>
  <tr> <td height="19">QUANTITY OF BUNDLES PER BARREL / КОЛИЧЕСТВО ПУЧКОВ В БОЧКЕ:</td></tr>  
  <tr> <td height="19">GROSS WEIGHT / ВЕС БРУТТО: <b><? echo $peso1_alt;?></b> KG / КГ</td> </tr>
  <tr> <td height="19">NET WEIGHT / ВЕС НЕТТО: <b><? echo $peso2_alt;?></b> KG / КГ </td> </tr>

  <tr>
    <td height="19">PRODUCTION DATE / ДАТА ИЗГОТОВЛЕНИЯ:/
    <? 
      $dat2=split(" ",$f_termino);
      $dat=split("-",$dat2[0]);
      $f_termino="$dat[2]-$dat[1]-$dat[0]";
      
      echo "<b> $dat[1] - $dat[2] </b>";?></td>
   </tr>
     <tr>
    <td height="21">EXPIRY DATE / СРОК ГОДНОСТИ:/
    <? 
      $dat3=split(" ",$f_vencimiento);
      $dat=split("-",$dat3[0]);
      $f_vencimiento="$dat[2]-$dat[1]-$dat[0]";
 
    echo "<b> $dat[1] - $dat[2] </b>";?></td>
    </tr>

  <tr> <td height="19">CONTRACT NO. 22092017  dt 22.09.2017 / КОНТРАКТ № 22092017 от 22.09.2017
</td> </tr>
  <tr> <td height="19">SPECIFICATION 1 dt 22.09.2017 / СПЕЦИФИКАЦИЯ 1 от 22.09.2017
</td></tr>
  <tr> <td height="19">WITHOUT SPECIAL CONDITIONS OF STORAGE AND TRANSPORTATION /</td></tr>
  <tr> <td height="19">СПЕЦИАЛЬНЫЕ УСЛОВИЯ ХРАНЕНИЯ И ТРАНСПОРТИРОВКИ НЕ</td></tr>
  <tr> <td height="19">ТРЕБУЮТСЯ</td></tr>
  <tr> <td height="19">STORAGE CONDITIONS/УСЛОВИЯ ХРАНЕНИЯ: AMBIENT TEMPERATURE /</td></tr>
  <tr> <td height="19">ТЕМПЕРАТУРА ОКРУЖАЮЩЕЙ СРЕДЫ</td></tr>
  <tr> <td height="19">PRODUCT OF CHILE / ПРОИЗВЕДЕНО В ЧИЛИ</td></tr>
  <tr> <td height="19">Not for retail sale/ Не для розничной продажи</td></tr>
  <tr> <td></td></tr> 
  <tr><td width="166"><img src="jpg/NR1362_207.jpg" width="120" height="120" /><img src="jpg/вилка с рюмкой.png" width="120" height="120" /><img src="jpg/Moebious 7.jpg" width="120" height="120" /><img src="jpg/EAC207.jpg" width="120" height="120" /></td></tr> 
</table>
<br>
<?
}}} //fin del for
?>
