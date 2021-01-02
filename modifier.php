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
    }
    if (!empty($_POST['nom']) && !empty($_POST['prenom']) && !empty($_POST['dateDeNaissance']) && !empty($_POST['poids']) && !empty($_POST['taille']) && !empty($_POST['numLicence']) && !empty($_POST['postePrefere']) && !empty($_POST['statut'])) {
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
        $res=$req2->fetch();
        if ($req2 != FALSE) {
            print("Modification effectué avec succés");
        } else {
            print("Erreur execute");
        }
    }
?>

<html>
    <body>  
        <p>
            <a href="http://localhost/php-projet/ajoutJoueur.php">Ajouter un joueur</a> /
            <a href="http://localhost/php-projet/recherche.php">Rechercher un joueur</a>
        </p>            
            <form action="<?php $_SERVER['PHP_SELF']?>" method="post">
                Numéro de Licence : <input readonly type="texte" value="<?php echo $res['numLicence'] ?>"><br />
                Nom : <input type="text" value="<?php echo $res['nom'] ?>" name='nom'><br /> 
                Prenom : <input type="text" value="<?php echo $res['prenom'] ?>" name='prenom'><br /> 
                Date de naissance : <input type="date" value="<?php echo $res['dateDeNaissance'] ?>" name='dateDeNaissance'><br /> 
                Poids : <input type="number" value="<?php echo $res['poids'] ?>" name='poids'><br />
                Taille : <input type="number" value="<?php echo $res['taille'] ?>" name='Taille'><br />
                Poste Préféré : <input type="text" value="<?php echo $res['postePrefere'] ?>" maxlength="2" size="3" name='PostePrefere'><br />
                Photo : <input type="file" name="photo" accept="image/png,image/jpg"><br />
                Statut :<select name='statut' value="<?php echo $res['statut'] ?>">
                            <option value='Actif'>Actif</option>
                            <option value='Blesse'>Bléssé</option>
                            <option value='Suspendu'>Suspendu</option>
                            <option value='Absent'>Absent</option>
                        </select><br />
                <input type='Submit' value='Valider'>
            </form>
        
    </body>
</html>


                