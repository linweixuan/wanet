//
// wanet search configurations
//
$().ready(function() {

	function log(event, data, formatted) {
		$("<li>").html( !data ? "No match!" : "Selected: " + formatted).appendTo("#result");
	}
	
	function formatItem(row) {
        if( $.trim(row[1]) == "") 
		return row[0];
        else
        return row[0] + "(" + row[1] + ")";
	}
	function formatResult(row) {
		return row[0].replace(/(<.+?>)/gi, '');
	}

	$("#key").autocomplete('http://www.wanet.cn/lib/search.php', {
		width: 345,
        max: 11,
		multiple: true,
        scrollHeight: 350,
		matchContains: true,
		formatItem: formatItem,
		formatResult: formatResult
	});
	
	$(":text, textarea").result(log).next().click(function() {
		$(this).prev().search();
	});

	$("#key").result(function(event, data, formatted) {
		var hidden = $(this).parent().next().find(">:input");
		hidden.val( (hidden.val() ? hidden.val() + ";" : hidden.val()) + data[1]);
	});

	$("#clear").click(function() {
		$(":input").unautocomplete();
	});
  
    /* 
    $("#query").click(function(){
      $.post("query.php", 
      { 
        key:$("#key").val()
      }, 
      
      function(data){
        //$(".content").val(data);
        alart(data);
      });
	
    })
    */
});


