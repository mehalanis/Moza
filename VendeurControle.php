<!DOCTYPE html>
<?php
include 'php/Standard.php';
require 'php/database.inc';
require 'php/Vendeur.inc';
require 'php/Vehicule.inc';
require 'php/Statistique.inc';
$database=new database();
require 'php/VerifierUser.php';
if(isset($_GET["id_journee_delete"])){
  $database->query("delete from journee where id_journee=".$_GET["id_journee_delete"]);
}
if(isset($_GET["PDF"])){
  header("location: BonEcartePDF.php?idVendeur=".$_GET["idVendeur"]."&depart=".$_GET["depart"]."&jusque=".$_GET["jusque"]."");
}
if(isset($_GET["MargePDF"])){
  header("location: BonMargePDF.php?idVendeur=".$_GET["idVendeur"]."&depart=".$_GET["depart"]."&jusque=".$_GET["jusque"]."");
}
if(isset($_POST["ModifierVendeur"])){
  $result=$database->query("update vendeur set nom='".$_POST["VendeurNom"]."' , prenom='".$_POST["VendeurPrenom"]."' ,
    telephone='".$_POST["VendeurTelephone"]."' , id_vehicule=".$_POST["VendeurVehicule"]." where id_vendeur=".$_POST["IdVendeur"]);
  header("location: Vendeur.php");
}
if(isset($_POST["AjouteVendeur"])){
  $result=$database->query("insert into vendeur (id_vehicule,nom,prenom,telephone) values (".$_POST["VendeurVehicule"]."
    ,'".$_POST["VendeurNom"]."','".$_POST["VendeurPrenom"]."','".$_POST["VendeurTelephone"]."')");
   header("location: Vendeur.php");
}
if(isset($_GET["idVendeur"])){
$result=$database->query("select id_vendeur as idVendeur,Vendeur.nom as VendeurNom ,Vendeur.Prenom as VendeurPrenom ,
  vehicule.id_vehicule as idvehicule, vehicule.nom as VehiculeNom , matricule,telephone from Vendeur join vehicule
   on Vendeur.id_vehicule=vehicule.id_vehicule where id_vendeur=".$_GET["idVendeur"]);

$row=mysqli_fetch_assoc($result);
$som_ecart=0;
$vendeur=new Vendeur($row["idVendeur"],new Vehicule($row["idvehicule"],$row["VehiculeNom"]
                              ,$row["matricule"],""),$row["VendeurNom"],$row["VendeurPrenom"],$row["telephone"]);
 // Statistique
 if(isset($_GET['page'])){ $page=$_GET['page'];}else{$page=1;}
 $debut=$page*10-10;
 $where="";
 if(!empty($_GET["depart"])&&!empty($_GET["jusque"])){
   $where="and journee.date BETWEEN '".$_GET["depart"]."' and '".$_GET["jusque"]."'";
 }
 $sql="select journee.id_journee as idjournee,sum(qte_vendue_dd*dd.prix+qte_vendue_dg*dg.prix+qte_vendue_sg*sg.prix) as facture ,recette
,recette-sum(qte_vendue_dd*dd.prix+qte_vendue_dg*dg.prix+qte_vendue_sg*sg.prix) as ecart,DATE_FORMAT(journee.date,'%d/%m/%Y') as date from commande_detail
join produit_prix as dd on commande_detail.id_produit_prix_dd=dd.id_produit_prix
join produit_prix as dg on commande_detail.id_produit_prix_dg=dg.id_produit_prix
join produit_prix as sg on commande_detail.id_produit_prix_sg=sg.id_produit_prix
join journee on commande_detail.id_journee=journee.id_journee
where id_vendeur=".$vendeur->id."  group by commande_detail.id_journee order by journee.date DESC";

 $result=$database->query($sql." limit $debut, 10");
$statistique=array();
while ($row=mysqli_fetch_assoc($result)) {
  $som_ecart+=$row["ecart"];
  $statistique[]=new Statistique($row["idjournee"],$row["date"],$row['facture'],$row["recette"],$row["ecart"]);
}
}
?>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title></title>
    <?php CSS();?>
    <script src="js/standrad.js">
    </script>
  </head>
  <body onload="<?php if(isset($_GET["idVendeur"])){ ?>
         Tab('<?php if(isset($_GET["page"])){echo "journee";}else{echo 'Information';} ?>')
         <?php } ?>">
    <?php NavBar(); ?>
    <div class="page">
      <?php SideBar(); ?>
      <div class="detail">
        <div class="titre_bar">
          <label for="" class="titre_bar_label">
            <a href="Vendeur.php"><img src="img/icon/back_bleu_40px.png" alt=""></a>
             Vendeur
          </label>
        </div>
        <div class="table">
          <?php if (isset($_GET["idVendeur"])): ?>
            <div class="nav_tab">
              <div class="nav_tab_item"  id="Information_label">
                <label onclick="Tab('Information')" for="">Information</label>
              </div>
              <div class="nav_tab_item" id="journee_label">
                <label onclick="Tab('journee')" for="">journée</label>
              </div>
            </div>
          <?php endif; ?>
          <div id="Information_div" class="nav_tab_div nav_tab_div_active">
            <form class="" action="VendeurControle.php" method="post">
              <div class="left_tab">
              <fieldset class="fields">
                <legend class="legends">Information sur le Vendeur</legend>
                <div class="control_table">
                  <div class="control_table_item">
                    <label class="controllabel" for="" >Nom</label>
                    <input type="text" id="nom" name="VendeurNom"  class="controlinput" value="<?php if(isset($vendeur)) echo $vendeur->nom; ?>" required>
                  </div>
                  <div class="control_table_item">
                    <label class="controllabel" for="" >Prenom</label>
                    <input type="text" id="nom" name="VendeurPrenom"  class="controlinput" value="<?php if(isset($vendeur)) echo $vendeur->prenom; ?>" required>
                  </div>
                  <div class="control_table_item">
                    <label class="controllabel" for="" >Telephone</label>
                    <input type="text" id="nom" name="VendeurTelephone"  class="controlinput"  value="<?php if(isset($vendeur)) echo $vendeur->telephone; ?>" required>
                  </div>
                  <div class="control_table_item">
                      <label for="" class="controllabel">Vehicule</label>
                      <select name="VendeurVehicule" class="controlinput" required>
                        <?php
                        if(isset($vendeur)){$id_vehicule=$vendeur->vehicule->id;}else{$id_vehicule=-1;}
                        $result=$database->query("select * from vehicule");
                        while ($row=mysqli_fetch_assoc($result)) {
                          if($row["id_vehicule"]==$id_vehicule){
                            echo "<option value=\"".$row["id_vehicule"]."\" selected>".$row["nom"]."</option>";
                          }else{
                            echo "<option value=\"".$row["id_vehicule"]."\">".$row["nom"]."</option>";
                          }
                        }
                         ?>
                      </select>
                  </div>
                  <?php if (isset($_GET["idVendeur"])): ?>
                    <div class="control_table_item">
                      <label class="controllabel" for="" >Ecaet</label>
                      <input type="text" id="nom" name="VendeurTelephone" disabled class="controlinput"  value="<?php if(isset($som_ecart)) echo $som_ecart; ?>">
                    </div>
                  <?php endif; ?>
                </div>
                 </fieldset>
             </div>
             <hr>
             <div class="control_div_btn">
               <input type="hidden" name="IdVendeur" value="<?php if(isset($_GET["idVendeur"]))echo $_GET["idVendeur"]; ?>">
               <?php if(isset($_GET["idVendeur"])) {$operation="Modifier"; }else{ $operation="Ajoute"; }?>
               <button type="submit" class="control_btn" name="<?php echo $operation;?>Vendeur">
                 <?php echo $operation;?>
               </button>
             </div>
            </form>
          </div>
          <div id="journee_div" class="nav_tab_div">
            <form class="" action="VendeurControle.php" method="GET">
              <div class="left_tab">
                <fieldset class="fields">
                  <legend class="legends">Information sur commande</legend>
                  <div class="control_table">
                    <div class="control_table_item_7col" >
                      <input type="hidden" name="idVendeur" value="<?php  if(isset($_GET["idVendeur"]))echo $_GET["idVendeur"]; ?>">
                      <label class="controllabel_titre" for="" >Du </label>
                      <input type="date" class="controlinput" name="depart" value="<?php  if(!empty($_GET["depart"])){echo $_GET["depart"];}
                                                                                            else echo date("Y-m-01"); ?>">
                      <label class="controllabel_titre" for="" >Au </label>
                      <input type="date"  class="controlinput" name="jusque" value="<?php if(!empty($_GET["jusque"]))echo $_GET["jusque"];else echo date("Y-m-d"); ?>">
                      <button type="submit" class="control_btn control_btn_rech" name="page" value="1" >
                        Recherche
                      </button>
                      <button type="submit" class="control_btn control_btn_rech control_btn_pdf" name="PDF" value="1" >
                        Ecart PDF
                      </button>
                      <button type="submit" class="control_btn control_btn_rech control_btn_pdf" name="MargePDF" value="1" >
                        Marge PDF
                      </button>
                    </div>
                  </div>
                </fieldset>
              </div>
            </form>
            <div class="left_tab">
              <fieldset class="fields">
                <legend class="legends">liste des Bon Journée</legend>
                <div class="control_table">
                  <table class="infotable info_table_control">
                    <tr>
                      <th>Date</th>
                      <th>Facture</th>
                      <th>Recette</th>
                      <th>Ecart</th>
                      <th>Operation</th>
                    </tr>
                    <?php foreach ($statistique as $key => $value): ?>
                      <tr>
                        <td><?php echo  $value->date; ?></td>
                        <td><?php echo $value->facture; ?></td>
                        <td><?php echo $value->recette;?></td>
                        <td style="color:<?php if(intval($value->ecart)<0){ echo  "red";}else echo "green"; ?>">
                              <?php echo $value->ecart; ?>
                        </td>
                        <td>
                          <a href="Bonjournee.php?id_journee=<?php echo $value->id; ?>" class="produitbtn produitbtnedit">
                            Detail
                          </a>
                          <a href="BonjourneePDF.php?id_journee=<?php echo $value->id; ?>" class="produitbtn produitbtnsupprime">
                            PDF
                          </a>
                          <a href="VendeurControle.php?idVendeur=<?php if(isset($_GET["idVendeur"])) echo $_GET["idVendeur"]; ?>&id_journee_delete=<?php echo $value->id; ?>&page=1" onclick="return confirm('vous les vous vrement supprimer')" class="produitbtn produitbtnsupprime">
                            Supprimer
                          </a>
                        </td>
                      </tr>
                    <?php endforeach; ?>
                  </table>
                  <div class="tableinfo">
                    <ul class="listinfo">
                      <?php
                        TableBar($page,"VendeurControle.php",$_GET,$sql);
                      ?>
                    </ul>
                  </div>
                </div>
              </fieldset>
            </div>
          </div>
        </div>
      </div>
    </div>
  </body>
</html>
