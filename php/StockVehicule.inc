<?php
class StockVehicule {
 public $produit;
 public $quantite;
 public function __construct ( $produit , $quantite) {
  $this->produit = $produit;
  $this->quantite = $quantite;
 }
}
