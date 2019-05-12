<?php

require_once('TCPDF/tcpdf_import.php');
require 'php/database.inc';
require 'php/StockVehicule.inc';
require 'php/Produit.inc';
require "php/CommandeDetail.inc";
$database=new database();
require 'php/VerifierUser.php';
if(isset($_GET["id_commande"])){
  $result=$database->query("select premier_bon.id_commande,vendeur.nom as nomvendeur,vendeur.prenom as prenom,vehicule.nom as nomvehicule
  ,DATE_FORMAT(premier_bon.date,'%d/%m/%Y') as date,sum(prix*qte_vendue) as facture ,recette ,(recette -sum(prix*qte_vendue)) as ecart from commande_detail
join produit_prix on commande_detail.id_produit_prix=produit_prix.id_produit_prix
join premier_bon on commande_detail.id_commande=premier_bon.id_commande
join vendeur on vendeur.id_vendeur=premier_bon.id_vendeur
join vehicule on vehicule.id_vehicule=vendeur.id_vehicule
where  commande_detail.id_commande=".$_GET["id_commande"]." group by commande_detail.id_commande");
  $Vendeur=mysqli_fetch_assoc($result);
  $result=$database->query("select produit.nom as nomproduit , qte_initiale , qte_commande,qte_sortie,qte_vendue,prix from produit_prix join commande_detail on
                commande_detail.id_produit_prix= produit_prix.id_produit_prix and id_commande=".$_GET["id_commande"]
                ." right join produit on produit_prix.id_produit=produit.id_produit");
  $bon=array();
  while ($row=mysqli_fetch_assoc($result)) {
     $bon[]=new CommandeDetail("",new Produit("",$row["nomproduit"],$row["prix"]),$row["qte_initiale"],$row["qte_commande"],$row["qte_sortie"],$row["qte_vendue"]);
  }
$pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, "A4", true, 'UTF-8', false);

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

$pdf->AddPage("L");

$pdf->SetFont('times', 'BI', 14);

$pdf->SetY(3,true,false);
$pdf->SetX(110,false);
$pdf->writeHTML("<label>ETAT DES VENTES DE LA FLOTTE</label>", true, false, true, false, '');

$pdf->SetFont('times', 'BI', 12);

$nomvehicule="<span  >Vehicule : <b> ".$Vendeur["nomvehicule"]." </b></span>";

$pdf->SetY(12,true,false);
$pdf->SetX(20,false);
$pdf->writeHTML($nomvehicule, true, false, true, false, '');

$vendeur="<span  >Vendeur : <b>".$Vendeur["nomvendeur"]." ".$Vendeur["prenom"]."</b></span>";

$pdf->SetY(12,true,false);
$pdf->SetX(120,false);
$pdf->writeHTML($vendeur, true, false, true, false, '');

$date="<span style=\"padding-right:50px;\">Date :".$Vendeur["date"]."</span>";

$pdf->SetY(12,true,false);
$pdf->SetX(220,false);
$pdf->writeHTML($date, true, false, true, false, '');



$y=20;
$txt="<table border=\"1\" cellpadding=\"2\" cellspacing=\"0\" align=\"center\">";
$txt.="<tr   nobr=\"true\"><th width=\"150\">Designation</th><th>Qte initiale</th><th>Qte Commande</th><th>Qte Sortie</th>
<th>Qte Charge</th><th>Qte Vendue</th><th>Qte Retoune</th><th>Prix Unitaire</th><th>Total</th></tr>";
foreach ($bon as $key => $value) {

  $txt.="<tr  nobr=\"true\"><td >".$value->nomproduit->nom."</td><td>".$value->qte_initiale."</td><td>$value->qte_commande</td>
  <td>$value->qte_sortie</td><td>".$value->getCharge()."</td><td>$value->qte_vendue</td><td>".$value->getRetoune()."</td>
  <td>".$value->nomproduit->list_prix."</td><td>".intval($value->nomproduit->list_prix)*intval($value->qte_vendue)."</td></tr>";
  $y+=6.8;
}
$txt.="</table>";

$pdf->SetY(20,true,false);
$pdf->SetX(8,false);

$pdf->writeHTML($txt, true, false, true, false, '');


$txt="<table cellpadding=\"2\" >";
$txt.="<tr><th>Facture :</th><td>".$Vendeur["facture"]." DA</td></tr>";
$txt.="<tr><th>Recette :</th><td>".$Vendeur["recette"]." DA</td></tr>";
$txt.="<tr><th>Ecart :</th><td>".$Vendeur["ecart"]." DA</td></tr>";

$pdf->SetFont('times', 'BI', 14);

$pdf->SetY($y,true,false);
$pdf->SetX(230,false);
$pdf->writeHTML($txt, true, false, true, false, '');

$pdf->SetFont('times', 'BI', 12);
$visaVendeur="<span  >VISA VENDEUR</span>";
$y+=22;
$pdf->SetY($y,true,false);
$pdf->SetX(20,false);
$pdf->writeHTML($visaVendeur, true, false, true, false, '');

$visaMagasinier="<span  >VISA MAGASINIER</span>";

$pdf->SetY($y,true,false);
$pdf->SetX(120,false);
$pdf->writeHTML($visaMagasinier, true, false, true, false, '');

$visacaissier="<span  >VISA CAISSIER</span>";

$pdf->SetY($y,true,false);
$pdf->SetX(220,false);
$pdf->writeHTML($visacaissier, true, false, true, false, '');


$pdf->Output('example_002.pdf', 'I');
}
?>
