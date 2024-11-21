<?php
  session_start();
  if((!isset($_SESSION["nom"]))){
    header("Location: deconnexion.php");
  }
  $moisFR = array(
    1 => 'janvier',
    2 => 'février',
    3 => 'mars',
    4 => 'avril',
    5 => 'mai',
    6 => 'juin',
    7 => 'juillet',
    8 => 'août',
    9 => 'septembre',
    10 => 'octobre',
    11 => 'novembre',
    12 => 'décembre'
);
?>
<!DOCTYPE HTML>
<html>
<head>
  <link rel="stylesheet" type="text/css" href="monStyle2.css">
  <script type="text/javascript" src="mesFonctions.js"></script>
  <script type="text/javascript" src="mesFonctions2.js"></script>
  <meta charset="utf-8">
  <title>Mise à jour des formations</title>
</head>
<body onload="gauche()">
  <div id="menu">
    <a href="modifierFormation.php" onmouseover="droite()" onmouseout="gauche()" class="cercle"><span><span><span></span></span></span></a>
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


  <div class="modifier">
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
    if (isset($_POST['nom-ms'])) {
        $formationFichier = $_POST['nom-ms'] . '.json';
        if (file_exists($formationFichier)) {
            unlink($formationFichier);
        }
        $updatedJsonString = json_encode($data);
        file_put_contents('data.json', $updatedJsonString);
      }
        }else {
      $nomFormationms = $_POST['nom-ms'];
      $formatms = $_POST['format-ms'];
      $groupems = $_POST['groupe-ms'];
      $dureems = $_POST['duree-ms'];
      $datems = $_POST['dates-ms'];
      $villems = $_POST['villes-ms'];
      $lienms = $_POST['lien-ms'];
      $data[$index]['nom de la formation'] = $nomFormationms;
      $data[$index]['format'] = $formatms;
      $data[$index]['groupe'] = $groupems;
      $data[$index]['duree'] = $dureems;
      $data[$index]['dates_villes'] = array();
      $mois = date('n');
      $annee = date('Y');
      $miseAjour = $moisFR[$mois] . ' ' . $annee;
      $data[$index]['mise_a_jour'] = $miseAjour;
      for ($i = 0; $i < count($datems); $i++) {
        $date = $datems[$i];
        $ville = $villems[$i];
        $lien = $lienms[$i];
        $data[$index]['dates_villes'][] = array(
          'date' => $date,
          'ville' => $ville,
          'lien' => $lien
        );
      }
      $formationFichier = $nomFormationms . '.json';
      $formationJson = array(
        "contexte" => $_POST['contexte'],
        "public" => $_POST['public'],
        "objectif" => $_POST['objectif'],
        "competence" => $_POST['competence'],
        "contenu" => $_POST['contenu'],
        "methode" => $_POST['methode'],
        "ressource" => $_POST['ressource'],
        "modalite" => $_POST['modalite']
      );
      $formationJsonString = json_encode($formationJson);
      file_put_contents($formationFichier, $formationJsonString);
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
            <?php
       $formationFichier = $formation['nom de la formation'] . '.json';
       if (file_exists($formationFichier)) {
           $formationJsonString = file_get_contents($formationFichier);
           $formationJson = json_decode($formationJsonString, true);
       }
       ?>
       <label for="contexte">Contexte :</label><br>
       <textarea class="ifa" id="contexte" name="contexte"><?php echo isset($formationJson['contexte']) ? $formationJson['contexte'] : ''; ?></textarea><br><br>
       <label for="public">Public visé :</label><br>
       <textarea class="ifa" id="public" name="public"><?php echo isset($formationJson['public']) ? $formationJson['public'] : ''; ?></textarea><br><br>
       <label for="competence">Compétences requises :</label><br>
       <textarea class="ifa" id="competence" name="competence"><?php echo isset($formationJson['competence']) ? $formationJson['competence'] : ''; ?></textarea><br><br>
       <label for="objectif">Objectifs :</label><br>
       <textarea class="ifa" id="objectif" name="objectif"><?php echo isset($formationJson['objectif']) ? $formationJson['objectif'] : ''; ?></textarea><br><br>
       <label for="contenu">Contenu :</label><br>
       <textarea class="ifa" id="contenu" name="contenu"><?php echo isset($formationJson['contenu']) ? $formationJson['contenu'] : ''; ?></textarea><br><br>
       <label for="methode">Méthode :</label><br>
       <textarea class="ifa" id="methode" name="methode"><?php echo isset($formationJson['methode']) ? $formationJson['methode'] : ''; ?></textarea><br><br>
       <label for="ressource">Ressources :</label><br>
       <textarea class="ifa" id="ressource" name="ressource"><?php echo isset($formationJson['ressource']) ? $formationJson['ressource'] : ''; ?></textarea><br><br>
       <label for="modalite">Modalités :</label><br>
       <textarea class="ifa" id="modalite" name="modalite"><?php echo isset($formationJson['modalite']) ? $formationJson['modalite'] : ''; ?></textarea><br><br>
       <?php foreach ($formation['dates_villes'] as $index => $dateVille):?>
         <?php if (is_array($dateVille) && isset($dateVille)): ?>
           <div class="datesVilles2">
             <label for="dates-ms">Date :</label>
             <input type="text" name="dates-ms[]" value="<?php echo $dateVille['date']; ?>"><br><br>
             <label for="villes-ms">Ville :</label>
             <input type="text" name="villes-ms[]" value="<?php echo $dateVille['ville']; ?>"><br><br>
             <label for="lien-ms">Lien :</label>
             <input type="text" name="lien-ms[]" value="<?php echo $dateVille['lien']; ?>"><br><br>
             <button class="ms" onclick="supprimerDateVille(this)">Supprimer</button><br><br>
           </div>
         <?php endif; ?>
       <?php endforeach; ?>
       <div id="datesVilles"></div>
       <input type="button" class="ms" value="Ajouter une date et ville" onclick="ajouterDateVille()"><br><br>
       <input type="submit" class="ms" value="Enregistrer">
     </form><br>
     <form method="POST" action="" onsubmit="return confirm('Êtes-vous sûr de vouloir supprimer cette formation ?');">
        <input type="hidden" name="id" value="<?php echo $formation["id"]; ?>">
        <input type="hidden" name="nom-ms" value="<?php echo $formation['nom de la formation']; ?>">
        <input type="hidden" name="delete">
        <input type="submit" class="ms" value="Supprimer cette formation">
      </form>
    </div>
  <?php endif; ?>
<?php endforeach; ?>
  </div>
  </div>
</body>
</html>
