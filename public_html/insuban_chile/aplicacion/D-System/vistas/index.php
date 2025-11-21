<? header("refresh: 60;"); ?>

<?php
  session_start();
  // Controlo si el usuario ya está logueado en el sistema.
  if(isset($_SESSION['email'])){
  }else{
    // Si no está logueado lo redireccion a la página de login.
    header("Location: ../vistas/login.html");
  }
?>
<?
require("../controladores/connection.php");
mysql_select_db("$database", $con);

if ($busca) {
  $fecha = $fecha_b;
} else {
  $fecha = date("Y-m-d");
}


                $query6=mysql_query("SELECT sal.fechaSalado, sal.idCodigo,pro.idEncargado, pro.IdCalibre, pro.cantidad
                FROM salado as sal,
                proceso_encargado as pro, 
                encargados as enc 
                  where pro.idEncargado=enc.idencargados
                  and pro.codigo=sal.idCodigo
                  and pro.IdCalibre !=30
                  and sal.fechaSalado='$fecha'
                group by sal.idSalado order by sal.idSalado desc", $con);
                
                while ($row6=mysql_fetch_row($query6)) {
                 
                  $totplast += $row6[4];
                }

	            $query6=mysql_query("SELECT sal.fechaSalado, sal.idCodigo, pro.idEncargado, pro.IdCalibre, pro.cantidad
	            FROM salado as sal,
	            proceso_encargado as pro, 
	            encargados as enc 
                  where pro.idEncargado=enc.idencargados
                  and pro.codigo=sal.idCodigo
                  and sal.fechaSalado='$fecha'
                  and pro.IdCalibre != 30
                  and pro.idEncargado = 16
                group by sal.idSalado order by sal.idSalado desc ", $con);
                
                while ($row6=mysql_fetch_row($query6)) {
                 
                  $tot1 += $row6[4];
              }

                  $calc1 = $tot1 / $totplast;
                  $preporcent11 = $calc1 * 100;
                  $porcent1 = number_format($preporcent11, 1,',', '');



                $query6=mysql_query("SELECT sal.fechaSalado, sal.idCodigo, pro.idEncargado, pro.IdCalibre, pro.cantidad
                    FROM salado as sal,
                    proceso_encargado as pro, 
                  encargados as enc 
                  where pro.idEncargado=enc.idencargados
                  and pro.codigo=sal.idCodigo
                  and sal.fechaSalado ='$fecha'
                  and pro.idEncargado =14
                  and pro.IdCalibre !=30
                  group by sal.idSalado order by sal.idSalado desc", $con);
                
                while ($row6=mysql_fetch_row($query6)) {
                 
                  $tot2 += $row6[4];
              }

                  $calc1 = $tot2 / $totplast;
                  $preporcent12 = $calc1 * 100;
                  $porcent2 = number_format($preporcent12, 1,',', '');



                $query6=mysql_query("SELECT sal.fechaSalado, sal.idCodigo, pro.idEncargado, pro.IdCalibre, pro.cantidad
                FROM salado as sal,
                proceso_encargado as pro, 
                  encargados as enc 
                  where pro.idEncargado=enc.idencargados
                  and pro.codigo=sal.idCodigo
                  and sal.fechaSalado ='$fecha'
                  and pro.IdCalibre !=30
                  and pro.idEncargado =13
                  group by sal.idSalado order by sal.idSalado desc", $con);
                
                while ($row6=mysql_fetch_row($query6)) {
                 
                  $tot3 += $row6[4];
                }

                $calc1 = $tot3 / $totplast;
                $preporcent13 = $calc1 * 100;
                $porcent3 = number_format($preporcent13, 1,',', ''); 

// bloque 2
//mp grupo
                $query7=mysql_query("SELECT rem.idGrupo2 , grp.grupo, org.origen, sum(rem.n_mallas)
                FROM remojo As rem, 
                origenes As org, 
                producto As pro, 
                grupo as grp 
                where org.id_origen = rem.procedencia 
                and grp.idgrupo = rem.idGrupo2 
                and pro.id_producto = rem.producto
                and rem.idGrupo2 = 11
                and rem.f_salida_produccion='$fecha'
                group by rem.procedencia", $con );

// total cortos
              $query8=mysql_query("SELECT sal.fechaSalado, sal.idCodigo,pro.idEncargado, pro.IdCalibre, pro.cantidad
                    FROM salado as sal,
                    proceso_encargado as pro, 
                      encargados as enc 
                      where pro.idEncargado=enc.idencargados
                      and pro.codigo=sal.idCodigo
                      and sal.fechaSalado='$fecha'
                      and pro.idEncargado=16
                      and pro.IdCalibre=30
                      group by sal.idSalado order by sal.idSalado desc", $con);
                
                while ($row6=mysql_fetch_row($query8)) {
                 
                  $totcal += $row6[4];
                }                


                $query9=mysql_query("SELECT rem.idGrupo2 , grp.grupo, org.origen, sum(rem.n_mallas)
                FROM remojo As rem, 
                origenes As org, 
                producto As pro, 
                grupo as grp 
                where org.id_origen = rem.procedencia 
                and grp.idgrupo = rem.idGrupo2 
                and pro.id_producto = rem.producto
                and rem.idGrupo2 = 13
                and rem.f_salida_produccion='$fecha'
                group by rem.procedencia", $con );


                $query10=mysql_query("SELECT sal.fechaSalado, sal.idCodigo,pro.idEncargado, pro.IdCalibre, pro.cantidad
                    FROM salado as sal,
                    proceso_encargado as pro, 
                  encargados as enc 
                  where pro.idEncargado=enc.idencargados
                  and pro.codigo=sal.idCodigo
                  and sal.fechaSalado='$fecha'
                  and pro.IdCalibre =30 
                  and pro.idEncargado =14
                group by sal.idSalado order by sal.idSalado desc", $con);
                
                while ($row6=mysql_fetch_row($query10)) {
                 
                  $totcal2 += $row6[4];
                }


                $query12=mysql_query("SELECT rem.idGrupo2 , grp.grupo, org.origen, sum(rem.n_mallas)
                FROM remojo As rem, 
                origenes As org, 
                producto As pro, 
                grupo as grp 
                where org.id_origen = rem.procedencia 
                and grp.idgrupo = rem.idGrupo2 
                and pro.id_producto = rem.producto
                and rem.idGrupo2 = 12
                and rem.f_salida_produccion='$fecha'
                group by rem.procedencia", $con );


                $query13=mysql_query("SELECT sal.fechaSalado, sal.idCodigo,pro.idEncargado, pro.IdCalibre, pro.cantidad
                    FROM salado as sal,
                    proceso_encargado as pro, 
                  encargados as enc 
                  where pro.idEncargado=enc.idencargados
                  and pro.codigo=sal.idCodigo
                  and sal.fechaSalado='$fecha'
                  and pro.IdCalibre =30 
                  and pro.idEncargado =13
                group by sal.idSalado order by sal.idSalado desc", $con);
                
                while ($row6=mysql_fetch_row($query13)) {
                 
                  $totcal3 += $row6[4];
                }

// bloque 3

                $query14=mysql_query("SELECT sal.fechaSalado, sal.idCodigo,pro.idEncargado, pro.IdCalibre,cal.calibre,cal.valor, pro.cantidad
                    FROM salado as sal,
                    proceso_encargado as pro, 
                      encargados as enc,
                      calibres as cal
                      where pro.idEncargado=enc.idencargados
                      and pro.codigo=sal.idCodigo
                      and pro.IdCalibre=cal.idcalibres
                      and pro.IdCalibre=20
                      and sal.fechaSalado='$fecha'
                    group by sal.idSalado
                    order by sal.idSalado desc", $con);

                		while ($row6=mysql_fetch_row($query14)) {
                 
                  $cal1 = $row6[4];
                  $val1 = $row6[5];
                  $totcal1 += $row6[6];
              }                          

                 $calc1 = $totcal1 / $totplast;
                 $preporcent1 = $calc1 * 100;
                 $porcent14 = number_format($preporcent1, 1,',', '');


                
                $query15=mysql_query("SELECT sal.fechaSalado, sal.idCodigo,pro.idEncargado, pro.IdCalibre,cal.calibre,cal.valor, pro.cantidad
                    FROM salado as sal,
                    proceso_encargado as pro, 
                      encargados as enc,
                      calibres as cal
                      where pro.idEncargado=enc.idencargados
                      and pro.codigo=sal.idCodigo
                      and pro.IdCalibre=cal.idcalibres
                      and pro.IdCalibre=21
                      and sal.fechaSalado='$fecha'
                    group by sal.idSalado
                    order by sal.idSalado desc", $con);

               		   while ($row6=mysql_fetch_row($query15)) {
                 
                  $cal2 = $row6[4];
                  $val2 = $row6[5];
                  $totcal5 += $row6[6];
                
                } 

                 $calc5 = $totcal5 / $totplast;
                 $preporcent2 = $calc5 * 100;
                 $porcent15 = number_format($preporcent2, 1,',', '');



                $query16=mysql_query("SELECT sal.fechaSalado, sal.idCodigo,pro.idEncargado, pro.IdCalibre,cal.calibre,cal.valor, pro.cantidad
                    FROM salado as sal,
                    proceso_encargado as pro, 
                      encargados as enc,
                      calibres as cal
                      where pro.idEncargado=enc.idencargados
                      and pro.codigo=sal.idCodigo
                      and pro.IdCalibre=cal.idcalibres
                      and pro.IdCalibre=22
                      and sal.fechaSalado='$fecha'
                    group by sal.idSalado
                    order by sal.idSalado desc", $con);

                while ($row6=mysql_fetch_row($query16)) {
                 
                  $cal3 = $row6[4];
                  $val3 = $row6[5];
                  $totcal6 += $row6[6];
                
                } 

                 $calc6 = $totcal6 / $totplast;
                 $preporcent3 = $calc6 * 100;
                 $porcent16 = number_format($preporcent3, 1,',', '');



                $query17=mysql_query("SELECT sal.fechaSalado, sal.idCodigo,pro.idEncargado, pro.IdCalibre,cal.calibre,cal.valor, pro.cantidad
                    FROM salado as sal,
                    proceso_encargado as pro, 
                      encargados as enc,
                      calibres as cal
                      where pro.idEncargado=enc.idencargados
                      and pro.codigo=sal.idCodigo
                      and pro.IdCalibre=cal.idcalibres
                      and pro.IdCalibre=23
                      and sal.fechaSalado='$fecha'
                    group by sal.idSalado
                    order by sal.idSalado desc", $con);


                while ($row6=mysql_fetch_row($query17)) {
                 
                  $cal4 = $row6[4];
                  $val4 = $row6[5];
                  $totcal7 += $row6[6];
                
                } 

                 $calc7 = $totcal7 / $totplast;
                 $preporcent4 = $calc7 * 100;
                 $porcent17 = number_format($preporcent4, 1,',', '');



                $query18=mysql_query("SELECT sal.fechaSalado, sal.idCodigo,pro.idEncargado, pro.IdCalibre,cal.calibre,cal.valor, pro.cantidad
                    FROM salado as sal,
                    proceso_encargado as pro, 
                      encargados as enc,
                      calibres as cal
                      where pro.idEncargado=enc.idencargados
                      and pro.codigo=sal.idCodigo
                      and pro.IdCalibre=cal.idcalibres
                      and pro.IdCalibre=24
                      and sal.fechaSalado='$fecha'
                    group by sal.idSalado
                    order by sal.idSalado desc", $con);

                while ($row6=mysql_fetch_row($query18)) {
                 
                  $cal5 = $row6[4];
                  $val5 = $row6[5];
                  $totcal8 += $row6[6];
                
                } 

                 $calc8 = $totcal8 / $totplast;
                 $preporcent5 = $calc8 * 100;
                 $porcent18 = number_format($preporcent5, 1,',', '');


                $query19=mysql_query("SELECT org.id_origen,org.origen, sum(rem.n_mallas)
                FROM remojo As rem, 
                origenes As org, 
                producto As pro, 
                grupo as grp 
                where org.id_origen = rem.procedencia 
                and grp.idgrupo = rem.idGrupo2 
                and pro.id_producto = rem.producto 
                and rem.f_salida_produccion='$fecha'
                group by rem.procedencia; ", $con);

                
                $query20=mysql_query("SELECT sum(rem.n_mallas)
                FROM remojo As rem, 
                origenes As org, 
                producto As pro, 
                grupo as grp 
                where org.id_origen = rem.procedencia 
                and grp.idgrupo = rem.idGrupo2 
                and pro.id_producto = rem.producto 
                and rem.f_salida_produccion='$fecha'; ", $con);
                
                while ($row6=mysql_fetch_row($query20)) {
                 
                  $totmat = $row6[0];
                
                }

                $query21=mysql_query("SELECT pro.cantidad
                    FROM salado as sal,
                    proceso_encargado as pro, 
                      encargados as enc 
                      where pro.idEncargado=enc.idencargados
                      and pro.codigo=sal.idCodigo
                      and sal.fechaSalado='$fecha'
                      and pro.IdCalibre =30
                    group by sal.idSalado order by sal.idSalado desc", $con);
                               
                while ($row6=mysql_fetch_row($query21)) {
                 
                  $totcor += $row6[0];
                
                }

                $res1 =   $totmat / $totplast ;
                $indice = number_format($res1, 2,',', '');



              $sql1=mysql_query("SELECT pr2.idproceso_encargado2, pr2.fecha, ope.onombre, org.origen, grp.grupo, pr2.n_bidon, pr2.n_nudos_e, pr2.n_nudos_r, pr2.origenid FROM proceso_encargado2 as pr2
              left outer join operarias as ope on ope.idoperarias=pr2.operaria
              left outer join origenes as org on org.id_origen=pr2.origenid
              left outer join grupo as grp on grp.idgrupo=pr2.idgrupo1
              where pr2.fecha = '$fecha' ORDER BY pr2.idproceso_encargado2 DESC", $con);

                while ($row5=mysql_fetch_row($sql1)) {

                $x1=$row5[6];
                $x2=$row5[7];
                $x3=$row5[8];
                $subtot_nudos=$x1-$x2;
                $sum5+=$subtot_nudos;


/*
1 CARNES ÑUBLE
2 VICTORIA
3 ANGOL
4 AGROLOMAS
5 COMAFRI
6 CAMER
7 TEMUCO
8 VALLEDOR (Vacuno)
9 MAVE
10  FRIOSA
11  TRIPO 6
12  NCS
13  FIPSO
14  CHA
15  NEMEX
16  KUPPER
1000011 TC
18  VALLEDOR (Cerdo)
19  MARIN
20  TRIPO 3
21  AGROSUPER
22  SUPER POLLO
23  COSTA CD
24  TRIPO 8
25  COSTA FC
26  TRIPO 2
27  INSUBAN
28  COEXCA
29  MAXAGRO
30  LO BOZA
31  SUPER POLLO - Abraham
32  AGRIMARES
33  FIPSO5
34  FIPSO6
35  VAZ
36  ICG
37  SUPERO POLLO - Padilla
38  ESB
1000048 CASCOM
40  PPS m3
41  PPS m4
42  PPS m5
43  PPS m7
44  PT
45  COSTA EG
46  COSTA FD
47  SAN SEBASTIAN
48  FRIGORIFICO CAREN
49  NFZ
50  FIPSO10
51  GE
52  BR
53  FIPSO 11
54  CMJ
55  VER
56  LA PINTANA
57  ARS
58  VDAX
59  PNR
60  VHES
61  FRIOSA FRIO
62  TRIPO
63  JEUGT
64  E
65  PNR
66  PPS1
67  REYES
68  BIERHALTER
69  FIPSO A
70  INTRES
71  DS-FRA
72  FRIGORIFICO FAMISA
73  FIPSO174
74  PANI
75  ARS
76  BIERH
77  HOLDIJK
78  STRECFUSS
79  Friosa  V
80  BOURD
81  MARIO GALAZ (FAENAGRO LTDA)
82  LUIS HERNANDEZ CERDA (agrosupe
83  SALAMANCA FOODS S.A.
84  Victor Aedo
85  BERNARD
86  SAV
87  NORDAN
88  AGRIMARES 1
89  CALACAR
90  BLAN
91  INS
92  DARIM
93  FIPSO R
94  NORDAN 2
96  TRI-716
97  BERNARD-B
98  BERNARD-L
99  TRIPO-570
100 FIPSO-A
103 CAS
104 DAX
105 Dax 1
106 Dax 2
1000000 FIP- A1
1000001 FIP- A2
1000002 FIP- R1
1000003 FIP- R2
1000004 TNT
1000005 TNT-533
1000006 TNT-570
1000007 TNT-716
1000008 VAZ-F
1000009 VAZ - G
1000010 T-716
1000012 TNT-1
1000013 TNT-2
1000014 TNT-3
1000015 TNT-4
1000016 TNT-5
1000017 CAREN
1000018 T-570
1000019 ROSARIO
1000020 LO MIRANDA
1000021 VDJ
1000022 FIP-L
1000023 BERDICK
1000024 FIPSO C
1000025 FIPSO C-2
1000026 FIPSO L-1
1000027 FIPSO L-2
1000028 AGROSUPER (Salado)
1000029 Wolfson
1000030 COSTA BRAVA
1000031 Emportrip
1000032 Tripnet
1000033 ICP
1000034 LIMATRIP
1000035 BLF
1000036 FIPSO C-1
1000037 LA CALERA
1000038 TOP CASING
1000039 GREAT WEST CASING, LLC
1000040 BA
1000041 BS
1000042 BBER
1000043 Olot Meats
1000044 Teeuwissen
1000045 BAB
1000046 SER
1000051 PPS 2
1000052 PPS 22
1000049 PPS 1
1000050 PPS 10
1000053 PPS 27
1000054 INTR
107 COMAFRI_2
1000055 CTH
1000056 PPS 26
1000058 BCO
1000059 DCW
555 REPROCESO
*/



                if ($x3 == 1000055 or $x3 == 1000043) {
                $varx1+=$subtot_nudos * 15;
                }elseif ($x3 == 1000039) {
                $varx2+=$subtot_nudos * 22;
                }elseif ($x3 == 555) {
                $varx3+=$subtot_nudos * 5;
                }elseif ($x3 == 107) {
                $varx4+=$subtot_nudos * 10;
                }elseif ($x3 == 87) {
                $varx4+=$subtot_nudos * 23;
                }elseif ($x3 == 1000058) {
                $varx5+=$subtot_nudos * 30;
                }else{
                $varx6+=$subtot_nudos * 20;
                }

              $sum6 = $varx1+$varx2+$varx3+$varx4+$varx5+$varx6;
            }

            $sql16=mysql_query("SELECT pr2.idproceso_encargado2, pr2.fecha, ope.onombre, org.origen, grp.grupo, pr2.n_bidon, pr2.n_nudos_e, pr2.n_nudos_r, pr2.origenid FROM proceso_encargado2 as pr2
              left outer join operarias as ope on ope.idoperarias=pr2.operaria
              left outer join origenes as org on org.id_origen=pr2.origenid
              left outer join grupo as grp on grp.idgrupo=pr2.idgrupo1
              where pr2.idgrupo1=11 and pr2.fecha = '$fecha' ORDER BY pr2.idproceso_encargado2 DESC", $con);

                while ($row5=mysql_fetch_row($sql16)) {

                $x1=$row5[6];
                $x2=$row5[7];
                $x3=$row5[8];
                $subtot_nudos16=$x1-$x2;
              //  $sum5+=$subtot_nudos16;

                if ($x3 == 1000055 or $x3 == 1000043) {
                $varx16+=$subtot_nudos16 * 15;
                }elseif ($x3 == 1000039) {
                $varx26+=$subtot_nudos16 * 22;
                }elseif ($x3 == 107) {
                $varx36+=$subtot_nudos16 * 10;
                }elseif ($x3 == 87) {
                $varx4+=$subtot_nudos * 23;
                }elseif ($x3 == 1000058) {
                $varx46+=$subtot_nudos16 * 30;
                }elseif ($x3 == 555) {
                $varx56+=$subtot_nudos16 * 5;
                }else{
                $varx66+=$subtot_nudos16 * 20;
                }

              $sum16 = $varx16+$varx26+$varx36+$varx46+$varx56+$varx66;
            }

              
              $sql13=mysql_query("SELECT pr2.idproceso_encargado2, pr2.fecha, ope.onombre, org.origen, grp.grupo, pr2.n_bidon, pr2.n_nudos_e, pr2.n_nudos_r, pr2.origenid FROM proceso_encargado2 as pr2
              left outer join operarias as ope on ope.idoperarias=pr2.operaria
              left outer join origenes as org on org.id_origen=pr2.origenid
              left outer join grupo as grp on grp.idgrupo=pr2.idgrupo1
              where pr2.idgrupo1=13 and pr2.fecha = '$fecha' ORDER BY pr2.idproceso_encargado2 DESC", $con);

                while ($row5=mysql_fetch_row($sql13)) {

                $x1=$row5[6];
                $x2=$row5[7];
                $x3=$row5[8];
                $subtot_nudos13=$x1-$x2;
              //  $sum5+=$subtot_nudos13;

                if ($x3 == 1000055 or $x3 == 1000043) {
                $varx13+=$subtot_nudos13 * 15;
                }elseif ($x3 == 1000039) {
                $varx23+=$subtot_nudos13 * 22;
                }elseif ($x3 == 107) {
                $varx33+=$subtot_nudos13 * 10;
                }elseif ($x3 == 87) {
                $varx4+=$subtot_nudos * 23;
                }elseif ($x3 == 1000058) {
                $varx43+=$subtot_nudos13 * 30;
                }elseif ($x3 == 555) {
                $varx53+=$subtot_nudos13 * 5;
                }else{
                $varx63+=$subtot_nudos13 * 20;
                }

              $sum13 = $varx13+$varx23+$varx33+$varx43+$varx53+$varx63;
            }            

             $sql12=mysql_query("SELECT pr2.idproceso_encargado2, pr2.fecha, ope.onombre, org.origen, grp.grupo, pr2.n_bidon, pr2.n_nudos_e, pr2.n_nudos_r, pr2.origenid FROM proceso_encargado2 as pr2
              left outer join operarias as ope on ope.idoperarias=pr2.operaria
              left outer join origenes as org on org.id_origen=pr2.origenid
              left outer join grupo as grp on grp.idgrupo=pr2.idgrupo1
              where pr2.idgrupo1=12 and pr2.fecha = '$fecha' ORDER BY pr2.idproceso_encargado2 DESC", $con);

                while ($row5=mysql_fetch_row($sql12)) {

                $x1=$row5[6];
                $x2=$row5[7];
                $x3=$row5[8];
                $subtot_nudos12=$x1-$x2;
              //  $sum5+=$subtot_nudos12;

                if ($x3 == 1000055 or $x3 == 1000043) {
                $varx12+=$subtot_nudos12 * 15;
                }elseif ($x3 == 1000039) {
                $varx22+=$subtot_nudos12 * 22;
                }elseif ($x3 == 107) {
                $varx32+=$subtot_nudos12 * 10;
                }elseif ($x3 == 87) {
                $varx4+=$subtot_nudos * 23;
                }elseif ($x3 == 1000058) {
                $varx42+=$subtot_nudos12 * 30;
                }elseif ($x3 == 555) {
                $varx52+=$subtot_nudos12 * 5;
                }else{
                $varx62+=$subtot_nudos12 * 20;
                }

              $sum12= $varx12+$varx22+$varx32+$varx42+$varx52+$varx62;

            }?>

<!DOCTYPE HTML>
<html>
<head>
<title>D-System</title>
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<script type="application/x-javascript"> addEventListener("load", function() { setTimeout(hideURLbar, 0); }, false); function hideURLbar(){ window.scrollTo(0,1); } </script>
<!-- Bootstrap Core CSS -->
<link href="css/bootstrap.css" rel='stylesheet' type='text/css' />
<!-- Custom CSS -->
<link href="css/style.css" rel='stylesheet' type='text/css' />
<!-- font CSS -->
<!-- font-awesome icons -->
<link href="css/font-awesome.css" rel="stylesheet"> 
<!-- //font-awesome icons -->
 <!-- js-->
<script src="js/jquery-1.11.1.min.js"></script>
<script src="js/modernizr.custom.js"></script>
<!--webfonts-->
<link href='//fonts.googleapis.com/css?family=Roboto+Condensed:400,300,300italic,400italic,700,700italic' rel='stylesheet' type='text/css'>
<!--//webfonts--> 
<!--animate-->
<link href="css/animate.css" rel="stylesheet" type="text/css" media="all">
<script src="js/wow.min.js"></script>
	<script>
		 new WOW().init();
	</script>
<!--//end-animate-->
<!-- chart -->
<script src="js/Chart.js"></script>
<!-- //chart -->
<!-- Metis Menu -->
<script src="js/metisMenu.min.js"></script>
<script src="js/custom.js"></script>
<link href="css/custom.css" rel="stylesheet"> 
<!--//Metis Menu -->
</head> 
<body class="cbp-spmenu-push">
	<div class="main-content">
		<!--left-fixed -navigation-->
		<div class=" sidebar" role="navigation">
            <div class="navbar-collapse">
				<nav class="cbp-spmenu cbp-spmenu-vertical cbp-spmenu-left" id="cbp-spmenu-s1">
					<ul class="nav" id="side-menu">
						<li>
							<a href="#" class="active"><i class="fa fa-home nav_icon"></i>Home</a>
						</li>
            <? if ($idEnc == 1 or $idEnc == 2 or $idEnc == 3) {?>                
						<li>
							<a href="#"><i class="fa fa-table nav_icon"></i>Produccion <span class="fa arrow"></span></a>
							<ul class="nav nav-second-level collapse">
								<li>
									<a href="mp_utilizada.php">MP Utilizada</a>
								</li>
								<li>
									<a href="mp_calidad.php">Calidad MP</a>
								</li>
				        <li>
				          <a href="tubing.php">Tubing</a>
				        </li>
							</ul>
						</li>          
            <li>
              <a href="#"><i class="fa fa-file-text-o nav_icon"></i>Trabajadores <span class="fa arrow"></span></a>
          <ul class="nav nav-second-level collapse">
            <li>
              <a href="tripales.php">Tripales</a>
            </li>
            <li>
              <a href="plasticos.php">Plasticos</a>
            </li>
          </ul>
            </li>
            <?}?>
            <? if ($idEnc == 1) {?>              
            <li>
              <a href="kardex.php"><i class="fa fa-file-text-o nav_icon"></i>Conciliación Inventario</a>
            </li>
           <li>
            <a href="#"><i class="fa fa-cogs nav_icon"></i>Ajustes<span class="fa arrow"></span></a>
            <ul class="nav nav-second-level collapse">
              <li>
                <a href="#">Trabajador<span class="fa arrow"></a>
                  <ul class="nav nav-second-level collapse">
                  <li>
                    <a href="list.php">&nbsp; Listar</a>
                  </li>
                  <li>
                    <a href="add_op.php">&nbsp; Nuevo</a>
                  </li>                  
                 </ul> 
               </li>
              <li>
                <a href="#">Origenes<span class="fa arrow"></a>
                  <ul class="nav nav-second-level collapse">
                  <li>
                    <a href="list_org.php">&nbsp; Listar</a>
                  </li>
                  <li>
                    <a href="add_mp.php">&nbsp; Nuevo</a>
                  </li>                  
                 </ul> 
              </li>   
            </ul>
      <!-- //nav-second-level -->
            </li>
            <?}?>  
    			</ul>
					<!-- //sidebar-collapse -->
				</nav>
			</div>
		</div>
		<!--left-fixed -navigation-->
		<!-- header-starts -->
		<div class="sticky-header header-section ">
			<div class="header-left">
				<!--toggle button start-->
				<button id="showLeftPush"><i class="fa fa-bars"></i></button>
				<!--toggle button end-->
				<!--logo -->
				<div class="logo">
					<a href="index.php">
						<h1>INSUBAN</h1>
						<span>AdminPanel</span>
					</a>
				</div>
				<!--//logo-->
				<!--search-box -->
				<div class="search-box">
					<form class="input" method="POST" action="">
						<input class="sb-search-input input__field--madoka" type="date" id="input-31" name="fecha_b" value="<?echo $fecha;?>" />
						<label class="input__label" for="input-31">
							<svg class="graphic" width="100%" height="100%" viewBox="0 0 404 77" preserveAspectRatio="none">
								<path d="m0,0l404,0l0,77l-404,0l0,-77z"/>
							</svg>
						</label>                              
				</div>
        <!--//end-search-box-->
			</div>
			<div class="header-left">
				<div class="profile_details_left">
          <input type="submit" name="busca" value="Buscar" class="btn btn-danger">
				</div>        
			 </form>
   <span id="liveclock" style="position:absolute;left:50;top:0; color:blue;" ></span>
   <script language="JavaScript" type="text/javascript">
    function show5(){
        if (!document.layers&&!document.all&&!document.getElementById)
        return

         var Digital=new Date()
         var hours=Digital.getHours()
         var minutes=Digital.getMinutes()
         var seconds=Digital.getSeconds()

        var dn="PM"
        if (hours<12)
        dn="AM"
        if (hours>12)
        hours=hours-12
        if (hours==0)
        hours=12

         if (minutes<=9)
         minutes="0"+minutes
         if (seconds<=9)
         seconds="0"+seconds
        //change font size here to your desire
        myclock="<font size='5' face='Arial' ><b><font size='1'>Hora actual:</font></br>"+hours+":"+minutes+":"
         +seconds+" "+dn+"</b></font>"
        if (document.layers){
        document.layers.liveclock.document.write(myclock)
        document.layers.liveclock.document.close()
        }
        else if (document.all)
        liveclock.innerHTML=myclock
        else if (document.getElementById)
        document.getElementById("liveclock").innerHTML=myclock
        setTimeout("show5()",1000)
         }
        window.onload=show5
         //-->
     </script>	
				<div class="profile_details">		
					<ul>
						<li class="dropdown profile_details_drop">
							<a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
								<div class="profile_img">	
									<span class="prfil-img"><img src="images/ico.png" alt=""> </span> 
									<div class="user-name">
										<p>Hola, <? echo $nombre; ?></p>
										<span><? echo $perfil; ?></span>
									</div>
									<i class="fa fa-angle-down lnr"></i>
									<i class="fa fa-angle-up lnr"></i>
									<div class="clearfix"></div>	
								</div>	
							</a>
							<ul class="dropdown-menu drp-mnu">
								<li> <a href="../modelos/cerrar-sesion.php"><i class="fa fa-sign-out"></i> Salir</a> </li>
							</ul>
						</li>
					</ul>
				</div>			
			</div>
			<div class="clearfix"> </div>	
		</div>
		<!-- //header-ends -->
		<!-- main content start-->
		<div id="page-wrapper">
			<div class="main-page">
				<div class="row-one">
					<div class="col-md-4 col-xs-12 widget">
						<div class="stats-left">
							<h5>Grupo Azul</h5>
							<h4>Unidades</h4>
						</div>
						<div class="stats-right">
							<?if ($tot1 == ""){ $tot1 = 0; }?>
              <label><? echo $tot1; ?></label>
						</div>
						<div class="clearfix"> </div>	
					</div>
					<div class="col-md-4 col-xs-12 widget states-mdl">
						<div class="stats-left">
							<h5>Grupo Amarillo</h5>
							<h4>Unidades</h4>
						</div>
						<div class="stats-right">
              <?if ($tot2 == ""){ $tot2 = 0; }?>
							<label><? echo $tot2; ?></label>
						</div>
						<div class="clearfix"> </div>	
					</div>
					<div class="col-md-4 col-xs-12 widget states-last">
						<div class="stats-left">
							<h5>Grupo Verde</h5>
							<h4>Unidades</h4>
						</div>
						<div class="stats-right">
              <?if ($tot3 == ""){ $tot3 = 0; }?>
							<label><? echo $tot3; ?></label>
						</div>
						<div class="clearfix"> </div>	
					</div>
					<div class="clearfix"> </div>	
				</div>
<!-- /.row -->
<div class="row">
 <div class="col-md-4">
          <div class="box">
            <div class="box-body no-padding">
              <table border class="table table-condensed" style="background-color: white">
                <tr>
                  <th style="background-color: #262ab5; color: white">Origenes</th>
                  <th style="background-color: #262ab5; color: white; width: 40px">Cant.</th>
                </tr>
                <tr>

             <? while ($row6=mysql_fetch_row($query7)) {
                 
                $orgutil1 = $row6[2];
                $mputil1 = $row6[3];

                $dev16+= $mputil1;
                $resultdev16= $sum16-$dev16;
                $precoef16= $sum16/$tot1;
                $coef16= number_format($precoef16, 2,',', '');
                $rest16= $sum16-$tot1;
                $deco16= $rest16-$totcal;               

             echo "<tr class='small'><td>$orgutil1 </td><td><span class='badge bg-green'>$mputil1</span></td></tr> \n"; 
           }

            echo "<tr class='small'><td>CORTOS</td><td><span class='badge bg-green'>$totcal</span></td></tr>";
            echo "<tr class='small'><td>TRIPALES</td><td><span class='badge bg-orange'>$sum16</span></td></tr>";
            echo "<tr class='small'><td>MP RENDIMIENTO</td><td><span class='badge bg-orange'>$resultdev16</span></td></tr>";
            echo "<tr class='small'><td>COEFICIENTE</td><td><span class='badge bg-orange'>$coef16</span></td></tr>";
            echo "<tr class='small'><td>DECOMISO</td><td><span class='badge bg-orange'>$deco16</span></td></tr>";
            ?> 
                </tr>
              </table>
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->
</div>
<div class="col-md-4">
          <div class="box">
            <div class="box-body no-padding">
              <table border class="table table-condensed" style="background-color: white">
                <tr>
                  <th style="background-color: #d5d620; color: white">Origenes</th>
                  <th style="background-color: #d5d620; color: white; width: 40px">Cant.</th>
                </tr>
                <tr>

             <? while ($row6=mysql_fetch_row($query9)) {
                 
                $orgutil2 = $row6[2];
                $mputil2 = $row6[3];  

                $dev13+= $mputil2;
                $resultdev13= $sum13-$dev13;
                $precoef13= $sum13/$tot2;
                $coef13 = number_format($precoef13, 2,',', '');
                $rest13= $sum13-$tot2;
                $deco13= $rest13-$totcal2; 


             echo "<tr class='small'><td>$orgutil2 </td><td><span class='badge bg-green'>$mputil2</span></td></tr> \n"; 
           }

            echo "<tr class='small'><td>CORTOS</td><td><span class='badge bg-green'>$totcal2</span></td></tr>";
            echo "<tr class='small'><td>TRIPALES</td><td><span class='badge bg-green'>$sum13</span></td></tr>";            
            echo "<tr class='small'><td>MP RENDIMIENTO</td><td><span class='badge bg-green'>$resultdev13</span></td></tr>";
            echo "<tr class='small'><td>COEFICIENTE</td><td><span class='badge bg-orange'>$coef13</span></td></tr>";
            echo "<tr class='small'><td>DECOMISO</td><td><span class='badge bg-orange'>$deco13</span></td></tr>";                            
           ?> 
                </tr>
              </table>
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->
</div>
<div class="col-md-4">
          <div class="box">
            <div class="box-body no-padding">
              <table border class="table table-condensed" style="background-color: white">
                <tr>
                  <th style="background-color: #0a9201; color: white">Origenes</th>
                  <th style="background-color: #0a9201; color: white; width: 40px">Cant.</th>
                </tr>
                <tr>

             <? while ($row6=mysql_fetch_row($query12)) {
                 
                $orgutil3 = $row6[2];
                $mputil3 = $row6[3];

                $dev12+= $mputil3;
                $resultdev12= $sum12-$dev12;
                $precoef12= $sum12/$tot3;
                $coef12 = number_format($precoef12, 2,',', '');
                $rest12= $sum12-$tot3;
                $deco12= $rest12-$totcal3;                                                      

             echo "<tr class='small'><td>$orgutil3 </td><td><span class='badge bg-green'>$mputil3</span></td></tr> \n"; 
           }

            echo "<tr class='small'><td>CORTOS</td><td><span class='badge bg-green'>$totcal3</span></td></tr>";
            echo "<tr class='small'><td>TRIPALES</td><td><span class='badge bg-green'>$sum12</span></td></tr>";            
            echo "<tr class='small'><td>MP RENDIMIENTO</td><td><span class='badge bg-green'>$resultdev12</span></td></tr>";
            echo "<tr class='small'><td>COEFICIENTE</td><td><span class='badge bg-orange'>$coef12</span></td></tr>";
            echo "<tr class='small'><td>DECOMISO</td><td><span class='badge bg-orange'>$deco12</span></td></tr>";                            
           ?> 
                </tr>
              </table>
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->
      </div>
      <!-- /.col -->
</div> 
<!-- /.row -->
				<div class="charts">
          <div class="col-md-12 charts-grids widget-shadow" >
            <h4 class="title">Producción Calibres</h4>
            <canvas id="bar" height="100" width="400"> </canvas>
            </div>
        </div>
          <div class="clearfix"> </div>
               <script>
                var barChartData = {
                  labels : ["<?echo $val1;?>","<?echo $val2;?>","<?echo $val3;?>","<?echo $val4;?>","<?echo $val5;?>"],
                  datasets : [
                    {
                      fillColor : "rgba(255, 153, 0, 0.9)",
                      strokeColor : "rgba(255, 153, 0, 0.9)",
                      highlightFill: "#ff9900",
                      highlightStroke: "#ff9900",
                      data : [<?echo $totcal1;?>,<?echo $totcal5;?>,<?echo $totcal6;?>,<?echo $totcal7;?>,<?echo $totcal8;?>]
                    }
                  ]
                  
                };              

              new Chart(document.getElementById("bar").getContext("2d")).Bar(barChartData);
              
              </script>
              
				</div>
  			<div class="row">
					<div class="col-md-4 stats-info widget">
						<div class="stats-title">
							<h4 class="title">Estado Calibres</h4>
						</div>
						<div class="stats-body">
							<ul class="list-unstyled">
<? if ($porcent14 != 0)  {?>
              <? echo	"<li>$cal1 $val1 ($totcal1)<span class='pull-right'><h5>$porcent14 %</h5></span> "?>
									<div class="progress progress-striped active progress-right">
										<div class="bar red" style="width:100%;"></div> 
									</div>
								</li> <?}?>
<? if ($porcent15 != 0)  {?>
							<? echo	"<li>$cal2 $val2 ($totcal5)<span class='pull-right'><h5>$porcent15 %</h5></span> "?>  
									<div class="progress progress-striped active progress-right">
										<div class="bar light-blue" style="width:100%;"></div>
									</div>
								</li> <?}?>
<? if ($porcent16 != 0)  {?>                
							<? echo	"<li>$cal3 $val3 ($totcal6)<span class='pull-right'><h5>$porcent16 %</h5></span> "?> 
									<div class="progress progress-striped active progress-right">
										<div class="bar white" style="width:100%;"></div>
									</div>
								</li> <?}?>
<? if ($porcent17 != 0)  {?>                
							<? echo	"<li>$cal4 $val4 ($totcal7)<span class='pull-right'><h5>$porcent17 %</h5></span> "?> 
									<div class="progress progress-striped active progress-right">
										<div class="bar green" style="width:100%;"></div>
									</div>
								</li> <?}?>
<? if ($porcent18 != 0)  {?>                
							<? echo	"<li>$cal5 $val5 ($totcal8)<span class='pull-right'><h5>$porcent18 %</h5></span> "?> 
									<div class="progress progress-striped active progress-right">
										<div class="bar blue" style="width:100%;"></div>
									</div>
								</li> <?}?>
                <div></div>
                <li class="last">TOTAL TUBING <span class="pull-right"><b><h5><?echo $totplast;?></h5></b></span>  
                  <div >
                    <div></div>
                  </div>
                </li>
                <li class="last">TOTAL CORTOS <span class="pull-right"><b><h5><?echo $totcor;?></h5></b></span>  
                  <div >
                    <div></div>
                  </div>
                </li>
                <li class="last">INDICE GENERAL <span class="pull-right"><strong><h5><?echo $indice;?></h5></strong></span>  
                  <div >
                    <div></div>
                  </div>
                </li>                
							</ul>
						</div>
					</div>
					<div class="col-md-8 stats-info stats-last widget-shadow">
						<table class="table stats-table ">
							<thead>
								<tr>
									<th>MATERIA</th>
									<th>STATUS</th>
									<th>UNIDADES</th>      
								</tr>
							</thead>
							<tbody>
              <?
                while ($row6=mysql_fetch_row($query19)) {
                 
                  $idorg = $row6[0];
                  $org = $row6[1];
                  $mallas = $row6[2];
               
                  echo "<tr>";
                  echo "<td>$org</td>";
                  echo "<td><span class='label label-success'>Entregada</span></td>";
                  echo "<td><h4>$mallas</h4></td>";
                  echo "</tr> \n";              
                }
?>
<tr></tr>
                <tr>
                  <th scope="row"></th>
                  <td>TOTAL MP:</td>
                  <td><span class="label label-warning"></span></td>
                  <td><h4><?echo $totmat;?></h4></td>
                </tr>
							</tbody>
						</table>
</div>
          <div class="col-md-8 stats-info stats-last widget-shadow">
                        <table class="table stats-table ">
              <tbody>           
                <tr>
                  <th scope="row"></th>
                  <td>TOTAL NUDOS:</td>
                  <td><span class="label label-warning"></span></td>
                  <td><h4><?echo $sum5;?></h4></td>
                </tr>

                 <tr>
                  <th scope="row"></th>
                  <td>TOTAL TRIPALES:</td>
                  <td><span class="label label-warning"></span></td>
                  <td><h4><?echo $sum6;?></h4></td>
                </tr>
              </tbody>
            </table>
					</div>
					 <div class="clearfix"> </div>
				</div>
        <!--./col-->
			</div>
      <!--./row-->
		</div>
		<!--footer-->
		<div class="footer">
		   <p>&copy; 2017 Insuban Admin Panel. Derechos Reservados </p>
		</div>
        <!--//footer-->
	</div>
	<!-- Classie -->
		<script src="js/classie.js"></script>
		<script>
			var menuLeft = document.getElementById( 'cbp-spmenu-s1' ),
				showLeftPush = document.getElementById( 'showLeftPush' ),
				body = document.body;
				
			showLeftPush.onclick = function() {
				classie.toggle( this, 'active' );
				classie.toggle( body, 'cbp-spmenu-push-toright' );
				classie.toggle( menuLeft, 'cbp-spmenu-open' );
				disableOther( 'showLeftPush' );
			};
			

			function disableOther( button ) {
				if( button !== 'showLeftPush' ) {
					classie.toggle( showLeftPush, 'disabled' );
				}
			}
		</script>
	<!--scrolling js-->
	<script src="js/jquery.nicescroll.js"></script>
	<script src="js/scripts.js"></script>
	<!--//scrolling js-->
	<!-- Bootstrap Core JavaScript -->
   <script src="js/bootstrap.js"> </script>
</body>
</html>