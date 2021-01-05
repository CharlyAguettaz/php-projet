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
        <h1> Ajouter un Joueur </h1>
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