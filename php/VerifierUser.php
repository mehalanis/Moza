<?php
session_start();
if((!isset($_SESSION['username']))||(!isset($_SESSION['password']))){ header("location: Login.php");}
/*else{
    $database=new database();
    $result=$database->query("select * from user where email='".$_SESSION['username']."' and password='".$_SESSION['password']."'");
    $cpt=0;
    while ($row=mysqli_fetch_assoc($result)) {
    	$cpt++;
    }
    if($cpt==0){ header("location: Login.php"); }
}*/
?>
