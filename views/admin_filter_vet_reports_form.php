<!-- formulaire de filtrage des rapports vétérinaires -->
<form id="filterForm" class="py-5" onsubmit="return filterReports();">
        <div class="mb-3">
            <label for="filterType" class="form-label">Type de filtre :</label>
            <select id="filterType" name="filterType" class="form-select">
                <option value="date">Date de passage</option>
                <option value="animal">ID de l'animal</option>
            </select>
        </div>
        
        <div class="mb-3">
            <label for="datePassage" class="form-label">Date de passage :</label>
            <input type="date" id="datePassage" name="datePassage" class="form-control">
        </div>

        <div class="mb-3">
            <label for="animal_id" class="form-label">ID de l'animal :</label>
            <input type="number" id="animal_id" name="animal_id" class="form-control">
        </div>

        <button type="submit" class="btn btn-primary">Filtrer les rapports</button>
    </form>

    <!-- conteneur pour afficher les rapports vétérinaires -->
    <h2 class="py-4">Rapports Vétérinaires</h2>
    <div id="reportsContainer">
        <!-- les rapports filtrés seront insérés ici par le script admin_script_filter_reports.js -->
    </div>

   