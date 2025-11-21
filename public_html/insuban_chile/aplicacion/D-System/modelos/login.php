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
  $perfil = $row["perfil"];
  $nombre = $row["nombre"];


    if ($idEnc == 1 or $idEnc == 2 or $idEnc == 3 ) {
    // Guardo en la sesión el email del usuario.
    $_SESSION['email'] = $email;
    $_SESSION['perfil'] = $perfil;
    $_SESSION['nombre'] = $nombre;
    $_SESSION['idEnc'] = $idEnc;
    // Redirecciono al usuario a la página principal del sitio.
    header("Location: ../vistas/index.php");
    }else{
    header("Location: ../index.html");  
  }?>

