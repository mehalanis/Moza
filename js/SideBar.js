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
    CloseSubMenu();
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
  var dropdown = document.getElementsByClassName("dropdown-container");
  for (var i = 0; i < dropdown.length; i++) {
    dropdown[i].style.display="none";
  }
}
