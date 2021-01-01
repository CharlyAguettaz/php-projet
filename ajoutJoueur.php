<html>
    <body>
        <p>
            <a href="http://localhost/php-projet/ajoutJoueur.php">Ajouter un joueur</a>
            <a href="http://localhost/php-projet/recherche.php">Rechercher un joueur</a>
        </p>
        <form action="<?php $_SERVER['PHP_SELF']?>" method="post">
            Nom : <input type="text" name="nom"><br />
            Prenom : <input type="text" name="prenom"><br />
            Date de naissance : <input type="text" name="dateDeNaissance"><br />
            Poids : <input type="text" name="poids"><br />
            Taille : <input type="text" name="taille"><br />
            Numéro de licence : <input type="text" name="numLicence"><br />
            Poste Préféré : <input type="text" name="postePrefere"><br />
            Photo : <input type="text" name="photo"><br />
            Statut : <input type="text" name="statut"><br />
            <input type="submit" value="Valider">
        </form>
        <?php
            if (!empty($_POST['nom']) && !empty($_POST['prenom']) && !empty($_POST['dateDeNaissance']) && !empty($_POST['poids']) && !empty($_POST['taille'])) {
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