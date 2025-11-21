<?
   if ($modificar)
     {
       foreach ($_POST as $key => $value)
	     {
		  $dat=split("-",$key);
		  if ($dat[0] == "prod") {
		 //echo "WAA $key es $value<br>";
		  $sql0="select * from producto_alt where  id_producto=$dat[1] and id_destinos=$id_destinos ";
		  $rest0=mysql_query($sql0);
		  $c0=mysql_num_rows($rest0);
		  if ($c0)
		  $sql="update producto_alt set producto_alt='$value' where id_producto=$dat[1] and id_destinos=$id_destinos ";
		  else
		  $sql="insert into producto_alt (id_destinos,id_producto,producto_alt) values ($id_destinos,$dat[1],'$value')";
		  //echo "SQL $sql<br>";
		  $rest=mysql_query($sql);
		    }
		 }
	 }
	
?>
<form id="form1" name="form1" method="post" action="">
  <table border="0" align="center">
	
<? ?>
    
    <tr>
      <td class="titulo">Destino</td>
      <td>
	  <? 
		$destinos=crea_destinos_onchange($link,$id_destinos);
		echo $destinos;
	  ?>	  </td>
    </tr>
    <? if ($id_destinos) { ?>
    <tr>
      <td class="titulo">Producto</td>
      <td>Nombre Alternativo </td>
    </tr>
    <? 
	  $sql="select * from producto";
	  $rest=mysql_query($sql);
	  while ($r1=mysql_fetch_array($rest)) { 
	      $nombre="";
	      $sql2="select * from producto_alt where id_producto=$r1[id_producto] and id_destinos=$id_destinos";
		  //echo "SQL 2 $sql2<br>";
		  $rest2=mysql_query($sql2);
		  $cuantos=mysql_num_rows($rest2);
		  if ($cuantos) {
		    $r2=mysql_fetch_array($rest2);
			$nombre=$r2[producto_alt];
		  }
		
	
	?>
    
	<tr>
      <td class="titulo"><? echo $r1[nombre] ?> </td>
      <td><label><?echo $r1[id_producto]?>
        <input name="prod-<?echo $r1[id_producto]?>" type="text" id="nombre_alt" value="<? echo $nombre?>">
      </label></td>
    </tr>
	<? } ?>
	<tr>
      <td colspan="2" class="titulo"><label>
        <div align="center">
          <input name="modificar" type="submit" id="modificar" value="Modificar Valores">
          </div>
      </label></td>
    </tr>
    <? } ?>

  </table>
</form>