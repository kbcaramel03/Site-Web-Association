
<?php
  session_start();
?>

<!DOCTYPE HTML>
<html>
<head>
  <link rel="stylesheet" type="text/css" href="monStyle.css">
  <script type="text/javascript" src="mesFonctions.js"></script>
  <meta charset="utf-8">
  <title>Accueil</title>
</head>
<body>
<div class="admin">
    <div class="milieuadmin">
      <br><br><br><br><br>
      <h2>Changer le mot de passe</h2>
      <br><br><br><br><br><br><br><br><br>
    </div>
    <br><br>
    <form class="formAdmin" method="POST" action="verificationChangement.php">
      <label for="id">Identifiant</label>
      <br>
      <input type="text" name="id">
      <br><br>
      <label for="mdp">Mot de passe</label>
      <br>
      <input type="password" name="mdp">
      <br><br>
      <label for="mdp">Nouveau mot de passe</label>
      <br>
      <input type="password" name="new_mdp">
      <br><br>
      <label for="mdp">Vérification du nouveau mot de passe</label>
      <br>
      <input type="password" name="verif_mdp">
      <br><br>
      <input type="submit" class="ms" name="submit" value="Confirmer">

      <br><br>
    </form>
    <button class="ms" value="retour" onclick="retour()">Retour</button>
      
</div>
  
</body>
</html>