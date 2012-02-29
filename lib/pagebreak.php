<?php 

  class Pagebreak 
  {
	private $page; //page number
	private $numPages; //number of total pages
	private $textarray = array(); // array of conents
	private $pageCont; //current page content
    
	public function __construct(){
		$this->page = $_GET['page'];
		if (!isset($_GET['page'])) {
		$this->page = 0;
		}
	}
    
	public function splitText($pageCont){
		$this->textarray = spliti('[more]', $pageCont);
		$this->numPages = count($this->textarray);
	}
    
	public function setPage(){
		$this->pageCont = $this->textarray[$_GET['page'] -1];
	}
    
	public function getContent(){
		if($this->page != 0){
		echo $this->pageCont;
		} else {
		echo $this->textarray[0];
		}
	}
    
	public function getPageLinks(){
		echo "<p>n";
		//prev page
		//if page number is more then 1 show previous link
		if ($this->page > 1) {
			$prevpage = $this->page - 1;
			echo "<a href="?page=$prevpage">". 'Previous Page</a> ';
		}
		//page numbers
		for($i = 1; $i <= $this->numPages ; $i++){
			if($this->numPages > 1){ // if more then 1 page show links
				if(($this->page) == $i){ //if page number is equal page number in loop don't link it
					echo "$in ";
					} else {
							if($this->page == 0){ //if no page numbers have been clicked don't link first page link
								if($i == 1){
									echo "$in ";
								} else { // link the rest
									echo "<a href="?page=$i">$i</a>n ";
							    }
						   } else { // link pages
								echo "<a href="?page=$i">$i</a>n ";
							}
				    }
			}
		}
		//next page
		//if page number is less then the total number of pages show next link
		if ($this->page <= $this->numPages - 1) {
			if($this->page == 0){ //if no page numbers have been clicked minus 2 from the next page link
				$nextpage = $this->page + 2;
			} else {
				$nextpage = $this->page + 1;
				}
				echo "<a href="?page=$nextpage">". 'Next Page</a>';
		}
		echo "</p>n";
	}
  }

$content = "<p><strong>The UK has suffered its coldest night of the winter so far with temperatures plummeting to -22.3C (-8.1F) in a village in Sutherland in the Highlands.</strong></p>
 
<p>Overnight temperatures of -10C (14F) were widespread, leaving commuters again battling icy roads and pavements amid &quot;stretched&quot; road salt supplies.</p>
 
[more]
 
<p>Many schools remain shut, with rail and air travel again hit by delays. Fresh snow is falling in eastern England. </p>
 
<p>The weekend could be colder, as another week of Arctic conditions is forecast. </p>
 
[more]
 
<p>Up to 4,000 homes are without water after a main burst outside the Royal Berkshire Hospital in Reading. The hospital was largely unaffected. </p>
 
<p>Thousands of schools remain shut, with warnings that some exam candidates could have to wait five months to sit GCSE and A-level modules in England, Wales and Northern Ireland if weather prevents them taking them next week. </p>
 
<p>Exams watchdog Ofqual said in cases where candidates would not have a second chance to sit papers in the summer, applications could be made for &quot;special consideration&quot;. </p>
 
[more]
 
<p>This involves pupils disadvantaged by circumstances being awarded up to an extra 5% of the maximum marks. </p>
 
<p>Milk deliveries have also been disrupted, with tankers struggling to reach dairy farms. </p>
 
<p>Some farmers have had to dump supplies as few have storage facilities to hold more than a day's stock.</p>
 
<!-- Inline Embbeded Media -->
 
<!-- This is the embedded player component -->
 
<!-- end of the embedded player component -->
 
<!-- END of Inline Embedded Media -->
 
<p>Easyjet has cancelled about 30 flights at airports including Gatwick, Liverpool, Belfast and Stansted, while Norwich Airport has been closed. </p>
 
<p>British Airways said passengers should check the status of their flight before leaving for the airport. </p>
 
<p>Overnight it had asked passengers on some flights arriving at Heathrow's Terminal 5 to leave without their luggage, with bags being sent on to them later. </p>
 
[more]
 
<p>Train companies operating revised timetables include East Coast, ScotRail, First Great Western, South West Trains, Southern and Southeastern. </p>
 
<p>The breakdown of a train travelling from Brussels to London in the Channel Tunnel on Thursday has affected Eurostar services. </p>
 
<p>Supplies of road grit are close to running out in some areas, and many councils are restricting gritting to major roads. </p>
 
<p>Thieves using a lorry with heavy lifting-gear have stolen a grit bin with two tonnes of salt intended for streets and footpaths from a road in Newton Mearns outside Glasgow. </p>
 
<p>The Local Government Association admitted reserves were &quot;stretched&quot;, while the government is helping suppliers prioritise areas most in need.</p>";

//$content = file_get_contents('testcut.html');  
$paginate = new Pagebreak();
$paginate->splitText($content);
$paginate->setPage();
$paginate->getContent();
$paginate->getPageLinks();

?> 