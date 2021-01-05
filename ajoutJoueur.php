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

        $req = $linkpdo->prepare("SELECT * FROM football.players WHERE numLicence LIKE ?");
        $req->execute(array($numLicence));
        $res=$req->fetch();
        if($res == false) {
            $req2 = $linkpdo->prepare("INSERT INTO football.players(numLicence, nom, prenom, photo, dateDeNaissance, taille, poids, postePrefere, statut) VALUES(:numLicence, :nom, :prenom, :photo, :dateDeNaissance, :taille, :poids, :postePrefere, :statut)");
            $req2->execute(array('numLicence' => $numLicence, 'nom' => $nom, 'prenom' => $prenom, 'photo' => $photo, 'dateDeNaissance' => $dateDeNaissance,  'taille' => $taille, 'poids' => $poids, 'postePrefere' => $postePrefere, 'statut' => $statut));
            if ($req2 != FALSE) {
                print("Ajout effectuer avec succés");
            } else {
                print("Erreur execute");
            }
        } else {
            echo "Numéro de licence déjà existante !";
        }
    }
?>

<html>
    <body>
        <p>
            <a href="http://localhost/php-projet/ajoutJoueur.php">Ajouter un joueur</a> /
            <a href="http://localhost/php-projet/recherche.php">Rechercher un joueur</a> /
            <a href="http://localhost/php-projet/ajoutRencontre.php">Ajouter une rencontre</a> /
            <a href="http://localhost/php-projet/rencontre.php">Rechercher une rencontre</a>
        </p>
        <form action="<?php $_SERVER['PHP_SELF']?>" method="post">
            Nom : <input type="text" name="nom" required><br />
            Prenom : <input type="text" name="prenom" required><br />
            Date de naissance : <input type="date" name="dateDeNaissance" required><br />
            Poids : <input type="number" name="poids" required ><br />
            Taille : <input type="number" name="taille" required><br />
            Numéro de licence : <input type="text" name="numLicence" required size="11" minlength ="10" maxlength="10"><br />
            Poste Préféré : <select name='postePrefere' required>
                                <option></option>
                                <option value='AD'>Attaquant droit</option>
                                <option value='AG'>Attaquant gauche</option>
                                <option value='AC'>Attanquant centre</option>
                                <option value='DD'>Défenseur droit</option>
                                <option value='DG'>Défenseur gauche</option>
                                <option value='DC'>Défenseur centre</option>
                                <option value='GB'>Gardien de but</option>
                            </select><br />
            Photo : <input type="file" name="photo" accept="image/png,image/jpg" required><br />
            Statut : <select name='statut' required>
                        <option></option>
                        <option value='Actif'>Actif</option>
                        <option value='Blesse'>Bléssé</option>
                        <option value='Suspendu'>Suspendu</option>
                        <option value='Absent'>Absent</option>
                    </select><br />
            <input type='Submit' value='Valider'>
        </form>
        
    </body>
</html>