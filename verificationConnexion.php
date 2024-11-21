<?php
  session_start();
?>
<!DOCTYPE html>
<html>
  <head>
    <link rel="stylesheet" href="monStyle.css">
    <meta charset="utf-8">
    <title>verificationConnexion</title>
  </head>
  <body>
    <div>
      <?php
      $id = $_POST['id'];
      $mdp = $_POST['mdp'];
      if(file_exists('identifiant.json')){
        $contenuFichier = file_get_contents('identifiant.json');
        $utilisateurs = json_decode($contenuFichier, true);
        foreach ($utilisateurs as $utilisateur) {
          if($utilisateur['id'] === $id && password_verify($mdp, $utilisateur['mdp']) === true){
            $_SESSION["nom"]=$id;
            header("Location: ajouterFormation.php");
            exit;
          }
        }
        session_destroy();
        header("Location: accueil.php");
      }else{
        session_destroy();
        header("Location: accueil.php");
      }
      ?>
    </div>
  </body>
</html>
