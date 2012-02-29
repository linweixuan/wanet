<?php
  require_once 'common.php';
  require_once 'functions.php';
  require_once 'db.php';
  
  class Paging
  {
	public $total;
	public $size;
	public $page;
	public $count;
	public $url;
	public $start;
	public $end;
	public $limit;

	function __construct($total=0, $size=1, $page=1, $url)
	{
		$this->total = $this->numeric($total);
		$this->size = $this->numeric($size);
		$this->page = $this->numeric($page);
		
		// next page start
		$this->limit = ($this->page * $this->size) - $this->size; 
		$this->url = $url;
		
		// current page less 1
		if ($this->page < 1)
			$this->page = 1;
		
		if ($this->total < 0)
			$this->page = 0;
			
		// pages total count
		$this->count = ceil($this->total/$this->size);		
		if ($this->count < 1)
			$this->count = 1;
			
		if ($this->page > $this->count)
			$this->page = $this->count;

		$this->start = $this->page - 2;
		$this->end = $this->page + 2;

		if ($this->start < 1)
			$this->start = 1;
			
		if ($this->end > $this->count)
			$this->end = $this->count; 
	}
	
    function __destruct()
	{
	}
		
	public function numeric($value)
	{ 
		if (strlen($value)){
			if (!ereg("^[0-9]+$",$value)) 
				$$value = 1;
		}else{
			$value = 1;
		}
		return $value;
	}
	
	// replace page address
	private function page_replace($page)
	{
		return str_replace("{page}", $page, $this->url);
	}
	
	// first page
	private function home()
	{ 		
		return "<span title=\"首页\"><b><a href=\"".$this->page_replace(1) ."\">首页</a></b></span>";
	}
	
	// previous page
	private function prev()
	{ 
		if($this->page){
			return "<span title=\"上一页\"><b><a href=\"".$this->page_replace($this->page-1) ."\">上一页</a></b></span>";
		}else{
			return "<span title=\"上一页\"><b><a href=\"".$this->page_replace(1) ."\">上一页</a></b></span>";
		}		
	}
	
	// next page
	private function next()
	{ 	
		if($this->page < $this->count){
			return "<span title=\"下一页\"><b><a href=\"".$this->page_replace($this->page+1) ."\">下一页</a></b></span>";
		}else{
			return "<span title=\"下一页\"><b><a href=\"".$this->page_replace($this->count) ."\">下一页</a></b></span>";
		}
	}
	
	// last page
	private function last()
	{
		return "<span title=\"尾页\"><b><a href=\"".$this->page_replace($this->count) ."\">尾页</a></b></span>";
	}
	
  	function show($id='pages')
	{
		$str .= "<div class=\"pages\">";
		
		// first page, not dispaly home and prev
		if($this->page >= 1) {
			$str .= $this->home();
			$str .= $this->prev();
		}
		
		// display pages number
		for($page_for_i=$this->start;$page_for_i <= $this->end; $page_for_i++){
			if($this->page == $page_for_i){
				$str .= "<strong><b>".$page_for_i."</b></strong>";
			}
			else{
				$str .= "<a href=\"".$this->page_replace($page_for_i)."\" title=\"第".$page_for_i."页\">";
				$str .= $page_for_i . "</a>\n";
			}
		}
		
		// last page, not display
		if($this->page <= $this->count) {
			$str .= $this->next();
			$str .= $this->last();
		}
		
		$str .= "</div>";
		echo $str;
	}
	 	
  }
?>