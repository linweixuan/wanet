<?php
    //
    // Access json post request
    //
    require_once 'db.php';
    require_once 'account.php';
        
    $post = json_decode($_REQUEST['data'], true); 

    // serialize the post data to file
    $fp = fopen("account_post.dat", "w");
    fwrite($fp, $_REQUEST['data']);
    fclose($fp);
    
    // dump the post object data to file
    $output = print_r($post, true);
    $fp = fopen("account_post.log", "w");
    fwrite($fp, $output);
    fclose($fp);

    // save access object post data 
    $obj = new Account;
    $obj->save($post);
        
    //$json['data'] = "账户信息已经成功保存!"; 
    //$result = json_encode($json);
    //echo $result;

?>