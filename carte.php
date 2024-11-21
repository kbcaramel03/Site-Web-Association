<?php
  session_start();
  if((!isset($_SESSION["nom"]))){
    header("Location: deconnexion.php");
  }
?>
<!DOCTYPE HTML>
<html>
<head>
  <link rel="stylesheet" type="text/css" href="monStyle2.css">
  <script type="text/javascript" src="mesFonctions.js"></script>
  <meta charset="utf-8">
  <title>Mise à jour des formations</title>
</head>
<body onload="gauche()">
  <div id="menu">
    <a href="carte.php" onmouseover="droite()" onmouseout="gauche()" class="cercle"><span><span><span></span></span></span></a>
    <h1 id="ifjr">IFJR</h1>
    <br><br><br>
    <a id="bouton1" class="button" href="ajouterFormation.php">Ajouter Formation</a>
    <a id="bouton2" class="button" href="modifierFormation.php">Modifier Formation</a>
    <a id="bouton3" class="button" href="ajouterMenu.php">Ajouter Menu</a>
    <a id="bouton4" class="button" href="modifierMenu.php">Modifier Menu</a>
    <a id="bouton5" class="button" href="messages.php">Messages</a>
    <a id="bouton6" class="button" href="carte.php">Carte</a>
    <a id="bouton7" href="deconnexion.php"></a>
  </div>
  <br><br><br><br><br><br>


  <div class="carte">
    <div class="milieu1">
      <br><br><br><br>
      <h2>Modification de la carte</h2>
      <br><br><br><br><br>
    </div>
      <?php
      $jsonString = file_get_contents('etat.json');
      $data = json_decode($jsonString, true);
      if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $index = $_POST['id'];
        if (isset($data[$index])) {
          $nom = isset($_POST['nom']) ? $_POST['nom'] : '';
          $prenom = isset($_POST['prenom']) ? $_POST['prenom'] : '';
          $adresse = isset($_POST['adresse']) ? $_POST['adresse'] : '';
          $telephone = isset($_POST['telephone']) ? $_POST['telephone'] : '';
          $mediation = $_POST['mediation'];
          $rencontre = $_POST['rencontre'];
          $soutien = $_POST['soutien'];
          $etat = $_POST['etat'];
          if ($etat === 'rouge' || $etat === 'orange') {
            $nom = '';
            $prenom = '';
            $adresse = '';
            $telephone = '';
          }
          $data[$index]['nom'] = $nom;
          $data[$index]['prenom'] = $prenom;
          $data[$index]['adresse'] = $adresse;
          $data[$index]['telephone'] = $telephone;
          $data[$index]['etat'] = $etat;
          $data[$index]['mediation'] = $mediation;
          $data[$index]['rencontre'] = $rencontre;
          $data[$index]['soutien'] = $soutien;
        }
        $updatedJsonString = json_encode($data);
        file_put_contents('etat.json', $updatedJsonString);
      }
      ?>
      <div class="center">
      <?php foreach ($data as $index => $departement): ?>
      <?php if (is_array($departement)): ?>
        <div id="departement-<?php echo $index; ?>" class="departement">
          <form method="POST" action="">
            <input type="hidden" name="id" value="<?php echo $index; ?>">
            <h3>Département : <?php echo $departement['departement']; ?></h3>
            <label for="nom">Nom :</label><br>
            <?php if ($departement['etat'] !== 'rouge' && $departement['etat'] !== 'orange'): ?>
              <?php if (isset($departement['nom'])): ?>
                <input type="text" id="nom" name="nom" value="<?php echo $departement['nom']; ?>"><br>
              <?php else: ?>
                <input type="text" id="nom" name="nom" value="" disabled><br>
              <?php endif; ?>
            <?php else: ?>
              <input type="text" id="nom" name="nom" value="" disabled><br>
            <?php endif; ?>
            <label for="prenom">Prénom :</label><br>
            <?php if ($departement['etat'] !== 'rouge' && $departement['etat'] !== 'orange'): ?>
              <?php if (isset($departement['prenom'])): ?>
                <input type="text" id="prenom" name="prenom" value="<?php echo $departement['prenom']; ?>"><br>
              <?php else: ?>
                <input type="text" id="prenom" name="prenom" value="" disabled><br>
              <?php endif; ?>
            <?php else: ?>
              <input type="text" id="prenom" name="prenom" value="" disabled><br>
            <?php endif; ?>
            <label for="adresse">Adresse :</label><br>
            <?php if ($departement['etat'] !== 'rouge' && $departement['etat'] !== 'orange'): ?>
              <?php if (isset($departement['adresse'])): ?>
                <input type="text" id="adresse" name="adresse" value="<?php echo $departement['adresse']; ?>"><br>
              <?php else: ?>
                <input type="text" id="adresse" name="adresse" value="" disabled><br>
              <?php endif; ?>
            <?php else: ?>
              <input type="text" id="adresse" name="adresse" value="" disabled><br>
            <?php endif; ?>
            <label for="telephone">Téléphone :</label><br>
            <?php if ($departement['etat'] !== 'rouge' && $departement['etat'] !== 'orange'): ?>
              <?php if (isset($departement['telephone'])): ?>
                <input type="text" id="telephone" name="telephone" value="<?php echo $departement['telephone']; ?>"><br>
              <?php else: ?>
                <input type="text" id="telephone" name="telephone" value="" disabled><br>
              <?php endif; ?>
            <?php else: ?>
              <input type="text" id="telephone" name="telephone" value="" disabled><br>
            <?php endif; ?>
            <label for="etat">État :</label>
            <select id="etat" name="etat" onchange="changementEtat(this)">
              <option value="rouge" <?php if ($departement['etat'] === 'rouge') echo 'selected'; ?>>Rouge</option>
              <option value="orange" <?php if ($departement['etat'] === 'orange') echo 'selected'; ?>>Orange</option>
              <option value="vert" <?php if ($departement['etat'] === 'vert') echo 'selected'; ?>>Vert</option>
            </select><br><br>
            <label for="soutien">Soutien :</label>
            <select name="soutien" onchange="changementEtat(this)">
              <option value="non" <?php if ($departement['soutien'] === 'non') echo 'selected'; ?>>Non</option>
              <option value="oui" <?php if ($departement['soutien'] === 'oui') echo 'selected'; ?>>Oui</option>
            </select><br><br>
            <label for="soutien">Méditation :</label>
            <select name="mediation" onchange="changementEtat(this)">
              <option value="non" <?php if ($departement['mediation'] === 'non') echo 'selected'; ?>>Non</option>
              <option value="oui" <?php if ($departement['mediation'] === 'oui') echo 'selected'; ?>>Oui</option>
            </select><br><br>
            <label for="soutien">Rencontre :</label>
            <select name="rencontre" onchange="changementEtat(this)">
              <option value="non" <?php if ($departement['rencontre'] === 'non') echo 'selected'; ?>>Non</option>
              <option value="oui" <?php if ($departement['rencontre'] === 'oui') echo 'selected'; ?>>Oui</option>
            </select><br><br>
            <input type="submit" class="ms" value="Modifier">
          </form>
        </div>
      <?php endif; ?>
      <?php endforeach; ?>
    </div>
  </div>
</body>
</html>
