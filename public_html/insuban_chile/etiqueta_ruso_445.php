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

table {
    font-size: 12px;
}


-->

</style>
<script language="JavaScript" type="text/javascript">
window.print();
</script>
<meta charset="utf-8">
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
    $cantidad=$r[contenido_unidades];

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
  <tr> <td height="19"><b>MANUFACTURER / ПРОИЗВОДИТЕЛЬ:</b></td></tr> 
  <tr> <td height="19">PROCESADORA INSUBAN SPA, 13-62, Antillanca Norte 391, REGION METROPOLITANA</td> </tr>
  <tr> <td height="19">(CHILE)</td> </tr>
  <tr> <td height="19">PROCESADORA INSUBAN SPA, 13-62, Antillanca Norte 391, REGION METROPOLITANA</td> </tr>
  <tr> <td height="19">(ЧИЛИ)</td> </tr>
<tr> <td height="19"></td> </tr>
  <tr> <td height="19">IMPORTER / ИМПОРТЕР:</td> </tr>
  <tr> <td height="19">ТОО «ALNAT PRODUCT», 050061, KAZAKHSTAN, 496/2, AVE. RAYIMBEK, ALMATY</td> </tr>
  <tr> <td height="19">ТОО «ALNAT PRODUCT», 050061, РК, Г. АЛМАТЫ, ПР. РАЙЫМБЕК, 496/2</td> </tr>
<tr> <td height="19"></td> </tr>
  <tr> <td height="19">THE NAME OF THE GOODS / НАИМЕНОВАНИЕ ТОВАРА:</td> </tr>
  <tr> <td height="19"><b>NATURAL SALTED HOG CASINGS</b></td> </tr>
  <tr> <td height="19">НАТУРАЛЬНОЕ МОКРОСОЛЕНОЕ СВИНОЕ КИШЕЧНОЕ СЫРЬЕ: ЧЕРЕВЫ</td> </tr>
  <tr> <td height="19">CALIBER AND QUALITY GRADE  / КАЛИБР И КАТЕГОРИЯ КАЧЕСТВА: <b><? echo $calibre_alt;?></b> </td> </tr>
 <!-- <tr> <td height="19">CALIBER AND QUALITY GRADE  / КАЛИБР И КАТЕГОРИЯ КАЧЕСТВА: <b><? echo $calibre_alt;?> <? echo $caract_producto;?></b> </td> </tr>-->
  <tr> <td height="19">BARREL NUMBER (BATCH NUMBER) /НОМЕР БОЧКИ (НОМЕР ПАРТИИ): <b><? echo $num;?></b></td> </tr>
  <tr> <td height="19">QUANTITY OF BUNDLES / КОЛИЧЕСТВО ПУЧКОВ: <b><? echo $cantidad;?></b>   </td> </tr>
  <tr> <td height="19">PRODUCTION DATE / ДАТА ПРОИЗВОДСТВА:
    <? 
      $dat2=split(" ",$f_termino);
      $dat=split("-",$dat2[0]);
      $f_termino="$dat[2]-$dat[1]-$dat[0]";
      
      echo "<b> $dat[1] - $dat[2] </b>";?></td> </tr>
  
  <tr> <td height="19">GROSS WEIGHT / ВЕС БРУТТО:<b><? echo $peso1_alt;?></b></td> </tr>
  <tr> <td height="19">NET WEIGHT / ВЕС НЕТТО:<b><? echo $peso2_alt;?></b></td> </tr>
<tr> <td height="19"></td> </tr>
  <tr> <td height="19">SHELFLIFE  / СРОК РЕАЛИЗАЦИИ 24 MONTHS</td> </tr>
  <tr> <td height="19">SPECIAL CONDITIONS OF STORAGE AND TRANSPORTATION  ARE NOT REQUIRED</td> </tr>
  <tr> <td height="19">/СПЕЦИАЛЬНЫЕ УСЛОВИЯ ХРАНЕНИЯ   И ТРАНСПОРТИРОВКИ НЕ ТРЕБУЮТСЯ</td> </tr>
<tr> <td height="19"></td> </tr>  
  <tr> <td height="19">INGREDIENTS / СОСТАВ:</td> </tr>
  <tr> <td height="19">HOG  INTESTINES, SODIUM CHLORIDE, WATER / СВИНОЕ  КИШЕЧНОЕ СЫРЬЕ,  СОЛЬ, ВОДА</td> </tr>
  <tr> <td height="19">NUTRITION VALUE PER 100G  / ПИЩЕВАЯ ЦЕННОСТЬ НА 100 Г:</td> </tr>
  <tr> <td height="19">PROTEIN - 9G, FAT - 11G, CARBOHYDRATES - 0G / БЕЛКИ - 9Г, ЖИРЫ - 11Г, УГЛЕВОДЫ - 0Г.</td> </tr>
  <tr> <td height="19">ENERGY VALUE PER 100G  / ЭНЕРГЕТИЧЕСКАЯ    ЦЕННОСТЬ (КАЛОРИЙНОСТЬ) НА 100 Г:</td> </tr>
  <tr> <td height="19">135 KCAL (560 KJ) / 135 ККАЛ (560 КДЖ)</td> </tr>
  <tr> <td height="19">MADE IN CHILE/СДЕЛАНО В ЧИЛИ</td> </tr>
<tr> <td height="19"></td> </tr>
  <tr><td width="166"><img src="jpg/NR1362_207.jpg" width="120" height="120" /><img src="jpg/organico2.png" width="120" height="120" /><img src="jpg/hdpe-2.png" width="120" height="120" /><img src="jpg/EAC207.jpg" width="120" height="120" /></td></tr> 
</table>
<br>
<?
}}} //fin del for
?>
