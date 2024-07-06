// ce fichier va affichers les évenements du zoo sur la page service 
console.log("Le fichier evenements.js est chargé");

// récupération et affichage des événements depuis la bdd mongoDB
fetch('../handlers/mongoDB/data_evenements.php')
  .then(response => response.json())
  .then(evenements => {
    const eventsContainer = document.getElementById('events-container');
    evenements.forEach(evenement => {
      const evenementBlock = `
        <div class="col-md-4 mb-4">
          <div class="card h-100 bg-info">
            <img src="${evenement.image}" class="card-img-top" alt="Image de ${evenement.nom}">
            <div class="card-body">
              <h5 class="card-title text-light">${evenement.nom}</h5>
              <p class="card-text text-light">${evenement.description}</p>
              <p class="card-text text-light">${evenement.date}</p>
            </div>
          </div>
        </div>
      `;
      eventsContainer.innerHTML += evenementBlock;
    });
  })
  .catch(error => {
    console.error('Erreur lors de la récupération des événements :', error);
  });
