<?php
class Vehicule {
 public $id;
 public $nom;
 public $matricule;
 public $StockVehicule;
 public function __construct ( $id , $nom , $matricule , $StockVehicule) {
  $this->id = $id;
  $this->nom = $nom;
  $this->matricule = $matricule;
  $this->StockVehicule = $StockVehicule;
 }
}
