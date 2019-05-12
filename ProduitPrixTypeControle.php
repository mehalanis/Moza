<!DOCTYPE html>
<?php
require 'php/Standard.php';
require 'php/database.inc';
require 'php/ProduitPrixType.inc';
$database=new database();
require 'php/VerifierUser.php';
if(isset($_POST["ModifiePixType"])){
  $database->query("update produit_prix_type set nom='".$_POST["nom_produit_prix_type"]."' where id_produit_prix_type=".$_POST["idproduit_prix_type"]);
  header("location: ProduitPrixType.php");
}
if(isset($_POST["AjouterPixType"])){
    $database->query("insert into  produit_prix_type(nom) values('".$_POST["nom_produit_prix_type"]."')");
  header("location: ProduitPrixType.php");
}
if(isset($_GET["idproduit_prix_type"])){
  $result=$database->query("select id_produit_prix_type,nom from produit_prix_type where id_produit_prix_type=".$_GET["idproduit_prix_type"]);
  $row=mysqli_fetch_assoc($result);
  $produit_prix_type=new ProduitPrixType($row["id_produit_prix_type"],$row["nom"]);
}
?>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title></title>
    <?php CSS();?>
    <script src="js/Admin/Controle.js">
    </script>
  </head>
  <body>
    <?php NavBar(); ?>
    <div class="page">
      <?php SideBar(); ?>
      <div class="detail">
        <div class="titre_bar">
          <label for="" class="titre_bar_label">
            <a href="ProduitPrixType.php"><img src="img/icon/back_bleu_40px.png" alt=""></a>
             Offres
          </label>
        </div>
        <div class="table">
          <form class="" action="ProduitPrixTypeControle.php" method="post">
            <div class="left_tab">
            <fieldset class="fields">
              <legend class="legends">Information sur l'Offres</legend>
              <div class="control_table">
                <div class="control_table_item">
                  <label class="controllabel" for="" >Nom</label>
                  <input type="text" id="nom" name="nom_produit_prix_type"  class="controlinput" value="<?php if(isset($produit_prix_type)){echo $produit_prix_type->nom;} ?>">
                </div>
              </div>
               </fieldset>
           </div>
           <hr>
           <div class="control_div_btn">
             <?php if(isset($_GET["idproduit_prix_type"])){ $operation= "Modifie";}else {$operation= "Ajouter";} ?>
             <input type="hidden" name="idproduit_prix_type" value="<?php if(isset($_GET["idproduit_prix_type"])){echo $_GET["idproduit_prix_type"];} ?>">
             <button type="submit" class="control_btn" name="<?php echo $operation; ?>PixType">
               <?php echo $operation; ?>
             </button>
           </div>
          </form>
        </div>
      </div>
    </div>
  </body>
</html>
