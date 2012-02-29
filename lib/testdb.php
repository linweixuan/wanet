<?php
   /*
  $link=mysql_connect(localhost,root,"ilovedearlwx");
  if(!$link) echo "失败!";
  else echo "成功!";
  mysql_close();
      */
    $mysql_server_name="sql200.byethost3.com";
    $mysql_username="b3_8959256";
    $mysql_password="Lwx76120";
    $mysql_database="b3_8959256_wjdb";
   
    $conn=mysql_connect($mysql_server_name, $mysql_username,
                        $mysql_password);
   
    $strsql="select * from user";
    $result=mysql_db_query($mysql_database, $strsql, $conn);
    $row=mysql_fetch_row($result);
   
    echo '<font face="verdana">';
    echo '<table border="1" cellpadding="1" cellspacing="2">';

    echo "\n<tr>\n";
    for ($i=0; $i<mysql_num_fields($result); $i++)
    {
      echo '<td bgcolor="#000F00"><b>'.
      mysql_field_name($result, $i);
      echo "</b></td>\n";
    }
    mysql_num_rows($result);
    echo "</tr>\n";
    mysql_data_seek($result, 0);
    while ($row=mysql_fetch_row($result))
    {
      echo "<tr>\n";
      for ($i=0; $i<mysql_num_fields($result); $i++ )
      {
        echo '<td bgcolor="#00FF00">';
        echo "$row[$i]";
        echo '</td>';
      }
      echo "</tr>\n";
    }
   
    echo "</table>\n";
    echo "</font>";
    mysql_free_result($result);
    mysql_close(); 

?>