<html>
    <body>  
        <p>
            <a href="http://localhost/php-projet/ajoutJoueur.php">Ajouter un joueur</a>
            <a href="http://localhost/php-projet/recherche.php">Rechercher un joueur</a>
        </p>            
        <?php
            if (!empty($_POST['id']) && isset($_POST['id'])) {
                $db = 'football';
                $login = 'root';
                $mdp = '';
                try {
                     $linkpdo = new PDO("mysql:host=localhost;dname=$db",$login,$mdp);
                }
                catch (Exeption $e) {
                     die('Error :' . $e->getMessage());
                }
                $req = $linkpdo->prepare("SELECT * FROM football.players WHERE numLicence LIKE ?");
                $req->execute(array(htmlentities($_POST['id'])));
                $res=$req->fetch();
                ?>
                <form action=<?php $_SERVER['PHP_SELF']?> method="post">
                Numéro de Licence : <input readonly type="texte" value="<?php echo $res['numLicence'] ?>"><br />
                Nom : <input type="text" value="<?php echo $res['nom'] ?>"><br /> 
                Prenom : <input type="text" value="<?php echo $res['prenom'] ?>"><br /> 
                Date de naissance : <input type="date" value="<?php echo $res['dateDeNaissance'] ?>"><br /> 
                Poids : <input type="number" name="<?php echo $res['poids'] ?>" ><br />
                Taille : <input type="number" name="<?php echo $res['taille'] ?>" ><br />
                Numéro de licence : <input type="text" name="numLicence"><br />
                Poste Préféré : <input type="text" name="postePrefere" maxlength="2" size="3"><br />
                Photo : <input type="file" name="photo" accept="image/png,image/jpg"><br />
                Statut : <label for="Actif">Actif</label>
                <input type="radio" id="Actif" name="statut" value="Actif" checked>
                <label for="Blessé">Blessé</label>
                <input type="radio" id="Blessé" name="statut" value="Blessé">
                <label for="Suspendu">Suspendu</label>
                <input type="radio" id="Suspendu" name="statut" value="Suspendu">
                <label for="Absent">Absent</label>
                <input type="radio" id="Absent" name="statut" value="Absent"><br />
                <input type="submit" value="Valider">
        </form>

                