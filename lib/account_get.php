<?php   
    // company get  request
    require_once '../lib/account.php';

    // handle the $_GET["id"] query
    function get_account_by_id() {
        $obj = new Account;
        $obj->fetch();
    }
    
    // display <div id="get" style="display:none"></div>
    get_account_by_id();
?>