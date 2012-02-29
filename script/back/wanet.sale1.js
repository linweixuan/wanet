//
// GF sales json
//
function Sales() {
    this.id = '';
    this.companyid = '';
    
    // display fields
    this.company = '';
    this.address = '';
    //this.parts = new Array();
    this.num = '';
    this.book = '';
    this.sheet = '';
    this.operator = '';
    this.date = '';
    this.total = '';
    
    this.post = function() {
            
        $('.result').html("正在保存数据...");           
        var request = $.toJSON(this);        
            ajax_swap();
            /*
			$.ajax({
				// try to leverage ajaxQueue plugin to abort previous requests
				mode: "sync",
				// limit abortion to this input
				port: "sale",
                type: "post",
				dataType: "json",
				url: "lib/part_post.php",
				data: request,
				success: function(data) {
                    alert(data);
				}
			});
            */
            
      
        $.post(
            "lib/part_post.php",
            {data: request},
            function(resp, state){
                if(state == "success"){
                    $('.result').html(resp.data);
                }
                else
                    $('.result').html("数据保存失败!");                
            },
            "json"
        );
      
    };

}


function ajaxpost1() {
    var sale = new Sales();
    sale.post();
}


$(document).ready(function () {
      
});
