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
  <meta charset="utf-8">
  <title>Mise à jour des formations</title>
</head>
<body onload="gauche()">
  <div id="menu">
    <a href="ajouterFormation.php" onmouseover="droite()" onmouseout="gauche()" class="cercle"><span><span><span></span></span></span></a>
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


  <?php
  if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['nom-ajout']) && isset($_POST['format-ajout']) && isset($_POST['groupe-ajout']) && isset($_POST['duree-ajout'])) {
    $nomFormation = $_POST['nom-ajout'];
    $format = $_POST['format-ajout'];
    $groupe = $_POST['groupe-ajout'];
    $duree = $_POST['duree-ajout'];
    $dates = $_POST['dates'];
    $villes = $_POST['villes'];
     $liens = $_POST['lien'];
     $mois = date('n');
     $annee = date('Y');
     $miseAjour = $moisFR[$mois] . ' ' . $annee;
    $formationDetails = array(
      "contexte" => $_POST['contexte'],
      "public" => $_POST['public'],
      "objectif" => $_POST['objectif'],
      "competence" => $_POST['competence'],
      "contenu" => $_POST['contenu'],
      "methode" => $_POST['methode'],
      "ressource" => $_POST['ressource'],
      "modalite" => $_POST['modalite'],
    );
    $jsonString = file_get_contents('data.json');
    $anciennesDonnees = json_decode($jsonString, true);
    $nvId = nvId($anciennesDonnees);
    $nouvelleInformation = array(
      "id" => $nvId,
      "nom de la formation" => $nomFormation,
      "format" => $format,
      "groupe" => $groupe,
      "duree" => $duree,
      "dates_villes" => array(),
      "mise_a_jour" => $miseAjour
);

for ($i = 0; $i < count($dates); $i++) {
      $date = $dates[$i];
      $ville = $villes[$i];
      $lien = $liens[$i];
      $nouvelleInformation['dates_villes'][] = array("date" => $date, "ville" => $ville, "lien" => $lien);
    }
    $anciennesDonnees[] = $nouvelleInformation;
    $nouveauJsonString = json_encode($anciennesDonnees);
    file_put_contents('data.json', $nouveauJsonString);
    $detailsJsonString = json_encode($formationDetails, JSON_PRETTY_PRINT);
    $detailsFileName = $nomFormation . '.json';
    file_put_contents($detailsFileName, $detailsJsonString);
    $ajout = true;
  }

  function nvId($donnee) {
    $ids = array_column($donnee, 'id');
    if (!empty($ids)) {
        $maxId = max($ids);
        return $maxId + 1;
    } else {
        return 0;
    }
}
  ?>
  <div class="milieu1">
    <br><br><br><br>
    <h2>Ajouter une formation</h2>
    <br><br><br><br><br>
  </div>
  <br>
  <?php if ( isset($ajout) && $ajout == true): ?>
    <p id="aver">Votre formation a bien été ajoutée</p>
  <?php endif; ?>
  <br>
    <form action="" method="POST">
      <div class="formAdmin">
        <label for="nomDeLaFormation">Le nom de la formation:</label><br><br>
        <input class="ifa" type="text" name="nom-ajout" id="nom-ajout" oninput="afficherResultat()"><br><br><br>
        <label for="format">Le format (présentiel ou à distance):</label><br><br>
        <input class="ifa" type="text" name="format-ajout" id="format-ajout" oninput="afficherResultat()"><br><br><br>
        <label for="groupe">Le nombre de personnes dans le groupe:</label><br><br>
        <input class="ifa" type="text" name="groupe-ajout" id="groupe-ajout" oninput="afficherResultat()"><br><br><br>
        <label for="duree">La durée:</label><br><br>
        <input class="ifa" type="text" name="duree-ajout" id="duree-ajout" oninput="afficherResultat()"><br><br>
      </div>
      <br><br><br>
      <div class="pageFormation">
        <div class="formation2">
          <h3 id="resultat-nom"></h3>
          <p><svg height="20px" width="20px" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6"><path stroke-linecap="round" stroke-linejoin="round" d="M4.26 10.147a60.436 60.436 0 00-.491 6.347A48.627 48.627 0 0112 20.904a48.627 48.627 0 018.232-4.41 60.46 60.46 0 00-.491-6.347m-15.482 0a50.57 50.57 0 00-2.658-.813A59.905 59.905 0 0112 3.493a59.902 59.902 0 0110.399 5.84c-.896.248-1.783.52-2.658.814m-15.482 0A50.697 50.697 0 0112 13.489a50.702 50.702 0 017.74-3.342M6.75 15a.75.75 0 100-1.5.75.75 0 000 1.5zm0 0v-3.675A55.378 55.378 0 0112 8.443m-7.007 11.55A5.981 5.981 0 006.75 15.75v-1.5" /></svg> <span id="resultat-format"></span></p>
          <p><svg height="20px" width="20px" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6"><path stroke-linecap="round" stroke-linejoin="round" d="M18 18.72a9.094 9.094 0 003.741-.479 3 3 0 00-4.682-2.72m.94 3.198l.001.031c0 .225-.012.447-.037.666A11.944 11.944 0 0112 21c-2.17 0-4.207-.576-5.963-1.584A6.062 6.062 0 016 18.719m12 0a5.971 5.971 0 00-.941-3.197m0 0A5.995 5.995 0 0012 12.75a5.995 5.995 0 00-5.058 2.772m0 0a3 3 0 00-4.681 2.72 8.986 8.986 0 003.74.477m.94-3.197a5.971 5.971 0 00-.94 3.197M15 6.75a3 3 0 11-6 0 3 3 0 016 0zm6 3a2.25 2.25 0 11-4.5 0 2.25 2.25 0 014.5 0zm-13.5 0a2.25 2.25 0 11-4.5 0 2.25 2.25 0 014.5 0z" /></svg> <span id="resultat-groupe"></span></p>
          <p><svg height="20px" width="20px" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6"><path stroke-linecap="round" stroke-linejoin="round" d="M12 6v6h4.5m4.5 0a9 9 0 11-18 0 9 9 0 0118 0z" /></svg> <span id="resultat-duree"></span></p>
        </div>
      </div>
      <br><br><br>
      <div class="formAdmin">
        <label for="contexteDeLaFormation">Le contexte de la formation:</label><br><br>
        <textarea class="ifa" name="contexte" id="contexte" rows="6"required></textarea><br><br><br>
        <label for="public">Le public visé:</label><br><br>
        <textarea class="ifa" name="public" id="public" rows="6"required></textarea><br><br>
        <label for="objectif">Les objectifs de la formation:</label><br><br>
        <textarea class="ifa" name="objectif" id="objectif" rows="6" required></textarea><br><br><br>
        <label for="competence">Les compétences visées:</label><br><br>
        <textarea class="ifa" name="competence" id="competence" rows="6" required></textarea><br><br><br>
        <label for="contenu">Le contenu de la formation:</label><br><br>
        <textarea class="ifa" name="contenu" id="contenu" rows="6" required></textarea><br><br><br>
        <label for="methode">Les méthodes utilisées:</label><br><br>
        <textarea class="ifa" name="methode" id="methode" rows="6" required></textarea><br><br><br>
        <label for="ressource">Les ressources pédagogiques:</label><br><br>
        <textarea class="ifa" name="ressource" id="ressource" rows="6" required></textarea><br><br><br>
        <label for="modalite">Les modalités d'évaluation:</label><br><br>
        <textarea class="ifa" name="modalite" id="modalite" rows="6" required></textarea><br><br><br>
          <div id="datesVilles">
          <div class="datesVilles2">
          </div>
          </div>
        <button type="button" id="ajouterDatesVilles" class="ajout3">Ajouter une date et une ville</button><br><br>
        <script>
        document.getElementById("ajouterDatesVilles").addEventListener("click", function() {
          var datesVilles = document.getElementById("datesVilles");
          var nvDatesVilles = document.createElement("div");
          nvDatesVilles.classList.add("datesVilles2");
          nvDatesVilles.innerHTML = `
          <input type="text" class="ifa" name="dates[]" placeholder="Date" required><br><br>
          <input type="text" class="ifa" name="villes[]" placeholder="Ville" required><br><br>
          <input type="text" class="ifa" name="lien[]" placeholder="Lien" required><br><br>
          <button type="button" class="ajout3" id="supprimerDatesVilles">Supprimer</button><br><br>
          `;
          datesVilles.appendChild(nvDatesVilles);
          var removeButton = nvDatesVilles.querySelector("#supprimerDatesVilles");
          removeButton.addEventListener("click", function() {
            datesVilles.removeChild(nvDatesVilles);
          });
        });
        </script>
      <input type="submit" class ="ajout" value="Ajouter">
    </div><br><br>
    </form>
</body>
</html>
