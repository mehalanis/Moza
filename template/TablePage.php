<!DOCTYPE html>
<?php 
include 'php/Standard.php';
?>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title></title>
    <script src="js/standrad.js">

    </script>
    <?php CSS();?>
  </head>
  <body>
    <?php NavBar(); ?>
    <div class="page">
      <?php Sidebar(); ?>
      <div class="detail">
        <div class="titre_bar">
          <label for="" class="titre_bar_label">
            <a href="index.php"><img src="img/icon/back_bleu_40px.png" alt=""></a>
            Nom Page ....
          </label>
        </div>
        <div class="table">
          <form class="" action="Client.php" method="post">
          <div class="bartable">
              <a href="ClientControle.php"><img src="img/icon/add32pxgreen.png" alt=""></a>
              <button type="submit" class="btn_remove_all" name="button"><img src="img/icon/remove32px.png" alt=""></button>
          </div>
          <div class="divtable">
            <div class="barrecherche">
              <input type="text" name="rech" value="">
              <button type="submit"><img src="img/icon/search24pxwhite.png"></button>
            </div>
            <table class="infotable">
              <thead>
                <tr>
                  <th><input type="checkbox" name=""></th>
                  <th>titre test</th>
                </tr>
              </thead>
              <tbody>
                <tr>
                  <td>Test Value</td>
                </tr>
              </tbody>
            </table>
            <div class="tableinfo">
              <ul class="listinfo">
                <?php
                  //$Table->bar();
                ?>
              </ul>
            </div>
          </div>
          </form>
        </div>
      </div>
    </div>
  </body>
</html>
