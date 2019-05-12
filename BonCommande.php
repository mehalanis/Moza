<!DOCTYPE html>
<?php
require 'php/Standard.php';
require 'php/database.inc';
require 'php/CommandeDetail.inc';
require 'php/ProduitPrix.inc';
require 'php/Produit.inc';
$database=new database();
require 'php/VerifierUser.php';
if(isset($_POST["Ajoute"])){
  $database->query("update premier_bon set recette=".$_POST["recette"].", etat_commande=0 where id_commande=".$_POST["id_commande"]);
  foreach ($_POST["id_commande_detail"] as $key => $value) {
    $database->query("update commande_detail set qte_vendue=".$_POST['qte_vendue'][$key]." , qte_sortie =".
    $_POST["qte_sortie"][$key]." where id_commande_detail=".$value);
  }
  $result=$database->query("select id_vehicule from vendeur join premier_bon
                        on premier_bon.id_vendeur=vendeur.id_vendeur and id_commande=".$_POST["id_commande"]);
  $row=mysqli_fetch_assoc($result);
  $id_vehicule=$row["id_vehicule"];
  $result=$database->query("select produit_prix.id_produit as idproduit,((qte_initiale+qte_sortie)-qte_vendue) as qte_retoune
  from commande_detail join produit_prix on commande_detail.id_produit_prix=produit_prix.id_produit_prix
  and id_commande=".$_POST["id_commande"]);
  while ($row=mysqli_fetch_assoc($result)) {
    echo "update stock_vehicule set quantite=".$row["qte_retoune"]." where id_vehicule=".$id_vehicule." and id_produit=".$row["idproduit"];
    $database->query("update stock_vehicule set quantite=".$row["qte_retoune"]." where id_vehicule=".$id_vehicule." and id_produit=".$row["idproduit"]);
  }
  header("location: BonCommandePDF.php?id_commande=".$_POST["id_commande"]);
}
if(isset($_GET["id_commande"])){
  $result=$database->query("select id_commande_detail,produit.nom as nomproduit,qte_initiale,qte_commande,qte_sortie,qte_vendue,prix from commande_detail
   join produit_prix on produit_prix.id_produit_prix=commande_detail.id_produit_prix and id_commande=".$_GET["id_commande"]."
    join produit on  produit.id_produit=produit_prix.id_produit ");
   $list=array();
  while ($row=mysqli_fetch_assoc($result)) {
    $list[]=new CommandeDetail($row["id_commande_detail"],new Produit("",$row["nomproduit"],$row["prix"]),$row["qte_initiale"],$row["qte_commande"],$row["qte_sortie"],$row["qte_vendue"]);
  }
  $result=$database->query("select premier_bon.id_commande,vendeur.nom as nomvendeur,vendeur.prenom as prenom,vehicule.nom as nomvehicule
  ,premier_bon.date,sum(prix*qte_vendue) as facture ,recette ,(recette -sum(prix*qte_vendue)) as ecart from commande_detail
join produit_prix on commande_detail.id_produit_prix=produit_prix.id_produit_prix
join premier_bon on commande_detail.id_commande=premier_bon.id_commande
join vendeur on vendeur.id_vendeur=premier_bon.id_vendeur
join vehicule on vehicule.id_vehicule=vendeur.id_vehicule
where  commande_detail.id_commande=".$_GET["id_commande"]." group by commande_detail.id_commande");
  $Vendeur=mysqli_fetch_assoc($result);
}
?>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title></title>
    <?php CSS();?>
    <script src="js/BonCommande.js">
    </script>
  </head>
  <body onload="">
    <?php NavBar(); ?>
    <div class="page">
      <?php SideBar(); ?>
      <div class="detail">
        <div class="titre_bar">
          <label for="" class="titre_bar_label">
            <a href="Vendeur.php"><img src="img/icon/back_bleu_40px.png" alt=""></a>
             BonCommande
          </label>
        </div>
        <div class="table">
          <?php if (isset($_GET["id_commande"])): ?>
            <form class="" action="BonCommande.php" method="post">
              <div class="left_tab">
                <fieldset class="fields">
                  <legend class="legends">Information sur commande</legend>
                  <div class="control_table">
                    <div class="control_table_item_6col" >
                      <label class="controllabel_titre" for="" >Vendeur</label>
                      <input type="hidden" name="id_vendeur" value="<?php echo $Vendeur["idvendeur"]; ?>">
                      <input type="text" disabled class="controlinput" value="<?php echo $Vendeur["nomvendeur"]." ".$Vendeur["prenom"]; ?>">
                      <label class="controllabel_titre" for="" >Vehicule</label>
                      <input type="hidden" name="id_vehicule" value="<?php echo $Vendeur["idvehicule"]; ?>">
                      <input type="text" disabled name="nom"  class="controlinput" value="<?php echo $Vendeur["nomvehicule"]; ?>">
                      <label class="controllabel_titre" for="" >Date</label>
                      <input type="date" disabled name="date"  class="controlinput" value="<?php echo $Vendeur["date"]; ?>">
                    </div>
                  </div>
                </fieldset>
              </div>
              <div class="left_tab">
              <fieldset class="fields">
                <legend class="legends">Information sur la Commande</legend>
                <div class="control_table">
                  <div class="control_table_item_9col">
                    <label class="controllabel" for="" ></label>
                    <label class="controllabel" for="" >qte init</label>
                    <label class="controllabel" for="" >qte commande</label>
                    <label class="controllabel" for="" >qte sortie</label>
                    <label class="controllabel" for="" >qte charge</label>
                    <label class="controllabel" for="" >qte vendue</label>
                    <label class="controllabel" for="" >qte retoune</label>
                    <label class="controllabel" for="" >prix</label>
                    <label class="controllabel" for="" >somme</label>
                  </div>
                  <?php foreach ($list as $key => $value): ?>
                    <div class="control_table_item_9col">
                      <input type="hidden" name="id_commande_detail[]" value="<?php echo $value->id; ?>">
                      <label class="controllabel" for="" ><?php echo $value->nomproduit->nom; ?></label>
                      <input id="qte_init_<?php echo $value->id; ?>" type="number" disabled class="controlinput" value="<?php echo $value->qte_initiale; ?>">
                      <input type="number" disabled class="controlinput" value="<?php echo $value->qte_commande; ?>">
         <!--sortie--><input name="qte_sortie[]" type="number" min="0" onkeyup="calculCharge(<?php echo $value->id; ?>,this.value)"  class="controlinput" value="<?php echo $value->qte_sortie; ?>">
                      <input id="qte_charge_<?php echo $value->id; ?>" type="number" disabled  class="controlinput" value="<?php echo $value->qte_initiale+$value->qte_sortie; ?>">
         <!--vendue--><input name="qte_vendue[]" id="id_vendue_<?php echo $value->id; ?>"  type="number" min="0" onkeyup="calculRetoune(<?php echo $value->id; ?>,this.value)"  class="controlinput" value="<?php echo $value->qte_vendue; ?>">
                      <input  id="qte_retoune_<?php echo $value->id; ?>" type="number" disabled class="controlinput" value="<?php echo ($value->qte_initiale+$value->qte_sortie)-$value->qte_vendue; ?>">
                      <input id="prix_<?php echo $value->id; ?>" type="number" disabled class="controlinput" value="<?php echo $value->nomproduit->list_prix; ?>">
                      <input id="somme_<?php echo $value->id; ?>" type="number" disabled class="controlinput sommeclass" value="<?php echo  $value->nomproduit->list_prix*$value->qte_vendue; ?>">
                    </div>
                  <?php endforeach; ?>
                </div>
              </fieldset>
             </div>
             <div class="left_tab">
               <fieldset class="fields">
                 <legend class="legends">Information sur commande</legend>
                 <div class="control_table">
                   <div class="control_table_item_6col" >
                     <label class="controllabel" for="" >Facture</label>
                     <input id="facture" type="number" disabled class="controlinput" value="<?php echo $Vendeur["facture"]; ?>">
                     <label class="controllabel" for="" >Recette</label>
                     <input id="recette" type="number" onkeyup="_ecart()" name="recette"  class="controlinput" value="<?php echo $Vendeur["recette"]; ?>">
                     <label class="controllabel" for="" >Ecart</label>
                     <input id="ecart" type="number" disabled class="controlinput" value="<?php echo $Vendeur["ecart"]; ?>">
                   </div>
                 </div>
               </fieldset>
             </div>
             <hr>
             <div class="control_div_btn">
               <input type="hidden" name="id_commande" value="<?php echo $_GET["id_commande"]; ?>">
               <button type="submit" class="control_btn" name="Ajoute">Ajoute</button>
             </div>
            </form>
          <?php endif; ?>
        </div>
      </div>
    </div>
  </body>
</html>
