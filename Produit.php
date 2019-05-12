<!DOCTYPE html>
<?php
include 'php/Standard.php';
require 'php/database.inc';
require 'php/Produit.inc';
$database=new database();
require 'php/VerifierUser.php';
if(isset($_POST["Delete"])){
  foreach ($_POST["Delete"] as $key => $id_produit) {
    $database->query("DELETE FROM `produit` WHERE id_produit=".$id_produit);
  }
}
$where="";
if(isset($_POST["rech"])){
  $where=" where nom like '%".$_POST["rech"]."%'";
}
if(isset($_GET['page'])){ $page=$_GET['page'];}else{$page=1;}
$debut=$page*10-10;
$sql="select * from produit $where";
$result=$database->query($sql." limit $debut ,10 ");
$listproduit=array();
while ($row=mysqli_fetch_assoc($result)) {
  $listproduit[]=new Produit($row["id_produit"],$row["nom"],"");
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
            Produit
          </label>
        </div>
        <div class="table">
          <form class="" action="Produit.php" method="post">
          <div class="bartable">
              <a href="ProduitControle.php"><img src="img/icon/add32pxgreen.png" alt=""></a>
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
                  <th width="15"><input type="checkbox" id="checkbox_all" onclick="SelecteAll()" name=""></th>
                  <th>Nom</th>
                  <th>Operation</th>
                </tr>
              </thead>
              <tbody>
                <?php foreach ($listproduit as $key => $value): ?>
                  <tr>
                    <td><input type="checkbox" class="remove_list" value="<?php echo $value->id; ?>" name="Delete[]"/></td>
                    <td><?php echo $value->nom; ?></td>
                    <td>
                      <a href="ProduitControle.php?idproduit=<?php echo $value->id; ?>" class="produitbtn produitbtnedit">
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
                  TableBar($page,"Produit.php",$_GET,$sql);
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
