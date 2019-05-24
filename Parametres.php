<!DOCTYPE html>
<?php
require 'php/Standard.php';
require 'php/database.inc';
require 'php/user.inc';
require 'php/VerifierUser.php';
$database=new database();
if (isset($_POST["Modifier"])) {
  $user=new user($_POST["id_user"],$_POST["nom"],$_POST["prenom"],$_POST["profession"],$_POST["email"],$_POST["username"],$_POST["password"]);
  $user->UpdateUser();
}
$result=$database->query("select * from user where id_user=".$_SESSION['id_user']);
$row=mysqli_fetch_assoc($result);
$user=new user($row["id_user"],$row["nom"],$row["prenom"],$row["profession"],$row["email"],$row["username"],$row["password"])
?>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title></title>
    <?php CSS();?>
  </head>
  <body>
    <?php NavBar(); ?>
    <div class="page">
      <?php SideBar(); ?>
      <div class="detail">
        <div class="titre_bar">
          <label for="" class="titre_bar_label">
            <a href="Client.php"><img src="img/icon/back_bleu_40px.png" alt=""></a>
             Parametre
          </label>
        </div>
        <div class="table">
          <form class="" action="Parametres.php" method="post">
            <div class="left_tab">
            <fieldset class="fields">
              <legend class="legends">Compte d'utilisateur</legend>
              <div class="control_table">
                <?php if(isset($_POST["Modifier"])){  ?>
                  <div class="AlertConfirme">
                    <strong>Succès!</strong> Mise à jour du profil réussie
                  </div>
                <?php } ?>
                <div class="control_table_item">
                  <label class="controllabel" for="" >Nom</label>
                  <input type="text" name="nom" value="<?php echo $user->nom; ?>" class="controlinput">
                </div>
                <div class="control_table_item">
                  <label class="controllabel" for="" >Prenom</label>
                  <input type="text" name="prenom" value="<?php echo $user->prenom; ?>" class="controlinput">
                </div>
                <div class="control_table_item">
                  <label class="controllabel" for="" >Profession</label>
                  <input type="text" name="profession" value="<?php echo $user->profession; ?>" class="controlinput">
                </div>
                <div class="control_table_item">
                  <label class="controllabel" for="" >Email</label>
                  <input type="text" name="email" value="<?php echo $user->email; ?>" class="controlinput">
                </div>
                <div class="control_table_item">
                  <label class="controllabel" for="" >UserName</label>
                  <input type="text" name="username" value="<?php echo $user->username; ?>" class="controlinput">
                </div>
                <div class="control_table_item">
                  <label class="controllabel" for="" >Mot de passe</label>
                  <input type="password" name="password"  class="controlinput">
                </div>
              </div>
               </fieldset>
           </div>
           <hr>
           <div class="control_div_btn">
             <input type="hidden" name="id_user" value="<?php echo $user->id; ?>">
             <button type="submit" class="control_btn" name="Modifier">Modifier</button>
           </div>
          </form>
        </div>
      </div>
    </div>
  </body>
</html>
