<?php
  //
  // global oder serise number function
  //
  function generate_order_number()
  {
    $year_code = array('A','B','C','D','E','F','G','H','I','J');
    $order_sn = $year_code[intval(date('Y'))-2010].
        strtoupper(dechex(date('m'))).date('d').
        substr(time(),-5).substr(microtime(),2,5).sprintf('%02d',rand(0,99));
    echo $order_sn;
  }

?>
  