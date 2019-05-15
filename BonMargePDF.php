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
   $where="and journee.date BETWEEN '".$_GET["depart"]."' and '".$_GET["jusque"]."'";
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

$pdf->AddPage();

$pdf->SetFont('times', 'BI', 20);

$pdf->SetY(5,true,false);
$pdf->SetX(90,false);
$pdf->writeHTML("<label>Marge</label>", true, false, true, false, '');

$pdf->SetFont('times', 'BI', 12);

$pdf->SetY(18,true,false);
$pdf->SetX(10,false);
$pdf->writeHTML("<label>Vehicule : ".$Vendeur["nomvehicule"]."</label>", true, false, true, false, '');

$pdf->SetY(18,true,false);
$pdf->SetX(60,false);
$pdf->writeHTML("<label>Vendeur : ".$Vendeur["nomvendeur"]." ".$Vendeur["prenom"]."</label>", true, false, true, false, '');

$pdf->SetY(18,true,false);
$pdf->SetX(135,false);
$pdf->writeHTML("<label> Du ".date_format(date_create($_GET["depart"]),"d/m/Y")." Au "
                 .date_format(date_create($_GET["jusque"]),"d/m/Y")." </label>", true, false, true, false, '');

$result=$database->query("select produit_marge.nom,sum(qte_vendue_dd+qte_vendue_dg+qte_vendue_sg) as qte_vendue
        ,benefice from journee
       join commande_detail on journee.id_journee=commande_detail.id_journee
       join produit_prix on produit_prix.id_produit_prix=commande_detail.id_produit_prix_dd
       join produit on produit_prix.id_produit=produit.id_produit
       join produit_marge on produit_marge.id_produit_marge=produit.id_produit_marge
      where journee.id_vendeur=".$_GET["idVendeur"]." $where  group by produit.id_produit_marge;");

$total=0;
$y=30;
$txt="<table border=\"1\" cellpadding=\"2\" cellspacing=\"0\" align=\"center\">";

$txt.="<tr   nobr=\"true\"><th width=\"150\">Nom</th><th>qte Vendue</th><th>Benefice</th><th>Somme</th></tr>";
while ($row= mysqli_fetch_assoc($result)) {
  $somme=$row["qte_vendue"]*$row['benefice'];
  $total+= $somme;
  $txt.="<tr  nobr=\"true\"><td >".$row["nom"]."</td><td>".$row["qte_vendue"]."</td><td>".$row['benefice']."</td>
  <td>".$somme."</td></tr>";
  $y+=10;
}
$txt.="</table>";

$pdf->SetY(30,true,false);
$pdf->SetX(5,false);
$pdf->writeHTML($txt, true, false, true, false, '');

$txt="<label>Total : ".$total." DA</label>";

$pdf->SetFont('times', 'BI', 14);

$pdf->SetY($y,true,false);
$pdf->SetX(140,false);
$pdf->writeHTML($txt, true, false, true, false, '');

$pdf->Output('BonMarge.pdf', 'I');
}
?>
