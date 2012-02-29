<?php
    // part json post request
    require_once 'db.php';
    require_once 'part.php';    
    
    $post = json_decode($_REQUEST['data'], true); 

    // serialize the post data to file
    $fp = fopen("part_post.dat", "w");
    fwrite($fp, $_REQUEST['data']);
    fclose($fp);
    
    // dump the post object data to file
    $dump = print_r($post, true);
    $fp = fopen("part_post.log", "w");
    fwrite($fp, $dump);
    fclose($fp);

    //  save company post data 
    $part = new Part;
    $part->save($post);
    
    //$json['data'] = "部件信息已经成功保存!"; 
    //$result = json_encode($json);
    //echo $result;
?>