<?php   
    // company get  request
    require_once './lib/bill.php';

    // handle the $_GET["id"] query
    function get_bill_by_id() {
        $bill = new Bill;
        $bill->fetch();
    }
    
    // display <div id="get" style="display:none"></div>
    get_bill_by_id(); 
?>