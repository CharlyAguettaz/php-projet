<html>
    <body>
        <form action="<?php $_SERVER['PHP_SELF']?>" method="post">
            Nom : <input type="text" name="nom"><br />
            Prenom : <input type="text" name="prenom"><br />
            Date de naissance : <input type="text" name="dateDeNaissance"><br />
            Poids : <input type="text" name="poids"><br />
            Taille : <input type="text" name="taille"><br />
            Poste Préféré : <input type="text" name="postePrefere"><br />
            photo : <input type="text" name="photo"><br />
            <input type="submit" value="Valider">
        </form>
        <?php
            if (!empty($_POST['nom']) && !empty($_POST['prenom']) && !empty($_POST['dateDeNaissance']) && !empty($_POST['poids']) && !empty($_POST['taille'])) {
                $nom = $_POST['nom'];
                $prenom = $_POST['prenom']; 
                $dateDeNaissance = $_POST['dateDeNaissance'];
                $poids = $_POST['poids'];
                $taille = $_POST['taille'];
                
                $server="mysql:host=localhost;"
                $db="test"
                $login="root";
                $mdp="";
                ///Connexion au serveur MySQL
                 $link = mysqli_connect($server, $login, $mdp, $db) or die("Error " . mysqli_error($link));

                ///Verification de la connexion
                if (mysqli_connect_errno()) {
                    print("Connect failed: \n" . mysqli_connect_error());
                    exit();
                }
            }
        ?>
    </body>
</html>