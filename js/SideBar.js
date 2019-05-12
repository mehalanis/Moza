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
