<?php
    require_once '../lib/db.php';

    $page = $_GET['page']; // get the requested page
    $limit = $_GET['rows']; // get how many rows we want to have into the grid
    $sidx = $_GET['sidx']; // get index row - i.e. user click to sort
    $sord = $_GET['sord']; // get the direction

    if(!$sidx) $sidx =1;

    // get the table row count
    $db = GLOBALDB();
    $sql = "SELECT COUNT(*) AS count FROM parts";
    $result = $db->query($sql);
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
    $sql = "SELECT * FROM parts ORDER BY $sidx $sord LIMIT $start , $limit";
    $result = $db->query($sql);

    $responce->page = $page;
    $responce->total = $total_pages;
    $responce->records = $count;

    // get rows from database
    $i=0;
    while($row = mysql_fetch_array($result,MYSQL_ASSOC)) {
        $responce->rows[$i]['id']=$row[id];
        $responce->rows[$i]['cell']=array(
            $row[id],
            //$row[catalog],
            //$row[series],
            //$row[model],
            $row[name],
            $row[partno],
            $row[code],
            //$row[ename],
            //$row[alias],
            //$row[pinyin],
            $row[spec],
            $row[quantity],
            $row[price],
            $row[totals]
        );
        $i++;
    }
    echo json_encode($responce);
?>
