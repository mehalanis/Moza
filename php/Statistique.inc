<?php
class Statistique { 
 public $id;
 public $date;
 public $facture;
 public $recette;
 public $ecart;
 public function __construct ( $id , $date , $facture , $recette , $ecart) { 
  $this->id = $id;
  $this->date = $date;
  $this->facture = $facture;
  $this->recette = $recette;
  $this->ecart = $ecart;
 }
}