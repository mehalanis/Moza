<!DOCTYPE html>
<?php
require 'php/Standard.php';
require 'php/VerifierUser.php';
 ?>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title></title>
    <?php CSS();?>
  </head>
  <body>
    <?php NavBar();?>
    <div class="page">
      <?php SideBar(); ?>
      <div class="detail">
        <div class="titre_bar">
          <label for="" class="titre_bar_label"> Accueil </label>
        </div>
        <div class="index">
          <div class="list_item">
            <a href="Vendeur.php" class="item_page_a">
              <div class="item_page">
                <div class="item_page_icon">
                  <img src="img/icon/clientxwhite62px.png" alt="">
                </div>
                <div class="item_page_titre">
                   <label for="">Vendeur</label>
                </div>
              </div>
            </a>
            <a href="Produit.php" class="item_page_a">
              <div class="item_page">
                <div class="item_page_icon">
                  <img src="img/icon/bottlewhite62px.png" alt="">
                </div>
                <div class="item_page_titre">
                   <label for="">Produit</label>
                </div>
              </div>
            </a>
            <a href="ProduitPrixType.php" class="item_page_a">
              <div class="item_page">
                <div class="item_page_icon">
                  <img src="img/icon/ProduitPrixType62px.png" alt="">
                </div>
                <div class="item_page_titre">
                   <label for="" >Offres</label>
                </div>
              </div>
            </a>
            <a href="Vehicule.php" class="item_page_a">
              <div class="item_page">
                <div class="item_page_icon">
                  <img src="img/icon/camionwhite62px.png" alt="">
                </div>
                <div class="item_page_titre">
                   <label for="">Vehicule</label>
                </div>
              </div>
            </a>
          </div>
        </div>
      </div>
    </div>
  </body>
</html>
