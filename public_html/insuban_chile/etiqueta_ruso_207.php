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
  <tr> <td height="19"><b>NATURAL SALTED HOG CASINGS CAL. <? echo $calibre_alt;?></b></td></tr>  
<!--  <tr> <td height="19"><b>НАТУРАЛЬНАЯ СОЛЕНАЯ СВИНАЯ ОБОЛОЧКА КАЛ. <? echo $calibre_alt;?> <? echo $caract_producto;?></b></td></tr> 
  <tr> <td height="19"><b>НАТУРАЛЬНАЯ СОЛЕНАЯ СВИНАЯ ОБОЛОЧКА КАЛ. <? echo $calibre_alt;?></b></td></tr>-->
  
  <tr> <td height="19"><b>НАТУРАЛЬНЫЕ СОЛЕНЫЕ СВИНЫЕ КИШКИ КАЛ. 48/+ СЕЛЕКЦИЯ 16/2+</b></td></tr>  
  <tr> <td height="19">MADE IN CHILE/ ПРОИЗВЕДЕНО В ЧИЛИ</td></tr>
  <tr> <td height="19">Number, Name and address of processing factory/:</td></tr>
  <tr> <td height="19">13-62,PROCESADORA INSUBAN SPA, Antillanca Norte 391</td> </tr>
  <tr> <td height="19">(Chile) /Номер, имя и адрес предприятия/ : 13-62 ,</td> </tr>
  <tr> <td height="19">PROCESADORA INSUBAN SPA, Antillanca Norte 391</td> </tr>
  <tr> <td height="19">(Чили )</td> </tr>
  <tr> <td height="19">Gross weight of cask: <b><? echo $peso1_alt;?></b> kg /Вес брутто бочке : <b><? echo $peso1_alt;?></b> кг</td> </tr>
  <tr> <td height="19">Net weight of cask: <b><? echo $peso2_alt;?></b> kg /Масса нетто бочке : <b><? echo $peso2_alt;?></b> кг</td> </tr>
  <tr>
    <td height="19">Produced:
    <? 
   $dat2=split(" ",$f_termino);
      $dat=split("-",$dat2[0]);
      $f_termino="$dat[2]-$dat[1]-$dat[0]";
    echo "<b> $dat[1] - $dat[2] </b>";
    echo "/Дата выработки ";
    echo "<b> $dat[1] - $dat[2] </b>";?></td>
   </tr>
    <tr> <td height="19">Shelf life- Two years / Срок хранения: два года</td> </tr>
  <tr> <td height="19">Barrel  number: <b><? echo $num;?></b>  /  Номер Бочки: <b><? echo $num;?></b></td> </tr>
  <tr> <td height="19">Special condictions of transportation are not required:</td></tr>
  <tr> <td height="19">/Специальных условий транспортировки не требуется</td></tr>
  <tr> <td height="19">Recipient:<? echo $destinos;?> <? echo $domicilio;?></td></tr>
  <tr> <td height="19"><? echo $ciudad;?>-<? echo $pais;?>/</td></tr>
  <tr> <td height="19">Получатель: ООО << СТАР-НАТУРДАРМ>> 390046 ,</td></tr>
  <tr> <td height="19">Рязанская обл. , Рязань, ул. Маяковского, д.</td></tr>
  <tr> <td height="19">1А, стр. 3, пом. 111</td></tr>
  <tr> <td height="19">Original standard package, reuse is forbidden /</td></tr>
  <tr> <td height="19">Оригинальная стандартная упаковка, повторное использование</td></tr>
  <tr> <td height="19">запрещено</td></tr>
  <tr> <td height="19">Nutrition value: in 100 g of hog casing: protein-9g, fat-11,4 g/</td></tr>
  <tr> <td height="19">Пищевая ценность : в 100 г свиной оболочки: белок- 9g , жир г 11,4</td></tr>
  <tr> <td height="19">Calories: in 100g of hog casings: 138,2 Kcal/ Калории: в 100 г</td></tr>
  <tr> <td height="19">свиных оболочек : 138,2 килокалорий</td></tr>
  <tr> <td height="19">Ingredients: intestines, brine (sodium chloride, citric acid E330, water)/</td></tr>
  <tr> <td height="19">Состав: кишки, насыщенные рассолом (хлорид натрия , Е330</td></tr>
  <tr> <td height="19">лимонная кислота , вода )</td></tr>
  <tr> <td height="19">GMO free/ Без ГМО</td></tr>
  <tr><td width="166"><img src="jpg/NR1362_207.jpg" width="120" height="120" /><img src="jpg/organico2.png" width="120" height="120" /><img src="jpg/Moebious 7.jpg" width="120" height="120" /><img src="jpg/EAC207.jpg" width="120" height="120" /></td></tr> 
</table>
<br>
<?
}}} //fin del for
?>
