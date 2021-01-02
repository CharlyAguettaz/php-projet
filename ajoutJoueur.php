<html>
    <body>
        <p>
            <a href="http://localhost/php-projet/ajoutJoueur.php">Ajouter un joueur</a> /
            <a href="http://localhost/php-projet/recherche.php">Rechercher un joueur</a>
        </p>
        <form action="<?php $_SERVER['PHP_SELF']?>" method="post">
            Nom : <input type="text" name="nom"><br />
            Prenom : <input type="text" name="prenom"><br />
            Date de naissance : <input type="date" name="dateDeNaissance"><br />
            Poids : <input type="number" name="poids" ><br />
            Taille : <input type="number" name="taille" ><br />
            Numéro de licence : <input type="text" name="numLicence"><br />
            Poste Préféré : <input type="text" name="postePrefere" maxlength="2" size="3"><br />
            Photo : <input type="file" name="photo" accept="image/png,image/jpg"><br />
            Statut : <select name='statut'>
                        <option value='Actif'>Actif</option>
                        <option value='Blesse'>Bléssé</option>
                        <option value='Suspendu'>Suspendu</option>
                        <option value='Absent'>Absent</option>
                    </select><br />
            <input type='Submit' value='Valider'>
        </form>
        <?php
            if (!empty($_POST['nom']) && !empty($_POST['prenom']) && !empty($_POST['dateDeNaissance']) && !empty($_POST['poids']) && !empty($_POST['taille']) && !empty($_POST['numLicence']) && !empty($_POST['postePrefere']) && !empty($_POST['statut']) && !empty($_POST['photo'])) {
                $nom = htmlentities($_POST['nom']);
                $prenom = htmlentities($_POST['prenom']); 
                $dateDeNaissance = htmlentities($_POST['dateDeNaissance']);
                $poids = htmlentities($_POST['poids']);
                $taille = htmlentities($_POST['taille']);
                $numLicence = htmlentities($_POST['numLicence']);
                $postePrefere = htmlentities($_POST['postePrefere']);
                $statut = htmlentities($_POST['statut']);
                $photo = htmlentities($_POST['photo']);
                
                $db = 'football';
                $login="root";
                $mdp="";
                try {
                    $linkpdo = new PDO("mysql:host=localhost;dname=$db",$login, $mdp);
                }
                catch (Exeption $e) {
                    die('Error :' . $e->getMessage());
                }
                $req = $linkpdo->prepare("INSERT INTO football.players(numLicence, nom, prenom, photo, dateDeNaissance, taille, poids, postePrefere, statut) VALUES(:numLicence, :nom, :prenom, :photo, :dateDeNaissance, :taille, :poids, :postePrefere, :statut)");
                $req->execute(array('numLicence' => $numLicence, 'nom' => $nom, 'prenom' => $prenom, 'photo' => $photo, 'dateDeNaissance' => $dateDeNaissance,  'taille' => $taille, 'poids' => $poids, 'postePrefere' => $postePrefere, 'statut' => $statut));
                if ($req != FALSE) {
                    print("Ajout effectuer avec succés");
                } else {
                    print("Erreur execute");
                }
            }
        ?>
    </body>
</html>