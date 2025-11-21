<?

if($id_us){
$sql="SELECT * FROM usuarios where id_usuario='$id_us' order by id_usuario desc";
$result=mysql_query($sql);
$cuantos=mysql_num_rows($result);
}else{
$sql="SELECT * FROM usuarios where id_usuario = id_usuario and id_usuario != 0 order by id_usuario desc";
$result=mysql_query($sql);
$cuantos=mysql_num_rows($result);
if(!$op) $op=0;
$sql="SELECT * FROM usuarios WHERE id_usuario=id_usuario and id_usuario != 0 order by id_usuario desc LIMIT $op , 1";
$result=mysql_query($sql);
$ante=$op - 1;
$next=$op + 1;
$ultimo=$cuantos - 1;
}
if($grabar_x){
  
   $sqlun="select * from usuarios where unombre='$unombre' or  uapellido='$uapellido'";
   $restun=mysql_query($sqlun);
   $cuantos_unombre=mysql_num_rows($restun);
   
   //echo " cuantos_unombre $cuantos_unombre <br>";
   $sqlus="select * from usuarios where username='$username'";
   $restus=mysql_query($sqlus);
   $cuantos_username=mysql_num_rows($restus);
   
   //echo "cuantos_username $cuantos_username <br>";
   
   if(!$cuantos_username){
  $fecha_ingreso=date("Y-m-d");
  
  if(!$id_u_n){ $id_u_n=2; }
  
  $sql_nuevo="insert into usuarios (id_u_n,unombre,uapellido,username,password,firma,fecha_ingreso) values ('$id_u_n','$unombre','$uapellido','$username','$password','$firma','$fecha_ingreso')";
  $result_nuevo=mysql_query($sql_nuevo,$link);
//echo "SQL $sql_nuevo";
  
  echo"<meta http-equiv=\"refresh\" content=\"0;URL=sistema.php?modulo=usuarios.php\">";
  exit;
  } else{
  $mensaje="El Usuario ya existe en nuestra bases de datos";
   
   }
  }
  if($borrar){
  $sql_borrar="delete from usuarios where id_usuario = $borrar";
  $r=mysql_query($sql_borrar,$link);
  if($op == -1)
   { 
   echo"<meta http-equiv=\"refresh\" content=\"0;URL=sistema.php?modulo=usuarios.php&op=0\">";
   exit;
   }
  if($op == 0)
   { 
   echo"<meta http-equiv=\"refresh\" content=\"0;URL=sistema.php?modulo=usuarios.php&op=1\">";
   exit;
   }
  //op para dejar el paginador en 0 si es -1
   //echo "estoy dentro de borrar";
   //header( 'Location: index.php?modulo=calibres.php');
   echo"<meta http-equiv=\"refresh\" content=\"0;URL=sistema.php?modulo=usuarios.php&op=$op\">";
   exit;
  }//fin borrar


if($modificar_x){
 $sql_modificar="UPDATE  usuarios set id_u_n='$id_u_n', unombre='$unombre',uapellido='$uapellido',username='$username', password='$password', firma='$firma', email='$email', op1 = '$op1', op2 = '$op2', op3 = '$op3', op4 = '$op4', op5 = '$op5', op6 = '$op6', op7 = '$op7', op8 = '$op8', op9 = '$op9', op10 = '$op10', op11 = '$op11', op12 = '$op12', op13 = '$op13', op14 = '$op14', op15 = '$op15', op16 = '$op16', op17 = '$op17', op18 = '$op18', op19 = '$op19', op20 = '$op20', op21 = '$op21', op22 = '$op22', op23 = '$op23', op24 = '$op24', op25 = '$op25', op26 = '$op26', op27 = '$op27', op28 = '$op28', op29 = '$op29', op30 = '$op30', op31 = '$op31', op32 = '$op32', op33 = '$op33', op34 = '$op34', op35 = '$op35', op36 = '$op36', op37 = '$op37', op38 = '$op38', op39 = '$op39', op40 = '$op40', op41 = '$op41', op42 = '$op42', op43 = '$op43', op44 = '$op44', op45 = '$op45', op46 = '$op46', op47 = '$op47', op48 = '$op48', op49 = '$op49', op50 = '$op50', op51 = '$op51', op52 = '$op52', op53 = '$op53', op54 = '$op54', op55 = '$op55', op56 = '$op56', op57 = '$op57' where id_usuario=$id_usuario";
 $rest=mysql_query($sql_modificar);
 
 //echo "modificar $sql_modificar";
 
 if($id_us){
 echo"<meta http-equiv=\"refresh\" content=\"0;URL=sistema.php?modulo=usuarios.php&id_us=$id_us\">";
 exit;
 }else{
 echo"<meta http-equiv=\"refresh\" content=\"0;URL=sistema.php?modulo=usuarios.php&op=$op\">";
 exit;
 }
 
}

if($modificarlistar || $eliminar){
foreach ($_POST as $key => $value)
{
 $dat=split("-",$key);
 if ($dat[0] == 'etiquetas')
	{
    $id=$dat[1];
    $etiquetas=$_POST["etiquetas-$id"];
	$descripcion=$_POST["descripcion-$id"];
    $sql_mod="UPDATE etiquetas SET  etiquetas='$etiquetas', descripcion='$descripcion' where id_etiquetas = $id";
	$rest=mysql_query($sql_mod);
	}
}
if ($elim)
	    {
 		foreach ( $elim as $key => $value)
     	{
	 	$sql_elim="delete from etiquetas where id_etiquetas = $value";
	 	$r=mysql_query($sql_elim);
	 	} 
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
.style2 {font-family: Verdana, Arial, Helvetica, sans-serif; font-size: 14; font-weight: bold; }
-->
</style>


<form id="form1" name="form1" method="post" action="">
<table width="600" border="0" align="center">
  <tr>
    <td width="773" height="14" bgcolor="#CCCCCC" class="titulo">Permisos de Usuarios  </td>
    <td width="32" bgcolor="#CCCCCC" class="cajas"><div align="center"><a href="?modulo=usuarios_listar.php">Volver</a></div></td>
  </tr>
  <tr>
    <td colspan="2"><? if(!$nuevo){?>
      <?
	   if($listar){
	  $sql="SELECT * FROM usuarios";
	  $result=mysql_query($sql);
	  $cuantos=mysql_num_rows($result);
	  }
	  $i=$op;
      while ($row=mysql_fetch_array($result))
      { 
	  $id_usuario=$row[id_usuario];
      $i++;
	  
	
	      ?>
      <span class="titulo1">
      <input name="id_usuario" type="hidden" value="<?echo $row[id_usuario]?>" />
      </span>
      <table width="600" height="250" border="1" align="center" bordercolor="#CCCCCC">
        <tr>
          <td><table width="433" border="0" align="center">
            <tr>
              <td width="123" class="titulo" >Nombre</td>
              <td><input name="unombre" type="text" class="cajas" id="unombre" value="<?echo $row[unombre]?>" size="50" maxlength="30" /></td>
              </tr>
            <tr>
              <td width="123" class="titulo" >Apellido</td>
              <td><input name="uapellido" type="text" class="cajas" id="uapellido" value="<?echo $row[uapellido]?>" size="50" maxlength="30" /></td>
            </tr>
            <tr>
              <td width="123" class="titulo" >Usuario</td>
              <td><input name="username" type="text" class="cajas" id="username" value="<?echo $row[username]?>" size="50" maxlength="20" /></td>
            </tr>
            <tr>
              <td class="titulo"  >Clave</td>
              <td><input name="password" type="password" class="cajas" id="password" value="<?echo $row[password]?>" size="50" maxlength="20" /></td>
              </tr>
            <tr>
              <td class="titulo"  >Nivel de Usuario </td>
              <td><? 
			
			$nivel_usuario= crea_nivel_usuario($link,$row[id_u_n]);
			echo $nivel_usuario;
			?></td>
            </tr>
            <tr>
              <td class="titulo"  >E-mail</td>
              <td><input name="email" type="text" class="cajas" id="email" value="<?echo $row[email]?>" size="50" maxlength="100" /></td>
            </tr>
            <tr>
              <td class="titulo"  >Firma Certificaci&oacute;n </td>
              <td><?
			  if ($row[firma]){
				 $cheq="checked";
			  ?>
                <input type="checkbox" name="firma" value="1" checked="<? echo $cheq?>"/>
                <?
				 }else{
			 	
			  ?>
                <input type="checkbox" name="firma" value="1" />
                <?
			  }
			 ?>
                <? if($mensaje) echo $mensaje?></td>
            </tr>
            <tr>
              <td>&nbsp;</td>
              <td>&nbsp;</td>
            </tr>
            <tr>
              <td colspan="2"><table width="793" border="0" align="center" cellpadding="0" cellspacing="0">

                <tr>
                  <td width="24" nowrap="nowrap" class="titulo"><div align="center">M</div></td>
                  <td width="20" nowrap="nowrap" class="titulo"><div align="center">L</div></td>
                  <td width="20" nowrap="nowrap" class="titulo"><div align="center">A</div></td>
                  <td width="126" nowrap="nowrap" class="titulo">Tablas</td>
                  <td width="24" nowrap="nowrap" class="titulo"><div align="center">M</div></td>
                  <td width="12" nowrap="nowrap" class="titulo"><div align="center">L</div></td>
                  <td width="12" nowrap="nowrap" class="titulo">A</td>
                  <td width="181" nowrap="nowrap" class="titulo">Asignacion</td>
                  <td width="24" nowrap="nowrap" class="titulo"><div align="center">M</div></td>
                  <td width="12" nowrap="nowrap" class="titulo"><div align="center">L</div></td>
                  <td width="12" nowrap="nowrap" class="titulo">A</td>
                  <td width="161" nowrap="nowrap" class="titulo">Movimientos</td>
                  <td width="20" nowrap="nowrap" class="titulo"><div align="center">M</div></td>
                  <td width="10" nowrap="nowrap" class="titulo"><div align="center">L</div></td>
                  <td width="10" nowrap="nowrap" class="titulo">A</td>
                  <td width="125" nowrap="nowrap" class="titulo">Informes</td>
                </tr>
                <tr>
                  <td nowrap="nowrap" class="cajas"><div align="center">
                    <input name="op1" type="radio" value="1" <? if ($row[op1] == 1) echo "checked";?>> 
                  </div></td>
                  <td nowrap="nowrap" class="cajas"><div align="center">
                    <input name="op1" type="radio" value="2" <? if ($row[op1] == 2) echo "checked";?>>
                  </div></td>
                  <td nowrap="nowrap" class="cajas"><div align="center">
                    <input name="op1" type="radio" value="3" <? if ($row[op1] == 3) echo "checked";?> />
                  </div></td>
                  <td nowrap="nowrap" class="cajas">&nbsp;Especie</td>
                  <td nowrap="nowrap" class="cajas"><input name="op18" type="radio" value="1" <? if ($row[op18] == 1) echo "checked";?>></td>
                  <td nowrap="nowrap" class="cajas"><input name="op18" type="radio" value="2" <? if ($row[op18] == 2) echo "checked";?>></td>
                  <td nowrap="nowrap" class="cajas"><input name="op18" type="radio" value="3" <? if ($row[op18] == 3) echo "checked";?> /></td>
                  <td nowrap="nowrap" class="cajas">&nbsp;Asignaci&oacute;n Especie Producto </td>
                  <td nowrap="nowrap" class="cajas"><input name="op26" type="radio" value="1" <? if ($row[op26] == 1) echo "checked";?>></td>
                  <td nowrap="nowrap" class="cajas"><input name="op26" type="radio" value="2" <? if ($row[op26] == 2) echo "checked";?>></td>
                  <td nowrap="nowrap" class="cajas"><input name="op26" type="radio" value="3" <? if ($row[op26] == 3) echo "checked";?> /></td>
                  <td nowrap="nowrap" class="cajas">&nbsp;Emisi&oacute;n Fajas </td>
                  <td nowrap="nowrap" class="cajas"><input name="op39" type="radio" value="1" <? if ($row[op39] == 1) echo "checked";?>></td>
                  <td nowrap="nowrap" class="cajas"><input name="op39" type="radio" value="2" <? if ($row[op39] == 2) echo "checked";?>></td>
                  <td nowrap="nowrap" class="cajas"><input name="op39" type="radio" value="3" <? if ($row[op39] == 3) echo "checked";?> /></td>
                  <td nowrap="nowrap" class="cajas">&nbsp;Informes Folios </td>
                </tr>
                <tr>
                  <td nowrap="nowrap" class="cajas"><input name="op2" type="radio" value="1" <? if ($row[op2] == 1) echo "checked";?>></td>
                  <td nowrap="nowrap" class="cajas"><input name="op2" type="radio" value="2" <? if ($row[op2] == 2) echo "checked";?>></td>
                  <td nowrap="nowrap" class="cajas"><input name="op2" type="radio" value="3" <? if ($row[op2] == 3) echo "checked";?> /></td>
                  <td nowrap="nowrap" class="cajas">&nbsp;Productos</td>
                  <td nowrap="nowrap" class="cajas"><input name="op19" type="radio" value="1" <? if ($row[op19] == 1) echo "checked";?> /></td>
                  <td nowrap="nowrap" class="cajas"><input name="op19" type="radio" value="2" <? if ($row[op19] == 2) echo "checked";?>></td>
                  <td nowrap="nowrap" class="cajas"><input name="op19" type="radio" value="3" <? if ($row[op19] == 3) echo "checked";?> /></td>
                  <td nowrap="nowrap" class="cajas">&nbsp;Asignaci&oacute;n Unidades Medidas </td>
                  <td nowrap="nowrap" class="cajas"><input name="op27" type="radio" value="1" <? if ($row[op27] == 1) echo "checked";?>></td>
                  <td nowrap="nowrap" class="cajas"><input name="op27" type="radio" value="2" <? if ($row[op27] == 2) echo "checked";?>></td>
                  <td nowrap="nowrap" class="cajas"><input name="op27" type="radio" value="3" <? if ($row[op27] == 3) echo "checked";?> /></td>
                  <td nowrap="nowrap" class="cajas">&nbsp;Pallets con Fajas </td>
                  <td nowrap="nowrap" class="cajas"><input name="op40" type="radio" value="1" <? if ($row[op40] == 1) echo "checked";?>></td>
                  <td nowrap="nowrap" class="cajas"><input name="op40" type="radio" value="2" <? if ($row[op40] == 2) echo "checked";?>></td>
                  <td nowrap="nowrap" class="cajas"><input name="op40" type="radio" value="3" <? if ($row[op40] == 3) echo "checked";?> /></td>
                  <td nowrap="nowrap" class="cajas">&nbsp;Informe Pallets/Fajas </td>
                </tr>
                <tr>
                  <td nowrap="nowrap" class="cajas"><input name="op3" type="radio" value="1" <? if ($row[op3] == 1) echo "checked";?>></td>
                  <td nowrap="nowrap" class="cajas"><input name="op3" type="radio" value="2" <? if ($row[op3] == 2) echo "checked";?>></td>
                  <td nowrap="nowrap" class="cajas"><input name="op3" type="radio" value="3" <? if ($row[op3] == 3) echo "checked";?> /></td>
                  <td nowrap="nowrap" class="cajas">&nbsp;Unidades de Medida </td>
                  <td nowrap="nowrap" class="cajas"><input name="op20" type="radio" value="1" <? if ($row[op20] == 1) echo "checked";?>></td>
                  <td nowrap="nowrap" class="cajas"><input name="op20" type="radio" value="2" <? if ($row[op20] == 2) echo "checked";?>></td>
                  <td nowrap="nowrap" class="cajas"><input name="op20" type="radio" value="3" <? if ($row[op20] == 3) echo "checked";?> /></td>
                  <td nowrap="nowrap" class="cajas">&nbsp;Asignar Medidas </td>
                  <td nowrap="nowrap" class="cajas"><input name="op28" type="radio" value="1" <? if ($row[op28] == 1) echo "checked";?>></td>
                  <td nowrap="nowrap" class="cajas"><input name="op28" type="radio" value="2" <? if ($row[op28] == 2) echo "checked";?>></td>
                  <td nowrap="nowrap" class="cajas"><input name="op28" type="radio" value="3" <? if ($row[op28] == 3) echo "checked";?> /></td>
                  <td nowrap="nowrap" class="cajas">&nbsp;Bodegas (Stok)</td>
                  <td nowrap="nowrap" class="cajas"><input name="op41" type="radio" value="1" <? if ($row[op41] == 1) echo "checked";?>></td>
                  <td nowrap="nowrap" class="cajas"><input name="op41" type="radio" value="2" <? if ($row[op41] == 2) echo "checked";?>></td>
                  <td nowrap="nowrap" class="cajas"><input name="op41" type="radio" value="3" <? if ($row[op41] == 3) echo "checked";?> /></td>
                  <td nowrap="nowrap" class="cajas">&nbsp;Informe Materia Prima </td>
                </tr>
                <tr>
                  <td nowrap="nowrap" class="cajas"><input name="op4" type="radio" value="1" <? if ($row[op4] == 1) echo "checked";?>></td>
                  <td nowrap="nowrap" class="cajas"><input name="op4" type="radio" value="2" <? if ($row[op4] == 2) echo "checked";?>></td>
                  <td nowrap="nowrap" class="cajas"><input name="op4" type="radio" value="3" <? if ($row[op4] == 3) echo "checked";?> /></td>
                  <td nowrap="nowrap" class="cajas">&nbsp;Medidas</td>
                  <td nowrap="nowrap" class="cajas"><input name="op21" type="radio" value="1" <? if ($row[op21] == 1) echo "checked";?>></td>
                  <td nowrap="nowrap" class="cajas"><input name="op21" type="radio" value="2" <? if ($row[op21] == 2) echo "checked";?>></td>
                  <td nowrap="nowrap" class="cajas"><input name="op21" type="radio" value="3" <? if ($row[op21] == 3) echo "checked";?> /></td>
                  <td nowrap="nowrap" class="cajas">&nbsp;Asignar Calibres </td>
                  <td nowrap="nowrap" class="cajas"><input name="op29" type="radio" value="1" <? if ($row[op29] == 1) echo "checked";?>></td>
                  <td nowrap="nowrap" class="cajas"><input name="op29" type="radio" value="2" <? if ($row[op29] == 2) echo "checked";?>></td>
                  <td nowrap="nowrap" class="cajas"><input name="op29" type="radio" value="3" <? if ($row[op29] == 3) echo "checked";?> /></td>
                  <td nowrap="nowrap" class="cajas">&nbsp;Pallets Packing List </td>
                  <td nowrap="nowrap" class="cajas"><input name="op42" type="radio" value="1" <? if ($row[op42] == 1) echo "checked";?>></td>
                  <td nowrap="nowrap" class="cajas"><input name="op42" type="radio" value="2" <? if ($row[op42] == 2) echo "checked";?>></td>
                  <td nowrap="nowrap" class="cajas"><input name="op42" type="radio" value="3" <? if ($row[op42] == 3) echo "checked";?> /></td>
                  <td nowrap="nowrap" class="cajas">&nbsp;Fajas C/Etiquetas</td>
                </tr>
                <tr>
                  <td nowrap="nowrap" class="cajas"><input name="op5" type="radio" value="1" <? if ($row[op5] == 1) echo "checked";?>></td>
                  <td nowrap="nowrap" class="cajas"><input name="op5" type="radio" value="2" <? if ($row[op5] == 2) echo "checked";?>></td>
                  <td nowrap="nowrap" class="cajas"><input name="op5" type="radio" value="3" <? if ($row[op3] == 3) echo "checked";?> /></td>
                  <td nowrap="nowrap" class="cajas">&nbsp;Calibres</td>
                  <td nowrap="nowrap" class="cajas"><input name="op22" type="radio" value="1" <? if ($row[op22] == 1) echo "checked";?>></td>
                  <td nowrap="nowrap" class="cajas"><input name="op22" type="radio" value="2" <? if ($row[op22] == 2) echo "checked";?>></td>
                  <td nowrap="nowrap" class="cajas"><input name="op22" type="radio" value="3" <? if ($row[op22] == 3) echo "checked";?> /></td>
                  <td nowrap="nowrap" class="cajas">&nbsp;Asignar Caract. Producto </td>
                  <td nowrap="nowrap" class="cajas"><input name="op30" type="radio" value="1" <? if ($row[op30] == 1) echo "checked";?>></td>
                  <td nowrap="nowrap" class="cajas"><input name="op30" type="radio" value="2" <? if ($row[op30] == 2) echo "checked";?>></td>
                  <td nowrap="nowrap" class="cajas"><input name="op30" type="radio" value="3" <? if ($row[op30] == 3) echo "checked";?> /></td>
                  <td nowrap="nowrap" class="cajas">&nbsp;Materia Prima Nac.</td>
                  <td nowrap="nowrap" class="cajas"><input name="op43" type="radio" value="1" <? if ($row[op43] == 1) echo "checked";?>></td>
                  <td nowrap="nowrap" class="cajas"><input name="op43" type="radio" value="2" <? if ($row[op43] == 2) echo "checked";?>></td>
                  <td nowrap="nowrap" class="cajas"><input name="op43" type="radio" value="3" <? if ($row[op43] == 3) echo "checked";?> /></td>
                  <td nowrap="nowrap" class="cajas">&nbsp;Trazab. Folios </td>
                </tr>
                <tr>
                  <td nowrap="nowrap" class="cajas"><input name="op6" type="radio" value="1" <? if ($row[op6] == 1) echo "checked";?>></td>
                  <td nowrap="nowrap" class="cajas"><input name="op6" type="radio" value="2" <? if ($row[op6] == 2) echo "checked";?>></td>
                  <td nowrap="nowrap" class="cajas"><input name="op6" type="radio" value="3" <? if ($row[op6] == 3) echo "checked";?> /></td>
                  <td nowrap="nowrap" class="cajas">&nbsp;Caract. Producto</td>
                  <td nowrap="nowrap" class="cajas"><input name="op23" type="radio" value="1" <? if ($row[op23] == 1) echo "checked";?>></td>
                  <td nowrap="nowrap" class="cajas"><input name="op23" type="radio" value="2" <? if ($row[op23] == 2) echo "checked";?>></td>
                  <td nowrap="nowrap" class="cajas"><input name="op23" type="radio" value="3" <? if ($row[op23] == 3) echo "checked";?> /></td>
                  <td nowrap="nowrap" class="cajas">&nbsp;Asignar Caract. Envase</td>
                  <td nowrap="nowrap" class="cajas"><input name="op31" type="radio" value="1" <? if ($row[op31] == 1) echo "checked";?>></td>
                  <td nowrap="nowrap" class="cajas"><input name="op31" type="radio" value="2" <? if ($row[op31] == 2) echo "checked";?>></td>
                  <td nowrap="nowrap" class="cajas"><input name="op31" type="radio" value="3" <? if ($row[op31] == 3) echo "checked";?> /></td>
                  <td nowrap="nowrap" class="cajas">&nbsp;Salida MPN</td>
                  <td nowrap="nowrap" class="cajas"><input name="op44" type="radio" value="1" <? if ($row[op44] == 1) echo "checked";?>></td>
                  <td nowrap="nowrap" class="cajas"><input name="op44" type="radio" value="2" <? if ($row[op44] == 2) echo "checked";?>></td>
                  <td nowrap="nowrap" class="cajas"><input name="op44" type="radio" value="3" <? if ($row[op44] == 3) echo "checked";?> /></td>
                  <td nowrap="nowrap" class="cajas">&nbsp;Trazab. Mat. Prima </td>
                </tr>
                <tr>
                  <td nowrap="nowrap" class="cajas"><input name="op7" type="radio" value="1" <? if ($row[op7] == 1) echo "checked";?>></td>
                  <td nowrap="nowrap" class="cajas"><input name="op7" type="radio" value="2" <? if ($row[op7] == 2) echo "checked";?>></td>
                  <td nowrap="nowrap" class="cajas"><input name="op7" type="radio" value="3" <? if ($row[op7] == 3) echo "checked";?> /></td>
                  <td nowrap="nowrap" class="cajas">&nbsp;Caract. Envase </td>
                  <td nowrap="nowrap" class="cajas"><input name="op24" type="radio" value="1" <? if ($row[op24] == 1) echo "checked";?>></td>
                  <td nowrap="nowrap" class="cajas"><input name="op24" type="radio" value="2" <? if ($row[op24] == 2) echo "checked";?>></td>
                  <td nowrap="nowrap" class="cajas"><input name="op24" type="radio" value="3" <? if ($row[op24] == 3) echo "checked";?> /></td>
                  <td nowrap="nowrap" class="cajas">&nbsp;Crear Producto </td>
                  <td nowrap="nowrap" class="cajas"><input name="op32" type="radio" value="1" <? if ($row[op32] == 1) echo "checked";?>></td>
                  <td nowrap="nowrap" class="cajas"><input name="op32" type="radio" value="2" <? if ($row[op32] == 2) echo "checked";?>></td>
                  <td nowrap="nowrap" class="cajas"><input name="op32" type="radio" value="3" <? if ($row[op32] == 3) echo "checked";?> /></td>
                  <td nowrap="nowrap" class="cajas">&nbsp;Materia Prima Imp. </td>
                  <td nowrap="nowrap" class="cajas"><input name="op45" type="radio" value="1" <? if ($row[op45] == 1) echo "checked";?>></td>
                  <td nowrap="nowrap" class="cajas"><input name="op45" type="radio" value="2" <? if ($row[op45] == 2) echo "checked";?>></td>
                  <td nowrap="nowrap" class="cajas"><input name="op45" type="radio" value="3" <? if ($row[op45] == 3) echo "checked";?> /></td>
                  <td nowrap="nowrap" class="cajas">&nbsp;Etiquetas P/Material</td>
                </tr>
                <tr>
                  <td nowrap="nowrap" class="cajas"><input name="op8" type="radio" value="1" <? if ($row[op8] == 1) echo "checked";?>></td>
                  <td nowrap="nowrap" class="cajas"><input name="op8" type="radio" value="2" <? if ($row[op8] == 2) echo "checked";?>></td>
                  <td nowrap="nowrap" class="cajas"><input name="op8" type="radio" value="3" <? if ($row[op8] == 3) echo "checked";?> /></td>
                  <td nowrap="nowrap" class="cajas">&nbsp;Operarios</td>
                  <td nowrap="nowrap" class="cajas"><input name="op25" type="radio" value="1" <? if ($row[op25] == 1) echo "checked";?>></td>
                  <td nowrap="nowrap" class="cajas"><input name="op25" type="radio" value="2" <? if ($row[op25] == 2) echo "checked";?>></td>
                  <td nowrap="nowrap" class="cajas"><input name="op25" type="radio" value="3" <? if ($row[op25] == 3) echo "checked";?> /></td>
                  <td nowrap="nowrap" class="cajas">&nbsp;Mod. / Elim. Producto T.</td>
                  <td nowrap="nowrap" class="cajas"><input name="op33" type="radio" value="1" <? if ($row[op33] == 1) echo "checked";?>></td>
                  <td nowrap="nowrap" class="cajas"><input name="op33" type="radio" value="2" <? if ($row[op33] == 2) echo "checked";?>></td>
                  <td nowrap="nowrap" class="cajas"><input name="op33" type="radio" value="3" <? if ($row[op33] == 3) echo "checked";?> /></td>
                  <td nowrap="nowrap" class="cajas">&nbsp;Salida MPI </td>
                  <td nowrap="nowrap" class="cajas"><input name="op46" type="radio" value="1" <? if ($row[op46] == 1) echo "checked";?>></td>
                  <td nowrap="nowrap" class="cajas"><input name="op46" type="radio" value="2" <? if ($row[op46] == 2) echo "checked";?>></td>
                  <td nowrap="nowrap" class="cajas"><input name="op46" type="radio" value="3" <? if ($row[op46] == 3) echo "checked";?> /></td>
                  <td nowrap="nowrap" class="cajas">&nbsp;Etiquetas P/Unidad Prod.</td>
                </tr>
                <tr>
                  <td height="22" nowrap="nowrap" class="cajas"><input name="op9" type="radio" value="1" <? if ($row[op9] == 1) echo "checked";?>></td>
                  <td nowrap="nowrap" class="cajas"><input name="op9" type="radio" value="2" <? if ($row[op9] == 2) echo "checked";?>></td>
                  <td nowrap="nowrap" class="cajas"><input name="op9" type="radio" value="3" <? if ($row[op9] == 3) echo "checked";?> /></td>
                  <td nowrap="nowrap" class="cajas">&nbsp;Funciones Operarios </td>
                  <td nowrap="nowrap" class="cajas"><input name="op49" type="radio" value="1" <? if ($row[op49] == 1) echo "checked";?>></td>
                  <td nowrap="nowrap" class="cajas"><input name="op49" type="radio" value="2" <? if ($row[op49] == 2) echo "checked";?>></td>
                  <td nowrap="nowrap" class="cajas"><input name="op49" type="radio" value="3" <? if ($row[op49] == 3) echo "checked";?>></td>
                  <td nowrap="nowrap" class="cajas">&nbsp;Listar Producto Terminado</td>
                  <td nowrap="nowrap" class="cajas"><input name="op34" type="radio" value="1" <? if ($row[op34] == 1) echo "checked";?>></td>
                  <td nowrap="nowrap" class="cajas"><input name="op34" type="radio" value="2" <? if ($row[op34] == 2) echo "checked";?>></td>
                  <td nowrap="nowrap" class="cajas"><input name="op34" type="radio" value="3" <? if ($row[op34] == 3) echo "checked";?> /></td>
                  <td nowrap="nowrap" class="cajas">&nbsp;Etiquetas por Folios</td>
                  <td nowrap="nowrap" class="cajas">&nbsp;</td>
                  <td nowrap="nowrap" class="cajas">&nbsp;</td>
                  <td nowrap="nowrap" class="cajas">&nbsp;</td>
                  <td nowrap="nowrap" class="cajas">&nbsp;</td>
                </tr>
                <tr>
                  <td nowrap="nowrap" class="cajas"><input name="op10" type="radio" value="1" <? if ($row[op10] == 1) echo "checked";?>></td>
                  <td nowrap="nowrap" class="cajas"><input name="op10" type="radio" value="2" <? if ($row[op10] == 2) echo "checked";?>></td>
                  <td nowrap="nowrap" class="cajas"><input name="op10" type="radio" value="3" <? if ($row[op10] == 3) echo "checked";?> /></td>
                  <td nowrap="nowrap" class="cajas">&nbsp;Unidad de Prod. </td>
                  <td nowrap="nowrap" class="cajas"><input name="op50" type="radio" value="1" <? if ($row[op50] == 1) echo "checked";?>></td>
                  <td nowrap="nowrap" class="cajas"><input name="op50" type="radio" value="2" <? if ($row[op50] == 2) echo "checked";?>></td>
                  <td nowrap="nowrap" class="cajas"><input name="op50" type="radio" value="3" <? if ($row[op50] == 3) echo "checked";?>></td>
                  <td nowrap="nowrap" class="cajas">&nbsp;Asignar Indice Producto T.</td>
                  <td nowrap="nowrap" class="cajas"><input name="op35" type="radio" value="1" <? if ($row[op35] == 1) echo "checked";?>></td>
                  <td nowrap="nowrap" class="cajas"><input name="op35" type="radio" value="2" <? if ($row[op35] == 2) echo "checked";?>></td>
                  <td nowrap="nowrap" class="cajas"><input name="op35" type="radio" value="3" <? if ($row[op35] == 3) echo "checked";?> /></td>
                  <td nowrap="nowrap" class="cajas">&nbsp;Movimientos Folios</td>
                  <td nowrap="nowrap" class="cajas">&nbsp;</td>
                  <td nowrap="nowrap" class="cajas">&nbsp;</td>
                  <td nowrap="nowrap" class="cajas">&nbsp;</td>
                  <td nowrap="nowrap" class="cajas">&nbsp;</td>
                </tr>
                <tr>
                  <td nowrap="nowrap" class="cajas"><input name="op11" type="radio" value="1" <? if ($row[op11] == 1) echo "checked";?> /></td>
                  <td nowrap="nowrap" class="cajas"><input name="op11" type="radio" value="2" <? if ($row[op11] == 2) echo "checked";?> /></td>
                  <td nowrap="nowrap" class="cajas"><input name="op11" type="radio" value="3" <? if ($row[op11] == 3) echo "checked";?> /></td>
                  <td nowrap="nowrap" class="cajas">&nbsp;Envases</td>
                  <td nowrap="nowrap" class="cajas"><input name="op51" type="radio" value="1" <? if ($row[op51] == 1) echo "checked";?> /></td>
                  <td nowrap="nowrap" class="cajas"><input name="op51" type="radio" value="2" <? if ($row[op51] == 2) echo "checked";?> /></td>
                  <td nowrap="nowrap" class="cajas"><input name="op51" type="radio" value="3" <? if ($row[op51] == 3) echo "checked";?> /></td>
                  <td nowrap="nowrap" class="cajas">&nbsp;Asignar MPN / Empresa</td>
                  <td nowrap="nowrap" class="cajas"><input name="op48" type="radio" value="1" <? if ($row[op48] == 1) echo "checked";?> /></td>
                  <td nowrap="nowrap" class="cajas"><input name="op48" type="radio" value="2" <? if ($row[op48] == 2) echo "checked";?> /></td>
                  <td nowrap="nowrap" class="cajas"><input name="op48" type="radio" value="3" <? if ($row[op48] == 3) echo "checked";?> /></td>
                  <td nowrap="nowrap" class="cajas">&nbsp;Bodega Traspaso MPI</td>
                  <td nowrap="nowrap" class="cajas">&nbsp;</td>
                  <td nowrap="nowrap" class="cajas">&nbsp;</td>
                  <td nowrap="nowrap" class="cajas">&nbsp;</td>
                  <td nowrap="nowrap" class="cajas">&nbsp;</td>
                </tr>
                <tr>
                  <td nowrap="nowrap" class="cajas"><input name="op12" type="radio" value="1" <? if ($row[op12] == 1) echo "checked";?> /></td>
                  <td nowrap="nowrap" class="cajas"><input name="op12" type="radio" value="2" <? if ($row[op12] == 2) echo "checked";?> /></td>
                  <td nowrap="nowrap" class="cajas"><input name="op12" type="radio" value="3" <? if ($row[op12] == 3) echo "checked";?> /></td>
                  <td nowrap="nowrap" class="cajas">&nbsp;Destinos</td>
                  <td nowrap="nowrap" class="cajas"><input name="op52" type="radio" value="1" <? if ($row[op52] == 1) echo "checked";?> /></td>
                  <td nowrap="nowrap" class="cajas"><input name="op52" type="radio" value="2" <? if ($row[op52] == 2) echo "checked";?> /></td>
                  <td nowrap="nowrap" class="cajas"><input name="op52" type="radio" value="3" <? if ($row[op52] == 3) echo "checked";?> /></td>
                  <td nowrap="nowrap" class="cajas">&nbsp;Asignar Costo MPN</td>
                  <td nowrap="nowrap" class="cajas"><input name="op56" type="radio" value="1" <? if ($row[op56] == 1) echo "checked";?> /></td>
                  <td nowrap="nowrap" class="cajas"><input name="op56" type="radio" value="2" <? if ($row[op56] == 2) echo "checked";?> /></td>
                  <td nowrap="nowrap" class="cajas"><input name="op56" type="radio" value="3" <? if ($row[op56] == 3) echo "checked";?> /></td>
                  <td nowrap="nowrap" class="cajas">&nbsp;Generar Pallet PT</td>
                  <td nowrap="nowrap" class="cajas">&nbsp;</td>
                  <td nowrap="nowrap" class="cajas">&nbsp;</td>
                  <td nowrap="nowrap" class="cajas">&nbsp;</td>
                  <td nowrap="nowrap" class="cajas">&nbsp;</td>
                </tr>
                <tr>
                  <td nowrap="nowrap" class="cajas"><input name="op13" type="radio" value="1" <? if ($row[op13] == 1) echo "checked";?> /></td>
                  <td nowrap="nowrap" class="cajas"><input name="op13" type="radio" value="2" <? if ($row[op13] == 2) echo "checked";?> /></td>
                  <td nowrap="nowrap" class="cajas"><input name="op13" type="radio" value="3" <? if ($row[op13] == 3) echo "checked";?> /></td>
                  <td nowrap="nowrap" class="cajas">&nbsp;Origenes</td>

                  <td nowrap="nowrap" class="cajas"><input name="op53" type="radio" value="1" <? if ($row[op53] == 1) echo "checked";?> /></td>
                  <td nowrap="nowrap" class="cajas"><input name="op53" type="radio" value="2" <? if ($row[op53] == 2) echo "checked";?> /></td>
                  <td nowrap="nowrap" class="cajas"><input name="op53" type="radio" value="3" <? if ($row[op53] == 3) echo "checked";?> /></td>
                  <td nowrap="nowrap" class="cajas">&nbsp;Asignar Costo Prod. Imp.</td>
                  <td nowrap="nowrap" class="cajas"><input name="op36" type="radio" value="1" <? if ($row[op36] == 1) echo "checked";?>></td>
                  <td nowrap="nowrap" class="cajas"><input name="op36" type="radio" value="2" <? if ($row[op36] == 2) echo "checked";?>></td>
                  <td nowrap="nowrap" class="cajas"><input name="op36" type="radio" value="3" <? if ($row[op36] == 3) echo "checked";?> /></td>
                  <td nowrap="nowrap" class="cajas">&nbsp;Capturas de Folios</td>
                  <td nowrap="nowrap" class="cajas">&nbsp;</td>
                  <td nowrap="nowrap" class="cajas">&nbsp;</td>
                  <td nowrap="nowrap" class="cajas">&nbsp;</td>
                  <td nowrap="nowrap" class="cajas">&nbsp;</td>
                </tr>
                <tr>
                  <td nowrap="nowrap" class="cajas"><input name="op14" type="radio" value="1" <? if ($row[op14] == 1) echo "checked";?> /></td>
                  <td nowrap="nowrap" class="cajas"><input name="op14" type="radio" value="2" <? if ($row[op14] == 2) echo "checked";?> /></td>
                  <td nowrap="nowrap" class="cajas"><input name="op14" type="radio" value="3" <? if ($row[op14] == 3) echo "checked";?> /></td>
                  <td nowrap="nowrap" class="cajas">&nbsp;Bodegas</td>
                  <td nowrap="nowrap" class="cajas"><input name="op54" type="radio" value="1" <? if ($row[op54] == 1) echo "checked";?> /></td>
                  <td nowrap="nowrap" class="cajas"><input name="op54" type="radio" value="2" <? if ($row[op54] == 2) echo "checked";?> /></td>
                  <td nowrap="nowrap" class="cajas"><input name="op54" type="radio" value="3" <? if ($row[op54] == 3) echo "checked";?> /></td>
                  <td nowrap="nowrap" class="cajas">&nbsp;Cierre por Fecha y Hora</td>
                  <td nowrap="nowrap" class="cajas"><input name="op37" type="radio" value="1" <? if ($row[op37] == 1) echo "checked";?>></td>
                  <td nowrap="nowrap" class="cajas"><input name="op37" type="radio" value="2" <? if ($row[op37] == 2) echo "checked";?>></td>
                  <td nowrap="nowrap" class="cajas"><input name="op37" type="radio" value="3" <? if ($row[op37] == 3) echo "checked";?> /></td>
                  <td nowrap="nowrap" class="cajas">&nbsp;Modificar Picking</td>
                  <td nowrap="nowrap" class="cajas">&nbsp;</td>
                  <td nowrap="nowrap" class="cajas">&nbsp;</td>
                  <td nowrap="nowrap" class="cajas">&nbsp;</td>
                  <td nowrap="nowrap" class="cajas">&nbsp;</td>
                </tr>
                <tr>
                  <td nowrap="nowrap" class="cajas"><input name="op15" type="radio" value="1" <? if ($row[op15] == 1) echo "checked";?> /></td>
                  <td nowrap="nowrap" class="cajas"><input name="op15" type="radio" value="2" <? if ($row[op15] == 2) echo "checked";?> /></td>
                  <td nowrap="nowrap" class="cajas"><input name="op15" type="radio" value="3" <? if ($row[op15] == 3) echo "checked";?> /></td>
                  <td nowrap="nowrap" class="cajas">&nbsp;Etiquetas e Inventario</td>
                  <td nowrap="nowrap" class="cajas"><input name="op55" type="radio" value="1" <? if ($row[op55] == 1) echo "checked";?> /></td>
                  <td nowrap="nowrap" class="cajas"><input name="op55" type="radio" value="2" <? if ($row[op55] == 2) echo "checked";?> /></td>
                  <td nowrap="nowrap" class="cajas"><input name="op55" type="radio" value="3" <? if ($row[op55] == 3) echo "checked";?> /></td>
                  <td nowrap="nowrap" class="cajas">&nbsp;Permiso Especial</td>
                  <td nowrap="nowrap" class="cajas"><input name="op47" type="radio" value="1" <? if ($row[op47] == 1) echo "checked";?> /></td>
                  <td nowrap="nowrap" class="cajas"><input name="op47" type="radio" value="2" <? if ($row[op47] == 2) echo "checked";?> /></td>
                  <td nowrap="nowrap" class="cajas"><input name="op47" type="radio" value="3" <? if ($row[op47] == 3) echo "checked";?> /></td>
                  <td nowrap="nowrap" class="cajas">&nbsp;Pedidos </td>
                  <td nowrap="nowrap" class="cajas">&nbsp;</td>
                  <td nowrap="nowrap" class="cajas">&nbsp;</td>
                  <td nowrap="nowrap" class="cajas">&nbsp;</td>
                  <td nowrap="nowrap" class="cajas">INFORME DE PRODUCCION</td>
                </tr>
                <tr>
                  <td nowrap="nowrap" class="cajas"><input name="op16" type="radio" value="1" <? if ($row[op16] == 1) echo "checked";?> /></td>
                  <td nowrap="nowrap" class="cajas"><input name="op16" type="radio" value="2" <? if ($row[op16] == 2) echo "checked";?> /></td>
                  <td nowrap="nowrap" class="cajas"><input name="op16" type="radio" value="3" <? if ($row[op16] == 3) echo "checked";?> /></td>
                  <td nowrap="nowrap" class="cajas">&nbsp;Datos Empresa</td>
                  <td nowrap="nowrap" class="cajas">&nbsp;</td>
                  <td nowrap="nowrap" class="cajas">&nbsp;</td>
                  <td nowrap="nowrap" class="cajas">&nbsp;</td>
                  <td nowrap="nowrap" class="cajas">&nbsp;</td>
                  <td nowrap="nowrap" class="cajas"><input name="op38" type="radio" value="1" <? if ($row[op38] == 1) echo "checked";?>></td>
                  <td nowrap="nowrap" class="cajas"><input name="op38" type="radio" value="2" <? if ($row[op38] == 2) echo "checked";?>></td>
                  <td nowrap="nowrap" class="cajas"><input name="op38" type="radio" value="3" <? if ($row[op38] == 3) echo "checked";?> /></td>
                  <td nowrap="nowrap" class="cajas">&nbsp;Folios en Picking</td>
                  <td nowrap="nowrap" class="cajas"><input name="op57" type="radio" value="1" <? if ($row[op57] == 1) echo "checked";?> /></td>
                  <td nowrap="nowrap" class="cajas"><input name="op57" type="radio" value="2" <? if ($row[op57] == 2) echo "checked";?> /></td>
                  <td nowrap="nowrap" class="cajas"><input name="op57" type="radio" value="3" <? if ($row[op57] == 3) echo "checked";?> /></td>
                  <td nowrap="nowrap" class="cajas">Inf. producc. planta</td>
                </tr>
                <tr>
                  <td nowrap="nowrap" class="cajas"><input name="op17" type="radio" value="1" <? if ($row[op17] == 1) echo "checked";?> /></td>
                  <td nowrap="nowrap" class="cajas"><input name="op17" type="radio" value="2" <? if ($row[op17] == 2) echo "checked";?> /></td>
                  <td nowrap="nowrap" class="cajas"><input name="op17" type="radio" value="3" <? if ($row[op17] == 3) echo "checked";?> /></td>
                  <td nowrap="nowrap" class="cajas">&nbsp;Usuarios</td>
                  <td nowrap="nowrap" class="cajas">&nbsp;</td>
                  <td nowrap="nowrap" class="cajas">&nbsp;</td>
                  <td nowrap="nowrap" class="cajas">&nbsp;</td>
                  <td nowrap="nowrap" class="cajas">&nbsp;</td>
                  <td nowrap="nowrap" class="cajas">&nbsp;</td>
                  <td nowrap="nowrap" class="cajas">&nbsp;</td>
                  <td nowrap="nowrap" class="cajas">&nbsp;</td>
                  <td nowrap="nowrap" class="cajas">&nbsp;</td>
                  <td nowrap="nowrap" class="cajas">&nbsp;</td>
                  <td nowrap="nowrap" class="cajas">&nbsp;</td>
                  <td nowrap="nowrap" class="cajas">&nbsp;</td>
                  <td nowrap="nowrap" class="cajas">&nbsp;</td>
                </tr>
                <tr>
                  <td nowrap="nowrap" class="cajas">&nbsp;</td>
                  <td nowrap="nowrap" class="cajas">&nbsp;</td>
                  <td nowrap="nowrap" class="cajas">&nbsp;</td>
                  <td nowrap="nowrap" class="cajas">&nbsp;</td>
                  <td nowrap="nowrap" class="cajas">&nbsp;</td>
                  <td nowrap="nowrap" class="cajas">&nbsp;</td>
                  <td nowrap="nowrap" class="cajas">&nbsp;</td>
                  <td nowrap="nowrap" class="cajas">&nbsp;</td>
                  <td nowrap="nowrap" class="cajas">&nbsp;</td>
                  <td nowrap="nowrap" class="cajas">&nbsp;</td>
                  <td nowrap="nowrap" class="cajas">&nbsp;</td>
                  <td nowrap="nowrap" class="cajas">&nbsp;</td>
                  <td nowrap="nowrap" class="cajas">&nbsp;</td>
                  <td nowrap="nowrap" class="cajas">&nbsp;</td>
                  <td nowrap="nowrap" class="cajas">&nbsp;</td>
                  <td nowrap="nowrap" class="cajas">&nbsp;</td>
                </tr>
                <tr>
                  <td nowrap="nowrap" class="cajas">&nbsp;</td>
                  <td nowrap="nowrap" class="cajas">&nbsp;</td>
                  <td nowrap="nowrap" class="cajas">&nbsp;</td>
                  <td nowrap="nowrap" class="cajas">&nbsp;</td>
                  <td nowrap="nowrap" class="cajas">&nbsp;</td>
                  <td nowrap="nowrap" class="cajas">&nbsp;</td>
                  <td nowrap="nowrap" class="cajas">&nbsp;</td>
                  <td nowrap="nowrap" class="cajas">&nbsp;</td>
                  <td nowrap="nowrap" class="cajas">&nbsp;</td>
                  <td nowrap="nowrap" class="cajas">&nbsp;</td>
                  <td nowrap="nowrap" class="cajas">&nbsp;</td>
                  <td nowrap="nowrap" class="cajas">&nbsp;</td>
                  <td nowrap="nowrap" class="cajas">&nbsp;</td>
                  <td nowrap="nowrap" class="cajas">&nbsp;</td>
                  <td nowrap="nowrap" class="cajas">&nbsp;</td>
                  <td nowrap="nowrap" class="cajas">&nbsp;</td>
                </tr>
                <tr>
                  <td nowrap="nowrap" class="cajas">&nbsp;</td>
                  <td nowrap="nowrap" class="cajas">&nbsp;</td>
                  <td nowrap="nowrap" class="cajas">&nbsp;</td>
                  <td nowrap="nowrap" class="cajas">&nbsp;</td>
                  <td nowrap="nowrap" class="cajas">&nbsp;</td>
                  <td nowrap="nowrap" class="cajas">&nbsp;</td>
                  <td nowrap="nowrap" class="cajas">&nbsp;</td>
                  <td nowrap="nowrap" class="cajas">&nbsp;</td>
                  <td nowrap="nowrap" class="cajas">&nbsp;</td>
                  <td nowrap="nowrap" class="cajas">&nbsp;</td>
                  <td nowrap="nowrap" class="cajas">&nbsp;</td>
                  <td nowrap="nowrap" class="cajas">&nbsp;</td>
                  <td nowrap="nowrap" class="cajas">&nbsp;</td>
                  <td nowrap="nowrap" class="cajas">&nbsp;</td>
                  <td nowrap="nowrap" class="cajas">&nbsp;</td>
                  <td nowrap="nowrap" class="cajas">&nbsp;</td>
                </tr>
              </table></td>
            </tr>
            <tr>
              <td  >&nbsp;</td>
              <td><? $id_bode=$row[id_usuario];?></td>
            </tr>
          </table></td>
        </tr>
      </table>
      <? }}?>
      <? if($nuevo){?>
      <table width="600" height="250" border="1" align="center" bordercolor="#CCCCCC">
        <tr>
          <td><table width="433" border="0" align="center">
              <tr>
                <td width="123" class="titulo" >Nombre</td>
                <td><input name="unombre" type="text" class="cajas" id="unombre" size="50" maxlength="30" onChange="javascript:this.value=this.value.toUpperCase();"/></td>
              </tr>
              <tr>
                <td class="titulo" >Apellidos</td>
                <td><input name="uapellido" type="text" class="cajas" id="uapellido" size="50" maxlength="30" onChange="javascript:this.value=this.value.toUpperCase();"></td>
              </tr>
              <tr>
                <td class="titulo" >Usuario</td>
                <td><input name="username" type="text" class="cajas" id="username" size="50" maxlength="20" /></td>
              </tr>
              <tr>
                <td class="titulo"  >Clave</td>
                <td><input name="password" type="password" class="cajas" id="password"  size="50" maxlength="20" /></td>
              </tr>
              <tr>
                <td class="titulo">Firma Certificaci&oacute;n</td>
                <td>
				
				<input type="checkbox" name="firma" value="1" /></td>
              </tr>
              <tr>
                <td class="titulo">&nbsp;</td>
                <td><? echo $mensaje?></td>
              </tr>
          </table></td>
        </tr>
      </table>
      <? }?>
      <table width="335" border="0" align="center">
        <tr>
          <td class="style2"><a href="?modulo=usuarios.php&amp;op=<? echo $ultimo?>"><img src="jpg/primero.jpg" width="54" height="13" border="0" /></a></td>
          <td class="style2"><? if ($cuantos > $next and !$nuevo){ ?>
              <a href="?modulo=usuarios.php&amp;op=<? echo $next?>" ><img src="jpg/anterior.jpg" width="58" height="13" border="0" /></a>
              <? }else{?>
            &nbsp;
            <? }?></td>
          <td><span class="style2">
            <? if($ante >= 0){ ?>
            <a href="?modulo=usuarios.php&amp;op=<? echo $ante?>" ><img src="jpg/siguiente.jpg" width="54" height="13" border="0" /></a>
            <? }else{?>
            &nbsp;
            <? }?>
          </span></td>
          <td><? if ($cuantos){ ?>
              <a href="?modulo=usuarios.php&amp;cancelar=1"><img src="jpg/ultimo.jpg" width="47" height="13" border="0" /></a>
              <? }?>          </td>
          <td width="47"><a href="?modulo=usuarios.php&amp;nuevo=1" ><img src="jpg/nuevo.jpg" width="47" height="13" border="0" /></a> </td>
          <td width="55"><a href="?modulo=usuarios.php&amp;cancelar=1"><img src="jpg/cancelar.jpg" width="55" height="13" border="0" /></a></td>
          <td width="62"><? if(!$nuevo and $cuantos){?>
              <a href="javascript: document.form1.submit();">
              <label>
              <input type="image" name="modificar" src="jpg/modificar.jpg" />
              </label>
              </a>
              <? }?>          </td>
          <td width="55"><? if(!$cuantos or $nuevo or $mantsec ){?>
              <a href="javascript: document.form1.submit();">
              <label>
              <input type="image" name="grabar" src="jpg/guardar.jpg" />
              </label>
              </a>
              <? }?>          </td>
          <td width="45"><? if(!$nuevo and $cuantos){?>
              <a href="?modulo=usuarios.php&amp;borrar=<?=$id_bode?>" onclick='return Confirmar(this.form1)' > <img src="jpg/borrar.jpg" width="45" height="13" border="0" /> </a>
              <? }?>          </td>
          <td width="45"><? if(!$nuevo and $cuantos){?>
              <a href="?modulo=usuarios_listar.php"><img src="jpg/listar.jpg" width="45" height="13" border="0" /></a>
              <? }?>          </td>
        </tr>
      </table></td>
  </tr>
</table>
</form>