<?php
class CommandeDetail {
 public $id;
 public $nomproduit;
 public $qte_initiale;
 public $qte_sortie;
 public $qte_vendue;
 public function __construct ( $id , $nomproduit , $qte_initiale  , $qte_sortie , $qte_vendue) {
  $this->id = $id;
  $this->nomproduit = $nomproduit;
  $this->qte_initiale = intval($qte_initiale);
  $this->qte_sortie =intval($qte_sortie);
  $this->qte_vendue = intval($qte_vendue);
 }
 public function getCharge() {
   return ($this->qte_initiale+$this->qte_sortie);
 }
 public function getRetoune() {
   return ($this->getCharge()-$this->qte_vendue);
 }

}
