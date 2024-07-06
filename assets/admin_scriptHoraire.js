// ce fichier récupère les valeurs des champs de saisie des horaires dans l'interface admin et les stocke dans un objet JavaScript horaires
    function updateOpeningHours() {
    var horaires = {
        'Lundi Mardi': {
            ouverture: document.getElementById('opening_LundiMardi').value,
            fermeture: document.getElementById('closing_LundiMardi').value
        },
        'Mercredi': {
            ouverture: document.getElementById('opening_Mercredi').value,
            fermeture: document.getElementById('closing_Mercredi').value
        },
        'Jeudi Vendredi': {
            ouverture: document.getElementById('opening_JeudiVendredi').value,
            fermeture: document.getElementById('closing_JeudiVendredi').value
        },
        'Samedi': {
            ouverture: document.getElementById('opening_Samedi').value,
            fermeture: document.getElementById('closing_Samedi').value
        },
        'Dimanche': {
            ouverture: document.getElementById('opening_Dimanche').value,
            fermeture: document.getElementById('closing_Dimanche').value
        }
    };

    console.log('Données à envoyer:', horaires);
    var jsonData = JSON.stringify(horaires);
    console.log('Données JSON:', jsonData);

    fetch('../handlers/mongoDB/admin_update_hours.php', { // ce fichier doit traiter ces données et les enregistrer dans la base de données MongoDB 
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
        },
        body: jsonData
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            alert(data.success);
        } else if (data.error) {
            alert('Erreur : ' + data.error);
        }
    })
    .catch(error => {
        console.error('Erreur:', error);
        alert('Erreur lors de la mise à jour des horaires.');
    });
}
