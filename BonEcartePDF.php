<?php
require_once('TCPDF/tcpdf_import.php');
require 'php/database.inc';
require 'php/StockVehicule.inc';
require 'php/Produit.inc';
require "php/CommandeDetail.inc";
require 'php/Statistique.inc';
$database=new database();
require 'php/VerifierUser.php';
if(isset($_GET["idVendeur"])){
  $result=$database->query("select vendeur.nom as nomvendeur,vendeur.prenom as prenom,vehicule.nom as nomvehicule from vendeur join vehicule
  on vendeur.id_vehicule=vehicule.id_vehicule and vendeur.id_vendeur=".$_GET["idVendeur"]);
  $Vendeur=mysqli_fetch_assoc($result);
   $where="";
  if(!empty($_GET["depart"])&&!empty($_GET["jusque"])){
   $where="and premier_bon.date BETWEEN '".$_GET["depart"]."' and '".$_GET["jusque"]."'";
  }
  $result=$database->query("select premier_bon.id_commande as idcommande,DATE_FORMAT(premier_bon.date,'%d/%m/%Y') as date
 ,sum(prix*qte_vendue) as facture ,recette ,(recette -sum(prix*qte_vendue)) as ecart from commande_detail
join produit_prix on commande_detail.id_produit_prix=produit_prix.id_produit_prix
join premier_bon on commande_detail.id_commande=premier_bon.id_commande
where id_vendeur=".$_GET["idVendeur"]." $where group by commande_detail.id_commande order by premier_bon.date ASC");
  $bon=array();
  while ($row=mysqli_fetch_assoc($result)) {
     $bon[]=new Statistique($row["idcommande"],$row["date"],$row["facture"],$row["recette"],$row['ecart']);
  }
$pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, "A5", true, 'UTF-8', false);

$pdf->SetCreator(PDF_CREATOR);
$pdf->SetAuthor('Nicola Asuni');
$pdf->SetTitle('TCPDF Example 002');
$pdf->SetSubject('TCPDF Tutorial');
$pdf->SetKeywords('TCPDF, PDF, example, test, guide');

$pdf->setPrintHeader(false);
$pdf->setPrintFooter(false);

$pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);

$pdf->SetMargins("15", "0", PDF_MARGIN_RIGHT);

$pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);

$pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);

if (@file_exists(dirname(__FILE__).'/lang/eng.php')) {
    require_once(dirname(__FILE__).'/lang/eng.php');
    $pdf->setLanguageArray($l);
}
$pdf->SetFont('times', 'BI', 12);

$pdf->AddPage();

$pdf->SetFont('times', 'BI', 14);

$pdf->SetY(5,true,false);
$pdf->SetX(60,false);
$pdf->writeHTML("<label>Bon Ecart</label>", true, false, true, false, '');

$pdf->SetFont('times', 'BI', 10);

$pdf->SetY(14,true,false);
$pdf->SetX(10,false);
$pdf->writeHTML("<label>Vehicule : ".$Vendeur["nomvehicule"]."</label>", true, false, true, false, '');

$pdf->SetY(20,true,false);
$pdf->SetX(10,false);
$pdf->writeHTML("<label>Nom du Vendeur : ".$Vendeur["nomvendeur"]." ".$Vendeur["prenom"]."</label>", true, false, true, false, '');

$pdf->SetY(20,true,false);
$pdf->SetX(80,false);
$pdf->writeHTML("<label> Du ".date_format(date_create($_GET["depart"]),"d/m/Y")." Au "
                 .date_format(date_create($_GET["jusque"]),"d/m/Y")." </label>", true, false, true, false, '');

$facture=0;
$recette=0;
$ecart=0;

$txt="<table border=\"1\" cellpadding=\"2\" cellspacing=\"0\" align=\"center\">";

$txt.="<tr   nobr=\"true\"><th width=\"150\">Date</th><th>Facture</th><th>Recette</th><th>Ecart</th></tr>";
foreach ($bon as $key => $value) {
  $facture+=$value->facture;
  $recette+=$value->recette;
  $ecart+=$value->ecart;
  $txt.="<tr  nobr=\"true\"><td >".$value->date."</td><td>".$value->facture."</td><td>$value->recette</td>
  <td>".$value->ecart."</td></tr>";
}
$txt.="<tr><td>Total</td><td>$facture</td><td>$recette</td><td>$ecart</td></tr>";
$txt.="</table>";

$pdf->SetY(30,true,false);
$pdf->SetX(5,false);

$pdf->writeHTML($txt, true, false, true, false, '');

$pdf->Output('example_002.pdf', 'I');
}
?>
