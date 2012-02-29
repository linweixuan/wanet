<?php
  require_once 'smarty.php';

  $smarty->assign("title", "leapsoul.cn为你展示smarty模板技术");
  $smarty->assign("content", "leapsoul.cn通过详细的安装使用步骤为你展示smarty模板技术");
  $smarty->display("test.tpl");
?>