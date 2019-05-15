<?php
class user{
  public $id;
  public $nom;
  public $prenom;
  public $profession;
  public $email;
  public $password;
  public function __construct($id,$nom,$prenom,$profession,$email,$password)
  {
    $this->id=$id;
    $this->nom=$nom;
    $this->prenom=$prenom;
    $this->profession=$profession;
    $this->email=$email;
    $this->password=$password;
  }
  public function InsertUser()
  {
    $database=new database();
    $database->query("INSERT INTO `user`( `nom`, `prenom`,`profession` ,`email`,  `password`)
                         VALUES ('$this->nom','$this->prenom','$this->profession','$this->email','$this->password')");
  }
  public function UpdateUser()
  {
    $database=new database();
    $sql_password="";
    if(!empty($this->password)){
      $sql_password=" , `password` = '".md5($this->password)."' ";
      $_SESSION["password"]=md5($this->password);
    }
      $_SESSION["nomprenom"]=$this->nom." ".$this->prenom;
    $_SESSION["username"]=$this->email;
    $database->query("UPDATE `user` SET `nom`='$this->nom',`prenom`='$this->prenom'
          ,`email`='$this->email' ,`profession`='$this->profession'
           $sql_password  WHERE id_user=$this->id ");
  }
}
