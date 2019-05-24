<?php
require_once('TCPDF/tcpdf_import.php');
require 'php/database.inc';
require 'php/StockVehicule.inc';
require 'php/Produit.inc';
require "php/CommandeDetail.inc";
require 'php/Statistique.inc';
$database=new database();
require 'php/VerifierUser.php';

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
$pdf->SetX(80,false);
$pdf->writeHTML("<label>Les Prix Des Produits</label>", true, false, true, false, '');

$result=$database->query("select produit.id_produit as idproduit,produit.nom as nomproduit
                       ,dd.prix as dd_prix,dg.prix as dg_prix,sg.prix as sg_prix
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


$txt="<table border=\"1\" cellpadding=\"2\" cellspacing=\"0\" align=\"center\">";

$txt.="<tr   nobr=\"true\"><th width=\"230\">Nom</th><th width=\"150\">La D.D</th><th width=\"150\">D.G</th><th width=\"150\">S.G</th></tr>";
while ($row= mysqli_fetch_assoc($result)) {
  $txt.="<tr  nobr=\"true\"><td >".$row["nomproduit"]."</td><td>".$row["dd_prix"]." DA</td><td>".$row['dg_prix']." DA</td>
  <td>".$row['sg_prix']." DA</td></tr>";
}
$txt.="</table>";

$pdf->SetFont('times', 'BI', 12);
$pdf->SetY(20,true,false);
$pdf->SetX(5,false);
$pdf->writeHTML($txt, true, false, true, false, '');


$pdf->Output('ProduitPrix.pdf', 'I');

?>
