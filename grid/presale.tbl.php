<?php
    include("dbconfig.php");

    $page = $_GET['page']; // get the requested page
    $limit = $_GET['rows']; // get how many rows we want to have into the grid
    $sidx = $_GET['sidx']; // get index row - i.e. user click to sort
    $sord = $_GET['sord']; // get the direction
    
    if(!$sidx) $sidx =1;

    // connect to the database
    $db = mysql_connect($dbhost, $dbuser, $dbpassword)
    or die("Connection Error: " . mysql_error());

    mysql_select_db($database)
    or die("Error conecting to db.");
    mysql_query("set names 'utf8'");
    
    $condition = 'type = 2';
    if(isset($_GET["year"])){
        $year = $_GET['year'];
        $condition = $condition.' AND year(date)='.$year;
    }
    if(isset($_GET["month"])){
        $month = 'month(date)='.$_GET['month'];
        $condition = $condition.' AND '.$month;
    }
        
    // get the table row count
    $SQL = "SELECT COUNT(*) AS count FROM bills ".$condition;        
    $result = mysql_query($SQL);
    $row = mysql_fetch_array($result,MYSQL_ASSOC);
    $count = $row['count'];

    if( $count >0 ) {
        $total_pages = ceil($count/$limit);
    } else {
        $total_pages = 0;
    }

    if ($page > $total_pages)
        $page=$total_pages;

    // do not put $limit*($page - 1)
    $start = $limit*$page - $limit;
    if($start <0 ) $start = 0;

    // query the table fields
    //$SQL = "SELECT * FROM bills ".$condition.
    //       " ORDER BY $sidx $sord LIMIT $start , $limit";
           
    $SQL = " SELECT bills.company, bills.*, company.name FROM bills".
           " INNER JOIN company ON bills.company = company.id".
           " WHERE ".$condition.
           " ORDER BY $sidx $sord LIMIT $start , $limit";
    
    $fp = fopen("grid_post.dat", "w");
    fwrite($fp, $SQL);
    fclose($fp); 
    
    $result = mysql_query( $SQL ) or die("Couldn t execute query.".mysql_error());

    $responce->page = $page;
    $responce->total = $total_pages;
    $responce->records = $count;

    // get rows from database
    $i=0;
    while($row = mysql_fetch_array($result,MYSQL_ASSOC)) {
        $responce->rows[$i]['id']=$row[id];
        $responce->rows[$i]['cell']=array(
            $row[id],
            $row[name],
          //  $row[company],
          //  $row[operator],
            $row[num],
            $row[total],
          //  $row[book],
          //  $row[sheet],
            $row[date],
            $row[memo]
        );
        $i++;
    }
    echo json_encode($responce);

?>
