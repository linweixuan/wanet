<?php

  require_once 'article.php';
  
  //
  // global user post function
  //
  function article_ajax_post()
  {  
    $article = new Article();
	if ($article->parse($_POST)) {
		if ($article->add()) {
			echo "success";
			return;
		}
	}
	echo $user->error;
  }
  
  // ajax request response
  article_ajax_post();
?>