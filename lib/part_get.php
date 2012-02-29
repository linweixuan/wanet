<?php   
    // company get  request
    require_once './lib/part.php';

    // handle the $_GET["id"] query
    function get_part_by_id() {
        $part = new Part;
        $part->fetch();
    }
    
    // display <div id="get" style="display:none"></div>
    get_part_by_id();
?>