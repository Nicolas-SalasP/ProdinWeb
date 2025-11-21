<?
if($cierre_produccion){
$fecha_cierre_producc=date("Y-m-d"); 
$sqlfecha_cierre_producc="UPDATE planilla_registro_fecha_asig_produccion set fecha_cierre_producc = '$fecha_cierre_producc' where fecha_asig_producc  = '$fecha_asig_producc'";
$resultfecha_cierre_producc=mysql_query($sqlfecha_cierre_producc);
//echo "sqlfecha_cierre_producc $sqlfecha_cierre_producc<br>";

$sqlfecha_cierre_producc2="UPDATE planilla_produccion set fecha_cierre_producc = '$fecha_cierre_producc' where fecha_asig_producc  = '$fecha_asig_producc'";
$resultfecha_cierre_producc2=mysql_query($sqlfecha_cierre_producc2);
//echo "sqlfecha_cierre_producc2 $sqlfecha_cierre_producc2<br>";
}
if($abrir_produccion){
$fecha_cierre_producc='0000-00-00'; 
$sqlfecha_cierre_producc="UPDATE planilla_registro_fecha_asig_produccion set fecha_cierre_producc = '$fecha_cierre_producc' where fecha_asig_producc  = '$fecha_asig_producc'";
$resultfecha_cierre_producc=mysql_query($sqlfecha_cierre_producc);
//echo "sqlfecha_cierre_producc $sqlfecha_cierre_producc<br>";

$sqlfecha_cierre_producc2="UPDATE planilla_produccion set fecha_cierre_producc = '$fecha_cierre_producc' where fecha_asig_producc  = '$fecha_asig_producc'";
$resultfecha_cierre_producc2=mysql_query($sqlfecha_cierre_producc2);
//echo "sqlfecha_cierre_producc2 $sqlfecha_cierre_producc2<br>";
}
?>