<html>
    <body>  
        <p>
            <a href="http://localhost/php-projet/ajoutJoueur.php">Ajouter un joueur</a> /
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
                Nom : <input type="text" value="<?php echo $res['nom'] ?>" name='nom'><br /> 
                Prenom : <input type="text" value="<?php echo $res['prenom'] ?>" name='prenom'><br /> 
                Date de naissance : <input type="date" value="<?php echo $res['dateDeNaissance'] ?>" name='dateDeNaissance'><br /> 
                Poids : <input type="number" value="<?php echo $res['poids'] ?>" name='poids'><br />
                Taille : <input type="number" value="<?php echo $res['taille'] ?>" name='Taille'><br />
                Poste Préféré : <input type="text" value="<?php echo $res['postePrefere'] ?>" maxlength="2" size="3" name='PostePrefere'><br />
                Photo : <input type="file" name="photo" accept="image/png,image/jpg" value=<?php echo $res['photo'] ?>><br />
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
        <?php
                if (!empty($_POST['nom']) && !empty($_POST['prenom']) && !empty($_POST['dateDeNaissance']) && !empty($_POST['poids']) && !empty($_POST['taille']) && !empty($_POST['numLicence']) && !empty($_POST['postePrefere']) && !empty($_POST['statut']) && !empty($_POST['photo'])) {
                    $nom = htmlentities($_POST['nom']);
                    $prenom = htmlentities($_POST['prenom']); 
                    $dateDeNaissance = htmlentities($_POST['dateDeNaissance']);
                    $poids = htmlentities($_POST['poids']);
                    $taille = htmlentities($_POST['taille']);
                    $postePrefere = htmlentities($_POST['postePrefere']);
                    $statut = htmlentities($_POST['statut']);
                    $photo = htmlentities($_POST['photo']);

                    $req2 = $linkpdo->prepare("UPDATE football.players SET nom = :nom, prenom = :prenom, photo = :photo, dateDeNaissance = :dateDeNaissance, taille = :taille, poids = :poids, postePrefere = :postePrefere WHERE numLicence = :numLicence");
                    $req2->execute(array('nom' => $nom, 'prenom' => $prenom, 'photo' => $photo, 'dateDeNaissance' => $dateDeNaissance,  'taille' => $taille, 'poids' => $poids, 'postePrefere' => $postePrefere, 'statut' => $statut, 'numLicence' => $numLicence));
                    if ($req2 != FALSE) {
                        print("Modification effectué avec succés");
                    } else {
                        print("Erreur execute");
                    }
                }
            }
        ?>
    </body>
</html>


                