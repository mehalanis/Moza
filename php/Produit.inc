<?php
class Produit {
 public $id;
 public $nom;
 public $list_prix;
 public function __construct ( $id , $nom , $list_prix) { 
  $this->id = $id;
  $this->nom = $nom;
  $this->list_prix = $list_prix;
 }
}
