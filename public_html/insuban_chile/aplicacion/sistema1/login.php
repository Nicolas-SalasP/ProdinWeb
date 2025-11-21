<? session_start();
  
  // Obtengo los datos cargados en el formulario de login.
  $email = $_POST['email'];
  $password = $_POST['password'];
  
  
      $con = mysql_connect("localhost", "prodinwe_stgo391", "391stgo.*.") 
      or die ("Could not connect: " . mysql_error());
      mysql_select_db("prodinwe_sistema1");
   
  // Consulta segura para evitar inyecciones SQL.
  $sql = mysql_query("SELECT * FROM usuarios WHERE email='$email' AND password = $password",$con);
//  $sqlResultado = mysql_query($sql);
  $row = mysql_fetch_array($sql);
  $email = $row["email"];
  $idEnc = $row["idEnc"];


    if ($idEnc == 1) {
    // Guardo en la sesión el email del usuario.
    $_SESSION['email'] = $email;
        $_SESSION['idEnc'] = $idEnc;
    // Redirecciono al usuario a la página principal del sitio.
    header("Location: presentacion/func.search_4_1.php");

    }elseif ($idEnc == 13) {
    // Guardo en la sesión el email del usuario.
    $_SESSION['email'] = $email;
    // Redirecciono al usuario a la página principal del sitio.
    header("Location: presentacion/func.search_4_16.php"); 

    }elseif ($idEnc == 14) {
    // Guardo en la sesión el email del usuario.
    $_SESSION['email'] = $email;
    // Redirecciono al usuario a la página principal del sitio.
    header("Location: presentacion/func.search_4_13.php");

    }elseif ($idEnc == 15) {
    // Guardo en la sesión el email del usuario.
    $_SESSION['email'] = $email;
    // Redirecciono al usuario a la página principal del sitio.
    header("Location: presentacion/func.search_4_15.php");              

    }elseif ($idEnc == 16) {
    // Guardo en la sesión el email del usuario.
    $_SESSION['email'] = $email;
    // Redirecciono al usuario a la página principal del sitio.
    header("Location: presentacion/func.search_4_14.php");

    }elseif ($idEnc == 20 or $idEnc == 3 ) {
    // Guardo en la sesión el email del usuario.
    $_SESSION['email'] = $email;
    // Redirecciono al usuario a la página principal del sitio.
    header("Location: presentacion/func.search_2.php");

    }elseif ($idEnc == 17) {
    // Guardo en la sesión el email del usuario.
    $_SESSION['email'] = $email;
    // Redirecciono al usuario a la página principal del sitio.
    header("Location: presentacion/func.search_5.php");
    }elseif ($idEnc == 27) {
    // Guardo en la sesión el email del usuario.
    $_SESSION['email'] = $email;
    // Redirecciono al usuario a la página principal del sitio.
    header("Location: presentacion/func.search_100.php");                           
    }else{
    echo '<h3>El email o password es incorrecto</h3><br>';
    echo '<a href="acceso.html"><h3>vuelva a intentarlo</h3></a>.<br/>';
  }

?>

