<?php
    session_start();
    if ($_SESSION['user'] != 'root') {
        header("location:index.php");
    }
    if (!empty($_POST['date']) && !empty($_POST['heure']) && !empty($_POST['adversaire']) && !empty($_POST['lieu'])) {
        $date = htmlentities($_POST['date']);
        $heure = htmlentities($_POST['heure']); 
        $adversaire = htmlentities($_POST['adversaire']);
        $lieu = htmlentities($_POST['lieu']);
        $points_equipe = 0;
        $points_adversaire = 0;
        
        $db = 'football';
        $login="root";
        $mdp="";
        try {
            $linkpdo = new PDO("mysql:host=localhost;dname=$db",$login, $mdp);
        }
        catch (Exception $e) {
            die('Error :' . $e->getMessage());
        }
        $req2 = $linkpdo->prepare("SELECT * FROM football.rencontre WHERE Date_rencontre LIKE ?");
        $req2->execute(array($date));
        $res=$req2->fetch();
        if ($res == false) {
            $req = $linkpdo->prepare("INSERT INTO football.rencontre(Date_rencontre, Heure_rencontre, Nom_adversaire, Lieu_de_rencontre, Points_equipe, Points_adversaire) VALUES(:date, :heure, :adversaire, :lieu, :points_equipe, :points_adversaire)");
            $req->execute(array('date' => $date, 'heure' => $heure, 'adversaire' => $adversaire, 'lieu' => $lieu, 'points_equipe' => $points_equipe,  'points_adversaire' => $points_adversaire));
            if ($req != FALSE) {
                print("Ajout effectuer avec succés");
            } else {
                print("Erreur execute");
            }
        } else {
            echo "Ajout impossible, un autre match est déjà prévu a ce jour.";
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
                            <li><hr class="dropdown-divider"></li>
                            <li><a class="dropdown-item" href="stats.php">Statistiques des matchs</a></li>
                        </ul>
                    </ul>
                </div>
            </div>
        </nav>
    </header>
    <body>
    <h1>Ajouter un match</h1><br/>
        <form action="<?php $_SERVER['PHP_SELF']?>" method="post">
            <div class="row gy-3 gx-5 align-items-center">
                <div class="col-auto">
                    <label for="date" class="form-label">Date</label>
                    <input type="date" name="date" class="form-control" id="date" required>
                </div>
                <div class="col-auto">
                    <label for="heure" class="form-label">Heure</label>
                    <input type="time" name="heure" class="form-control" id="heure" required>
                </div>
            </div>
            <div class="row gy-3 gx-5 align-items-center">
                <div class="col-auto">
                    <label for="adversaire" class="form-label">Adversaire</label>
                    <input type="text" name="adversaire" class="form-control" id="adversaire" required>
                </div>
                <div class="col-auto">
                    <label for="lieu" class="form-label">Lieu</label>
                    <input type="text" name="lieu" class="form-control" id="lieu" required>
                </div>
            </div>
            <div class="col-auto">
                <button type="submit" class="btn btn-primary" style="margin-top: 30px;">Enregister</button>
            </div>
        </form>
    </body>
</html>