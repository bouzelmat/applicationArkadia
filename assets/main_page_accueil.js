function showAnimals(habitatId) { // cette fonction à pour role d'afficher ou de masquer un carrousel d'animaux spécifique à un habitat donné sur la page d'accueil
    var carousel = document.getElementById('carousel' + habitatId);
    carousel.classList.toggle('d-none');
}
