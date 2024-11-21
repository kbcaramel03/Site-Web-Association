<!DOCTYPE HTML>
<html>
<head>
  <link rel="stylesheet" type="text/css" href="monStyle2.css">
  <script type="text/javascript" src="mesFonctions.js"></script>
  <meta charset="utf-8">
  <title>Mise à jour des informations</title>
</head>
<div class="milieu4">
  <br><br><br><br>
  <h2>Modifier ou supprimer une information</h2>
  <br><br><br><br><br><br>
</div>
<div class="pageFormation">
  <?php
  $jsonString = file_get_contents('menuinfo.json');
  $data = json_decode($jsonString, true);
  if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset( $_POST['id'])) {
    $index = $_POST['id'];
    if (isset($data[$index])) {
      if (isset($_POST['delete'])) {
        unset($data[$index]);
        echo '<script>document.getElementById("formation-'.$index.'").remove();</script>';
      } else {
        $titreInfo = $_POST['titreInfo'];
        $texteInfo = $_POST['texteInfo'];
        $data[$index]['titre'] = $titreInfo;
        $data[$index]['info'] = $texteInfo;
      }
      $updatedJsonString = json_encode($data);
      file_put_contents('menuinfo.json', $updatedJsonString);
    }
  }
  ?>
  <?php foreach ($data as $index => $info): ?>
  <?php if (is_array($info)): ?>
    <div class="formation2">
      <h3 class="titreInfo"><?php echo $info['titre']; ?></h3>
      <p><b>Texte:</b> <?php echo $info['info']; ?></p>
      <form method="POST" action="modifInfo.php">
        <input type="hidden" name="id" value="<?php echo $index; ?>">
        <label for="titre">Titre de l'information :</label><br><br>
        <input class="ifa" type="text" id="titreInfo" name="titreInfo" value="<?php echo $info['titre']; ?>"><br><br>
        <label for="texte">Texte :</label><br><br>
        <input class="ifa" type="text" id="texteInfo" name="texteInfo" value="<?php echo $info['info']; ?>"><br><br>
        <input type="submit" class="ms" value="Enregistrer">
      </form><br>
      <form method="POST" action="modifInfo.php" onsubmit="return confirm('Êtes-vous sûr de vouloir supprimer cette information ?');">
        <input type="hidden" name="id" value="<?php echo $index; ?>">
        <input type="hidden" name="delete" value="true">
        <input type="submit" class="ms" value="Supprimer cette information">
      </form>
    </div>
  <?php endif; ?>
<?php endforeach; ?>
</div>
</body>
</html>
