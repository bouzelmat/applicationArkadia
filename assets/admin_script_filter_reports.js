// ce fichier est utilisé pour filtrer les rapport véterinaires sur l'interface admin

function filterReports() { // l'effet de cette fonction implique une coopération avec la methode read($filters = []) de la class rapportVeterinaire. la methode read($filters = []) (php) se charge de recuperer les données filtrées depuis la bdd et la fonction JS permet d'afficher ces donnée de manière dynamique sur l'interface admin
    const filterType = document.getElementById('filterType').value;
    const datePassage = document.getElementById('datePassage').value;
    const animalId = document.getElementById('animal_id').value;

    let params = '';
    if (filterType === 'date' && datePassage !== '') {
        params = 'datePassage=' + datePassage;
    } else if (filterType === 'animal' && animalId !== '') {
        params = 'animal_id=' + animalId;
    }

    const xhr = new XMLHttpRequest();
    xhr.open('GET', '../../handlers/interface_admin_data.php?' + params, true);
    xhr.onreadystatechange = function() {
        if (xhr.readyState === 4 && xhr.status === 200) {
            document.getElementById('reportsContainer').innerHTML = xhr.responseText;
        }
    };
    xhr.send();

    return false; // empêcher le rechargement de la page
}
