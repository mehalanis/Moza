<!DOCTYPE html>
<?php
require 'php/Standard.php';
require 'php/database.inc';
require 'php/Produit.inc';
require 'php/ProduitPrix.inc';
require 'php/ProduitPrixType.inc';
$database=new database();
require 'php/VerifierUser.php';
if((isset($_POST["AjouteProduit"]))||(isset($_POST["ModifierProduit"]))){
  if (isset($_POST["AjouteProduit"])) {
    $result=$database->query("insert into produit(nom) values ('".$_POST["NomProduit"]."')");
    $idproduit=$database->insertid($result);
  }else{
     $database->query("update produit set nom='".$_POST["NomProduit"]."' where id_produit=".$_POST["id_produit"]);
     $idproduit=$_POST["id_produit"];
  }
  $date=date("Y/m/d");
  foreach ($_POST["id_produit_prix_type"] as $key => $idProduitPrixType) {
    if($_POST["ProduitPrixAncien"][$key]!=$_POST["ProduitPrix"][$key]){
      $database->query("insert into produit_prix (id_produit,id_produit_prix_type,prix,date) values ($idproduit,$idProduitPrixType,".$_POST["ProduitPrix"][$key].",'".$date."')");
    }
  }
  header("location: Produit.php");
}

if(isset($_GET["idproduit"])){
$result=$database->query("select * from produit where id_produit=".$_GET["idproduit"]);
$produit=mysqli_fetch_assoc($result);
$nomproduit=$produit["nom"];
$result=$database->query("select  id_produit_prix,produit_prix_type.id_produit_prix_type as id_produit_prix_type, produit_prix_type.nom
                          as nom,prix,date from produit_prix_type left join produit_prix
                          on  produit_prix_type.id_produit_prix_type=produit_prix.id_produit_prix_type
                           and produit_prix.id_produit_prix in
                          (select max(id_produit_prix) from produit_prix_type left join produit_prix on produit_prix_type.id_produit_prix_type=produit_prix.id_produit_prix_type
                          and id_produit=".$_GET["idproduit"]." group by produit_prix.id_produit_prix_type)");
$produitprix=array();
while ($row=mysqli_fetch_assoc($result)) {
  if($row['prix']==NULL){$prix=0;}else{$prix=$row['prix'];}
  $produitprix[]=new ProduitPrix($row["id_produit_prix"],new ProduitPrixType($row["id_produit_prix_type"],$row["nom"]),
                                  $prix,$row["date"]);
}
}else{
$result=$database->query("select * from produit_prix_type");
$produitprixtype=array();
while ($row=mysqli_fetch_assoc($result)) {
  $produitprixtype[]=new ProduitPrixType($row["id_produit_prix_type"],$row["nom"]);
}
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
            <a href="produitControle.php"><img src="img/icon/back_bleu_40px.png" alt=""></a>
             Produit
          </label>
        </div>
        <div class="table">
          <form class="" action="ProduitControle.php" method="post">
            <div class="left_tab">
            <fieldset class="fields">
              <legend class="legends">Information sur le produit</legend>
              <div class="control_table">
                <div class="control_table_item">
                  <label class="controllabel" for="" >Nom</label>
                  <input type="text" id="nom" name="NomProduit" value="<?php if(isset($nomproduit)) echo $nomproduit; ?>" class="controlinput">
                </div>
              </div>
            </fieldset>
            <fieldset class="fields">
              <legend class="legends">Liste des Prix</legend>
              <div class="control_table">
                <?php if(isset($produitprixtype)){ foreach ($produitprixtype as $key => $value): ?>
                  <div class="control_table_item">
                    <label class="controllabel" for="" ><?php echo $value->nom; ?></label>
                    <input type="hidden" name="id_produit_prix_type[]" value="<?php echo $value->id; ?>">
                    <input type="number" id="nom" name="ProduitPrix[]"  class="controlinput" value="0" required>
                    <input type="hidden" name="ProduitPrixAncien[]" value="-1">
                  </div>
                <?php endforeach;}else{ ?>
                  <?php foreach ($produitprix as $key => $value): ?>
                    <div class="control_table_item">
                      <label class="controllabel" for="" ><?php echo $value->produitprixtype->nom; ?></label>
                      <input type="hidden" name="id_produit_prix_type[]" value="<?php echo $value->produitprixtype->id; ?>">
                      <input type="number" id="nom" name="ProduitPrix[]" value="<?php echo $value->prix; ?>"  class="controlinput" required>
                      <input type="hidden" name="ProduitPrixAncien[]" value="<?php echo $value->prix; ?>">
                    </div>
                  <?php endforeach;} ?>
              </div>
            </fieldset>
           </div>
           <hr>
           <div class="control_div_btn">
             <?php if(isset($_GET["idproduit"])) $opetation= "Modifier"; else $opetation= "Ajoute"; ?>
             <input type="hidden" name="id_produit" value="<?php if(isset($_GET["idproduit"])) echo $_GET["idproduit"]; ?>">
             <button type="submit" class="control_btn" name="<?php echo $opetation; ?>Produit">
               <?php echo $opetation; ?>
             </button>
           </div>
          </form>
        </div>
      </div>
    </div>
  </body>
</html>
