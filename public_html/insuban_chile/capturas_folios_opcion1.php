<?

$sql_xx="SELECT * FROM paking where id_paking = id_paking order by folio_piking desc LIMIT 0,1";
$result_xx=mysql_query($sql_xx);
$ultimo=mysql_fetch_array($result_xx);
$idxx=$ultimo[id_paking] + 1;

//echo "id $id_insuban";

$sql_id="SELECT * FROM paking where id_paking = id_paking order by folio_piking desc LIMIT 0,1";
$result_id=mysql_query($sql_id);


if ($r=mysql_fetch_array($result_id))
{ 

$cuantos=$r[folio_piking]; 
$id=$cuantos + 1;

}



 
$sql="SELECT * from paking where id_paking=id_paking group by id_paking_relacion 
order by id_paking  desc";
$rest=mysql_query($sql);
//$cuantos=mysql_num_rows($rest);

/*
$sql="SELECT p.id_paking, ef.factura, e.estado_folio, count( DISTINCT ef.id_etiquetados_folios) AS cf 
from paking AS p, etiquetados_folios AS ef, estado_folio AS e 
where
p.id_paking_relacion = p.id_paking_relacion
and p.id_etiquetados_folios = ef.id_etiquetados_folios
and ef.id_estado_folio = e.id_estado_folio
group by p.id_paking 
order by p.id_paking  desc
";
$rest=mysql_query($sql);
$cuantos=mysql_num_rows($rest);
*/

?>
<style type="text/css">
<!--
.cajas {	font-family: Arial, Helvetica, sans-serif;
	font-size: 11px;
}
.titulo {font-family: Verdana, Arial, Helvetica, sans-serif; font-size: 10px; font-weight: bold; }
-->
</style>
<script language="JavaScript"> 
function seleccionar_todo(){ 
   for (i=0;i<document.form1.elements.length;i++) 
      if(document.form1.elements[i].type == "checkbox") 
         document.form1.elements[i].checked=1 
} 

function deseleccionar_todo(){ 
   for (i=0;i<document.form1.elements.length;i++) 
      if(document.form1.elements[i].type == "checkbox") 
         document.form1.elements[i].checked=0 
} 
</script>

<script language="JavaScript">
<!--
var nav4 = window.Event ? true : false;
function numeros(evt){ 
// NOTE: Backspace = 8, Enter = 13, '0' = 48, '9' = 57 
var key = nav4 ? evt.which : evt.keyCode; 
return (key <= 32 || (key >= 48 && key <= 59) || (key >= 45 && key <= 47 ));
}
//-->
</script>



<table width="715" border="0" align="center">
  <tr>
    <td width="709" height="30"><span class="titulo">Ingreso de Folio </span></td>
  </tr>
  <tr>
    <td>
	<form id="form1" name="form1" method="post" action="">
	<table width="487" border="0" align="center">
    <tr>
      <td width="230"><span class="cajas">N&ordm; de Picking al cual sera asignado</span></td>
      <td width="247"><span class="cajas">Ingrese Folios separados por un Enter </span></td>
    </tr>
    <tr>
      <td class="titulo">N&ordm; <? echo $folio_pinking2=$cuantos+1?></td>
      <td><textarea name="folios" cols="30" rows="3" id="folios" onKeyPress="return numeros(event)"></textarea></td>
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td><input name="buscar" type="submit" class="cajas" id="buscar" value="Buscar" /></td>
    </tr>
  </table>
<br>
<? if($folios){?>
<span class="cajas"></span>
<table width="700" border="1" align="center" cellpadding="0" cellspacing="0">
    <tr>
      <td width="7%" bgcolor="#CCCCCC" class="titulo">N&ordm; </td>
      <td width="8%" bgcolor="#CCCCCC"><a href="javascript:seleccionar_todo()"><img src="jpg/todos.jpg" width="13" height="13" border="0"/></a> <a href="javascript:deseleccionar_todo()"><img src="jpg/ninguno.jpg" width="13" height="13" border="0"/></a> </td>
      <td width="10%" nowrap="nowrap" bgcolor="#CCCCCC" class="titulo">Folio PT </td>
      <td width="10%" bgcolor="#CCCCCC" class="titulo">Fecha Folio </td>
      <td width="42%" bgcolor="#CCCCCC" class="titulo">Producto</td>
      <td width="8%" bgcolor="#CCCCCC" class="titulo">Calibre</td>
      <td width="7%" bgcolor="#CCCCCC" class="titulo"> Medida </td>
      <td width="8%" bgcolor="#CCCCCC" class="titulo">Cantidad</td>
    </tr>
    <? 
	   
	 $dat=split("\n",$folios);
	 $c=count($dat);
	
	 for ($i=0; $i<=$c;$i++)
	  { 
	   if ($dat[$i] != "")
	   {
	    $id_f=$dat[$i];
		$largo=strlen($id_f);
		if($largo != 1){
		  $id_f=substr($id_f, 0, $largo);
		  //echo "idf $id_f";
		}
		 
		 $sql="SELECT *	 FROM etiquetados_folios AS ef, producto AS p, calibre AS c, medidas_productos AS mp 
		 where ef.id_etiquetados_folios = ef.id_etiquetados_folios 
		 and ef.id_producto = p.id_producto 
		 and ef.id_calibre=c.id_calibre 
		 and ef.id_medidas_productos = mp.id_medidas_productos 
		 and ef.id_estado_folio != 3
		 and ef.id_estado_folio != 7
		 and ef.id_estado_folio != 1
		 and ef.id_estado_folio != 6
		 and ef.id_estado_folio != 9
		 and ef.id_estado_folio != 10
		 and ef.id_estado_folio != 5
		 and ef.id_estado_folio != 4
		 and ef.borrado != 1
		 and id_etiquetados_folios = $id_f
		 and ef.ocupado = 0
		 ";
         $rest=mysql_query($sql);
		 $cuantos=mysql_num_rows($rest);
		//echo "c $sql";
		 
		 if($cuantos){
			
		    while ($r=mysql_fetch_array($rest)){ 
	   		$f_elaboracion=format_fecha_sin_hora($r[f_elaboracion]);
			$id_pedidos=$r[id_pedidos];
			$id_c_es_so=$r[id_c_es_so];
			$ii++;
	     //echo "id_c_es_so $id_c_es_so";
		?>
    <tr>
      <td nowrap="nowrap" class="cajas"><center><? echo $ii?></center></td>
      <td nowrap="nowrap"> <label class="cajas">
          
	    <? if(!$id_pedidos) {?> 
        <input name="id_etiquetados_folios[]" type="checkbox" id="id_etiquetados_folios[]" value="<?echo $r[id_etiquetados_folios];?>" />
		<? }else{?>
		<? 
		if(!$id_c_es_so){
			echo "<b> Pedido: </b> $r[id_pedidos]";
		}else{
			echo "<b> Solicitud C/Estado: </b> $r[id_c_es_so]";
		}
			
		?>
		<? }?>
      </label></td>
      <td class="cajas"><? //echo substr($r[ano],2,4); ?><?echo $r[id_etiquetados_folios]?></td>
      <td class="cajas"><?echo $f_elaboracion?></td>
      <td class="cajas"><?echo $r[producto]?></td>
      <td class="cajas"><?echo $r[calibre]?></td>
      <td class="cajas"><?echo $r[medidas_productos]?></td>
      <td class="cajas"><?echo $r[contenido_unidades]?></td>
	</tr>
    <?
	 }//while ($r=mysql_fetch_array($rest)){ 
	}// if($cuantos){
	}//if ($dat[$i] != "")
	}//for ($i=0; $i<=$c;$i++)
?>
  </table>

   <br>
   <a href="javascript: document.form1.submit();">
   <label>
    <? if($permiso36 == 1){?>
	<? if(!$id_pedidos) {?>
   <div align="center">
     <input type="image" name="grabar" src="jpg/asignar_folio_picking.jpg" />
     </div>
	 <? }?>
	 <? }?>
   </label>
   </a>
	<? }?>
	</form>	</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
  </tr>
</table>
<?
if($grabar_x){
if ($id_etiquetados_folios) {
  foreach ($id_etiquetados_folios as $key)
   {
   $sqlsulta="SELECT * FROM paking WHERE id_etiquetados_folios = $key";
   $result_consulta=mysql_query($sqlsulta);
   $cuantos_consulta=mysql_num_rows($result_consulta);
   

   if(!$cuantos_consulta){
   $fecha_ingreso_paking  =date("Y-m-d");
	$sql="insert into paking (folio_piking,id_paking_relacion,id_etiquetados_folios,fecha_ingreso_paking,idUser) values ($folio_pinking2,$idxx,$key,'$fecha_ingreso_paking',$id_insuban)";
	//echo "sql $sql<br>";
	$res=mysql_query($sql);
    $sq_up="update etiquetados_folios set id_estado_folio = '3' where id_estado_folio != 3 and id_etiquetados_folios=$key";
	$rest_up=mysql_query($sq_up);
	//echo "sql2 $sq_up";
	}
  }
}
echo"<meta http-equiv=\"refresh\" content=\"0;URL=sistema.php?modulo=capturas_folios.php\">";
exit;
}
?>