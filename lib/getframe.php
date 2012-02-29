<?php
    // web page redirection
    function getframe()
    {
        $url = "sale.html";
        if(isset($_GET["go"])){
            $url = $_GET['go'];
        }
        echo $url;
    }
?>