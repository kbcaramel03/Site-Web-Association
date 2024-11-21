<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['titreInfo']) && isset($_POST['texteInfo'])) {
$titreInfo = $_POST['titreInfo'];
$texteInfo = $_POST['texteInfo'];
$jsonString = file_get_contents('menuinfo.json');
$anciennesDonnees = json_decode($jsonString, true);
$nvId = nvId($anciennesDonnees);
$nouvelleInformation = array(
    "id" => $nvId,
    "titre" => $titreInfo,
    "info" => $texteInfo,
);
$anciennesDonnees[] = $nouvelleInformation;
$nouveauJsonString = json_encode($anciennesDonnees);
file_put_contents('menuinfo.json', $nouveauJsonString);
}
function nvId($donnee){
$ids = array_column($donnee, 'id');
$maxId = max($ids);
return $maxId + 1;
}
?>
<!DOCTYPE HTML>
<html>
<head>
  <link rel="stylesheet" type="text/css" href="monStyle2.css">
  <script type="text/javascript" src="mesFonctions.js"></script>
  <meta charset="utf-8">
  <title>Mise à jour du menu</title>
</head>

<div class="milieu1">
  <br><br><br><br>
  <h2>Ajouter une information</h2>
  <br><br><br><br><br>
</div>
<br><br>
<div class="formAdmin">
  <form action="ajoutMenu.php" method="POST">
    <label for="titreInfo">Le titre de l'information:</label><br><br>
    <input class="ifa" type="text" name="titreInfo" id="titreInfo"><br><br><br>
    <label for="format">Texte de l'information:</label><br><br>
    <input class="ifa" type="text" name="texteInfo" id="texteInfo"><br><br><br>
    <input type="submit" class ="ajout"value="Ajouter">
    </form>
  </div>
    </body>
</html>
