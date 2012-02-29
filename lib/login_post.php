<?php
    //
    // sales json post request
    //
    require_once 'db.php';
    require_once 'account.php';    
        
    $post = json_decode($_REQUEST['data'], true); 

    // serialize the post data to file
    $fp = fopen("login_post.dat", "w");
    fwrite($fp, $_REQUEST['data']);
    fclose($fp);
    
    // dump the post object data to file
    $output = print_r($post, true);
    $fp = fopen("login_post.log", "w");
    fwrite($fp, $output);
    fclose($fp);

    // save company post data 
    $account = new Account;
    $account->auth($post);

?>