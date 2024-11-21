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
      $new_mdp = $_POST['new_mdp'];
      $verif_mdp = $_POST['verif_mdp'];
      if(file_exists('identifiant.json')){
        $contenuFichier = file_get_contents('identifiant.json');
        $utilisateurs = json_decode($contenuFichier, true);
        foreach ($utilisateurs as $utilisateur) {
          if($utilisateur['id'] === $id && password_verify($mdp, $utilisateur['mdp']) === true && $new_mdp === $verif_mdp){
            $utilisateur['mdp'] = password_hash($new_mdp, PASSWORD_DEFAULT);
            $newmdp = json_encode($utilisateur);
            file_put_contents('identifiant.json', "[" . $newmdp . "]");
            $_session["new_mdp_verif"]=0;
            header("Location: accueil.php");
            exit;
          }
        }
        $_session["new_mdp_verif"]=1;
        header("Location: accueil.php");
      }else{;
        $_session["new_mdp_verif"]=1;
        header("Location: accueil.php");
      }
      ?>
    </div>
  </body>
</html>