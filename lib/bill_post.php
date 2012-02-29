<?php
    //
    // purchase json post request
    //
    require_once 'db.php';
    require_once 'sales.php';    
        
    $post = json_decode($_REQUEST['data'], true); 
    
    // serialize the post data to file
    $fp = fopen("bill_post.dat", "w");
    fwrite($fp, $_REQUEST['data']);
    fclose($fp);
    
    // dump the post object data to file
    $output = print_r($post, true);
    $fp = fopen("bill_post.log", "w");
    fwrite($fp, $output);
    fclose($fp);

    // purchase company post data 
    $bill = new Sales;
    $bill->save($post);
    $post['type'] = 'buy';
        
    //$json['data'] = "部件信息已经成功保存!"; 
    //$result = json_encode($json);
    //echo $result;

?>