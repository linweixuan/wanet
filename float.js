// 部件根菜单项点击赋值
$(function(){
  $(".class_nav a").click(function(){
    $("#querypart").attr("value",this.text);
    return false;
  })
})

// 部件子菜单项点击赋值
$(function(){
  $(".psubmenu a").click(function(){
    //alert(this.text);
    document.queryfrom.part.value = this.text;
    //$("#querypart").attr("value",this.text);
    $.powerFloat.hide();
    return false;
  })
})

// 显示部件子菜单
function submenu_float(id) {
	  $("#pc1").powerFloat({eventType: "click"});