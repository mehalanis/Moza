<!DOCTYPE html>
<?php
require 'php/Standard.php';
require 'php/database.inc';
require 'php/CommandeDetail.inc';
require 'php/ProduitPrix.inc';
require 'php/Produit.inc';
$database=new database();
require 'php/VerifierUser.php';
function testEmpty($v)
{
  if(empty($v)){ return 0;}else{ return $v;}
}
if((isset($_POST["Ajouter"]))||(isset($_POST["Modifier"]))){
 if (isset($_POST["Ajouter"])) {
   $result=$database->query("insert into journee(id_vendeur,date,recette) value (".$_POST["id_vendeur"].",
    '".$_POST["date"]."',".testEmpty($_POST["recette"]).")");
    $id_journee=$database->insertid($result);
    foreach ($_POST["idproduit"] as $key => $idproduit) {
      $result=$database->query("insert into commande_detail(id_journee,qte_initiale,qte_sortie
      ,id_produit_prix_dd,qte_vendue_dd,id_produit_prix_dg,qte_vendue_dg,id_produit_prix_sg,qte_vendue_sg) values
      ($id_journee,".testEmpty($_POST["qte_init"][$key]).",".testEmpty($_POST["qte_sortie"][$key]).",".
      testEmpty($_POST["dd_id_prix"][$key]).",".testEmpty($_POST["qte_vendue_dd"][$key]).",".testEmpty($_POST["dg_id_prix"][$key]).","
      .testEmpty($_POST["qte_vendue_dg"][$key]).",".testEmpty($_POST["sg_id_prix"][$key]).","
      .testEmpty($_POST["qte_vendue_sg"][$key]).")");
    }
 }else{
   $id_journee=$_POST["id_journee"];
   $database->query("update journee set date='".$_POST["date"]."' , recette=".testEmpty($_POST["recette"])
   ." where id_journee=".$id_journee);
   foreach ($_POST["id_commande_detail"] as $key => $id_commande_detail) {
    $database->query("UPDATE `commande_detail` SET `qte_initiale`=".testEmpty($_POST["qte_init"][$key])
    ." , `qte_sortie`=".testEmpty($_POST["qte_sortie"][$key])." , `qte_vendue_dd`=".testEmpty($_POST["qte_vendue_dd"][$key])
    ." , `qte_vendue_dg`=".testEmpty($_POST["qte_vendue_dg"][$key])." , `qte_vendue_sg`="
    .testEmpty($_POST["qte_vendue_sg"][$key])." WHERE id_commande_detail=".$id_commande_detail);
   }
 }
  $result=$database->query("select produit_prix.id_produit as idproduit,((qte_initiale+qte_sortie)-(qte_vendue_dd+qte_vendue_dg+qte_vendue_sg)) as qte_retoune
  from commande_detail join produit_prix on commande_detail.id_produit_prix_dd=produit_prix.id_produit_prix
  and id_journee=".$id_journee);
  $database->query("DELETE FROM `stock_vehicule` WHERE id_vehicule=".$_POST["id_vehicule"]);
  while ($row=mysqli_fetch_assoc($result)) {
    $database->query("insert into stock_vehicule (id_vehicule,id_produit,quantite) values (".$_POST["id_vehicule"].",".$row["idproduit"].",".$row["qte_retoune"].")");
  }
  header("location: BonJourneePDF.php?id_journee=".$id_journee);
}
$list=array();
if(isset($_GET["idVendeur"])){
  $result=$database->query("select id_vendeur as idvendeur,vendeur.id_vehicule as id_vehicule,vendeur.nom as nomvendeur,prenom,vehicule.nom as nomvehicule from vendeur join vehicule on vendeur.id_vehicule=vehicule.id_vehicule where id_vendeur=".$_GET["idVendeur"]);
  $Vendeur=mysqli_fetch_assoc($result);
  $result=$database->query("select produit.id_produit as idproduit,produit.nom as nomproduit,stock_vehicule.quantite
                        as qte_init ,dd.id_produit_prix as dd_id_prix,dd.prix as dd_prix,dg.id_produit_prix as dg_id_prix
                         ,dg.prix as dg_prix,sg.id_produit_prix as sg_id_prix,sg.prix as sg_prix
                         from produit left join produit_prix as dd on produit.id_produit=dd.id_produit and dd.id_produit_prix
                         in (select max(id_produit_prix) from produit_prix_type join produit_prix
                         on produit_prix_type.id_produit_prix_type=produit_prix.id_produit_prix_type
                         and produit_prix.id_produit_prix_type=1
                         group by produit_prix.id_produit)
                         left join produit_prix as dg on produit.id_produit=dg.id_produit and dg.id_produit_prix
                         in (select max(id_produit_prix) from produit_prix_type join produit_prix
                         on produit_prix_type.id_produit_prix_type=produit_prix.id_produit_prix_type
                         and produit_prix.id_produit_prix_type=2
                         group by produit_prix.id_produit)
                         left join produit_prix as sg on produit.id_produit=sg.id_produit and sg.id_produit_prix
                         in (select max(id_produit_prix) from produit_prix_type join produit_prix
                         on produit_prix_type.id_produit_prix_type=produit_prix.id_produit_prix_type
                         and produit_prix.id_produit_prix_type=3
                         group by produit_prix.id_produit)
                         left join stock_vehicule on stock_vehicule.id_vehicule=".$Vendeur["id_vehicule"]." and produit.id_produit=stock_vehicule.id_produit");
}
if(isset($_GET["id_journee"])){
$result=$database->query("select vendeur.id_vendeur as idvendeur,vendeur.nom as nomvendeur,prenom,vehicule.nom as nomvehicule,vehicule.id_vehicule,journee.date,sum(qte_vendue_dd*dd.prix+qte_vendue_dg*dg.prix+qte_vendue_sg*sg.prix) as facture ,recette
,recette-sum(qte_vendue_dd*dd.prix+qte_vendue_dg*dg.prix+qte_vendue_sg*sg.prix) as ecart from journee
join vendeur on vendeur.id_vendeur=journee.id_vendeur
join vehicule on vehicule.id_vehicule=vendeur.id_vehicule
join commande_detail on journee.id_journee=commande_detail.id_journee
join produit_prix as dd on commande_detail.id_produit_prix_dd=dd.id_produit_prix
join produit_prix as dg on commande_detail.id_produit_prix_dg=dg.id_produit_prix
join produit_prix as sg on commande_detail.id_produit_prix_sg=sg.id_produit_prix
where journee.id_journee=".$_GET["id_journee"]."  group by journee.id_journee;");
  $Vendeur=mysqli_fetch_assoc($result);
  $result=$database->query("select  id_commande_detail,produit.id_produit as idproduit,produit.nom as nomproduit, qte_initiale as qte_init,qte_sortie,qte_vendue_dd,dd.id_produit_prix as dd_id_prix,dd.prix as dd_prix
,qte_vendue_dg,dg.id_produit_prix as dg_id_prix,dg.prix as dg_prix,qte_vendue_sg,sg.id_produit_prix as sg_id_prix,sg.prix as sg_prix from commande_detail
join produit_prix as dd on dd.id_produit_prix=commande_detail.id_produit_prix_dd
join produit_prix as dg on dg.id_produit_prix=commande_detail.id_produit_prix_dg
join produit_prix as sg on sg.id_produit_prix=commande_detail.id_produit_prix_sg
join produit on produit.id_produit=dd.id_produit
 where id_journee=".$_GET["id_journee"]);
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
             journée
          </label>
        </div>
        <div class="table">
          <form class="" action="BonJournee.php" method="post">
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
                    <input type="date" name="date"  class="controlinput" value="<?php if(isset($_GET["id_journee"]))echo $Vendeur["date"]; else echo date("Y-m-d"); ?>">
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
                  <label class="controllabel" for="" >qte sortie</label>
                  <label class="controllabel" for="" >qte charge</label>
                  <label class="controllabel">D.D</label>
                  <label class="controllabel">D.G</label>
                  <label class="controllabel">S.G</label>
                  <label class="controllabel" for="" >qte retoune</label>
                  <label class="controllabel" for="" >somme</label>
                </div>
                <?php
                  while ($row=mysqli_fetch_assoc($result)):
                    $qte_init=$row["qte_init"];
                    if($row["qte_init"]==NULL){$qte_init=0;}
                    if(isset($_GET["id_journee"])){
                      $qte_vendue_dd=$row["qte_vendue_dd"];
                      $qte_vendue_dg=$row["qte_vendue_dg"];
                      $qte_vendue_sg=$row["qte_vendue_sg"];
                      $qte_sortie=$row["qte_sortie"];
                      $qte_charge=$qte_sortie+$qte_init;
                      $qte_retoune=$qte_charge-($qte_vendue_dd+$qte_vendue_dg+$qte_vendue_sg);
                      $somme=$qte_vendue_dd*$row["dd_prix"]+$qte_vendue_dg*$row["dg_prix"]+$qte_vendue_sg*$row["sg_prix"];
                    }else{
                      $qte_vendue_dd=0;
                      $qte_vendue_dg=0;
                      $qte_vendue_sg=0;
                      $qte_sortie=0;
                      $qte_charge=$qte_init;
                      $qte_retoune=$qte_init;
                      $somme=0;
                    }
                 ?>
                  <div class="control_table_item_9col">
                    <?php if (isset($_GET["id_journee"])): ?>
                      <input type="hidden" name="id_commande_detail[]" value="<?php echo $row["id_commande_detail"]; ?>">
                    <?php endif; ?>
                    <input type="hidden" name="idproduit[]" value="<?php echo $row["idproduit"]; ?>">
                    <label class="controllabel" for="" ><?php echo $row["nomproduit"]; ?></label>
                    <input type="hidden" name="qte_init[]" value="<?php echo $qte_init; ?>">
                    <input id="qte_init_<?php echo $row["idproduit"]; ?>" name="" type="text" disabled class="controlinput" value="<?php  echo $qte_init; ?>">
                    <input name="qte_sortie[]" type="text" min="0" onkeyup="calculCharge(<?php echo $row["idproduit"]; ?>,this.value)"  class="controlinput" value="<?php echo $qte_sortie; ?>">
                    <input id="qte_charge_<?php echo $row["idproduit"]; ?>" type="text" disabled  class="controlinput" value="<?php echo $qte_charge; ?>">
                    <!--dd-->
                    <input id="prix_dd_<?php echo $row["idproduit"]; ?>" type="hidden"  value="<?php echo $row["dd_prix"]; ?>">
                    <input type="hidden" name="dd_id_prix[]" value="<?php echo $row["dd_id_prix"]; ?>">
                    <input id="qte_vendue_dd_<?php echo $row["idproduit"]; ?>" type="text" name="qte_vendue_dd[]"
                     onkeyup="calculRetoune(<?php echo $row["idproduit"]; ?>)"  class="controlinput" value="<?php echo   $qte_vendue_dd; ?>">
                     <!--dg-->
                     <input id="prix_dg_<?php echo $row["idproduit"]; ?>" type="hidden"  value="<?php echo $row["dg_prix"]; ?>">
                     <input type="hidden" name="dg_id_prix[]" value="<?php echo $row["dg_id_prix"]; ?>">
                     <input id="qte_vendue_dg_<?php echo $row["idproduit"]; ?>"  type="text" name="qte_vendue_dg[]"
                      onkeyup="calculRetoune(<?php echo $row["idproduit"]; ?>)"  class="controlinput" value="<?php echo   $qte_vendue_dg; ?>">
                    <!--sg-->
                    <input id="prix_sg_<?php echo $row["idproduit"]; ?>" type="hidden" value="<?php echo $row["sg_prix"]; ?>">
                    <input type="hidden" name="sg_id_prix[]" value="<?php echo $row["sg_id_prix"]; ?>">
                    <input id="qte_vendue_sg_<?php echo $row["idproduit"]; ?>" type="txt" name="qte_vendue_sg[]"
                       onkeyup="calculRetoune(<?php echo $row["idproduit"]; ?>)"  class="controlinput" value="<?php echo   $qte_vendue_sg; ?>">

                    <input  id="qte_retoune_<?php echo $row["idproduit"]; ?>" type="text" disabled class="controlinput" value="<?php echo $qte_retoune; ?>">
                    <input id="somme_<?php echo $row["idproduit"]; ?>" type="text" disabled class="controlinput sommeclass" value="<?php echo $somme; ?>">
                  </div>
                <?php endwhile; ?>
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
             <input type="hidden" name="id_vehicule" value="<?php echo $Vendeur["id_vehicule"]; ?>">
             <input type="hidden" name="id_vendeur" value="<?php echo $Vendeur["idvendeur"]; ?>">
             <input type="hidden" name="id_journee" value="<?php if(isset($_GET["id_journee"])) echo $_GET["id_journee"]; ?>">
             <button type="submit" class="control_btn" name="<?php if(isset($_GET["idVendeur"])) echo "Ajouter";
                                                                  else{ echo "Modifier";} ?>">Enregistrer</button>
           </div>
          </form>
        </div>
      </div>
    </div>
  </body>
</html>
