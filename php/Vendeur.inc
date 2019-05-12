<?php
class Vendeur { 
 public $id;
 public $vehicule;
 public $nom;
 public $prenom;
 public $telephone;
 public function __construct ( $id , $vehicule , $nom , $prenom , $telephone) { 
  $this->id = $id;
  $this->vehicule = $vehicule;
  $this->nom = $nom;
  $this->prenom = $prenom;
  $this->telephone = $telephone;
 }
}