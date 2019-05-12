<?php
require_once('TCPDF/tcpdf_import.php');
require 'php/database.inc';
require 'php/StockVehicule.inc';
require 'php/Produit.inc';
require "php/CommandeDetail.inc";
$database=new database();
require 'php/VerifierUser.php';
if(isset($_GET["id_commande"])){
  $result=$database->query("select vendeur.nom as nomvendeur,vendeur.prenom as prenom,vehicule.nom as nomvehicule
  ,DATE_FORMAT(date,'%d/%m/%Y') as date from premier_bon join vendeur join vehicule
  on premier_bon.id_vendeur=vendeur.id_vendeur and vendeur.id_vehicule=vehicule.id_vehicule and
  premier_bon.id_commande=".$_GET["id_commande"]);
  $Vendeur=mysqli_fetch_assoc($result);
  $result=$database->query("select produit.nom as nomprodit , qte_initiale , qte_commande from produit_prix join commande_detail on
                commande_detail.id_produit_prix= produit_prix.id_produit_prix and id_commande=".$_GET["id_commande"]
                ." right join produit on produit_prix.id_produit=produit.id_produit");
  $bon=array();
  while ($row=mysqli_fetch_assoc($result)) {
     $bon[]=new CommandeDetail("",$row["nomprodit"],$row["qte_initiale"],$row["qte_commande"],'','');
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
$pdf->writeHTML("<label>Bon de Charge</label>", true, false, true, false, '');

$pdf->SetFont('times', 'BI', 10);

$pdf->SetY(14,true,false);
$pdf->SetX(10,false);
$pdf->writeHTML("<label>Vehicule : ".$Vendeur["nomvehicule"]."</label>", true, false, true, false, '');

$pdf->SetY(20,true,false);
$pdf->SetX(10,false);
$pdf->writeHTML("<label>Nom du Vendeur : ".$Vendeur["nomvendeur"]." ".$Vendeur["prenom"]."</label>", true, false, true, false, '');

$pdf->SetY(17,true,false);
$pdf->SetX(100,false);
$pdf->writeHTML("<label>Date : ".$Vendeur["date"]."</label>", true, false, true, false, '');



$txt="<table border=\"1\" cellpadding=\"2\" cellspacing=\"0\" align=\"center\">";

$txt.="<tr   nobr=\"true\"><th width=\"150\">Designation</th><th>Qte initiale</th><th>Qte Commande</th><th>Qte Charge</th></tr>";
foreach ($bon as $key => $value) {
  $qte_charge=$value->qte_initiale+$value->qte_commande;
  $txt.="<tr  nobr=\"true\"><td >".$value->nomproduit."</td><td>".$value->qte_initiale."</td><td>$value->qte_commande</td>
  <td>".$qte_charge."</td></tr>";
}
$txt.="</table>";

$pdf->SetY(30,true,false);
$pdf->SetX(5,false);

$pdf->writeHTML($txt, true, false, true, false, '');

$pdf->Output('example_002.pdf', 'I');
}
?>
