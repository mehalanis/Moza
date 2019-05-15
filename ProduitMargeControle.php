<!DOCTYPE html>
<?php
require 'php/Standard.php';
require 'php/database.inc';
$database=new database();
if(isset($_POST["Modifier"])){
  $database->query("update produit_marge set nom='".$_POST["nom"]."' , benefice=".$_POST["benefice"]
                            ." where id_produit_marge=".$_POST["id_produit_marge"]);
  header("location: ProduitMarge.php");
}
if (isset($_POST["Ajouter"])) {
  $database->query("insert into produit_marge (nom,benefice) values ('".$_POST["nom"]."',".$_POST["benefice"].")");
  header("location: ProduitMarge.php");
}
$id_produit_marge=-1;
$btn="Ajouter";
$nom="";
$benefice=0;
if(isset($_GET["id_produit_marge"])){
  $btn="Modifier";
  $id_produit_marge=$_GET["id_produit_marge"];
  $result=$database->query("select * from produit_marge where id_produit_marge=".$id_produit_marge);
  $row=mysqli_fetch_assoc($result);
  $nom=$row["nom"];
  $benefice=$row["benefice"];
}
?>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title></title>
    <?php CSS();?>
  </head>
  <body>
    <?php NavBar(); ?>
    <div class="page">
      <?php SideBar(); ?>
      <div class="detail">
        <div class="titre_bar">
          <label for="" class="titre_bar_label">
            <a href="ProduitMarge.php"><img src="img/icon/back_bleu_40px.png" alt=""></a>
             Marge
          </label>
        </div>
        <div class="table">
          <form class="" action="ProduitMargeControle.php" method="post">
            <div class="left_tab">
              <fieldset class="fields">
                <legend class="legends">information sur la Marge</legend>
                <div class="control_table">
                  <div class="control_table_item">
                    <label class="controllabel" for="" >Nom</label>
                    <input type="text" name="nom" value="<?php echo $nom; ?>" class="controlinput">
                  </div>
                  <div class="control_table_item">
                    <label class="controllabel" for="" >Benefice</label>
                    <input type="number" name="benefice" value="<?php echo $benefice; ?>" class="controlinput">
                  </div>
                </div>
              </fieldset>
            </div>
            <hr>
            <div class="control_div_btn">
              <input type="hidden" name="id_produit_marge" value="<?php echo $id_produit_marge; ?>">
              <button type="submit" class="control_btn" name="<?php echo $btn; ?>">
                <?php echo $btn; ?>
              </button>
            </div>
          </form>
        </div>
      </div>
    </div>
  </body>
</html>
