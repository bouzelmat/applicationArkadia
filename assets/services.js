// récupération et affichage des services sur la page service
fetch('../handlers/data_page_services.php')
  .then(response => response.json())
  .then(services => {
    const servicesContainer = document.getElementById('services-container');
    services.forEach(service => {
      const serviceBlock = `
        <div class="col-md-4 mb-4">
          <div class="card h-100 bg-success">
            <img src="${service.image}" class="card-img-top" alt="Image de ${service.nom}">
            <div class="card-body">
              <h5 class="card-title text-light">${service.nom}</h5>
              <p class="card-text text-light">${service.description}</p>
            </div>
          </div>
        </div>
      `;
      servicesContainer.innerHTML += serviceBlock;
    });
  })
  .catch(error => {
    console.error('Erreur lors de la récupération des services :', error);
  });
