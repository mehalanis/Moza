<?php 
require 'php/database.inc';
class test {
 public $id;
 public  $id_produit_marge;
 public $nom;
 public $dd_prix;
 public $dg_prix;
 public $sg_prix;
 public function __construct ($id,$id_produit_marge, $nom , $dd_prix , $dg_prix , $sg_prix) { 
   $this->id= $id;
   $this->id_produit_marge= $id_produit_marge;
  $this->nom = $nom;
  $this->dd_prix = $dd_prix;
  $this->dg_prix = $dg_prix;
  $this->sg_prix = $sg_prix;
 }
}
function Affiche($l,$s,$p,$k)
  {
      $date=date("Y-m-d");
      for ($i=$s;$i<=$p;$i++) {
         echo "INSERT INTO `produit` (`id_produit_marge`, `nom`) VALUES (".$l[$i]->id_produit_marge.",'".$l[$i]->nom."');<br>";
         $k++;
      }
      return $k;
  }
$database=new database();
  $result=$database->query("select produit.id_produit as idproduit,produit.nom as nomproduit,produit.id_produit_marge
                          ,dd.id_produit_prix as dd_id_prix,dd.prix as dd_prix,dg.id_produit_prix as dg_id_prix
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
                         group by produit_prix.id_produit)");
  $list=array();
  while ($row=mysqli_fetch_assoc($result)) {
      $list[]=new test($row["idproduit"],$row["id_produit_marge"],$row["nomproduit"],$row["dd_prix"],$row["dg_prix"],$row["sg_prix"]);
  }
  
  echo "<table>";
  $k=1;
  $k=Affiche($list,0,2,$k);
  $k=Affiche($list,19,19,$k);
  Affiche($list,3,18,$k);
  echo "</table>";
 ?>