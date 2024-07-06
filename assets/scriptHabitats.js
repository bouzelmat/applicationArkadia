// ce bloc de code gère 5 fonctionnalités dont l'affichage des données sur la page habitats et animaux : 


$(document).ready(function() { // 1 fonctionnalité : Chargement initial des données (habitat, animaux, rapport veterinaire)
    $.ajax({
        url: '../handlers/data_page_habitatsAnimaux.php',
        method: 'GET',
        dataType: 'json',
        success: function(data) {
            var habitatsData = data.habitats;
            var animalsData = data.animals;
            var rapportsData = data.rapports;

            $('#habitat-buttons button').click(function() { // 2 fonctionnalité : lorsqu'un bouton d'habitat est cliqué, les informations correspondantes sont affichées.
                var habitatName = $(this).data('habitat');
                var selectedHabitat = habitatsData.find(h => h.nom === habitatName);
                if (selectedHabitat) {
                    $('#habitat-info').html(`
                        <h4 class="text-success">${selectedHabitat.nom}</h4>
                        <p class="text-success">${selectedHabitat.description}</p>
                        <img src="${selectedHabitat.image}" alt="${selectedHabitat.nom}">
                    `);

                    var filteredAnimals = animalsData.filter(a => a.habitat_id == selectedHabitat.id); // 3 fonctionnalité : Filtrage et affichage des animaux
                    $('#animal-list').empty();
                    filteredAnimals.forEach(function(animal) {
                        $('#animal-list').append(`
                            <div class="col-md-4">
                                <div class="card mb-4 shadow-sm">
                                    <a href="#" class="animal-link" data-animal-id="${animal.id}">
                                        <div class="animal-img-container position-relative">
                                            <img src="${animal.image}" class="card-img-top animal-img" alt="${animal.prenom}">
                                            <p class="text-success overlay">Cliquez pour voir le rapport véterinaire</p>
                                        </div>
                                        <div class="card-body">
                                            <h5 class="card-title text-success">${animal.prenom}</h5>
                                            <p class="card-text text-success">${animal.race}</p>
                                        </div>
                                    </a>
                                </div>
                            </div>
                        `);
                    });

                    $('.animal-link').click(function(e) { // 4 fonctionnalité : Gestion des clics sur les animaux
                        e.preventDefault();
                        var animalId = $(this).data('animal-id');
                        
                        $.ajax({
                            url: '../handlers/mongodb/enregistrer_clic.php', //ce fichier enregistre les clics dans la bdd mongoDB
                            method: 'POST',
                            data: { animal_id: animalId },
                            success: function(response) {
                                console.log('Clic enregistré :', response);
                            },
                            error: function(xhr, status, error) {
                                console.log('Erreur lors de l\'enregistrement du clic :', error);
                            }
                        });

                        var animalRapport = rapportsData.find(r => r.animal_id == animalId); //5 fonctionnalité : affichage du rapport veterinaire apres un clique sur un animal
                        if (animalRapport) {
                            $('#rapportModal .modal-body').html(`
                                <p><strong>État:</strong> ${animalRapport.etat}</p>
                                <p class="fw-bold"><strong>Nourriture Proposée:</strong> ${animalRapport.nourritureProposee}</p>
                                <p class="fw-bold"><strong>Grammage:</strong> ${animalRapport.grammage}</p>
                                <p class="fw-bold"><strong>Date de Passage:</strong> ${animalRapport.datePassage}</p>
                                <p class="fw-bold"><strong>Détail de l'État:</strong> ${animalRapport.detailEtat}</p>
                            `);
                            $('#rapportModal').modal('show');
                        }
                    });
                }
            });
        },
        error: function(xhr, status, error) {
            console.log('Erreur lors du chargement des données :', error);
        }
    });
});
