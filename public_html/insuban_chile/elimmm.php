<? 
require "lib/conexion.php";
$link = mysql_connect("$localhost","$user","$pass");
mysql_select_db("$db");
require "lib/funciones.php";



if($modificar){

$sql="delete from folios_mat where  id_etiquetados_folios = $id_etiquetados_folios";
$res=mysql_query($sql);
//echo "sqls $sql<br>";
foreach ($_POST as $key => $value)
{ 

 $dat=split("-",$key); 

   if ($dat[0] == 'id_mat')
   {
	$id=$dat[1];
   	$id_mat=$_POST["id_mat-$id"];
	
    $sql2="SELECT * FROM mat_prima_nacional WHERE id_mat_prima_nacional = $id_mat";
	$result2=mysql_query($sql2);
	//echo "sql2 $sql2<br>";
	if ($row2=mysql_fetch_array($result2)) { 
         $contenido2=$row2[contenido];
		 $total_contenido2+=$contenido2;
		 
	}
	
   }
   
   }
 
//echo "mat_prima_nacional $total_contenido<br>";
foreach ($_POST as $keyg3 => $value3)
{ 

 $dat3e=split("-",$keyg3); 

   if ($dat3e[0] == 'id_mat3')
   {
	$id3e=$dat3e[1];
	$id_mat33=$_POST["id_mat3-$id3e"]; 
	//echo "id_mat33 $id_mat33";
	$sql37="SELECT * FROM mat_prima_importada WHERE id_mat_prima_importada = $id_mat33";
	$result37=mysql_query($sql37);
	//echo "sql3 $sql37<br>";
	
	if ($row37=mysql_fetch_array($result37)) { 
         $contenido3=$row37[contenido];
		 $total_contenido3+=$contenido3;
	}
   }
	
   }
 
//echo "mat_prima_importada $total_contenido3<br>";

foreach ($_POST as $keyy => $value)
{ 
 $dat5=split("-",$keyy); 
   if ($dat5[0] == 'id_mat')
   {
	$id5=$dat5[1];
   	$id_mat5=$_POST["id_mat-$id5"]; 
	$sql36="SELECT * FROM mat_prima_nacional WHERE id_mat_prima_nacional = $id_mat5";
	$result33=mysql_query($sql36);
	
	while ($row33=mysql_fetch_array($result33)) { 
          $contenido2=$row33[contenido];
		  $valor_cmp2=$row33[valor_cmp];
		 
		  $aporte_por_material2 = $contenido2 / $total_contenido2;
		  $ponderado2 =$valor_cmp2 *  $aporte_por_material2;
		
		//echo "$id_etiquetas / $id_mat / $contenido / $valor_cmp / $aporte_por_material / $ponderado <br>";
		 $sql_mod="insert folios_mat (id_etiquetados_folios,id_mat,contenido,valor_cmp,aporte_por_material,ponderado) values ($id_etiquetados_folios,$id_mat5,$contenido2,$valor_cmp2,$aporte_por_material2,$ponderado2)";
	$result_cruce=mysql_query($sql_mod,$link);
	//echo "SQL AGREGAR $sql_mod<br>";
	 $total_ponderado2+=$ponderado2;
	 
	}//while ($row3=mysql_fetch_array($result3)) { 
		 
		 
	}//if ($dat[0] == 'id_mat')
	


}//foreach ($_POST as $key => $value)
//echo "total_ponderado_nacional $total_ponderado<br>";

foreach ($_POST as $keyg3 => $value3)
{ 
 $dat3f=split("-",$keyg3); 
   if ($dat3f[0] == 'id_mat3')
   {
	$id3f=$dat3f[1];
	//echo "id3f $id3f<br>";
	$id_mat3f=$_POST["id_mat3-$id3f"]; 
	//echo "id_mat3f $id_mat3f<br>";
	$sql3f="SELECT * FROM mat_prima_importada WHERE id_mat_prima_importada = $id_mat3f";
	$result3f5=mysql_query($sql3f);
	//echo "sql3f $sql3f<br>";
	while ($row3f5=mysql_fetch_array($result3f5)) { 
          $contenido3=$row3f5[contenido];
		  $valor_cmpi=$row3f5[valor_cmpi];
		  $aporte_por_material3 = $contenido3 / $total_contenido3;
		  $ponderado3 =$valor_cmpi *  $aporte_por_material3;
		
		//echo "$id_etiquetas / $id_mat / $contenido / $valor_cmp / $aporte_por_material / $ponderado <br>";
		 $sql_mod="insert folios_mat (id_etiquetados_folios,id_mat,contenido,valor_cmp,aporte_por_material,ponderado) values ($id_etiquetados_folios,$id_mat3f,$contenido3,$valor_cmpi,$aporte_por_material3,$ponderado3)";
	$result_cruce=mysql_query($sql_mod,$link);
	//echo "SQL AGREGAR $sql_mod";
	 $total_ponderado3+=$ponderado3;
	 
	}//while ($row3=mysql_fetch_array($result3)) { 
  }//if ($dat[0] == 'id_mat')
	
}//foreach ($_POST as $key => $value)
//echo "total_ponderado_importado $total_ponderado3<br>";


$suma_mpni=$total_contenido3 + $total_contenido2;

//echo "Total suman $suma_mpni<br>";

$res1=$total_contenido2 / $suma_mpni;
$res2=$total_contenido3 / $suma_mpni;

$ver1=$total_ponderado2 * $res1;
$ver2=$total_ponderado3 * $res2;

$total_ponderado_mpni=$ver1 + $ver2;

//echo "total ponderado $total_ponderado_mpni<br>";

   if($id_tipo_calculo == 3) //multiplocar
   {
	 $resul_valor_unitario = $total_ponderado_mpni * $valor_indice;
	   
   }
    if($id_tipo_calculo == 4) //dividir
   {
	  $resul_valor_unitario = $total_ponderado_mpni / $valor_indice;
   }
   
    $fech_generada_inicio =date("Y-m-d H:i:s");

 $sqlup3="UPDATE etiquetados_folios  set total_ponderado   = '$resul_valor_unitario', fech_generada_inicio = '$fech_generada_inicio' where id_etiquetados_folios  = $id_etiquetados_folios";
	  $result3=mysql_query($sqlup3);   
//echo "$sqlup3<br>";

//echo"<meta http-equiv=\"refresh\" content=\"0;URL=ver_trazabilidad.php?id_etiquetados_folios=$id_etiquetados_folios&amp;f_elaboracion=$f_elaboracion&
//f_termino=$f_termino&id_producto=$id_producto\">";
 //exit;
 ?>
<script languaje="javascript">
/*top.opener.document.location = top.opener.document.location;*/
window.opener.document.location.replace('http://200.63.96.220/~insubac/<? echo $url;?>/sistema.php?modulo=ejemplo_etiquetas_folios.php&id_etf2=<? echo  $id_etiquetados_folios;?>');
</script>
<script language="javascript">
window.close();
</script>
<?
}






if($id_etiquetados_folios){

$sql_buscar="SELECT * from folios_mat AS fm, mat_prima_nacional AS mpn, origenes as orig, producto AS p where fm.id_etiquetados_folios=$id_etiquetados_folios and fm.id_mat = mpn.id_mat_prima_nacional and mpn.id_origen=orig.id_origen and mpn.id_producto = p.id_producto";
$result_buscar=mysql_query($sql_buscar);
$cuantos_buscar=mysql_num_rows($result_buscar);


$sql_buscar2="SELECT * from folios_mat AS fm, mat_prima_importada AS mpn, origenes as orig, producto AS p where fm.id_etiquetados_folios=$id_etiquetados_folios and fm.id_mat = mpn.id_mat_prima_importada and mpn.id_origen=orig.id_origen and mpn.id_producto = p.id_producto";
$result_buscar2=mysql_query($sql_buscar2);
$cuantos_buscar2=mysql_num_rows($result_buscar2);


?>

<style type="text/css">
<!--
.cajas {
	font-family: Arial, Helvetica, sans-serif;
	font-size: 11px;
}
.titulo {font-family: Verdana, Arial, Helvetica, sans-serif; font-size: 10px; font-weight: bold; }
.numero {	font-family: Verdana, Arial, Helvetica, sans-serif;
	font-size: 14px;
	font-weight: bold;
}
.style2 {font-family: Verdana, Arial, Helvetica, sans-serif; font-size: 14; font-weight: bold; }
-->
</style>



<input type="hidden" name="id_producto" value="<? echo $id_producto?>" />
<input type="hidden" name="f_termino" value="<? echo $f_termino?>" />
<input type="hidden" name="id_tipo_calculo" value="<? echo $id_tipo_calculo?>" />
<input type="hidden" name="valor_indice" value="<? echo $valor_indice?>" />

<? //echo "valor_indice $valor_indice - id_tipo_calculo $id_tipo_calculo";?>
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
<script>
window.onload=function(){
var pos=window.name || 0;
window.scrollTo(0,pos);
}
window.onunload=function(){
window.name=self.pageYOffset || (document.documentElement.scrollTop+document.body.scrollTop);
}
</script>
<script language="JavaScript" type="text/javascript" src="lib/cal.js">
</script>

<form id="form1" name="form1" method="post" action="">
  <input type="hidden" name="id_producto" value="<? echo $id_producto?>">
  <input type="hidden" name="f_elaboracion" value="<? echo $f_elaboracion?>">
  <table width="100%" border="1" align="center" cellpadding="0" cellspacing="0">
          <tr>
            <td width="8%" bgcolor="#CCCCCC" class="titulo">&nbsp;Codigo&nbsp;</td>
            <td width="9%" nowrap="nowrap" bgcolor="#CCCCCC" class="titulo">&nbsp;F. ingreso&nbsp;</td>
            <td width="23%" nowrap="nowrap" bgcolor="#CCCCCC" class="titulo">&nbsp;Producto&nbsp;</td>
            <td width="20%" nowrap="nowrap" bgcolor="#CCCCCC" class="titulo">&nbsp;Origen&nbsp;</td>
            <td width="10%" nowrap="nowrap" bgcolor="#CCCCCC" class="titulo">&nbsp;Factura Imp.</td>
            <td width="7%" nowrap="nowrap" bgcolor="#CCCCCC" class="titulo">&nbsp;N&ordm; Bidon&nbsp;</td>
            <td width="8%" nowrap="nowrap" bgcolor="#CCCCCC" class="titulo">&nbsp;Contenido&nbsp;</td>
             <td width="7%" nowrap="nowrap" bgcolor="#CCCCCC" class="titulo">&nbsp;Costo MP&nbsp;</td>
            <td width="4%" nowrap="nowrap" bgcolor="#CCCCCC" class="titulo">&nbsp;F. Faena</td>
            <td width="4%" nowrap="nowrap" bgcolor="#CCCCCC" class="titulo">&nbsp;F. Despacho</td>
          </tr>
		  <? 
		  while ($r=mysql_fetch_array($result_buscar)) { 
		//$ano=substr($r[ano], 2, 3);
		 //$base="N".$ano.$r[id_mat_prima_nacional];
		  ?>
          <tr>
            <td class="cajas">&nbsp;<?echo "N$r[id_mat_prima_nacional]";?></td>
            <td nowrap="nowrap" class="cajas">&nbsp;<?echo format_fecha($r[fecha_ingreso]);?>&nbsp;</td>
            <td nowrap="nowrap" class="cajas">&nbsp;<?echo $r[producto]?> [<? echo $r[id_producto]?>]</td>
            <td nowrap="nowrap" class="cajas">&nbsp;<?echo $r[origen]?> [<? echo $r[id_origen]?>]</td>
            <td nowrap="nowrap" class="cajas">&nbsp;</td>
            <td nowrap="nowrap" class="cajas">&nbsp;<?echo $r[bidon_num]?>&nbsp;</td>
            <td nowrap="nowrap" class="cajas">&nbsp;<?echo $r[contenido]?>&nbsp;</td>
            <td nowrap="nowrap" class="cajas">&nbsp;<?echo $r[valor_cmp]?></td>
            <td nowrap="nowrap" class="cajas">&nbsp;<?echo format_fecha($r[fecha_faena]);?></td>
            <td nowrap="nowrap" class="cajas">&nbsp;<?echo format_fecha($r[fecha_salida]);?></td>
          </tr>
          <? } //while ($row=mysql_fetch_array($result))?>
          
          <?
		  if($cuantos_buscar2){//pregunta si viene materia prima importada
		  while ($r2=mysql_fetch_array($result_buscar2)) { 
		  //$ano=substr($r[ano], 2, 3);
		  //$base="N".$ano.$r[id_mat_prima_nacional];
		  $id_mat_prima_importa3=$r2[id_mat_prima_importada];
		  ?>
          <tr>
            <td class="cajas">&nbsp;
		   <?
           $largo=strlen($id_mat_prima_importa3);
		   if($largo == 8){ 
		   $id_mat_prima_importa3=substr($id_mat_prima_importa3,1,7);
		   }
  		   if($largo == 9){
		   $id_mat_prima_importa3=substr($id_mat_prima_importa3,1,8);
		   }
		   echo "I$id_mat_prima_importa3";
	  	 ?>
         </td>
            <td nowrap="nowrap" class="cajas">&nbsp;<?echo format_fecha($r2[fecha_ingreso]);?>&nbsp;</td>
            <td nowrap="nowrap" class="cajas">&nbsp;<?echo $r2[producto]?> [<? echo $r2[id_producto]?>]</td>
            <td nowrap="nowrap" class="cajas">&nbsp;<?echo $r2[origen]?></td>
            <td nowrap="nowrap" class="cajas">&nbsp;<?echo $r2[comprobante_num]?></td>
            <td nowrap="nowrap" class="cajas">&nbsp;<?echo $r2[bidon_num]?>&nbsp;</td>
            <td nowrap="nowrap" class="cajas">&nbsp;<?echo $r2[contenido]?>&nbsp;</td>
              <td nowrap="nowrap" class="cajas">&nbsp;<?echo $r2[valor_cmpi]?></td>
            <td nowrap="nowrap" class="cajas">&nbsp;<?echo format_fecha($r2[fecha_elaboracion]);?></td>
            <td nowrap="nowrap" class="cajas">&nbsp;<?echo format_fecha($r2[fecha_salida]);?></td>
          </tr>
		  <? } //while ($row=mysql_fetch_array($result))
			}
		  ?>
          
          
  </table>
  <? } //  while ($r=mysql_fetch_array($result_buscar)) 
		 
		?>
  <table width="497" border="0" align="center">
    <tr>
      <td width="244"><strong>
	 	  <a href="javascript: document.form1.submit();">
      
        <? if($buscar_faja or $hasta){?>
       
       
        <input type="submit" name="modificar" id="modificar" value="modificar" />
        <? }?>
      </a>
	 
	  </strong> </td>
      <td width="245"><a href="ver_trazabilidad.php?id_etiquetados_folios=<? echo $id_etiquetados_folios?>&amp;trazabilidad=1&f_elaboracion=<? echo $f_elaboracion?>&f_termino=<? echo $f_termino?>&id_producto=<? echo $id_producto?>&valor_indice=<? echo $valor_indice?>&id_tipo_calculo=<? echo $id_tipo_calculo?>" class="titulo">+ Trazabilidad</a></td>
    </tr>
  </table>
  <br>
		<? if($trazabilidad){?>
		
		<table width="100%" border="0" align="center">
          <tr>
            </tr>
          <tr>
            <td colspan="3"><table width="437" border="0" align="center">
              <tr>
                <td width="158"><span class="titulo">Desde </span></td>
                <td width="167"><span class="titulo">Hasta</span></td>
                <td width="98"><input name="buscar_faja" type="submit" class="cajas" value="Buscar" /></td>
              </tr>
              <tr>
                <td><input name="desde" type="text" class="cajas" value="<?echo $desde?>" size="10" maxlength="10" />
                <a href="javascript:show_Calendario('form1.desde');" class="cajas" >Ver</a></td>
                <td><input name="hasta" type="text" class="cajas" value="<? echo $hasta;?>" size="10" maxlength="10" />
              <a href="javascript:show_Calendario('form1.hasta');" class="cajas" >Ver</a></td>
                <td><? $producto= crea_producto_onChange($link,$id_producto);
		 echo $producto;?></td>
              </tr>
              <tr>
                <td>&nbsp;</td>
                <td>&nbsp;</td>
                <td>&nbsp;</td>
              </tr>
            </table></td>
          </tr>
          <tr>
            <td colspan="3">
			<? if($hasta and $id_producto){
		    $desde=format_fecha_sin_hora($desde);
			$hasta=format_fecha_sin_hora($hasta);
			$sql_buscar="SELECT * from mat_prima_nacional AS mpn, origenes AS orig, producto AS p WHERE mpn.fecha_salida BETWEEN '$desde' AND '$hasta' and mpn.id_estado_material = 2 and mpn.id_origen = orig.id_origen and p.id_producto = $id_producto and mpn.id_producto = p.id_producto";
			$result_buscar=mysql_query($sql_buscar);
			$cuantos_buscar=mysql_num_rows($result_buscar);
			//echo "MPN $cuantos_buscar<br>";
			$sql_buscarimp="SELECT * from mat_prima_importada AS mpi, origenes AS orig, producto AS p WHERE mpi.fecha_salida BETWEEN '$desde' AND '$hasta' and mpi.id_origen =orig.id_origen and mpi.id_producto = $id_producto and mpi.id_producto = p.id_producto and mpi.id_estado_material = 2  order by mpi.id_mat_prima_importada desc";
			$result_buscarimpo=mysql_query($sql_buscarimp);
			$cuantos_buscarimportada=mysql_num_rows($result_buscarimpo);
   			//echo "MPI $cuantos_buscarimportada<br>";		
			
		  ?>
                
                <table width="100%" border="1" cellpadding="0" cellspacing="0">
                  <tr>
                    <td width="3%" bgcolor="#CCCCCC" class="titulo">
					 <a href="javascript:seleccionar_todo()"><img src="jpg/todos.jpg" width="13" height="13" border="0"/></a> 
			  <a href="javascript:deseleccionar_todo()"><img src="jpg/ninguno.jpg" width="13" height="13" border="0"/></a>					</td>
                    <td width="9%" bgcolor="#CCCCCC" class="titulo">&nbsp;Codigo&nbsp;</td>
                    <td width="8%" bgcolor="#CCCCCC" class="titulo">&nbsp;F.Ingreso&nbsp;</td>
                    <td width="20%" bgcolor="#CCCCCC" class="titulo">&nbsp;Producto</td>
                    <td width="30%" bgcolor="#CCCCCC" class="titulo">&nbsp;Origen&nbsp;</td>
                    <td width="7%" bgcolor="#CCCCCC" class="titulo">&nbsp;N&ordm; Bidon&nbsp;</td>
                    <td width="8%" bgcolor="#CCCCCC" class="titulo">&nbsp;Contenido&nbsp;</td>
                      <? if($permiso34 == 1 and $nivel_usua == 1){?><td width="7%" bgcolor="#CCCCCC" class="titulo">&nbsp;Costo MP&nbsp;</td><? }?>
                    <td width="8%" bgcolor="#CCCCCC" class="titulo">&nbsp;F.Faena&nbsp;</td>
                  </tr>
                  <? 
				  if ($hasta and $cuantos_buscar) {
				 
				  while ($ro=mysql_fetch_array($result_buscar)) { 
				  $ano=substr($ro[ano], 2, 3);
				  $base="N".$ano.$ro[id_mat_prima_nacional];
				  $id_mat_prima_nacional2=$ro[id_mat_prima_nacional];
				  $id_origen2=$ro[id_origen];
				  $id_producto2=$ro[id_producto];
				  $contenido2=$ro[contenido];
				  $valor_cmp2=$ro[valor_cmp];
				  ?>
                  <tr>
                    <td class="cajas">
                     <input type="checkbox" name="id_mat-<? echo $id_mat_prima_nacional2?>" id="id_mat" value="<? echo $id_mat_prima_nacional2?>" />
                    
                    </td>
                    <td nowrap="nowrap" class="cajas">&nbsp;<?echo "N$ro[id_mat_prima_nacional]";?>&nbsp;</td>
                    <td nowrap="nowrap" class="cajas">&nbsp;<?echo format_fecha($ro[fecha_ingreso]);?>&nbsp;</td>
                    <td nowrap="nowrap" class="cajas">&nbsp;<?echo $ro[producto]?>&nbsp;</td>
                    <td nowrap="nowrap" class="cajas">&nbsp;<?echo $ro[origen]?></td>
                    <td nowrap="nowrap" class="cajas">&nbsp;<?echo $ro[bidon_num]?>&nbsp;</td>
                    <td nowrap="nowrap" class="cajas">&nbsp;<?echo $ro[contenido]?>&nbsp;</td>
                      <? if($permiso34 == 1 and $nivel_usua == 1){?><td nowrap="nowrap" class="cajas">&nbsp;<?echo format_fecha($ro[fecha_faena]);?>&nbsp;</td><? }?>
                    <td nowrap="nowrap" class="cajas">&nbsp;<?echo format_fecha($ro[fecha_faena]);?>&nbsp;</td>
                  </tr>
                  <? } 
				  }
				  ?>
                 <!-- ********************************************************************************************************-->
              <? 
			  
			  if ($hasta and $cuantos_buscarimportada) { 
			
			  while ($rimp=mysql_fetch_array($result_buscarimpo)) { 
				  	 //$ano3=substr($rimp[ano], 2, 3);
				  	 $id_mat_prima_importa3=$rimp[id_mat_prima_importada];
				  	 $id_origen3=$rimp[id_origen];
				  	 $id_producto3=$rimp[id_producto];
				  	 $contenido3=$rimp[contenido];
				 	 $valor_cmpi3=$rimp[valor_cmpi];
				  
				  	 //$base="N".$ano.$rimp[id_mat_prima_nacional];
				  
			?>
                    <tr>
                    <td class="cajas"><!--<input type="checkbox" name="id_mat3-<? echo $id_mat_prima_importa3?>" id="id_mat3" value="<? echo $id_mat_prima_importa3?>" />-->
                   <input type="checkbox" name="id_mat3-<? echo $id_mat_prima_importa3?>" id="id_mat3" value="<? echo $id_mat_prima_importa3?>" />
                    
                    </td>
                    <td nowrap="nowrap" class="cajas">&nbsp;<? $largo=strlen($rimp[id_mat_prima_importada]);
																if($largo == 8){ 
																$id_mat_prima_importa3=substr($id_mat_prima_importa3,1,7);
																}
																if($largo == 9){
															    $id_mat_prima_importa3=substr($id_mat_prima_importa3,1,8);
																}
																echo "I$id_mat_prima_importa3";
															?>&nbsp;
                    </td>
                    <td nowrap="nowrap" class="cajas">&nbsp;<?echo format_fecha($rimp[fecha_ingreso]);?>&nbsp;</td>
                    <td nowrap="nowrap" class="cajas">&nbsp;<?echo $rimp[producto]?>&nbsp;</td>
                    <td nowrap="nowrap" class="cajas">&nbsp;<?echo $rimp[origen]?></td>
                    <td nowrap="nowrap" class="cajas">&nbsp;<?echo $rimp[bidon_num]?>&nbsp;</td>
                    <td nowrap="nowrap" class="cajas">&nbsp;<?echo $rimp[contenido]?>&nbsp;</td>
                      <? if($permiso34 == 1 and $nivel_usua == 1){?><td nowrap="nowrap" class="cajas">&nbsp;<?echo $rimp[valor_cmpi]?>&nbsp;</td><? }?>
                    <td nowrap="nowrap" class="cajas">&nbsp;<?echo format_fecha($rimp[fecha_elaboracion]);?>&nbsp;</td>
                  </tr>
                 <? } //  if ($hasta and $cuantos_buscarimportada) { 
			 	 }// while ($rimp=mysql_fetch_array($result_buscarimpo)) { 
				 ?>
                 <!-- ********************************************************************************************************-->
              </table>
              <? } // Vemos si contiene datos la busqueda ?>
                </td>
          </tr>
  </table> 
  
   
 	<? 
	
	} // fin trazabilidad?>
</form>