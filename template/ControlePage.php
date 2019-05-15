<!DOCTYPE html>
<?php
require 'php/Standard.php';
?>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title></title>
    <?php CSS();?>
    <script src="js/Admin/Controle.js">
    </script>
  </head>
  <body>
    <?php NavBar(); ?>
    <div class="page">
      <?php SideBar(); ?>
      <div class="detail">
        <div class="titre_bar">
          <label for="" class="titre_bar_label">
            <a href="Client.php"><img src="img/icon/back_bleu_40px.png" alt=""></a>
             Nom Page ..
          </label>
        </div>
        <div class="table">
          <form class="" action=".....Controle.php" method="post">
            <div class="left_tab">
              <fieldset class="fields">
                <legend class="legends">Information Du .....</legend>
                <div class="control_table">
                  <div class="control_table_item">
                    <label class="controllabel" for="" >Input</label>
                    <input type="text" name="nom"  class="controlinput">
                  </div>
                  <div class="control_table_item">
                      <label for="" class="controllabel">Select</label>
                      <select name="pays" class="controlinput" >
                      </select>
                  </div>
                  <div class="control_table_item">
                    <label for="" class="controllabel">TextArea</label>
                    <textarea name="address" class="controlinput"></textarea>
                  </div>
                </div>
              </fieldset>
            </div>
            <hr>
            <div class="control_div_btn">
              <input type="hidden" name="client_id" value="">
              <button type="submit" class="control_btn">Ajoute</button>
            </div>
          </form>
        </div>
      </div>
    </div>
  </body>
</html>
