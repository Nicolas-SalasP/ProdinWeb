<?
ini_set('memory_limit', '-1');
require "lib/conexion.php";
$link = mysql_connect("$localhost","$user","$pass");
mysql_select_db("$db");
require "lib/funciones.php";



$feceti=substr($fhoyindicada,2,3);

//echo "feceti $feceti<br>";

//echo $myString;  // 'number 1, number 2, number 3'


//echo "id_origen $id_origen - id_operarios $id_operarios - cantidad $cantidad";

$fhoy=date("y");
$fecha_emision=date("Y-m-d H:i:s");
if($id_origen and $id_operarios and $cantidad)
{
$fhoy=date("y");

$sql="select * from etiquetas_unidad where id_origen ='$id_origen' order by fecha_emision desc ";
$result=mysql_query($sql);
$cuantos=mysql_num_rows($result);

if ($cuantos){
$row=mysql_fetch_array($result);
//$hasta= $row[hasta] + 1;
$valor= $row[hasta] + $cantidad;


$sql_nuevo="UPDATE  etiquetas_unidad set id_origen='$id_origen', id_operarios='$id_operarios',hasta='$valor',fecha_emision='$fecha_emision', fhoy='$fhoy' where id_origen=$id_origen";
//$sql_nuevo="insert into etiquetas_unidad  (id_origen,id_operarios,desde,hasta,fecha_emision,fhoy) values ($id_origen,$id_operarios,$hasta,$valor,'$fecha_emision','$fhoy')";
$result_nuevo=mysql_query($sql_nuevo,$link);
}else{
$desde=1;

$valor= $hastanuevo + $cantidad;
$sql_nuevo2="insert into etiquetas_unidad  (id_origen,id_operarios,desde,hasta,fecha_emision,fhoy) values ('$id_origen','$id_operarios','$desde','$valor','$fecha_emision','$fhoy')";
$result_nuevo2=mysql_query($sql_nuevo2,$link);

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
	margin-top: 0px;
}
-->
</style>
<script language="JavaScript" type="text/javascript">
window.print();
</script>
<?
//echo "cuantos $cuantos";
for ($i=0;$i<$cantidad;$i++)
   {
   if($hasta != 1){
   $num=$hasta + $i;
   }else{
   $num=$hastanuevo + $i;
   }
   		//for ($j=1; $j <= 2 ; $j++){
  
?>
	<?
        $sqlo1="SELECT * FROM origenes where id_origen='$id_origen'";
		$resulto1=mysql_query($sqlo1);
		if ($rowo1=mysql_fetch_array($resulto1))
        {
		
    $cod=$rowo1[cod]; 
		$domicilio=$rowo1[domicilio];
		$ciudad =$rowo1[ciudad];
		$pais=$rowo1[pais];		     
    }

    if ($id_origen == 5 or $id_origen == 28 or $id_origen == 29) 
      $cod2 = 'Cerdo';
  
    if ($id_origen == 6 or $id_origen == 4 or $id_origen == 7) 
      $cod2 = 'Vacuno';

    if ($id_origen == 56 or $id_origen == 1000037) 
      $cod2 = 'Equino';

		?>

            <? 
    if($id_origen == 5){ ?>

<table width="393" height="399" border="1" cellpadding="0" cellspacing="0">
  <tr>
    <td width="355" height="23"><div align="center" class="numero"><? echo $cod2 ?> Procesadora Insuban Spa.</div></td>
  </tr>
  <tr>
    <td height="30"><div align="center" class="cajas">
      <p><? echo "$domicilio - $cuidad - $pais";?> ________________________________________________</p>
    </div></td>
  </tr>
  <tr>
    <td height="254"><table width="318" border="0" align="center">
      <tr>
        <td width="312" height="25" class="titulo">Cod. Del Bidon: &nbsp;&nbsp;&nbsp;
    <span class="numero">
  
    
    <? 
  
    echo $cod?>/<? echo $feceti;?>/<? echo $num;?>    </span></td>
      </tr>
      <tr>
        <td height="25" class="titulo">PROCEDENCIA: _____________________________</td>
      </tr>
<!--      <tr>
        <td height="25" class="titulo">PREDIO: __________________________________</td>
      </tr>
      <tr>
        <td height="25" class="titulo">LOTE: _____________________________________</td>
      </tr> -->
      <tr>
        <td height="25" class="titulo">COD. DE PRODUCTO: _________________________</td>
      </tr>
<!--      <tr>
        <td height="25" class="titulo">CALIBRE: __________________________________</td>
      </tr> -->
      <tr>
        <td height="25" class="titulo">CANTIDAD: ________________________________ </td>
      </tr>
      <tr>
        <td height="25" class="titulo">FECHA DE PRODUCCION: ______/_______/______ </td>
      </tr>
      <tr>
        <td height="25" class="titulo">HORA DE CIERRE BIDON: ______ /_______ </td>
      </tr>
    </table></td>
  </tr>
  <tr>
    <td height="85" valign="top" class="cajas">
    <div align="center">
    <? if ($radio == 1){?>
    PLANTA DE ORIGEN: SAG 06-01<BR>
    <? } ?>
    <? if ($radio2 == 11){?>
     MANTENER LA MERCADERIA A MENOS 3&deg; C 
     <? } ?>
    <? if ($radio3 == 13){?>
     MANTENER LA MERCADERIA A Tº AMBIENTE 
     <? } ?>
    </div>
    </td>
  </tr>
</table>

<?}else{?>


        <? 
		if($id_origen == 7){
		for ($j=1; $j <= 2 ; $j++){
		
		?>
<table width="393" height="399" border="1" cellpadding="0" cellspacing="0">
  <tr>
    <td width="355" height="23"><div align="center" class="numero"><? echo $cod2 ?> Procesadora Insuban Spa.</div></td>
  </tr>
  <tr>
    <td height="30"><div align="center" class="cajas">
      <p><? echo "$domicilio - $cuidad - $pais";?> ________________________________________________</p>
    </div></td>
  </tr>
  <tr>
    <td height="254"><table width="318" border="0" align="center">
      <tr>
        <td width="312" height="25" class="titulo">Cod. Del Bidon: &nbsp;&nbsp;&nbsp;
		<span class="numero">
	
		
		<? 
	
		echo $cod?>/<? echo $feceti;?>/<? echo $num;?>		</span></td>
      </tr>
      <tr>
        <td height="25" class="titulo">PROCEDENCIA: _____________________________</td>
      </tr>
      <tr>
        <td height="25" class="titulo">PREDIO: __________________________________</td>
      </tr>
      <tr>
        <td height="25" class="titulo">LOTE: _____________________________________</td>
      </tr>
      <tr>
        <td height="25" class="titulo">COD. DE PRODUCTO: _________________________</td>
      </tr>
      <tr>
        <td height="25" class="titulo">CALIBRE: __________________________________</td>
      </tr>
      <tr>
        <td height="25" class="titulo">CANTIDAD: ________________________________ </td>
      </tr>
      <tr>
        <td height="25" class="titulo">FECHA DE INICIO: ________ /________ /_______ </td>
      </tr>
      <tr>
        <td height="25" class="titulo">FECHA DE TERMINO: ________/________/______ </td>
      </tr>
    </table></td>
  </tr>
  <tr>
    <td height="85" valign="top" class="cajas">
    <div align="center">
    <? if ($radio == 1){?>
    PLANTA DE ORIGEN: SAG 09-02<BR>
    <? } ?>
    <? if ($radio2 == 11){?>
     MANTENER LA MERCADERIA A MENOS 3&deg; C 
     <? } ?>
    <? if ($radio3 == 13){?>
     MANTENER LA MERCADERIA A Tº AMBIENTE 
     <? } ?>
    </div>
    </td>
  </tr>
</table>

<?  }//for
		}else{
	?>		
		<table width="393" height="399" border="1" cellpadding="0" cellspacing="0">
  <tr>
    <td width="355" height="23"><div align="center" class="numero"><? echo $cod2 ?> Procesadora Insuban Spa.</div></td>
  </tr>
  <tr>
    <td height="30"><div align="center" class="cajas">
      <p><? echo "$domicilio - $cuidad - $pais";?> ________________________________________________</p>
    </div></td>
  </tr>
  <tr>
    <td height="254"><table width="318" border="0" align="center">
      <tr>
        <td width="312" height="25" class="titulo">Cod. Del Bidon: &nbsp;&nbsp;&nbsp;
		<span class="numero">
	
		
		<? 
	
		echo $cod?>/<? echo $feceti;?>/<? echo $num;?>		</span></td>
      </tr>
      <tr>
        <td height="25" class="titulo">PROCEDENCIA: _____________________________</td>
      </tr>
      <tr>
        <td height="25" class="titulo">PREDIO: __________________________________</td>
      </tr>
      <tr>
        <td height="25" class="titulo">LOTE: _____________________________________</td>
      </tr>
      <tr>
        <td height="25" class="titulo">COD. DE PRODUCTO: _________________________</td>
      </tr>
      <tr>
        <td height="25" class="titulo">CALIBRE: __________________________________ </td>
      </tr>
      <tr>
        <td height="25" class="titulo">CANTIDAD: ________________________________ </td>
      </tr>
      <tr>
        <td height="25" class="titulo">FECHA DE INICIO: ________ /________ /_______ </td>
      </tr>
      <tr>
        <td height="25" class="titulo">FECHA DE TERMINO: ________/________/______ </td>
      </tr>
    </table></td>
  </tr>
  <tr>
   <td height="85" valign="top" class="cajas">
    <div align="center">
    <? if ($radio == 1){?>
      <? if ($id_origen == 28){?>  
    PLANTA DE ORIGEN: SAG 07-03<BR>
      <?}?>
      <? if ($id_origen == 29){?>  
    PLANTA DE ORIGEN: SAG 06-17<BR>
      <?}?>
    <? if ($id_origen == 6){?>  
    PLANTA DE ORIGEN: SAG 13-11<BR>
      <?}?>
      <? if ($id_origen <> 28 or 29){?>  
    PLANTA DE ORIGEN: SAG <BR>
      <?}?>
    <? } ?>
    <? if ($radio2 == 11){?>
     MANTENER LA MERCADERIA A MENOS 3&deg; C 
     <? } ?>
    <? if ($radio3 == 13){?>
     MANTENER LA MERCADERIA A Tº AMBIENTE 
     <? } ?>
    </div>
    </td>
  </tr>
</table>
<?	
		}}
			
}?>