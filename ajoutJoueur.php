<html>
    <body>
        <form action="<?php $_SERVER['PHP_SELF']?>" method="post">
            Nom : <input type="text" name="nom"><br />
            Prenom : <input type="text" name="prenom"><br />
            Date de naissance : <input type="text" name="dateDeNaissance"><br />
            Poids : <input type="text" name="poids"><br />
            Taille : <input type="text" name="taille"><br />
            Numéro de lincence : <input type="text" name="NumLicence"><br />
            Poste Préféré : <input type="text" name="postePrefere"><br />
            Photo : <input type="text" name="photo"><br />
            <input type="submit" value="Valider">
        </form>
        <?php
            if (!empty($_POST['nom']) && !empty($_POST['prenom']) && !empty($_POST['dateDeNaissance']) && !empty($_POST['poids']) && !empty($_POST['taille'])) {
                $nom = $_POST['nom'];
                $prenom = $_POST['prenom']; 
                $dateDeNaissance = $_POST['dateDeNaissance'];
                $poids = $_POST['poids'];
                $taille = $_POST['taille'];
                
                $db="test";
                $login="root";
                $mdp="";
                try {
                    $linkpdo = new PDO("mysql:host=localhost;dname=$db",$login, $mdp);
                }
                catch (Exeption $e) {
                    die('Error :' . $e->getMessage());
                }
                $req = $linkpdo->prepare("INSERT INTO test.joueur(nom,prenom,dateDeNaissance,poids,taille) VALUES(:nom,:prenom,:dateDeNaissance,:poids,:taille)");
                $req->execute(array('nom'=> $nom, 'prenom' => $prenom, 'dateDeNaissance' => $dateDeNaissance, 'poids' => $poids, 'taille' => $taille));
                if ($req != FALSE) {
                    print("Ajout effectuer avec succés");
                } else {
                    print("Erreur execute");
                }
            }
        ?>
    </body>
</html>