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
    <a href="accueil.php" onmouseover="droite()" onmouseout="gauche()" class="cercle"><span><span><span></span></span></span></a>
    <h1 id="ifjr">IFJR</h1>
    <div><a id="bouton1" class="button" href="ajouter.php">Ajouter</a></div>
    <div><a id="bouton2" class="button">Modifier</a></div>
    <div><a id="bouton3" class="button">Messages</a></div>
    <div><a id="bouton5" class="button">Carte</a></div>
    <div><a id="bouton4" href="accueil.php"></a></div>
  </div>
  <br><br><br><br><br><br>


  <div class="ajouter">
    <?php
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['nom-ajout']) && isset($_POST['format-ajout']) && isset($_POST['groupe-ajout']) && isset($_POST['duree-ajout'])) {
    $nomFormation = $_POST['nom-ajout'];
    $format = $_POST['format-ajout'];
    $groupe = $_POST['groupe-ajout'];
    $duree = $_POST['duree-ajout'];
    $jsonString = file_get_contents('data.json');
    $anciennesDonnees = json_decode($jsonString, true);
    $nvId = nvId($anciennesDonnees);
    $nouvelleInformation = array(
        "id" => $nvId,
        "nom de la formation" => $nomFormation,
        "format" => $format,
        "groupe" => $groupe,
        "duree" => $duree
    );
    $anciennesDonnees[] = $nouvelleInformation;
    $nouveauJsonString = json_encode($anciennesDonnees);
    file_put_contents('data.json', $nouveauJsonString);
}
function nvId($donnee){
    $ids = array_column($donnee, 'id');
    $maxId = max($ids);
    return $maxId + 1;
}
?>
    <div class="milieu1">
      <br><br><br><br>
      <h2>Ajouter une formation</h2>
      <br><br><br><br><br>
    </div>
    <br><br>
    <div class="formAdmin">
      <form action="" method="POST">
        <label for="nomDeLaFormation">Le nom de la formation:</label><br><br>
        <input class="ifa" type="text" name="nom-ajout" id="nom-ajout" oninput="afficherResultat()"><br><br><br>
        <label for="format">Le format (présentiel ou à distance):</label><br><br>
        <input class="ifa" type="text" name="format-ajout" id="format-ajout" oninput="afficherResultat()"><br><br><br>
        <label for="groupe">Le nombre de personnes dans le groupe:</label><br><br>
        <input class="ifa" type="text" name="groupe-ajout" id="groupe-ajout" oninput="afficherResultat()"><br><br><br>
        <label for="duree">La durée:</label><br><br>
        <input class="ifa" type="text" name="duree-ajout" id="duree-ajout" oninput="afficherResultat()"><br><br>
        <input type="submit" class ="ajout"value="Ajouter">
      </form>
    </div><br><br><br>
    <div class="pageFormation">
      <div class="formation2">
        <h3 id="resultat-nom"></h3>
        <p><svg height="20px" width="20px" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6"><path stroke-linecap="round" stroke-linejoin="round" d="M4.26 10.147a60.436 60.436 0 00-.491 6.347A48.627 48.627 0 0112 20.904a48.627 48.627 0 018.232-4.41 60.46 60.46 0 00-.491-6.347m-15.482 0a50.57 50.57 0 00-2.658-.813A59.905 59.905 0 0112 3.493a59.902 59.902 0 0110.399 5.84c-.896.248-1.783.52-2.658.814m-15.482 0A50.697 50.697 0 0112 13.489a50.702 50.702 0 017.74-3.342M6.75 15a.75.75 0 100-1.5.75.75 0 000 1.5zm0 0v-3.675A55.378 55.378 0 0112 8.443m-7.007 11.55A5.981 5.981 0 006.75 15.75v-1.5" /></svg> <span id="resultat-format"></span></p>
        <p><svg height="20px" width="20px" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6"><path stroke-linecap="round" stroke-linejoin="round" d="M18 18.72a9.094 9.094 0 003.741-.479 3 3 0 00-4.682-2.72m.94 3.198l.001.031c0 .225-.012.447-.037.666A11.944 11.944 0 0112 21c-2.17 0-4.207-.576-5.963-1.584A6.062 6.062 0 016 18.719m12 0a5.971 5.971 0 00-.941-3.197m0 0A5.995 5.995 0 0012 12.75a5.995 5.995 0 00-5.058 2.772m0 0a3 3 0 00-4.681 2.72 8.986 8.986 0 003.74.477m.94-3.197a5.971 5.971 0 00-.94 3.197M15 6.75a3 3 0 11-6 0 3 3 0 016 0zm6 3a2.25 2.25 0 11-4.5 0 2.25 2.25 0 014.5 0zm-13.5 0a2.25 2.25 0 11-4.5 0 2.25 2.25 0 014.5 0z" /></svg> <span id="resultat-groupe"></span></p>
        <p><svg height="20px" width="20px" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6"><path stroke-linecap="round" stroke-linejoin="round" d="M12 6v6h4.5m4.5 0a9 9 0 11-18 0 9 9 0 0118 0z" /></svg> <span id="resultat-duree"></span></p>
      </div>
    </div>
    </div>


    <div class="modifier" hidden>
      <div class="milieu4">
        <br><br><br><br>
        <h2>Modifier ou supprimer une formation</h2>
        <input id="chercherformation" class="barre" onkeyup="chercher3()" type="text">
        <br><br><br><br><br><br><br><br>
      </div>
      <div class="pageFormation">
        <?php
        $jsonString = file_get_contents('data.json');
        $data = json_decode($jsonString, true);
        if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset( $_POST['id'])) {
          $index = $_POST['id'];
          if (isset($data[$index])) {
            if (isset($_POST['delete'])) {
              unset($data[$index]);
              echo '<script>document.getElementById("formation-'.$index.'").remove();</script>';
            } else {
              $nomFormationms = $_POST['nom-ms'];
              $formatms = $_POST['format-ms'];
              $groupems = $_POST['groupe-ms'];
              $dureems = $_POST['duree-ms'];
              $data[$index]['nom de la formation'] = $nomFormationms;
              $data[$index]['format'] = $formatms;
              $data[$index]['groupe'] = $groupems;
              $data[$index]['duree'] = $dureems;
            }
            $updatedJsonString = json_encode($data);
            file_put_contents('data.json', $updatedJsonString);
          }
        }
        ?>
        <?php foreach ($data as $index => $formation): ?>
        <?php if (is_array($formation)): ?>
          <div id="formation-<?php echo $index; ?>" class="formation3">
            <h3 class="titrems"><?php echo $formation['nom de la formation']; ?></h3>
            <p><b><svg height="20px" width="20px" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6"><path stroke-linecap="round" stroke-linejoin="round" d="M4.26 10.147a60.436 60.436 0 00-.491 6.347A48.627 48.627 0 0112 20.904a48.627 48.627 0 018.232-4.41 60.46 60.46 0 00-.491-6.347m-15.482 0a50.57 50.57 0 00-2.658-.813A59.905 59.905 0 0112 3.493a59.902 59.902 0 0110.399 5.84c-.896.248-1.783.52-2.658.814m-15.482 0A50.697 50.697 0 0112 13.489a50.702 50.702 0 017.74-3.342M6.75 15a.75.75 0 100-1.5.75.75 0 000 1.5zm0 0v-3.675A55.378 55.378 0 0112 8.443m-7.007 11.55A5.981 5.981 0 006.75 15.75v-1.5" /></svg></b> <?php echo $formation['format']; ?></p>
            <p><b><svg height="20px" width="20px" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6"><path stroke-linecap="round" stroke-linejoin="round" d="M18 18.72a9.094 9.094 0 003.741-.479 3 3 0 00-4.682-2.72m.94 3.198l.001.031c0 .225-.012.447-.037.666A11.944 11.944 0 0112 21c-2.17 0-4.207-.576-5.963-1.584A6.062 6.062 0 016 18.719m12 0a5.971 5.971 0 00-.941-3.197m0 0A5.995 5.995 0 0012 12.75a5.995 5.995 0 00-5.058 2.772m0 0a3 3 0 00-4.681 2.72 8.986 8.986 0 003.74.477m.94-3.197a5.971 5.971 0 00-.94 3.197M15 6.75a3 3 0 11-6 0 3 3 0 016 0zm6 3a2.25 2.25 0 11-4.5 0 2.25 2.25 0 014.5 0zm-13.5 0a2.25 2.25 0 11-4.5 0 2.25 2.25 0 014.5 0z" /></svg></b> <?php echo $formation['groupe']; ?></p>
            <p><b><svg height="20px" width="20px" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6"><path stroke-linecap="round" stroke-linejoin="round" d="M12 6v6h4.5m4.5 0a9 9 0 11-18 0 9 9 0 0118 0z" /></svg></b> <?php echo $formation['duree']; ?></p>
            <form method="POST" action="">
              <input type="hidden" name="id" value="<?php echo $index; ?>">
              <label for="nom">Nom de la formation :</label><br><br>
              <input class="ifa" type="text" id="nom-ms" name="nom-ms" value="<?php echo $formation['nom de la formation']; ?>"><br><br>
              <label for="format">Format :</label><br><br>
              <input class="ifa" type="text" id="format-ms" name="format-ms" value="<?php echo $formation['format']; ?>"><br><br>
              <label for="groupe">Groupe :</label><br><br>
              <input class="ifa" type="text" id="groupe-ms" name="groupe-ms" value="<?php echo $formation['groupe']; ?>"><br><br>
              <label for="duree">Durée :</label><br><br>
              <input class="ifa" type="text" id="duree-ms" name="duree-ms" value="<?php echo $formation['duree']; ?>"><br><br>
              <input type="submit" class="ms" value="Enregistrer">
            </form><br>
            <form method="POST" action="" onsubmit="return confirm('Êtes-vous sûr de vouloir supprimer cette formation ?');">
              <input type="hidden" name="id" value="<?php echo $index; ?>">
              <input type="hidden" name="delete" value="true">
              <input type="submit" class="ms" value="Supprimer cette formation">
            </form>
          </div>
        <?php endif; ?>
      <?php endforeach; ?>
    </div>
  </div>



  <div class="messages" hidden>
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
            <button class="ms" onclick="popupmessage('<?php echo $messageId; ?>')">Voir le message</button>
            <?php if ($lu) : ?>
              <span class="lu"></span>
            <?php endif; ?>
            <?php if (!$lu) : ?>
              <span class="nonlu"></span>
            <?php endif; ?>
          </div>
          <div class="modal" id="message-<?php echo $messageId; ?>" hidden>
            <div class="boitemessages">
              <span class="fermerX" onclick="fermerX(this)" id="<?php echo $messageId; ?>">X</span>
              <h4><?php echo $nom . ' ' . $prenom; ?></h4>
              <p><?php echo $formation; ?></p>
              <p><?php echo $email; ?></p>
              <p><?php echo $message; ?></p>
            </div>
          </div>
          <?php endforeach; ?>
        </div>
      </div>
  </div>



  <div class="carte" hidden>
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
