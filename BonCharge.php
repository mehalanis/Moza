<!DOCTYPE html>
<?php
require 'php/Standard.php';
require 'php/database.inc';
require 'php/Vehicule.inc';
require 'php/Vendeur.inc';
require 'php/Produit.inc';
require 'php/ProduitPrix.inc';
require 'php/StockVehicule.inc';
$database=new database();
require 'php/VerifierUser.php';
if(isset($_POST["Ajoute"])){
 $result=$database->query("insert into premier_bon(id_vendeur,date,recette,etat_commande) values (
    ".$_POST["id_vendeur"].",'".$_POST["date"]."',0,1)");
  $id_commande=$database->insertid($result);
  foreach ($_POST["id_produit_prix"] as $key => $idproduitprix) {
    $database->query("insert into commande_detail(id_commande,id_produit_prix,qte_initiale,qte_commande,qte_vendue) values
          ($id_commande,$idproduitprix,".$_POST["qte_init"][$key].",".$_POST["qte_commande"][$key].",0)");  }
  header("location: BonChargePDF.php?id_commande=".$id_commande);
}
if(isset($_GET["idVendeur"])){
$result=$database->query("select id_vendeur,vendeur.id_vehicule as idvehicule,vendeur.nom as nomvendeur,prenom,vehicule.nom as nomvehicule from vendeur join vehicule on vendeur.id_vehicule=vehicule.id_vehicule where id_vendeur=".$_GET["idVendeur"]);
$Vendeur=mysqli_fetch_assoc($result);
$result=$database->query("select id_produit_prix ,produit.id_produit as idproduit,produit.nom as nomproduit,prix,date,quantite
                         from produit left join stock_vehicule on produit.id_produit=stock_vehicule.id_produit
                         and id_vehicule=".$Vendeur["idvehicule"]." left join produit_prix
                         on produit.id_produit=produit_prix.id_produit and id_produit_prix
                         in (select max(id_produit_prix) from produit_prix_type join produit_prix
                         on produit_prix_type.id_produit_prix_type=produit_prix.id_produit_prix_type
                         and produit_prix.id_produit_prix_type=1
                         group by produit_prix.id_produit)");
$StockVehicule=array();
while ($row=mysqli_fetch_assoc($result)) {
  if($row["quantite"]==NULL) $quantite=0; else $quantite=$row["quantite"];
  $StockVehicule[]=new StockVehicule(new ProduitPrix($row["id_produit_prix"],
                                                 new Produit($row["idproduit"],$row["nomproduit"],""),
                                                 $row["prix"],$row["date"]),$quantite);
}
}
?>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title></title>
    <?php CSS();?>
    <link rel="stylesheet" href="css/BonCharge.css">
    <script type="text/javascript" src="js/BonCharge.js">
    </script>
  </head>
  <body>
    <?php NavBar(); ?>
    <div class="page">
      <?php SideBar(); ?>
      <div class="detail">
        <div class="titre_bar">
          <label for="" class="titre_bar_label">
            <a href="Client.php"><img src="img/icon/back_bleu_40px.png" alt=""></a>
             Bon Charge
          </label>
        </div>
        <div class="table">
          <form class="" action="BonCharge.php" method="post">
            <div class="left_tab">
              <fieldset class="fields">
                <legend class="legends">Information sur commande</legend>
                <div class="control_table">
                  <div class="control_table_item_6col" >
                    <label class="controllabel_titre" for="" >Vendeur</label>
                    <input type="hidden" name="id_vendeur" value="<?php echo $Vendeur["id_vendeur"]; ?>">
                    <input type="text" disabled class="controlinput" value="<?php echo $Vendeur["nomvendeur"]." ".$Vendeur["prenom"]; ?>">
                    <label class="controllabel_titre" for="" >Vehicule</label>
                    <input type="hidden" name="id_vehicule" value="<?php echo $Vendeur["idvehicule"]; ?>">
                    <input type="text" disabled name="nom"  class="controlinput" value="<?php echo $Vendeur["nomvehicule"]; ?>">
                    <label class="controllabel_titre" for="" >Date</label>
                    <input type="date"  name="date"  class="controlinput" value="<?php echo date("Y-m-d"); ?>">
                  </div>
                </div>
              </fieldset>
            </div>
            <div class="left_tab">
              <fieldset class="fields">
                <legend class="legends">Creer Bon Charge</legend>
                <div class="control_table">
                  <div class="control_table_item_4col" >
                    <label class="controllabel_titre" for="" ></label>
                    <label class="controllabel_titre" for="" >QTE Initiale</label>
                    <label class="controllabel_titre" for="" >QTE Commande</label>
                    <label class="controllabel_titre" for="" >QTE Charge</label>
                  </div>
                    <?php foreach ($StockVehicule as $key => $value): ?>
                      <div class="control_table_item_4col">
                        <input type="hidden" name="id_stock_vehicule[]" value="<?php echo $value->produit->id; ?>">
                        <label class="controllabel" for="" ><?php echo $value->produit->produitprixtype->nom; ?></label>
                        <input type="hidden" name="id_produit_prix[]" value="<?php  echo $value->produit->id; ?>">
                        <input type="hidden" name="qte_init[]"  value="<?php echo $value->quantite; ?>">
                        <input id="Init-<?php echo $value->produit->id;?>" type="number" disabled  class="controlinput"  value="<?php echo $value->quantite; ?>">
                        <input id="commande-<?php echo $value->produit->id;?>" min="0"name="qte_commande[]" type="number" onseeking="calcul(<?php echo $value->produit->id;?>,this.value)" onkeyup="calcul(<?php echo $value->produit->id;?>,this.value)" class="controlinput" value="0">
                        <input id="charge-<?php echo $value->produit->id;?>" type="number" disabled    class="controlinput" value="<?php echo $value->quantite; ?>">
                      </div>
                    <?php endforeach; ?>
                </div>
              </fieldset>
            </div>
           <hr>
           <div class="control_div_btn">
             <input type="hidden" name="client_id" value="">
             <button type="submit" class="control_btn" name="Ajoute">
               Ajoute
             </button>
           </div>
          </form>
        </div>
      </div>
    </div>
  </body>
</html>
