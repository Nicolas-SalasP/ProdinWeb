<?
ini_set('memory_limit', '-1');
require "lib/conexion.php";
$link = mysql_connect("$localhost","$user","$pass");
mysql_select_db("$db");
require "lib/funciones.php";
//echo "id_etiqueta_idioma $id_etiqueta_idioma";
//echo "ini $ini - fin $fin";

if($id_etiqueta_idioma == 1 and $id_destinosotro == 3){

$sqlconsult="select * from etiqueta_paking_idioma_destinos  where id_etiqueta_idioma = $id_etiqueta_idioma order by id_epid desc";
$resultconsult=mysql_query($sqlconsult);
$cuantosconsult=mysql_num_rows($resultconsult);

//echo "cuantosconsult $cuantosconsult";

$rowconsult=mysql_fetch_array($resultconsult);

		if($rowconsult[hasta] == '')
		{
			$hasta2= $rowconsult[hasta] + 1;
			$valor2= $rowconsult[hasta] + $bultos;
		}else{
			$hasta2= $rowconsult[hasta] + 1;
			$valor2= $rowconsult[hasta] + $bultos;
	    }

//$sql_nuevo="insert into etiqueta_paking_idioma_destinos   (id_etiqueta_idioma,id_destinos,folio_piking,desde,hasta) values ('$id_etiqueta_idioma','$id_destinos','$folio_piking','$hasta2','$valor2')";
  //$result_nuevo=mysql_query($sql_nuevo,$link);

}else{

//$otro=1;

$hasta2=1;
$valor2=$bultos;

if($fin){
$valor2=$fin;
}

//echo "valor2 $valor2";

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

$sql2="SELECT * FROM pallet AS p, etiquetados_folios As ef, calibre AS c, producto AS pro, medidas_productos AS mp where 		p.pallet=$pallet and ef.id_calibre=c.id_calibre and ef.id_producto = pro.id_producto and	ef.id_medidas_productos = mp.id_medidas_productos and	p.id_etiquetados_folios= ef.id_etiquetados_folios order by ef.nombre_alt, ef.calibre_alt,mp.medidas_productos, ef.id_etiquetados_folios asc ";
$rest2=mysql_query($sql2);
$cuantos=mysql_num_rows($rest2);

//echo "cuantos $cuantos<br>";

$sqlpp="SELECT SUM(ef.contenido_unidades) AS contenido_unidadesp, SUM(ef.contenido_alt) AS contenido_altp,ef.id_etiquetados_folios AS id_etiquetados_folios, ef.id_cruce_tablas AS id_cruce_tablasv, ef.nombre_alt AS nombre_alt, ef.id_producto AS id_producto, pro.producto AS producto, ef.f_termino AS f_termino, ef.f_vencimiento AS f_vencimiento, ef.calibre_alt AS calibre_alt, c.calibre AS calibre, mp.medidas_productos AS medidas_productos, cpro.caract_producto AS caract_producto, ef.id_procedencia AS id_procedencia, ef.pallet AS pallet  FROM pallet AS p, etiquetados_folios As ef, calibre AS c, producto AS pro, medidas_productos AS mp, caract_producto cpro where 
		p.pallet=$pallet
		and ef.id_calibre=c.id_calibre
		and ef.id_producto = pro.id_producto
		and	ef.id_medidas_productos = mp.id_medidas_productos
		and	ef.id_caract_producto = cpro.id_caract_producto
		and	p.id_etiquetados_folios= ef.id_etiquetados_folios group by ef.pallet order by ef.nombre_alt, ef.calibre_alt,mp.medidas_productos, ef.id_etiquetados_folios asc ";
$restpp=mysql_query($sqlpp);
$cuantospp=mysql_num_rows($restpp);

//echo "$sqlp <br>sqlpp $sqlpp<br>";




//if($ini and $fin){
//$hasta2=$ini;
//$valor2=$fin;
//}

if($cuantos){
for ($i=$hasta2; $i <= $valor2 ; $i++){

//for($ini=$ini; $ini <= $fin ; $ini++){

$sql="SELECT * FROM destinos where id_destinos='$id_destinos'";
$result=mysql_query($sql);
$row=mysql_fetch_array($result);
$destinos=$row[destinos];
$domicilio=$row[domicilio];
$ciudad=$row[ciudad];
$pais=$row[pais];
$medidas_productos=$row[medidas_productos];
$enviadopor=$row[enviadopor];
$num=$i;
$r=mysql_fetch_array($rest2);



if($ini == $i){
$ini++;
?>

<?

//if($desde == $hasta){
for ($j=1; $j <= 2 ; $j++){
	  $f_termino=format_fecha_sin_hora($r[f_termino]);
	  $f_vencimiento =format_fecha_sin_hora($r[f_vencimiento]);
?>
<table width="393" height="346" border="0" cellpadding="0" cellspacing="0">
  <tr>
    <td width="27" class="style7">&nbsp;</td>
    <td width="105" height="19" class="style7"><? if($id_destinos != 150){?>Exportador<? }else{?>Fabricado por<? } ?></td>
    <td width="5">:</td>
    <td colspan="2" class="style7">PROCESADORA INSUBAN LTDA</td>
  </tr>
  <tr>
    <td height="19">&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td colspan="2"><span class="cajas">Antillanca Norte 391</span></td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td height="20" class="style7">Pa&iacute;s Exportador </td>
    <td class="style7">:</td>
    <td colspan="2" class="style7">Santiago Chile </td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td height="20" class="style7">Pa&iacute;s de Destino </td>
    <td class="style7">:</td>
    <td colspan="2" class="style7">
	<? 
	
 	echo "$ciudad - $pais";
	
	?></td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td height="19" class="style7">Compa&ntilde;ia</td>
    <td class="style7">:</td>
    <td colspan="2" class="style7"><? echo $destinos?></td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td height="19" class="style7">Direcci&oacute;n</td>
    <td class="style7">:</td>
    <td colspan="2" class="style7"><? echo $domicilio;?></td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td height="19" class="style7">N&ordm; de Bultos </td>
    <td class="style7">:</td>
    <td class="style7"><? echo $valor2?></td>
    <td rowspan="4"><div align="center" class="numero">
      <table width="101" border="0" cellpadding="1" cellspacing="1">
          <tr>
            <td width="97"><div align="center" class="style9">
			<?
			
			if($id_destinos == 3 or $id_destinos == 146){
			echo "$otro";
			$otroo = $otroo + $otro;
			}else{
			echo "$num";
			//$numm = $numm + $num;
			}
			
			//echo $num;?><br><? //echo $otro;?></div>
              <div align="right"></div></td>
          </tr>
        </table>
    </div><div align="right"></div></td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td height="21" class="style7">Enviado Por </td>
    <td class="style7">:</td>
    <td class="style7"><? echo $enviadopor;?></td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td height="21" class="style7">N&ordm; de Lote </td>
    <td class="style7">:</td>
    <td class="style7"><?echo $r[id_etiquetados_folios]?></td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td height="21" class="style7">Cantidad</td>
    <td class="style7">:</td>
    <td class="style7"><?
    
	
	if($r[contenido_alt]){
		echo  $contenido_alt=$r[contenido_alt];
	  }else{
		echo  $contenido_unidades=$r[contenido_unidades];
	  }
	
	
	?></td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td height="19" class="style7">Tripa</td>
    <td class="style7">:</td>
    <td colspan="2"><span class="titulo">
      <?
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
		?>
    </span></td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td height="22" class="style7">Calibre</td>
    <td class="style7">:</td>
    <td width="88" class="style7"><?
		if ($r[calibre_alt] != '') 
		  $calibre=$r[calibre_alt];
		else
		  $calibre=$r[calibre];
		echo $calibre;
		?>      </td>
    <td width="168" rowspan="4"><img src="jpg/NR1362.jpg" width="128" height="73" /></td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td height="19" class="style7">Metraje</td>
    <td class="style7">:</td>
    <td class="style7"><?echo $r[medidas_productos]?></td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td height="19" class="style7">Fecha de Elab </td>
    <td class="style7">:</td>
    <td class="style7"><? 
	 $dat2=split(" ",$f_termino);
      $dat=split("-",$dat2[0]);
      $f_termino="$dat[2]-$dat[1]-$dat[0]";
	  echo "  $dat[1] - $dat[2]";
	?></td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td height="19" class="style7">Fecha Vencimiento</td>
    <td class="style7">:</td>
    <td class="style7"><? 
	 $dat3=split(" ",$f_vencimiento);
      $dat=split("-",$dat3[0]);
      $f_vencimiento="$dat[2]-$dat[1]-$dat[0]";
	  echo "  $dat[1] - $dat[2]";
	 ?></td>
  </tr>
  <tr>
    <td height="50" class="cajas">&nbsp;</td>
    <td height="50" colspan="4" valign="top" class="cajas">Mantener en Lugar Fresco y Seco a Temperatura<br> 
    Monograf&iacute;a Reg. MGAP/DGSG/DIA ZZ 158/01<br />
    R&oacute;tulo Reg. MGAP/DGSG/DIA ZZ 158/02<br><BR>
    TRIPA DE CERDO SALADA EN TUBING. PRODUCTO CHILENO<BR>
    IMPORTADO POR PRINZI SA<BR>
    IM SRA 11183/ 56</td></td>
    
  </tr>
</table>

<? 

}
$otro++;
} //fin del if

} //fin del for
//+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++

}
//$otroo = $otroo + $otro;
//echo "NUM $num<br>";
$nummf = $cuantospp + $num;
//$nummw= $numm + $cuantospp;
//echo "otroo $otroo $r[id_etiquetados_folios] - nummw $nummw<br>";
?>



