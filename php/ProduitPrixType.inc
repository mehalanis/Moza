<?php
class ProduitPrixType { 
 public $id;
 public $nom;
 public function __construct ( $id , $nom) { 
  $this->id = $id;
  $this->nom = $nom;
 }
}