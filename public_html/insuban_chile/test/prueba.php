<?
echo "COMENZAMOS!!<br>";

// open in read-only mode
$db = dbase_open('fajas.dbf', 0);

if ($db) {
  // read some data ..
  echo "WAAA";
  dbase_close($db);
}
else
{
echo "NOOOOOO";
}

?> 
