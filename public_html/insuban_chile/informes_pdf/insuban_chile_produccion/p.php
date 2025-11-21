<?

  $fecha_faena= "2012-02-21";
  $dat4=split(" ",$fecha_faena);
  $dat6=split("-",$dat4[0]);
  $fecha_faena1="$dat6[2]-$dat6[1]-$dat6[0]";
  $an=$dat6[0]+1;
  $fecha_faena1="$dat6[2]-$dat6[1]-$an";
   $dias=1;
  $fecha_termino1 = date("Y-m-d", strtotime("$fecha_faena1 + $dias day"));
  
  echo "fecha_termino1 $fecha_termino1<br>";
?>