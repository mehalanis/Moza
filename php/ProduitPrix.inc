<?php
class ProduitPrix {
 public $id;
 public $produitprixtype;
 public $prix;
 public $date;
 public function __construct ( $id , $produitprixtype , $prix , $date) {
  $this->id = $id;
  $this->produitprixtype = $produitprixtype;
  $this->prix = $prix;
  $this->date = $date;
 }
}
