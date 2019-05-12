<!DOCTYPE html>
<?php
include 'php/Standard.php';
require 'php/database.inc';
require 'php/ProduitPrixType.inc';
$database=new database();
require 'php/VerifierUser.php';
if(isset($_POST["Delete"])){
  foreach ($_POST["Delete"] as $key => $id) {
    if($id!="1") {
      $database->query("DELETE FROM `produit_prix_type` WHERE id_produit_prix_type=".$id);
    }
  }
}
if(isset($_GET["page"])){$page=$_GET["page"]; }else{$page=1;}
$debut=$page*10-10;
$where="";
if(isset($_POST["rech"])){
  $where=" where nom like '%".$_POST["rech"]."%'";
}
$sql="select * from produit_prix_type $where";
$result=$database->query($sql." limit $debut ,10");
$listVehicule=array();
while ($row=mysqli_fetch_assoc($result)) {
  $listVehicule[]=new ProduitPrixType($row["id_produit_prix_type"],$row["nom"]);
}
?>

<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title></title>
    <script src="js/standrad.js">

    </script>
    <?php CSS();?>
  </head>
  <body>
    <?php NavBar(); ?>
    <div class="page">
      <?php Sidebar(); ?>
      <div class="detail">
        <div class="titre_bar">
          <label for="" class="titre_bar_label">
            <a href="index.php"><img src="img/icon/back_bleu_40px.png" alt=""></a>
            Offres
          </label>
        </div>
        <div class="table">
          <form class="" action="ProduitPrixType.php" method="post">
          <div class="bartable">
              <a href="ProduitPrixTypeControle.php"><img src="img/icon/add32pxgreen.png" alt=""></a>
              <button type="submit" class="btn_remove_all" name="button"><img src="img/icon/remove32px.png" alt=""></button>
          </div>
          <div class="divtable">
            <div class="barrecherche">
              <input type="text" name="rech" value="">
              <button type="submit"><img src="img/icon/search24pxwhite.png"></button>
            </div>
            <table class="infotable">
              <thead>
                <tr>
                  <th><input type="checkbox" id="checkbox_all" onclick="SelecteAll()"  name=""></th>
                   <th>Nom</th>
                   <th>Operation</th>
                </tr>
              </thead>
              <tbody>
                <?php foreach ($listVehicule as $key => $value): ?>
                    <tr>
                      <td width="25"><input type="checkbox" value="<?php echo $value->id; ?>" class="remove_list" name="Delete[]"></td>
                      <td><?php echo $value->nom; ?></td>
                      <td>
                        <a href="ProduitPrixTypeControle.php?idproduit_prix_type=<?php echo $value->id; ?>" class="produitbtn produitbtnedit">
                          Detail
                        </a>
                      </td>
                    </tr>
                  <?php endforeach; ?>
              </tbody>
            </table>
            <div class="tableinfo">
              <ul class="listinfo">
                <?php
                  TableBar($page,"ProduitPrixType.php",$_GET,$sql);
                ?>
              </ul>
            </div>
          </div>
          </form>
        </div>
      </div>
    </div>
  </body>
</html>
