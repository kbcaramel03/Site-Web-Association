function ajouterDateVille() {
  var datesContainer = document.createElement("div");
  datesContainer.classList.add("datesVilles2");
  datesContainer.innerHTML = `
    <label for="dates-ms">Date :</label>
    <input type="text" name="dates-ms[]" placeholder="Date"><br><br>
    <label for="villes-ms">Ville :</label>
    <input type="text" name="villes-ms[]" placeholder="Ville"><br><br>
    <label for="lien-ms">Lien :</label>
    <input type="text" name="lien-ms[]" placeholder="Lien"><br><br>
    <button class="ms" onclick="supprimerDateVille(this)">Supprimer</button><br><br>
  `;
  document.getElementById("datesVilles").appendChild(datesContainer);
}

function supprimerDateVille(button) {
  var container = button.parentNode;
  container.parentNode.removeChild(container);
}
