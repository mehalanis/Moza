<?php

require_once('TCPDF/tcpdf_import.php');
require 'php/database.inc';
require 'php/StockVehicule.inc';
require 'php/Produit.inc';
require "php/CommandeDetail.inc";
$database=new database();
require 'php/VerifierUser.php';
if(isset($_GET["id_journee"])){
  $result=$database->query("select journee.id_journee,vendeur.nom as nomvendeur,vendeur.prenom as prenom,vehicule.nom as nomvehicule
  ,DATE_FORMAT(journee.date,'%d/%m/%Y') as date ,sum(qte_vendue_dd*dd.prix+qte_vendue_dg*dg.prix+qte_vendue_sg*sg.prix) as facture,recette
  ,recette-sum(qte_vendue_dd*dd.prix+qte_vendue_dg*dg.prix+qte_vendue_sg*sg.prix) as ecart from commande_detail
join produit_prix as dd on dd.id_produit_prix=commande_detail.id_produit_prix_dd
join produit_prix as dg on dg.id_produit_prix=commande_detail.id_produit_prix_dg
join produit_prix as sg on sg.id_produit_prix=commande_detail.id_produit_prix_sg
join journee on commande_detail.id_journee=journee.id_journee
join vendeur on vendeur.id_vendeur=journee.id_vendeur
join vehicule on vehicule.id_vehicule=vendeur.id_vehicule
where  commande_detail.id_journee=".$_GET["id_journee"]." group by commande_detail.id_journee");
  $Vendeur=mysqli_fetch_assoc($result);

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

$pdf->SetFont('times', 'BI', 12);

$result=$database->query("select produit.nom as nomproduit , qte_initiale ,qte_sortie,qte_vendue_dd+qte_vendue_dg+qte_vendue_sg as qte_vendue
            ,qte_vendue_dd*dd.prix+qte_vendue_dg*dg.prix+qte_vendue_sg*sg.prix as somme from commande_detail
            join produit_prix as dd on dd.id_produit_prix=commande_detail.id_produit_prix_dd
            join produit_prix as dg on dg.id_produit_prix=commande_detail.id_produit_prix_dg
            join produit_prix as sg on sg.id_produit_prix=commande_detail.id_produit_prix_sg
            right join produit on dd.id_produit=produit.id_produit where id_journee=".$_GET["id_journee"]);
$y=20;

$txt="<table border=\"1\" cellpadding=\"2\" cellspacing=\"0\" align=\"center\">";
$txt.="<tr   nobr=\"true\"><th width=\"200\">Designation</th><th>Qte initiale</th><th>Qte Sortie</th>
<th>Qte Charge</th><th>Qte Vendue</th><th>Qte Retoune</th><th>Total</th></tr>";
while ($row =mysqli_fetch_assoc($result)) {
  $qte_charge=intval($row["qte_initiale"])+intval($row["qte_sortie"]);
  $qte_retoune=(intval($row["qte_initiale"])+intval($row["qte_sortie"]))-intval($row["qte_vendue"]);
  $txt.="<tr  nobr=\"true\"><td >".$row["nomproduit"]."</td><td>".$row["qte_initiale"]."</td><td>".$row["qte_sortie"]
  ."</td><td>".$qte_charge."</td><td>".$row["qte_vendue"]."</td><td>"
  .$qte_retoune."</td><td>".$row["somme"]."</td></tr>";
  $y+=6.8;
}
$txt.="</table>";

$pdf->SetY(20,true,false);
$pdf->SetX(8,false);

$pdf->writeHTML($txt, true, false, true, false, '');


$txt="<table cellpadding=\"2\" >";
$txt.="<tr><th>Facture :</th><td>".$Vendeur["facture"]." DA</td></tr>";
$txt.="<tr><th>Recette :</th><td>".$Vendeur["recette"]." DA</td></tr>";
$txt.="<tr><th>Ecart :</th><td>".$Vendeur["ecart"]." DA</td></tr></table>";

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


$pdf->Output('BonJournee-'.$Vendeur["date"].'.pdf', 'I');
}
?>
