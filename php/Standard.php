<?php
function CSS()
{
	include 'html/css.html';
}
function Sidebar()
{
	include 'html/sidebar.html';
}
function NavBar()
{
	include 'html/navbar.html';
}
function testEmpty($v)
{
  if(empty($v)){ return 0;}else{ return $v;}
}
function printitem($id,$page,$style,$get){
   echo "<li class='$style'><a href='$page?".$get."page=$id'>$id</a></li>";
}
function FilterGET($GET)
{
	$k="";
	foreach ($GET as $key => $value) {
	 if($key!="page"){ 	$k.=$key."=".$value."&";}
	}
	return $k;
}
function TableBar($numpage,$nompage,$GET,$sql)
{
	  $GET=FilterGET($GET);
    echo "<li class='suivprec'>";
    if($numpage>1){
          $precedant=$numpage-1;
          echo "<a href='$nompage?".$GET."page=$precedant'><img src='img/icon/precedant.png'/></a></li>";
          printitem($precedant,$nompage,"listitem",$GET);
          printitem($numpage,$nompage,"itemactiv",$GET);
    }else{
        echo "<a href='$nompage?".$GET."page=1'><img src='img/icon/precedant.png'/></a></li>";
        printitem(1,$nompage,"itemactiv",$GET);
    }
    $pagesuivant=$numpage*10;
    $database=new database();
    $result=$database->query($sql." limit $pagesuivant ,2");
    if($numpage>1){$suivant=$numpage;}else{$suivant=1;}
    if(mysqli_num_rows($result)>0){
      $suivant++;
      printitem($suivant,$nompage,"listitem",$GET);
    }
      echo "<li class='suivprec'><a href='$nompage?".$GET
			."page=$suivant'><img src='img/icon/suivant.png'/></a></li>";
}
?>
