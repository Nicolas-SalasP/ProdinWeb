<?php
class MysqlFunciones{
    public static function DesplegarTabla($a)
     {
        $query =  mysql_query($a);
        echo "<table border><tr>";
            for($i=0;$i<mysql_num_fields($query);$i++)
                {
                    echo "<td>".mysql_field_name($query,$i)."</td>";
                }
       
        while ($row=mysql_fetch_assoc($query)) {
            echo "</tr><tr>";
            for($i=0;$i<mysql_num_fields($query);$i++)
                {
                    echo "<td>".$row[mysql_field_name($query,$i)]."</td>";
                }
            echo "</tr>";
        }    
        echo "</table>";
    }
}
?>