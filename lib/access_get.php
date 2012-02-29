<?php   
    // company get  request
    require_once '../lib/access.php';

    // handle the $_GET["id"] query
    function get_access_by_id() {
        $obj = new Access;
        $obj->fetch();
    }
    
    // display <div id="get" style="display:none"></div>
    get_access_by_id();
?>