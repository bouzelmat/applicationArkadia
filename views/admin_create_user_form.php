<h2 class="py-4">Créer un compte utilisateur</h2>
    <!-- formulaire HTML pour créer un nouvel utilisateur -->
    <form id="createUserForm" method="POST" action="../handlers/interface_admin_data.php" class="mb-5">
        <input type="hidden" name="create_user" value="1">
        
        <div class="mb-3">
            <label for="username" class="form-label">Nom d'utilisateur:</label>
            <input type="text" id="username" name="username" class="form-control" required>
        </div>
        
        <div class="mb-3">
            <label for="email" class="form-label">Email:</label>
            <input type="email" id="email" name="email" class="form-control" required>
        </div>
        
        <div class="mb-3">
            <label for="password" class="form-label">Mot de passe:</label>
            <input type="password" id="password" name="password" class="form-control" required>
        </div>
        
        <div class="mb-3">
            <label for="prenom" class="form-label">Prénom:</label>
            <input type="text" id="prenom" name="prenom" class="form-control" required>
        </div>
        
        <div class="mb-3">
            <label for="nom" class="form-label">Nom:</label>
            <input type="text" id="nom" name="nom" class="form-control" required>
        </div>
        
        <div class="mb-3">
            <label for="role_id" class="form-label">Rôle:</label>
            <select id="role_id" name="role_id" class="form-select" required>
                <option value="3">Employé</option>
                <option value="2">Vétérinaire</option>
            </select>
        </div>
        
        <button type="submit" class="btn btn-primary">Créer l'utilisateur</button>
    </form>
