<!DOCTYPE html>
<?php
require 'php/Standard.php';
require 'php/database.inc';
require 'php/Vehicule.inc';
require 'php/Produit.inc';
require 'php/StockVehicule.inc';
$database=new database();
require 'php/VerifierUser.php';
if((isset($_POST["ModifierVehicule"]))||(isset($_POST["AjouterVehicule"]))){
  if(isset($_POST["ModifierVehicule"])){
  $result=$database->query("update vehicule set nom='".$_POST["NomVehicule"]."' , matricule='".$_POST["MatriculeVehicule"]
    ."' where id_vehicule=".$_POST["IdVehicule"]);
    $idVehicule=$_POST["IdVehicule"];
  }else{
    $result=$database->query("insert into vehicule(nom,matricule) values ('".$_POST["NomVehicule"]."','".$_POST["MatriculeVehicule"]."')");
    $idVehicule=$database->insertid($result);
  }
  $database->query("DELETE FROM `stock_vehicule` WHERE id_vehicule=".$idVehicule);
  foreach ($_POST["IdProduit"] as $key => $idproduit) {
    $database->query("insert into stock_vehicule (id_vehicule,id_produit,quantite) values ($idVehicule,$idproduit,".$_POST["Quantite"][$key].")");
  }
  header("location: Vehicule.php");
}

if(isset($_GET["idvehicule"])){
  $result=$database->query("select id_vehicule,nom,matricule from vehicule where id_vehicule=".$_GET["idvehicule"]);
  $row_vehicule=mysqli_fetch_assoc($result);
  $result=$database->query("select produit.id_produit as idproduit,nom,quantite from produit left join stock_vehicule
                  on produit.id_produit=stock_vehicule.id_produit  and id_vehicule=".$_GET["idvehicule"]
                  ." order by idproduit ASC");
  $StockVehicule=array();
  while ($row=mysqli_fetch_assoc($result)) {
    if($row["quantite"]==NULL) $quantite=0; else $quantite=$row["quantite"];
    $StockVehicule[]=new StockVehicule(new Produit($row["idproduit"],$row["nom"],""),$quantite);
  }
  $vehicule=new Vehicule($row_vehicule["id_vehicule"],$row_vehicule["nom"],$row_vehicule["matricule"],$StockVehicule);
}else{
$listProduit=array();
$result=$database->query("select * from produit");
while ($row =mysqli_fetch_assoc($result)) {
  $listProduit[]=new Produit($row["id_produit"],$row["nom"],"");
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
            <a href="Vehicule.php"><img src="img/icon/back_bleu_40px.png" alt=""></a>
             Vehicule
          </label>
        </div>
        <div class="table">
          <form class="" action="VehiculeControle.php" method="post">
            <div class="left_tab">
            <fieldset class="fields">
              <legend class="legends">Information Sur Le Vehicule</legend>
              <div class="control_table">
                <div class="control_table_item">
                  <label class="controllabel" for="" >Nom</label>
                  <input type="text" id="nom" name="NomVehicule"  class="controlinput" required value="<?php if(isset($vehicule)){echo $vehicule->nom;} ?>">
                </div>
                <div class="control_table_item">
                  <label class="controllabel" for="" >Matricule</label>
                  <input type="text" id="nom" name="MatriculeVehicule"  class="controlinput" required value="<?php if(isset($vehicule)){echo $vehicule->matricule;} ?>">
                </div>
              </div>
            </fieldset>
            <fieldset class="fields">
              <legend class="legends">Stock Le Vehicule</legend>
              <div class="control_table">
                <?php if(isset($listProduit)){ foreach ($listProduit as $key => $value): ?>
                  <div class="control_table_item">
                    <label class="controllabel" for="" ><?php echo $value->nom; ?></label>
                    <input type="hidden"  name="IdProduit[]" value="<?php echo $value->id; ?>">
                    <input type="number" name="Quantite[]"  class="controlinput" value="0" required>
                  </div>
                <?php endforeach; }else{?>
                <?php foreach ($vehicule->StockVehicule as $key => $value): ?>
                  <div class="control_table_item">
                    <label class="controllabel" for="" ><?php echo $value->produit->nom; ?></label>
                    <input type="hidden" name="IdProduit[]" value="<?php echo $value->produit->id; ?>">
                    <input type="number"  name="Quantite[]" required  class="controlinput" value="<?php echo $value->quantite; ?>">
                  </div>
                <?php endforeach; }?>
              </div>
            </fieldset>
           </div>
           <hr>
           <div class="control_div_btn">
             <?php if(isset($vehicule)){ $operation="Modifier";}else{$operation="Ajouter";} ?>
             <input type="hidden" name="IdVehicule" value="<?php if(isset($_GET["idvehicule"]))echo $_GET["idvehicule"];?>">
             <button type="submit" class="control_btn" name="<?php echo $operation; ?>Vehicule">
               <?php echo $operation; ?>
             </button>
           </div>
          </form>
        </div>
      </div>
    </div>
  </body>
</html>
