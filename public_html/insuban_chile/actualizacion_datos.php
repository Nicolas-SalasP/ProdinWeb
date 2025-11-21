<?
/*if($ejecutar1){

$sql="SELECT * FROM cruce_producto_empresa where id_cruce_producto_empresa = id_cruce_producto_empresa";
$result=mysql_query($sql);
$cuantos=mysql_num_rows($result);

//$i=1;
while ($row=mysql_fetch_array($result)) { 

$id_cruce_producto_empresa = $row[id_cruce_producto_empresa];
$valor_cmp = $row[valor_cmp];
$id_origen = $row[id_origen];
$id_producto = $row[id_producto];


$sqlup="UPDATE mat_prima_nacional  set id_cruce_producto_empresa='$id_cruce_producto_empresa', valor_cmp = '$valor_cmp' where id_origen  = $id_origen and id_producto=$id_producto";
$resultup=mysql_query($sqlup);

//echo " $sqlup <br>";
//$i++;
}

}//fin del ejecutar

if($ejecutar2){

$sql="SELECT * FROM mat_prima_nacional WHERE ano = 2010 and id_cruce_producto_empresa  != 0 and valor_cmp != 0 LIMIT 20000 , 25000";
$result=mysql_query($sql);
//$cuantos=mysql_num_rows($result);

     // 1 Bodega 
     // 2 Despacho 
      //3 Anulado 
     // 0   
     // 4 Decomiso 

//$i=1;
while ($row=mysql_fetch_array($result)) { 

$id_matsss = $row[id_mat_prima_nacional];
$valor_cmp2 = $row[valor_cmp];
$contenido2 = $row[contenido];
echo " id_matsss $id_matsss <br>";

$sqlup="UPDATE folios_mat set contenido = '$contenido2', valor_cmp = '$valor_cmp2' where id_mat  = $id_matsss";
$resultup=mysql_query($sqlup);

//echo " $sqlup <br>";
//$i++;
}

}//fin del ejecutar

if($ejecutar3){

$sql="SELECT * FROM etiquetados_folios WHERE id_etiquetados_folios = id_etiquetados_folios and id_estado_folio = 2 and id_procedencia = 'N' and ano = 2010";
$result=mysql_query($sql);
$i=0;
while ($row=mysql_fetch_array($result)) { 
$id_etiquet = $row[id_etiquetados_folios];
echo "id_etiquet $id_etiquet<br>";

	$sql2="SELECT SUM( fm.contenido ) AS total_contenido FROM folios_mat AS fm, mat_prima_nacional AS mpn WHERE fm.id_mat = mpn.id_mat_prima_nacional AND mpn.ano = 2010 AND fm.id_etiquetados_folios =$id_etiquet";
	$result2=mysql_query($sql2);
	
	if ($row2=mysql_fetch_array($result2)) { 
         $total_contenido=$row2[total_contenido];
	}

	$sql4="SELECT fm.id_etiquetados_folios AS id_etiquetados_folios, fm.id_mat AS id_mat2, fm.contenido AS contenido, fm.valor_cmp AS valor_cmp FROM folios_mat AS fm, mat_prima_nacional AS mpn WHERE fm.id_mat = mpn.id_mat_prima_nacional AND mpn.ano = 2010 AND fm.id_etiquetados_folios =$id_etiquet ";
	$result4=mysql_query($sql4);

	 while ($row4=mysql_fetch_array($result4)) { 
	 $id_mat2 = $row4[id_mat2];
	 $contenido = $row4[contenido];
	 $valor_cmp = $row4[valor_cmp];
	 $aporte_por_material = $row4[aporte_por_material];
		 

	
	}

	echo "<br>$i - id_etiquetados_folios $id_etiquet<br>";
	$i++;
	}
}//fin del ejecutar

if($ejecutar4){

$sql="SELECT * FROM etiquetados_folios   WHERE  id_etiquetados_folios = 10009683 and id_estado_folio = 2 and ano = 2010";
$result=mysql_query($sql);

while ($row=mysql_fetch_array($result)) { 
	   $id_etiquetados_folios2 = $row[id_etiquetados_folios];
	   $sql2="SELECT * FROM folios_mat   WHERE  id_etiquetados_folios = $id_etiquetados_folios2 ";
	   $result2=mysql_query($sql2);
       
	   while ($row2=mysql_fetch_array($result2)) 
	   { 
	    $ponderado  = $row2[ponderado];
	   }
	    $total_ponderado+=$ponderado;
		
		$sqlup3="UPDATE etiquetados_folios  set total_ponderado   = $total_ponderado  where id_etiquetados_folios  = $id_etiquetados_folios2";
	    $result3=mysql_query($sqlup3);
		
		echo "<br>$sqlup3<br>";
}

}//fin del ejecutar

*/

/*if($ejecutar5){

$sql="SELECT * FROM mat_prima_importada WHERE ano = 2010 ";
$result=mysql_query($sql);
$cuantos=mysql_num_rows($result);

$sql="SELECT * FROM mat_prima_importada WHERE ano = 2010";
$result=mysql_query($sql);


$i=0;
while ($row=mysql_fetch_array($result)) { 
$id_mat_prima_importada = $row[id_mat_prima_importada];
$id=2;
$id_nuevo = $id.$id_mat_prima_importada;

$sqlup="UPDATE mat_prima_importada set id_mat_prima_importada = '$id_nuevo' where id_mat_prima_importada  = $id_mat_prima_importada";
$resultup=mysql_query($sqlup);

echo " $sqlup <br>";
$i++;
}

}//fin del ejecutar*/

/*if(ejecutar7){
	$sql="SELECT * FROM etiquetados_folios WHERE id_estado_folio = 1 ";
	$result=mysql_query($sql);
	$cuantos=mysql_num_rows($result);
	echo "cuantos $cuantos<br>";
	while ($row=mysql_fetch_array($result)) { 
	$id_etiquetados_folios = $row[id_etiquetados_folios];
      $f_termino =format_fecha_sin_hora($row[f_termino]);
	   
	 $dat1ven=split(" ",$f_termino);
 					   $datven=split("-",$dat1ven[0]);
					   $fech_an="$datven[2]";
					   $fech=$fech_an + 1;
					   $fecd=$datven[0];
  					   $fecha_ven="$datven[1]";
				       $f_vencimiento2="$fecd-$fecha_ven-$fech";
	 $dat4=split(" ",$f_vencimiento2);
  $dat6=split("-",$dat4[0]);
  $f_vencimiento23="$dat6[2]-$dat6[1]-$dat6[0]";
  
	 $sqlupn="UPDATE etiquetados_folios set f_vencimiento = '$f_vencimiento23' where id_etiquetados_folios  = $id_etiquetados_folios";
     $resultupn=mysql_query($sqlupn);
	 echo "sqlupn $sqlupn<br>";
	}
}
*/
if($ejecutar6){


$id_in=11010133  ;
$sql="SELECT * FROM folios_mat WHERE id_etiquetados_folios  = $id_in ";
$result=mysql_query($sql);
$cuantos=mysql_num_rows($result);
echo "cuantos $cuantos<br>";

$sqli="SELECT * FROM etiquetados_folios where id_etiquetados_folios ='$id_in'";
$resulti=mysql_query($sqli);
$cuantosi=mysql_num_rows($resulti);

if ($rowi=mysql_fetch_array($resulti)) { 
    $id_cruce_tablas=$rowi[id_cruce_tablas];
	
	$sqlin="SELECT * FROM cruce_tablas where id_cruce_tablas ='$id_cruce_tablas'";
	$resultin=mysql_query($sqlin);
	$cuantosin=mysql_num_rows($resultin);
	
		if ($rowi=mysql_fetch_array($resultin)) { 
   	 	$valor_indice2=$rowi[valor_indice];
		$id_tipo_calculo2=$rowi[id_tipo_calculo];
		}

	}

   //++++++++++++++++++++++++++++++++++++++++++++++++++++++nacional+++++++++++++++++++++++++++++++++++++++
    $sql11="SELECT * FROM folios_mat WHERE id_etiquetados_folios  = $id_in ";
	$result11=mysql_query($sql11);
	$cuantos11=mysql_num_rows($result11);
   
   	while ($row11=mysql_fetch_array($result11)) { 
	$id_mat11 = $row11[id_mat];
  
	$sql2="SELECT * FROM mat_prima_nacional WHERE id_mat_prima_nacional = $id_mat11";
	$result2=mysql_query($sql2);
	
	if ($row2=mysql_fetch_array($result2)) { 
         $contenido=$row2[contenido];
		 $total_contenido+=$contenido;
	}
	}
	 $total_contenido=$total_contenido;
	
	//++++++++++++++++++++++++++++++++++++++++++++++++++++++nacional+++++++++++++++++++++++++++++++++++++++
	 //++++++++++++++++++++++++++++++++++++++++++++++++++++++importado+++++++++++++++++++++++++++++++++++++++	
	$sql22="SELECT * FROM folios_mat WHERE id_etiquetados_folios  = $id_in ";
	$result22=mysql_query($sql22);
	$cuantos22=mysql_num_rows($result22);
   
   	while ($row22=mysql_fetch_array($result22)) { 
	$id_mat22 = $row22[id_mat];
	
	$sql3="SELECT * FROM mat_prima_importada WHERE id_mat_prima_importada = $id_mat22";
	$result3=mysql_query($sql3);
	//echo "sql3 $sql3<br>";
	
	if ($row3=mysql_fetch_array($result3)) { 
         $contenido3=$row3[contenido];
		 $total_contenido3+=$contenido3;
	}
	}
	 $total_contenido3=$total_contenido3;
	
	//++++++++++++++++++++++++++++++++++++++++++++++++++++++importado+++++++++++++++++++++++++++++++++++++++
  
while ($row=mysql_fetch_array($result)) { 
$id_mat = $row[id_mat];
$id_etiquetados_folios = $row[id_etiquetados_folios];

	//++++++++++++++++++++++++++++++++++++++++++++++++++++++nacional+++++++++++++++++++++++++++++++++++++++
	$sql3="SELECT * FROM mat_prima_nacional WHERE id_mat_prima_nacional = $id_mat";
	$result3=mysql_query($sql3);
	
	if ($row3=mysql_fetch_array($result3)) { 
          $contenido=$row3[contenido];
		  $valor_cmp=$row3[valor_cmp];
		 
		  $aporte_por_material = $contenido / $total_contenido;
		  $ponderado =$valor_cmp *  $aporte_por_material;
		
		$sqlupn="UPDATE folios_mat set contenido = '$contenido', valor_cmp = '$valor_cmp', aporte_por_material = '$aporte_por_material', ponderado = '$ponderado'    where id_mat  = $id_mat";
$resultupn=mysql_query($sqlupn);
//echo "sqlupn -> $sqlupn<br>";
	 	$total_ponderado+=$ponderado;
	 
	}//while ($row3=mysql_fetch_array($result3)) { 
	//++++++++++++++++++++++++++++++++++++++++++++++++++++++nacional+++++++++++++++++++++++++++++++++++++++


   
    //++++++++++++++++++++++++++++++++++++++++++++++++++importado+++++++++++++++++++++++++++++++++++++++
	$sql4="SELECT * FROM mat_prima_importada WHERE id_mat_prima_importada = $id_mat";
	$result4=mysql_query($sql4);
	
	if ($row4=mysql_fetch_array($result4)) { 
          $contenido3=$row4[contenido];
		   $valor_cmpi =$row4[valor_cmpi];
		  $aporte_por_material3 = $contenido3 / $total_contenido3;
		  $ponderado3 = $valor_cmpi  * $aporte_por_material3;
		
		$sqlupn="UPDATE folios_mat set contenido = '$contenido3', valor_cmp = '$valor_cmpi', aporte_por_material = '$aporte_por_material3', ponderado = '$ponderado3' where id_mat  = $id_mat";
$resultupn=mysql_query($sqlupn);

	 	$total_ponderado3+=$ponderado3;
	 
	}//while ($row3=mysql_fetch_array($result3)) { 
	//+++++++++++++++++++++++++++++++++++++++++++++++++++importado+++++++++++++++++++++++++++++++++++++++
	
 }
  echo "total_contenido MPN $total_contenido<br><br>";  echo "total_contenido MPI $total_contenido3<br><br>";
  echo "<br>total_ponderado $total_ponderado    ////  total_ponderado3 $total_ponderado3<br><br>";
  $suma_mpni=$total_contenido3 + $total_contenido;

echo "Total suman $suma_mpni<br>";

$res1=$total_contenido / $suma_mpni;
$res2=$total_contenido3 / $suma_mpni;

echo "res1 ($res1)  -  res2 ($res2)<br>";

$ver1=$total_ponderado * $res1;
$ver2=$total_ponderado3 * $res2;

$total_ponderado_mpni=$ver1 + $ver2;
echo "ver1 $ver1  ----  ver2 $ver2<br>";


   if($id_tipo_calculo2 == 3) //multiplocar
   {
	 $resul_valor_unitario = $total_ponderado_mpni * $valor_indice2;
	   
   }
    if($id_tipo_calculo2 == 4) //dividir
   {
	  $resul_valor_unitario = $total_ponderado_mpni / $valor_indice2;
   }


 $fech_generada_inicio = date("Y-m-d H:i:s");
// valor_unitario = '$resul_valor_unitario'
 $sqlup3="UPDATE etiquetados_folios  set total_ponderado   = '$resul_valor_unitario', valor_indice = '$valor_indice2',id_tipo_calculo  = '$id_tipo_calculo2', fech_generada_inicio = '$fech_generada_inicio' where id_etiquetados_folios  = $id_etiquetados_folios";
 $result3=mysql_query($sqlup3);   
 echo "$sqlup3<br>";
	

}//fin del ejecutar


if($ejecutar8){
	
$id_codigo=46;
$sql="SELECT * FROM cruce_tablas WHERE id_cruce_tablas  = $id_codigo";
$result=mysql_query($sql);
$cuantos=mysql_num_rows($result);
echo "cuantos $cuantos<br>";
	
	 
   	if ($row=mysql_fetch_array($result)) 
	{ 
	$mat_prima1 = $row[mat_prima];
	$mano_obra1 = $row[mano_obra];
	$insumos1 = $row[insumos];
	$costounidad1 = $row[costounidad];
	$id_cruce_tablas2 = $row[id_cruce_tablas];
	

	$sqlpn2="update etiquetados_folios set mat_prima = '$mat_prima1', mano_obra = '$mano_obra1', insumos = '$insumos1', costounidad = '$costounidad1' where id_cruce_tablas  = $id_cruce_tablas2 and f_termino between '2011-07-01' and '$2011-07-31'";
$resultupn=mysql_query($sqlpn2);

	
		
	}//while ($row4=mysql_fetch_array($result4)) { 

	}
?>

<form name="form1" method="post" action="">


  <p>Ejecutar cambios
  <input type="submit" name="ejecutar1" id="ejecutar1" value="Ejecutar actualizacion 1">
  <input type="submit" name="ejecutar2" id="ejecutar2" value="Ejecutar actualizacion 2">
  <input type="submit" name="ejecutar3" id="ejecutar3" value="Ejecutar actualizacion 3" />
  <input type="submit" name="ejecutar4" id="ejecutar4" value="Ejecutar actualizacion 4" />
  <input type="submit" name="ejecutar5" id="ejecutar5" value="Ejecutar actualizacion 5" />
  <input type="submit" name="ejecutar6" id="ejecutar6" value="Ejecutar actualizacion 6" />
   <input type="submit" name="ejecutar7" id="ejecutar7" value="Ejecutar actualizacion 7" />
      <input type="submit" name="ejecutar8" id="ejecutar8" value="Ejecutar actualizacion 8" />
  </p>
  <p>&nbsp;</p>
  <p>Ejecutar Nº 1= Actualizada valores de costos asiganados por origen a materia prima</p>
  <p>Ejecutar Nº 2= Actualizada valores de materia prima a trazabilidad</p>
  <p>Ejecutar Nº 3= saca el ponderado dentro de la trazabiliad</p>
  <p>Ejecutar Nº 4= suma el ponderado de la trazabilidad y lo asigna al producto terminado</p>
  <p>Ejecutar Nº 5 = inserta un 2 en el id de materia prima importada</p>
  <p>Ejecutar Nº 6 = actualizacion costos mpni y ponderacion folios (producto terminado)</p>
  <p>Ejecutar Nº 7 = modificar fecha</p>
  <p>Ejecutar Nº 8 = Asigna costos generales a cada producto terminado</p>
<p>&nbsp;</p>
</form>
