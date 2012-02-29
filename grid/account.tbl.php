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
    
    // get the table row count
    $result = mysql_query("SELECT COUNT(*) AS count FROM account");
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

    // query the table fields
    $SQL = "SELECT * FROM account ORDER BY $sidx $sord LIMIT $start , $limit";
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
            $row[fullname],
            $row[role],
            $row[phone],
            $row[email],
            $row[qq],
            $row[date]
        );
        $i++;
    }
    echo json_encode($responce);

?>
