<?php
session_start();
function formatDetailsListe($details) {
    $formatDetails = preg_replace_callback('/\((.*?)\)/', function($matches) {
        $items = explode(',', $matches[1]);
        $list = '<ul>';
        foreach ($items as $item) {
            $item = trim($item);
            $list .= '<li>' . $item . '</li>';
        }
        $list .= '</ul>';
        return $list;
    }, $details);
    return $formatDetails;
}
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['nom']) && isset($_POST['prenom']) && isset($_POST['email']) && isset($_POST['formation']) && isset($_POST['message']) ) {
        $nom = $_POST['nom'];
        $prenom = $_POST['prenom'];
        $email = $_POST['email'];
        $formation = $_POST['formation'];
        $message = $_POST['message'];
        $messageData = array(
            'nom' => $nom,
            'prenom' => $prenom,
            'email' => $email,
            'formation' => $formation,
            'message' => $message
        );
        $messages = array();
        if (file_exists('messages.json')) {
            $jsonString = file_get_contents('messages.json');
            $messages = json_decode($jsonString, true);
        }
        $messages[] = $messageData;
        $jsonString = json_encode($messages);
        file_put_contents('messages.json', $jsonString);
        //////////////
        $jsonString = file_get_contents('data.json');
        $data = json_decode($jsonString, true);
        $formation=$_SESSION["formation"];
        $formationDetails=$_SESSION["formationDetails"];
    }else{
      $jsonString = file_get_contents('data.json');
      $data = json_decode($jsonString, true);
      if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['id'])) {
        $index = $_POST['id'];
        if (isset($data[$index])) {
            $formation = $data[$index];
            $formationDetails = null;
            $formationFichier = $formation['nom de la formation'] . '.json';
            if (file_exists($formationFichier)) {
                $formationDetailsJson = file_get_contents($formationFichier);
                $formationDetails = json_decode($formationDetailsJson, true);
            }
            $_SESSION['formation'] = $formation;
            $_SESSION['formationDetails'] = $formationDetails;
        }
    }
    }
}

?>
<!DOCTYPE HTML>
<html>
<head>
    <link rel="stylesheet" type="text/css" href="monStyle3.css">
    <script type="text/javascript" src="mesFonctions.js"></script>
    <meta charset="utf-8">
    <title>Détails de la formation</title>
</head>
<body onload="formationsbouton();gauche();">
  <div id="menu">
    <a href="accueil.php" onmouseover="droite()" onmouseout="gauche()" class="cercle"><span><span><span></span></span></span></a>
    <h1 id="ifjr">IFJR</h1>
    <div><a id="bouton1" class="button" href="accueil.php">Menu</a></div>
    <div><span id="bouton2" class="button" onclick="redirectionlocalisation()">Localisation</span></div>
    <div><span id="bouton3" class="button">Formations</span></div>
    <div><span onclick="redirectionadmin()" id="bouton4"></span></div>
  </div>
  <div class="milieuDetail">
    <br><br><br><br><br><br><br><br><br><br><br>
    <h2><?php echo $formation["nom de la formation"]; ?></h2>
    <br><br><br><br><br><br><br><br><br>
  </div><br><br><br><br><br>
  <div class="haut1" >
    <span><b>Format:</b> <?php echo $formation["format"]; ?></span>
    <span><b>Groupe:</b> <?php echo $formation["groupe"]; ?></span>
    <span><b>Durée:</b> <?php echo $formation["duree"]; ?></span>
  </div><br><br>
  <div class="Z1">
      <h2>Le contexte</h2>
      <?php $formatContexte=formatDetailsListe($formationDetails['contexte']) ?>
      <p><?php echo $formatContexte ?> </p>
      <h2>À qui s’adresse cette formation ? </h2>
      <h4>Le public visé</h4>
      <?php $formatPublic=formatDetailsListe($formationDetails['public']) ?>
      <p><?php echo $formatPublic ?> </p>
      <h4>Personnes en situation de handicap :</h4>
      <p>Toutes nos formations sont ouvertes aux personnes en situation de handicap. La faisabilité des adaptations à envisager sera étudiée en fonction des besoins communiqués par l’apprenant.</p>
      <p>Contactez <a href="mailto:referent-handicap@justicerestaurative.org"><i>referent-handicap@justicerestaurative.org</i></a></p>
      <h4>Pré-requis</h4>
      <p>Maitrise de la langue française</p>
      <h2>Les objectifs de la formation</h2>
      <?php $formatObjectif=formatDetailsListe($formationDetails['objectif']) ?>
      <p><?php echo $formatObjectif ?> </p>
      <p>Les compétences visées sont : </p>
      <?php $formatCompetence=formatDetailsListe($formationDetails['competence']) ?>
      <p><?php echo $formatCompetence ?> </p>

      <h2>Le contenu de la formation</h2>
      <?php $formatContenu=formatDetailsListe($formationDetails['contenu']) ?>
      <p><?php echo $formatContenu ?> </p>
      <p><h2>Les méthodes utilisées</h2></p>
      <?php $formatMethode=formatDetailsListe($formationDetails['methode']) ?>
      <p><?php echo $formatMethode ?> </p>
      <h2>Les ressources pédagogiques </h2>
      <?php $formatRessource=formatDetailsListe($formationDetails['ressource']) ?>
      <p><?php echo $formatRessource ?> </p>
      <h2>Les modalités d’évaluation </h2>
      <?php $formatModalite=formatDetailsListe($formationDetails['modalite']) ?>
      <p><?php echo $formatModalite ?> </p>
      <h2>Les modalités de suivi </h2>
      <p>L’intervenant.e reste disponible pour les apprenants pendant 6 mois après la formation.</p>

      <p>Tous nos intervenants sont des spécialistes experts de la Justice Restaurative.</p>
      <p>En plus d’être formateurs, leurs activités professionnelles couvrent :</p>
      <ul>
        <li>l’animation de mesures de justice restaurative (médiations restauratives, rencontres détenus ou condamnés / victimes),</li>
        <li>la supervision technique de l’animation de mesures de justice restaurative,</li>
        <li>la gestion de projets et l’accompagnement dans la mise en oeuvre de programmes de justice restaurative,</li>
        <li>les actions de sensibilisation et d’échanges de pratiques dans le domaine de la justice restaurative,</li>
        <li>des travaux de recherches autour de la justice restaurative, etc.</li>
      </ul>
      <div class="sessions">
      </div>
      <br><br>
      <h2>Les prochaines sessions</h2><br>
      <?php foreach ($formation['dates_villes'] as $dateVille):?>
          <?php if (is_array($dateVille) && isset($dateVille)): ?>
            <div class="dv">
            <span class="span1"><b><?php echo $dateVille['date']; ?></b></span>
            <span class="span1"><b><?php echo ("-"); ?></b></span>
            <span class="span3"><b><?php echo  $dateVille['ville']; ?></b></span>
            <a href="<?php echo $dateVille['lien']; ?>"><button class="inscription"> Inscrivez vous </button></a>
            </div><br><br>
          <?php endif; ?>
      <?php endforeach; ?>
      <span><b>Dernière mise à jour:</b> <?php echo $formation["mise_a_jour"]; ?></span>
          <br><br><br>
      <div class="contact1">
        <h2>Contactez nous</h2>
      <form method="POST" action="">
      <label for="nom">Nom :</label><br>
      <input type="text" class="inpt" id="nom" name="nom" required><br><br>
      <label for="prenom">Prénom :</label><br>
      <input type="text" class="inpt" id="prenom" name="prenom" required><br><br>
      <label for="email">Adresse email :</label><br>
      <input type="email" class="inpt" id="email" name="email" required><br><br>
      <label for="formation">Formation concernée :</label><br>
      <select id="formation" class="inpt" name="formation" required>
        <option value="">Sélectionnez une formation</option>
        <?php foreach ($data as $formation): ?>
          <?php if (isset($formation['nom de la formation'])): ?>
            <option value="<?php echo $formation['nom de la formation']; ?>"><?php echo $formation['nom de la formation']; ?></option>
          <?php endif; ?>
        <?php endforeach; ?>
      </select><br><br>
      <label for="message">Message :</label><br>
      <textarea id="message" class="inpt" name="message" rows="5" required></textarea><br><br>
          <input type="submit" class="bouton" value="Envoyer">
      </form>
      </div>  <br><br>  <br><br>
      </div>
    <br><br>
       <div class="Z2">
         <h2>Les prochaines sessions</h2>
         <button class="bouton" onclick="scrollToSection('.sessions')">Consultez les dates et villes</button>
          <h2>Les tarifs</h2>
          <p>L’IFJR met son expertise à disposition de la fédération <a class="lien" href="https://www.france-victimes.fr/index.php/formation/catalogue?view=category&id=181"target="_blank">France Victimes</a>  et de l’<a class="lien" href="https://www.enap.justice.fr/contact"target="_blank">École Nationale d’Administration Pénitentiaire (ENAP)</a>.</p>
          <p>L’IFJR met également en place des formations avec certaines Directions Interrégionales des Services Pénitentiaires DISP et Directions Territoriales de la Protection Judiciaire de la Jeunesse DTPPJ.
           L’inscription à ces formations est généralement réservée aux agents de ces DISP et DTPJJ. Merci de vous rapprocher de ces structures qui vous informeront sur leurs tarifs et modalités d’accès.</p>
          <p>Merci de vous rapprocher de ces structures qui vous informeront sur leurs tarifs et modalités d’accès.</p>
          <button class="bouton" onclick="scrollToSection('.contact1')">Contactez nous</button>
        </div>
      <script>
      window.addEventListener('DOMContentLoaded', function() {
        var div = document.querySelector('.Z2');
        var scrollPosition = window.pageYOffset || document.documentElement.scrollTop;

        if (scrollPosition > 470) {
          div.style.visibility = 'visible';
        } else {
          div.style.visibility = 'hidden';
        }
      });

      window.addEventListener('scroll', function() {
        var div = document.querySelector('.Z2');
        var scrollPosition = window.pageYOffset || document.documentElement.scrollTop;

        if (scrollPosition > 470) {
          div.style.visibility = 'visible';
        } else {
          div.style.visibility = 'hidden';
        }
      });
      function scrollToSection(sectionSelector) {
        const section = document.querySelector(sectionSelector);
        if (section) {
          section.scrollIntoView({ behavior: 'smooth' });
        }
      }
      </script>
  </body>
  </html>
