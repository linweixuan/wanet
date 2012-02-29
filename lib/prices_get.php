<?php
    //
    // sales json post request
    //
    require_once 'db.php';
    require_once 'part.php';    
    
    $partid = $_REQUEST['part'];
    $companyid = $_REQUEST['company'];
    
    // dump the post object data to file
    $output = print_r($_REQUEST, true);
    $fp = fopen("prices_get.log", "w");
    fwrite($fp, $output);
    fclose($fp);

    // query company part price history
    $part = new Part;
    $part->get_sale_prices($companyid, $partid);

    //$json['data'] = "部件信息已经成功保存!"; 
    //$result = json_encode($json);
    //echo $result;

?>