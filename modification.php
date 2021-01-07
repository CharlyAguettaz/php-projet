<?php 
    echo $_POST['nom'];
    echo $_POST['prenom'];
    echo $_POST['dateDeNaissance'];
    echo $_POST['poids'];
    echo $_POST['taille'];
    echo $_POST['numLicence'];
    echo $_POST['postePrefere'];
    if (!empty($_POST['nom']) && !empty($_POST['prenom']) && !empty($_POST['dateDeNaissance']) && !empty($_POST['poids']) && !empty($_POST['taille']) && !empty($_POST['numLicence']) && !empty($_POST['postePrefere'])) {
        $numLicence = htmlentities($_POST['numLicence']);
        $nom = htmlentities($_POST['nom']);
        $prenom = htmlentities($_POST['prenom']); 
        $dateDeNaissance = htmlentities($_POST['dateDeNaissance']);
        $poids = htmlentities($_POST['poids']);
        $taille = htmlentities($_POST['taille']);
        $postePrefere = htmlentities($_POST['postePrefere']);
        $statut = htmlentities($_POST['statut']);

        $db = 'football';
        $login = 'root';
        $mdp = '';
        try {
            $linkpdo = new PDO("mysql:host=localhost;dname=$db",$login,$mdp);
        }
        catch (Exeption $e) {
             die('Error :' . $e->getMessage());
        }
        if (!empty($_FILES['photo'])) {
            $req2 = $linkpdo->prepare("SELECT * FROM football.players WHERE numLicence = ?");
            $req2->execute(array($numLicence));
            $res2 = $req2->fetch();
            if ($req2 != false){
                $filename= $res2['photo'];
                unlink("photos-m3104/".$filename);
            }
            $filename=$_FILES['photo']['name'];
            $fileExt = "." . strtolower(substr(strchr($filename, "."), 1));
            $uniqueName = md5(uniqid(rand(), true));
            $newFileName = $uniqueName . $fileExt;
            move_uploaded_file($_FILES["photo"]["tmp_name"], "photos-m3104/" . $newFileName);
            $req = $linkpdo->prepare("UPDATE football.players SET nom = :nom, prenom = :prenom, photo = :photo, dateDeNaissance = :dateDeNaissance, taille = :taille, poids = :poids, postePrefere = :postePrefere, statut = :statut WHERE numLicence = :numLicence");
            $req->execute(array('nom' => $nom, 'prenom' => $prenom, 'photo' => $newFileName, 'dateDeNaissance' => $dateDeNaissance,  'taille' => $taille, 'poids' => $poids, 'postePrefere' => $postePrefere, 'statut' => $statut, 'numLicence' => $numLicence));
            if ($req != FALSE) {
                print("Modification effectué avec succés !");
            } else {
                print("Erreur execute");
            }
        } else {
            $req = $linkpdo->prepare("UPDATE football.players SET nom = :nom, prenom = :prenom, dateDeNaissance = :dateDeNaissance, taille = :taille, poids = :poids, postePrefere = :postePrefere, statut = :statut WHERE numLicence = :numLicence");
            $req->execute(array('nom' => $nom, 'prenom' => $prenom, 'dateDeNaissance' => $dateDeNaissance,  'taille' => $taille, 'poids' => $poids, 'postePrefere' => $postePrefere, 'statut' => $statut, 'numLicence' => $numLicence));
            if ($req != FALSE) {
                print("Modification effectué avec succés !");
            } else {
                print("Erreur execute");
            }
        }
    } else {
        echo "Erreur de modification : Erreur sur la séléction des informations par l'utilisateur";
    }
?>

<html>
    <head>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1" crossorigin="anonymous">
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.bundle.min.js" integrity="sha384-ygbV9kiqUc6oa4msXn9868pTtWMgiQaeYH7/t7LECLbyPA2x65Kgf80OJFdroafW" crossorigin="anonymous"></script>  
        <link rel="stylesheet" href="style.css" />
    </head>
    <header>
        <nav class="navbar navbar-expand-lg navbar-light bg-light">
            <div class="container-fluid">
                <a class="navbar-brand" href="#">Projet PHP</a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                        <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            Joueur
                        </a>
                        <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                            <li><a class="dropdown-item" href="ajoutJoueur.php">Ajouter un joueur</a></li>
                            <li><hr class="dropdown-divider"></li>
                            <li><a class="dropdown-item" href="recherche.php">Rechercher un joueur</a></li>
                        </ul>
                        <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            Match
                        </a>
                        <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                            <li><a class="dropdown-item" href="ajoutRencontre.php">Ajouter un match</a></li>
                            <li><hr class="dropdown-divider"></li>
                            <li><a class="dropdown-item" href="rencontre.php">Rechercher un match</a></li>
                        </ul>
                    </ul>
                </div>
            </div>
        </nav>
    </header>
    <body> 
    <h1> Modification de Joueur </h1>
        <p>
            <a href="recherche.php">Revenir sur la page de recherche<a>
        <p>
    </body>
</html>