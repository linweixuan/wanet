//
// GF sales search
//

function set_query_url(query) {
    jQuery("#tblobj").jqGrid("setGridParam", {
        url: query,
        datatype: "json"
    }).trigger('reloadGrid');
}

function set_water_mark() {
    $("#company").watermark({gray:"#ccc",black:"#000",tip:"客户.."});
    $("#part").watermark({gray:"#ccc",black:"#000",tip:"部件.."});
    $("#billno").watermark({gray:"#ccc",black:"#000",tip:"单号.."});
    $("#price").watermark({gray:"#ccc",black:"#000",tip:"价格.."});
    $("#date").watermark({gray:"#ccc",black:"#000",tip:"时间.."});
}

// submit button click
function adsearch(){
    var company = $("#company").val();
    var part = $("#part").val();
    var billno = $("#billno").val();
    var price = $("#price").val();
    var date = $("#date").val();

    // build query string
    var query = 'sale.tbl.php?company='+company;
    alert(query);
    set_query_url(query);
    return false;
}

$(document).ready(function () {
    // set search water mark
    set_water_mark();
    
    
});
