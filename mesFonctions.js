function chercher(){
  let input = document.getElementById('chercherlocalisation').value;
  input = input.toLowerCase();
  let formation = document.getElementsByClassName('departement');
  if(input === ''){
    for(let i=0;i<formation.length;i++){
      formation[i].style.display="none";
    }
  }else{
    for(let i=0;i<formation.length;i++){
      if(!formation[i].innerHTML.toLowerCase().includes(input)){
        formation[i].style.display="none";
      }else{
        formation[i].style.display="list-item";
      }
    }
  }
}

function droite(){
  let titre = document.getElementById('ifjr');
  titre.classList.remove("gauche");
  titre.classList.add("droite");
}

function gauche(){
  let titre = document.getElementById('ifjr');
  titre.classList.remove("droite");
  titre.classList.add("gauche");
}

function couleurdepartement(){
  fetch('etat.json')
    .then(response => response.json())
    .then(data => {
      let idlist;
      let objet;
      let element;
      for(let i=0;i<data.length;i++){
        if(data[i].etat=="rouge"){
          objet = document.getElementById(data[i].departement);
          objet.classList.add('departementrouge');
          objet.addEventListener("click", function() {
            rouge(this); // Appel à la fonction popup avec l'élément cliqué en tant que paramètre
          });
          idlist = data[i].departement.substr(3);
          element = document.getElementById("list-"+idlist);
          element.addEventListener("click", function() {
            listerouge(this); // Appel à la fonction popup avec l'élément cliqué en tant que paramètre
          });

        }else if(data[i].etat=="orange"){
          objet = document.getElementById(data[i].departement);
          objet.classList.add('departementorange');
          objet = document.getElementById(data[i].departement);
          objet.addEventListener("click", function() {
            orange(this); // Appel à la fonction popup avec l'élément cliqué en tant que paramètre
          });
          idlist = data[i].departement.substr(3);
          element = document.getElementById("list-"+idlist);
          element.addEventListener("click", function() {
            listeorange(this); // Appel à la fonction popup avec l'élément cliqué en tant que paramètre
          });

        }else if(data[i].etat=="vert"){
          objet = document.getElementById(data[i].departement);
          objet.classList.add('departementvert');
          objet = document.getElementById(data[i].departement);
          objet.addEventListener("click", function() {
            vert(this); // Appel à la fonction popup avec l'élément cliqué en tant que paramètre
          });
          idlist = data[i].departement.substr(3);
          element = document.getElementById("list-"+idlist);
          element.addEventListener("click", function() {
            listevert(this); // Appel à la fonction popup avec l'élément cliqué en tant que paramètre
          });
        }
      }
    });
}

function categorie(checkbox,texte){
  if(checkbox.checked){
    fetch('etat.json')
    .then(response => response.json())
    .then(data => {
      for(let i=0;i<98;i++){
        if(data[i][texte]=="oui"){
          let objet = document.getElementById(data[i].departement);
          objet.classList.add(texte);
        }
      }
    });
  }else{
    fetch('etat.json')
    .then(response => response.json())
    .then(data => {
      for(let i=0;i<98;i++){
        if(data[i][texte]=="oui"){
          let objet = document.getElementById(data[i].departement);
          objet.classList.remove(texte);
        }
      }
    });
  }
}

function fermer(croix) {
  id = croix.id;
  var division = croix.id.split("-"); // Divise la chaîne en utilisant le tiret comme séparateur
  var numero = division[1];
  var division = document.getElementById(numero);
  division.remove();
}

var idgrimpe;
idgrimpe=0;

function vert(identite){
  idgrimpe=idgrimpe+1;
  var division = document.createElement('div');
  division.className = 'infolocalisation';
  division.id = idgrimpe;
  var titre = document.createElement('h2');
  var paragraphe = document.createElement('p');
  fetch('etat.json')
    .then(response => response.json())
    .then(data => {
      for(let i=0;i<data.length;i++){
        if(data[i].departement==identite.id){
          titre.textContent = identite.getAttribute('title');
          paragraphe.textContent = "- " + data[i].prenom + " " + data[i].nom + " -\n\nAdresse: " + data[i].adresse + "\nTéléphone: " + data[i].telephone;
        }
      }
      division.appendChild(titre);
      division.appendChild(paragraphe);
    });
  var caselocalisation = document.getElementById('caselocalisation');
  caselocalisation.appendChild(division);
  var buttonFermer = document.createElement('button');
  buttonFermer.innerHTML = "X";
  buttonFermer.className = 'fermer';
  buttonFermer.id = "croix-"+idgrimpe;
  buttonFermer.onclick = function() {
    fermer(this);
  };
  division.appendChild(buttonFermer);
  var caselocalisation = document.getElementById('caselocalisation');
  caselocalisation.appendChild(division);
}

function listevert(element){
  let barre = document.getElementById("chercherlocalisation");
  barre.value = element.innerHTML;
  id=element.id.substr(5);
  objet=document.getElementById("FR-"+id);
  vert(objet);
}

function rouge(identite){
  var division = document.createElement('div');
  division.className = 'infolocalisation';
  division.id = idgrimpe;
  var titre = document.createElement('h2');
  var paragraphe = document.createElement('p');
  fetch('etat.json')
    .then(response => response.json())
    .then(data => {
      for(let i=0;i<data.length;i++){
        if(data[i].departement==identite.id){
          titre.textContent = identite.getAttribute('title');
          paragraphe.textContent = "Il n'y a pas encore de localisation disponible dans ce département";
        }
      }
    });
  var caselocalisation = document.getElementById('caselocalisation');
  caselocalisation.appendChild(division);
  var buttonFermer = document.createElement('button');
  buttonFermer.className = 'fermer';
  buttonFermer.id = "croix-"+idgrimpe;
  buttonFermer.innerHTML = "X";
  buttonFermer.onclick = function() {
    fermer(this);
  };
  division.appendChild(buttonFermer);
  var caselocalisation = document.getElementById('caselocalisation');
  division.appendChild(titre);
  division.appendChild(paragraphe);
  caselocalisation.appendChild(division);
}

function listerouge(element){
  let barre = document.getElementById("chercherlocalisation");
  barre.value = element.innerHTML;
  id=element.id.substr(5);
  objet=document.getElementById("FR-"+id);
  rouge(objet);
}

function orange(identite){
  var division = document.createElement('div');
  division.className = 'infolocalisation';
  division.id = idgrimpe;
  var titre = document.createElement('h2');
  var paragraphe = document.createElement('p');
  fetch('etat.json')
    .then(response => response.json())
    .then(data => {
      for(let i=0;i<data.length;i++){
        if(data[i].departement==identite.id){
          titre.textContent = identite.getAttribute('title');
          paragraphe.textContent = "Nos informations seront bientôt disponibles dans ce département";
        }
      }
    });
  var caselocalisation = document.getElementById('caselocalisation');
  caselocalisation.appendChild(division);
  var buttonFermer = document.createElement('button');
  buttonFermer.innerHTML = "X";
  buttonFermer.className = 'fermer';
  buttonFermer.id = "croix-"+idgrimpe;
  buttonFermer.onclick = function() {
    fermer(this);
  };
  division.appendChild(buttonFermer);
  var caselocalisation = document.getElementById('caselocalisation');
  division.appendChild(titre);
  division.appendChild(paragraphe);
  caselocalisation.appendChild(division);
}

function listeorange(element){
  let barre = document.getElementById("chercherlocalisation");
  barre.value = element.innerHTML;
  id=element.id.substr(5);
  objet=document.getElementById("FR-"+id);
  orange(objet);
}

function adminbouton(){
  let localisation = document.getElementsByClassName('localisation');
  let menu = document.getElementsByClassName('menu');
  let formations = document.getElementsByClassName('formationsbutton');
  let admin = document.getElementsByClassName('admin');
  let boutonstrio = document.getElementsByClassName('button');
  let mdp = document.getElementsByClassName('mdp');
  for(let i=0;i<admin.length;i++){
    admin[i].hidden = false;
  }
  for(let i=0;i<localisation.length;i++){
    localisation[i].hidden = true;
  }
  for(i=0;i<menu.length;i++){
    menu[i].hidden = true;
  }
  for(i=0;i<formations.length;i++){
    formations[i].hidden = true;
  }
  for(i=0;i<mdp.length;i++){
    mdp[i].hidden = true;
  }
  for(i=0;i<boutonstrio.length;i++){
    boutonstrio[i].classList.remove('buttonvert');
    boutonstrio[i].classList.remove('buttonrouge');
    boutonstrio[i].classList.remove('buttonbleu');
    boutonstrio[i].classList.add('buttonjaune');
  }
  bouton2 = document.getElementById("bouton2");
  bouton2.classList.remove('appuyelocalisation');
  bouton3 = document.getElementById('bouton3');
  bouton3.classList.remove('appuyeformations');
  bouton1 = document.getElementById('bouton1');
  bouton1.classList.remove('appuyemenu');
}

function adminmdpbouton(){
  let localisation = document.getElementsByClassName('localisation');
  let menu = document.getElementsByClassName('menu');
  let formations = document.getElementsByClassName('formationsbutton');
  let admin = document.getElementsByClassName('admin');
  let boutonstrio = document.getElementsByClassName('button');
  let mdp = document.getElementsByClassName('mdp');
  for(let i=0;i<admin.length;i++){
    admin[i].hidden = true;
  }
  for(let i=0;i<localisation.length;i++){
    localisation[i].hidden = true;
  }
  for(i=0;i<menu.length;i++){
    menu[i].hidden = true;
  }
  for(i=0;i<formations.length;i++){
    formations[i].hidden = true;
  }
  for(i=0;i<mdp.length;i++){
    mdp[i].hidden = false;
  }
  for(i=0;i<boutonstrio.length;i++){
    boutonstrio[i].classList.remove('buttonvert');
    boutonstrio[i].classList.remove('buttonrouge');
    boutonstrio[i].classList.remove('buttonbleu');
    boutonstrio[i].classList.add('buttonjaune');
  }
  bouton2 = document.getElementById("bouton2");
  bouton2.classList.remove('appuyelocalisation');
  bouton3 = document.getElementById('bouton3');
  bouton3.classList.remove('appuyeformations');
  bouton1 = document.getElementById('bouton1');
  bouton1.classList.remove('appuyemenu');
}

function localisationbouton(){
  let localisation = document.getElementsByClassName('localisation');
  let menu = document.getElementsByClassName('menu');
  let formations = document.getElementsByClassName('formationsbutton');
  let admin = document.getElementsByClassName('admin');
  let mdp = document.getElementsByClassName('mdp');
  let boutonstrio = document.getElementsByClassName('button');
  for(let i=0;i<localisation.length;i++){
    localisation[i].hidden = false;
  }
  for(i=0;i<menu.length;i++){
    menu[i].hidden = true;
  }
  for(i=0;i<formations.length;i++){
    formations[i].hidden = true;
  }
  for(i=0;i<admin.length;i++){
    admin[i].hidden = true;
  }
  for(i=0;i<mdp.length;i++){
    mdp[i].hidden = true;
  }
  for(i=0;i<boutonstrio.length;i++){
    boutonstrio[i].classList.remove('buttonvert');
    boutonstrio[i].classList.remove('buttonrouge');
    boutonstrio[i].classList.add('buttonbleu');
    boutonstrio[i].classList.remove('buttonjaune');
  }
  bouton2 = document.getElementById("bouton2");
  bouton2.classList.add('appuyelocalisation');
  bouton3 = document.getElementById('bouton3');
  bouton3.classList.remove('appuyeformations');
  bouton1 = document.getElementById('bouton1');
  bouton1.classList.remove('appuyemenu');
}

function menubouton(){
  let localisation = document.getElementsByClassName('localisation');
  let menu = document.getElementsByClassName('menu');
  let formations = document.getElementsByClassName('formationsbutton');
  let boutonstrio = document.getElementsByClassName('button');
  let admin = document.getElementsByClassName('admin');
  let mdp = document.getElementsByClassName('mdp');
  for(i=0;i<mdp.length;i++){
    mdp[i].hidden = true;
  }
  for(let i=0;i<localisation.length;i++){
    localisation[i].hidden = true;
  }
  for(i=0;i<menu.length;i++){
    menu[i].hidden = false;
  }
  for(i=0;i<formations.length;i++){
    formations[i].hidden = true;
  }
  for(i=0;i<boutonstrio.length;i++){
    boutonstrio[i].classList.add('buttonvert');
    boutonstrio[i].classList.remove('buttonrouge');
    boutonstrio[i].classList.remove('buttonbleu');
    boutonstrio[i].classList.remove('buttonjaune');
  }
  for(i=0;i<admin.length;i++){
    admin[i].hidden = true;
  }
  bouton1 = document.getElementById("bouton1");
  bouton1.classList.add('appuyemenu');
  bouton2 = document.getElementById('bouton2');
  bouton2.classList.remove('appuyelocalisation');
  bouton3 = document.getElementById('bouton3');
  bouton3.classList.remove('appuyeformations');
}

function formationsbouton(bouton){
  let admin = document.getElementsByClassName('admin');
  let localisation = document.getElementsByClassName('localisation');
  let menu = document.getElementsByClassName('menu');
  let formations = document.getElementsByClassName('formationsbutton');
  let boutonstrio = document.getElementsByClassName('button');
  let mdp = document.getElementsByClassName('mdp');
  for(let i=0;i<localisation.length;i++){
    localisation[i].hidden = true;
  }
  for(i=0;i<menu.length;i++){
    menu[i].hidden = true;
  }
  for(i=0;i<formations.length;i++){
    formations[i].hidden = false;
  }
  for(i=0;i<admin.length;i++){
    admin[i].hidden = true;
  }
  for(i=0;i<mdp.length;i++){
    mdp[i].hidden = true;
  }
  for(i=0;i<boutonstrio.length;i++){
    boutonstrio[i].classList.remove('buttonvert');
    boutonstrio[i].classList.add('buttonrouge');
    boutonstrio[i].classList.remove('buttonbleu');
    boutonstrio[i].classList.remove('buttonjaune');
  }
  bouton3 = document.getElementById('bouton3');
  bouton3.classList.add('appuyeformations');
  bouton2 = document.getElementById('bouton2');
  bouton2.classList.remove('appuyelocalisation');
  bouton1 = document.getElementById('bouton1');
  bouton1.classList.remove('appuyemenu');
}

function rotation(){
  cercle = document.getElementById('nbformations');
  cercle.classList.add('rotate');
}

function normal(){
  cercle = document.getElementById('nbformations');
  cercle.classList.remove('rotate');
}

function gif(){
  livre = document.getElementById('livre');
  livre.src = "livre.gif";
}

function png(){
  livre = document.getElementById('livre');
  livre.src = "livre.png";
}

function chercher2(){
  let input2 = document.getElementById('chercherformation').value;
  input2 = input2.toLowerCase();
  let titre = document.getElementsByClassName('titre');
  let formation = document.getElementsByClassName('formations');
  for(let i=0;i<formation.length;i++){
    if(!titre[i].innerHTML.toLowerCase().includes(input2)){
      formation[i].style.display="none";
    }else{
      formation[i].style.display="block";
    }
  }
}

function changementEtat(select) {
  var selectedValue = select.value;
  var form = select.closest('form');
  var nomInput = form.querySelector('#nom');
  var prenomInput = form.querySelector('#prenom');
  var adresseInput = form.querySelector('#adresse');
  var telephoneInput = form.querySelector('#telephone');

  if (selectedValue === 'rouge' || selectedValue === 'orange') {
    nomInput.value = '';
    prenomInput.value = '';
    adresseInput.value = '';
    telephoneInput.value = '';

    nomInput.disabled = true;
    prenomInput.disabled = true;
    adresseInput.disabled = true;
    telephoneInput.disabled = true;
  }else{
    nomInput.disabled = false;
    prenomInput.disabled = false;
    adresseInput.disabled = false;
    telephoneInput.disabled = false;
  }
}

function afficherResultat() {
  let nomFormation = document.getElementById("nom-ajout").value;
  let format = document.getElementById("format-ajout").value;
  let groupe = document.getElementById("groupe-ajout").value;
  let duree = document.getElementById("duree-ajout").value;
  document.getElementById("resultat-nom").textContent = nomFormation;
  document.getElementById("resultat-format").textContent = format;
  document.getElementById("resultat-groupe").textContent = groupe;
  document.getElementById("resultat-duree").textContent = duree;
}
function chercher3(){
  let input2 = document.getElementById('chercherformation').value;
  input2 = input2.toLowerCase();
  let titre = document.getElementsByClassName('titrems');
  let formation = document.getElementsByClassName('formation3');
  for(let i=0;i<formation.length;i++){
    if(!titre[i].innerHTML.toLowerCase().includes(input2)){
      formation[i].style.display="none";
    }else{
      formation[i].style.display="block";
    }
  }
}

function popupmessage(messageId){
  message = document.getElementById("message-"+messageId);
  message.hidden=false;
}

function fermerX(xid){
  message = document.getElementById("message-"+xid.id);
  message.hidden=true;
}

function derouleinfo(infoId,boite){
  info = document.getElementById("info-"+infoId);
  info.hidden=false;
  boite.onclick = function() {
    fermerinfo(infoId,this);
  };
}

function fermerinfo(infoId,boite){
  info = document.getElementById("info-"+infoId);
  info.hidden=true;
  boite.onclick = function() {
    derouleinfo(infoId,this);
  };
}

function retour(){
  location.replace("accueil.php")
}
function redirectionlocalisation(){
   window.location.href = "accueil.php?bouton=localisation";
}
function redirectionadmin(){
   window.location.href = "accueil.php?bouton=admin";
}
