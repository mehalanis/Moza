function Sidegrande() {
  document.getElementById("sidebar").style.width ="200px";
  document.getElementById("sidebaruserinfo").style.opacity="1";
}
function SideMini() {
  document.getElementById("sidebar").style.width="55px";
  document.getElementById("sidebaruserinfo").style.opacity="0";
}
function SwitchSideBar() {
  var sidebar=document.getElementById("sidebar");
  var side_bar_user_info=document.getElementById("sidebaruserinfo");
  if(side_bar_user_info.style.opacity=="1"){
    SideMini();
  }else{
    Sidegrande();
  }
}
function OpenSubMenu(nom) {
  CloseSubMenu();
  if(document.getElementById(nom+"_submenu").style.height==0){
    document.getElementById(nom+"_submenu").className+="sidebar_submenu_active";
  }
}
function CloseSubMenu() {
  var list_submenu=document.getElementsByClassName("sidebar_submenu");
  for (var i = 0; i < list_submenu.length; i++) {
  list_submenu[i].className="sidebar_submenu ";
  }
}
