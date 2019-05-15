<!DOCTYPE html>
<?php
include 'php/Standard.php';
require 'php/database.inc';
require 'php/VerifierUser.php';
$database=new database();
if(isset($_POST["Delete"])){
  foreach ($_POST["Delete"] as $key => $id_produit_marge) {
    $database->query("DELETE FROM `produit_marge` WHERE id_produit_marge=".$id_produit_marge);
  }
}
if(isset($_GET["page"])){$page= $_GET["page"];}else{ $page=1;}
$debut=$page*10-10;
$where="";
if(isset($_POST["rech"])){
  $where=" where nom like '%".$_POST["rech"]."%'";
}
$sql="select * from produit_marge $where";
$result=$database->query($sql." limit $debut , 10");
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
            Marge
          </label>
        </div>
        <div class="table">
          <form class="" action="ProduitMarge.php" method="post">
          <div class="bartable">
              <a href="ProduitMargeControle.php"><img src="img/icon/add32pxgreen.png" alt=""></a>
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
                  <th>Benefice</th>
                  <th>Operation</th>
                </tr>
              </thead>
              <tbody>
                <?php while ($row = mysqli_fetch_assoc($result)): ?>
                  <tr>
                    <td><input type="checkbox" class="remove_list" value="<?php echo $row["id_produit_marge"]; ?>" name="Delete[]"/></td>
                    <td><?php echo $row["nom"]; ?></td>
                    <td><?php echo $row["benefice"]; ?></td>
                    <td>
                      <a href="ProduitMargeControle.php?id_produit_marge=<?php echo $row["id_produit_marge"]; ?>" class="produitbtn produitbtnedit">
                        Detail
                      </a>
                    </td>
                  </tr>
                <?php endwhile; ?>
              </tbody>
            </table>
            <div class="tableinfo">
              <ul class="listinfo">
                <?php
                  TableBar($page,"ProduitMarge.php",$_GET,$sql);
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
