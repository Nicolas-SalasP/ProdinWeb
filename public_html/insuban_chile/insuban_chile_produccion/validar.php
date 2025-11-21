<?php 
ini_set('memory_limit', '-1');
require "lib/conexion.php";
$link = mysql_connect("$localhost","$user","$pass");
mysql_select_db("$db");
//require "lib/funciones.php";
   
      // $password2 = md5($_POST['password']);
	  //$encriptada4 =sha1(�password�);

   
         if ($username and $password)
        {
        $sql="SELECT * FROM usuarios where username='$username' and password='$password'";
        $result = mysql_query($sql);
        $cuantos = mysql_num_rows($result);
		//echo "cuantos $cuantos";
		}

        if (!$cuantos)
         {     
          $error_page = "index.php";
          $error_url = $error_page;
          $message='Usuario+No+autorizado';
          $error_url .= "?error=$message";
          Header( "Location: $error_url");
          exit;
         }else{
		  $row=mysql_fetch_array($result);
		  $id_insuban=$row['id_usuario'];
		  $unombre=$row['unombre'];
		  $uapellido=$row['uapellido'];
		  $email=$row['email'];
		  $nivel_us=$row['id_u_n'];
		  $op1=$row['op1']; $op2=$row['op2']; $op3=$row['op3']; $op4=$row['op4']; $op5=$row['op5']; $op6=$row['op6']; $op7=$row['op7']; $op8=$row['op8']; $op9=$row['op9']; $op10=$row['op10']; $op11=$row['op11']; $op12=$row['op12']; $op13=$row['op13']; $op14=$row['op14']; $op15=$row['op15']; $op16=$row['op16']; $op17=$row['op17']; $op18=$row['op18']; $op19=$row['op19']; $op20=$row['op20']; $op21=$row['op21']; $op22=$row['op22']; $op23=$row['op23']; $op24=$row['op24']; $op25=$row['op25']; $op26=$row['op26']; $op27=$row['op27']; $op28=$row['op28']; $op29=$row['op29']; $op30=$row['op30']; $op31=$row['op31']; $op32=$row['op32']; $op33=$row['op33']; $op34=$row['op34']; $op35=$row['op35']; $op36=$row['op36']; $op37=$row['op37']; $op38=$row['op38']; $op39=$row['op39']; $op40=$row['op40']; $op41=$row['op41']; $op42=$row['op42']; $op43=$row['op43']; $op44=$row['op44']; $op45=$row['op45']; $op46=$row['op46']; $op47=$row['op47']; $op48=$row['op48']; $op49=$row['op49']; $op50=$row['op50']; $op51=$row['op51']; $op52=$row['op52']; $op53=$row['op53']; $op54=$row['op54']; $op55=$row['op55']; $op56=$row['op56'];
	  
		  session_start();
          $_SESSION['id_insuban']="$id_insuban";
		  $_SESSION['nombre_usuario']="$unombre";
		  $_SESSION['apellido_usuario']="$uapellido";
		  $_SESSION['email']="$email";
		  
		  $_SESSION['permiso1']="$op1"; $_SESSION['permiso2']="$op2"; $_SESSION['permiso2']="$op2"; $_SESSION['permiso3']="$op3"; $_SESSION['permiso4']="$op4"; $_SESSION['permiso5']="$op5";  $_SESSION['permiso6']="$op6"; $_SESSION['permiso7']="$op7"; $_SESSION['permiso8']="$op8"; $_SESSION['permiso9']="$op9"; $_SESSION['permiso10']="$op10"; $_SESSION['permiso11']="$op11"; $_SESSION['permiso12']="$op12"; $_SESSION['permiso13']="$op13"; $_SESSION['permiso14']="$op14"; $_SESSION['permiso15']="$op15"; $_SESSION['permiso16']="$op16";  $_SESSION['permiso17']="$op17"; $_SESSION['permiso18']="$op18"; $_SESSION['permiso19']="$op19"; $_SESSION['permiso20']="$op20"; $_SESSION['permiso21']="$op21"; $_SESSION['permiso22']="$op22"; $_SESSION['permiso23']="$op23"; $_SESSION['permiso24']="$op24"; $_SESSION['permiso25']="$op25"; $_SESSION['permiso26']="$op26"; $_SESSION['permiso27']="$op27"; $_SESSION['permiso28']="$op28"; $_SESSION['permiso29']="$op29"; $_SESSION['permiso30']="$op30"; $_SESSION['permiso31']="$op31"; $_SESSION['permiso32']="$op32"; $_SESSION['permiso33']="$op33"; $_SESSION['permiso34']="$op34"; $_SESSION['permiso35']="$op35"; $_SESSION['permiso36']="$op36"; $_SESSION['permiso37']="$op37"; $_SESSION['permiso38']="$op38"; $_SESSION['permiso39']="$op39"; $_SESSION['permiso40']="$op40"; $_SESSION['permiso41']="$op41"; $_SESSION['permiso42']="$op42"; $_SESSION['permiso43']="$op43"; $_SESSION['permiso44']="$op44"; $_SESSION['permiso45']="$op45"; $_SESSION['permiso46']="$op46"; $_SESSION['permiso47']="$op47"; $_SESSION['permiso48']="$op48"; $_SESSION['permiso49']="$op49"; $_SESSION['permiso50']="$op50"; $_SESSION['permiso51']="$op51"; $_SESSION['permiso52']="$op52"; $_SESSION['permiso53']="$op53"; $_SESSION['permiso54']="$op54"; $_SESSION['permiso55']="$op55";  $_SESSION['permiso56']="$op56"; $_SESSION['nivel_usua']="$nivel_us";
		  
		  
		  $page = "sistema.php"; // Ingreso al Sistema
      	  Header( "Location: $page");
		  //header( 'Location: sistema.php' );
		  exit;
		  
		  
		 }
?>