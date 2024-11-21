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
    <a href="messages.php" onmouseover="droite()" onmouseout="gauche()" class="cercle"><span><span><span></span></span></span></a>
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

  <div class="messages">
    <div class="milieu1">
        <br><br><br><br>
        <h2>Messages</h2>
        <br><br><br><br><br>
    </div>
    <div class="pageFormation">
        <div class="center">
            <?php
            $messages = array();
            if (file_exists('messages.json')) {
                $jsonString = file_get_contents('messages.json');
                $messages = json_decode($jsonString, true);
            }
            ?>
            <?php foreach ($messages as $messageId => $msg) : ?>
                <?php
                $nom = $msg['nom'];
                $prenom = $msg['prenom'];
                $email = $msg['email'];
                $formation = $msg['formation'];
                $message = $msg['message'];
                $lu = isset($msg['lu']) && $msg['lu'];
                ?>
                <div class="message">
                    <h4><?php echo $nom . ' ' . $prenom; ?></h4>
                    <p><?php echo $formation; ?></p>
                    <p><?php echo $email; ?></p>
                    <form action="" method="POST" style="display: inline;">
                        <input type="hidden" name="messageId" value="<?php echo $messageId; ?>">
                        <button class="ms">Voir le message</button>
                    </form>
                    <?php if ($lu) : ?>
                        <span class="lu"></span>
                    <?php else : ?>
                        <span class="nonlu"></span>
                    <?php endif; ?>
                </div>
                <?php if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['messageId']) && $_POST['messageId'] == $messageId) : ?>
                    <div class="modal" id="message-<?php echo $messageId; ?>">
                        <div class="boitemessages">
                            <span class="fermerX" onclick="fermerX(this)" id="<?php echo $messageId; ?>">X</span>
                            <h4><?php echo $nom . ' ' . $prenom; ?></h4>
                            <p><?php echo $formation; ?></p>
                            <p><?php echo $email; ?></p>
                            <p><?php echo $message; ?></p>
                        </div>
                    </div>
                    <?php
                    $messages[$messageId]['lu'] = true;
                    $updatedJsonString = json_encode($messages);
                    file_put_contents('messages.json', $updatedJsonString);
                    ?>
                <?php endif; ?>
            <?php endforeach; ?>
        </div>
    </div>
</div>
</body>
</html>
