function SelecteAll() {
  var list=document.getElementsByClassName('remove_list');
  var bool=document.getElementById("checkbox_all").checked;
  for(var i=0; i<list.length;i++){
    list[i].checked=bool;
  }
}
function Tab(nom) {
  var list_label=document.getElementsByClassName("nav_tab_item");
  var list_div=document.getElementsByClassName("nav_tab_div");
  for (var i = 0; i < list_label.length; i++) {
  list_label[i].className="nav_tab_item ";
}
for (var i = 0; i < list_div.length; i++) {
  list_div[i].className="nav_tab_div ";
}
document.getElementById(nom+"_label").className+="nav_tab_item_active";
document.getElementById(nom+"_div").className+="nav_tab_div_active";
}
