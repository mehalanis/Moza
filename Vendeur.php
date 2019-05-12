<!DOCTYPE html>
<?php
include 'php/Standard.php';
require 'php/database.inc';
require 'php/Vendeur.inc';
require 'php/Vehicule.inc';
$database=new database();
require 'php/VerifierUser.php';
if(isset($_POST["VendeurDelete"])){
  foreach ($_POST["VendeurDelete"] as $key => $id_vendeur) {
    $database->query("DELETE FROM `vendeur` WHERE id_vendeur=".$id_vendeur);
  }
}
if(isset($GET['page'])){ $page=$GET['page'];}else{$page=1;}
$debut=$page*10-10;
$where="";
if(!empty($_POST["rech"])){
  $where="where Vendeur.nom like '%".$_POST["rech"]."%' or Vendeur.Prenom like '%".$_POST["rech"]
  ."%' or vehicule.nom like '%".$_POST["rech"]."%' or telephone like '%".$_POST["rech"]."%'";
}
$sql="select id_vendeur as idVendeur,Vendeur.nom as VendeurNom ,Vendeur.Prenom as VendeurPrenom ,
  vehicule.id_vehicule as idvehicule, vehicule.nom as VehiculeNom , matricule,telephone from Vendeur join vehicule
  on Vendeur.id_vehicule=vehicule.id_vehicule $where order by idvehicule ASC ";
$result=$database->query($sql." limit $debut , 10");
$listvendeur=array();
$listbon=array();
while ($row=mysqli_fetch_assoc($result)) {
  $listvendeur[]=new Vendeur($row["idVendeur"],new Vehicule($row["idvehicule"],$row["VehiculeNom"]
                              ,$row["matricule"],""),$row["VendeurNom"],$row["VendeurPrenom"],$row["telephone"]);
  $bon=$database->query("select * from premier_bon where id_vendeur=".$row["idVendeur"]." order by id_commande DESC limit 1 ;");
  if(mysqli_num_rows($result)>0){
    $rowbon=mysqli_fetch_assoc($bon);
    if($rowbon["etat_commande"]==1){
      $item["nom"]="Bon Commande";
      $item["php"]="BonCommande";
      $item["id_bon"]=$rowbon["id_commande"];
    }else{
      $item["nom"]="Bon Charge";
      $item["php"]="BonCharge";
    }
  }else{
      $item["nom"]="Bon Charge";
      $item["php"]="BonCharge";
  }
  $listbon[]=$item;
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
            Vendeur
          </label>
        </div>
        <div class="table">
          <form class="" action="Vendeur.php" method="post">
          <div class="bartable">
              <a href="VendeurControle.php"><img src="img/icon/add32pxgreen.png" alt=""></a>
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
                  <th>Prenom</th>
                  <th>Telephone</th>
                  <th>Vehicule</th>
                  <th>Operation</th>
                </tr>
              </thead>
              <tbody>
                  <?php foreach ($listvendeur as $key => $value): ?>
                    <tr>
                      <td><input type="checkbox" class="remove_list" value="<?php echo $value->id; ?>" name="VendeurDelete[]"/></td>
                      <td><?php echo $value->nom; ?></td>
                      <td><?php echo $value->prenom; ?></td>
                      <td><?php echo $value->telephone; ?></td>
                      <td><?php echo $value->vehicule->nom; ?></td>
                      <td>
                        <a href="<?php echo $listbon[$key]["php"]; ?>.php?<?php if($listbon[$key]["nom"]!="Bon Charge"){echo "id_commande=".$listbon[$key]["id_bon"];}
                        else{echo "idVendeur=".$value->id;}?>" class="produitbtn
                        <?php if($listbon[$key]["nom"]!="Bon Charge"){echo "produitbtn_bon_commande";}else{echo "produitbtn_bon_charge";} ?>">
                          <?php echo $listbon[$key]["nom"]; ?>
                        </a>
                        <a href="VendeurControle.php?idVendeur=<?php echo $value->id; ?>" class="produitbtn produitbtnedit">
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
                  TableBar($page,"Vendeur.php",$_GET,$sql);
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
