<?php 
    if (!empty($_POST['nom']) && !empty($_POST['prenom']) && !empty($_POST['dateDeNaissance']) && !empty($_POST['poids']) && !empty($_POST['taille']) && !empty($_POST['numLicence']) && !empty($_POST['postePrefere']) && !empty($_POST['photo'])) {
        $numLicence = htmlentities($_POST['numLicence']);
        $nom = htmlentities($_POST['nom']);
        $prenom = htmlentities($_POST['prenom']); 
        $dateDeNaissance = htmlentities($_POST['dateDeNaissance']);
        $poids = htmlentities($_POST['poids']);
        $taille = htmlentities($_POST['taille']);
        $postePrefere = htmlentities($_POST['postePrefere']);
        $statut = htmlentities($_POST['statut']);
        $photo = htmlentities($_POST['photo']);

        $db = 'football';
        $login = 'root';
        $mdp = '';
        try {
            $linkpdo = new PDO("mysql:host=localhost;dname=$db",$login,$mdp);
        }
        catch (Exeption $e) {
             die('Error :' . $e->getMessage());
        }
        $req = $linkpdo->prepare("UPDATE football.players SET nom = :nom, prenom = :prenom, photo = :photo, dateDeNaissance = :dateDeNaissance, taille = :taille, poids = :poids, postePrefere = :postePrefere, statut = :statut WHERE numLicence = :numLicence");
        $req->execute(array('nom' => $nom, 'prenom' => $prenom, 'photo' => $photo, 'dateDeNaissance' => $dateDeNaissance,  'taille' => $taille, 'poids' => $poids, 'postePrefere' => $postePrefere, 'statut' => $statut, 'numLicence' => $numLicence));
        if ($req != FALSE) {
            print("Modification effectué avec succés !");
        } else {
            print("Erreur execute");
        }
    } else {
        echo "Erreur de modification : Erreur sur la séléction des informations par l'utilisateur";
    }
?>

<html>
    <body>
        <p>
            <a href="recherche.php">Revenir sur la page de recherche<a>
        <p>
    </body>
</html>