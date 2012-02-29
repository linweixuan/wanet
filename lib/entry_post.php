<?php
    //
    // sales json post request
    //
    require_once 'db.php';
    require_once 'sales.php';    
        
    $post = json_decode($_REQUEST['data'], true); 

    // serialize the post data to file
    $fp = fopen("sales_post.dat", "w");
    fwrite($fp, $_REQUEST['data']);
    fclose($fp);
    
    // dump the post object data to file
    $output = print_r($post, true);
    $fp = fopen("sales_post.log", "w");
    fwrite($fp, $output);
    fclose($fp);

    // save company post data 
    $sale = new Sales;
    $post['type'] = 'entry';
    $sale->save($post);
        
    //$json['data'] = "部件信息已经成功保存!"; 
    //$result = json_encode($json);
    //echo $result;

?>