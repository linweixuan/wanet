<?php   
    // company get request
    require_once './lib/company.php';
    
    // handle the $_GET["id"] query
    function get_company_by_id() {
        $com = new Company;
        $com->fetch();
    }
    
    // display <div id="get" style="display:none"></div>
    get_company_by_id();
?>