<?php
    if (!empty($_POST['id'] && isset($_POST['id']))) {
        $id_rencontre = htmlentities($_POST['id']);

        $db = 'football';
        $login="root";
        $mdp="";
        try {
            $linkpdo = new PDO("mysql:host=localhost;dname=$db",$login, $mdp);
        }
        catch (Exeption $e) {
            die('Error :' . $e->getMessage());
        }

        if (!empty($_POST['Points_equipe']) && !empty($_POST['Points_adversaire'])) {
            $Points_equipe=htmlentities($_POST['Points_equipe']);
            $Points_adversaire=htmlentities($_POST['Points_adversaire']);
            $req3 = $linkpdo->prepare("UPDATE football.rencontre SET Points_equipe = :points_equipe, Points_adversaire = :points_adversaire WHERE Id_rencontre = :Id_rencontre");
            $req3->execute(array('points_adversaire' => $Points_adversaire,'points_equipe' => $Points_equipe,'Id_rencontre' => $id_rencontre));
        }
        
        if (!empty($_POST['AD'])) {
            $numLicence = htmlentities($_POST['AD']);
            $req5 = $linkpdo->prepare("INSERT INTO football.participant(Id_rencontre,numLicence,Position,Commentaire) VALUE(?,?,'Attaquant Droit','')");
            $req5->execute(array($id_rencontre,$numLicence));
        }

        $req = $linkpdo->prepare("SELECT * FROM football.rencontre WHERE Id_rencontre LIKE ?");
        $req->execute(array($id_rencontre));
        $res=$req->fetch();
        $req2 = $linkpdo->prepare("SELECT nom,prenom,numLicence,statut FROM football.players");
        $req4 = $linkpdo->prepare("SELECT * FROM football.participant WHERE Id_rencontre LIKE ?");
        $req4->execute(array($id_rencontre));
        $res4 = $req4->fetch();
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
        <h1>Details de la rencontre entre Agen - <?php echo $res['Nom_adversaire'] ?></h1>
        <form action="<?php $_SERVER['PHP_SELF']?>" method="post">
            <p>
                Score du match : Agen <input type="number" value="<?php echo $res['Points_equipe'] ?>" name='Points_equipe' size="3"> - 
                <input type ="number" value=<?php echo $res['Points_adversaire']?> name ='Points_adversaire' size="3"> <?php echo $res['Nom_adversaire'] ?>
            </p>
            Attaquant droit :
            <select name='AD' required>
                <option></option>
                <?php
                    $req2->execute();
                    $res2=$req2->fetch();
                    if ($res2 != false) {
                        do { 
                            if ($res2['statut'] == "Actif") { ?>
                                <option value='<?php $res2['numLicence'] ?>'><?php echo $res2['nom']." ".$res2['prenom'] ?></option>
                            <?php }
                        } while($res2=$req2->fetch());
                    }
                ?>
            </select><br />
            Attaquant gauche :
            <select name='AG' required>
                <option></option>
                <?php
                    $req2->execute();
                    $res2=$req2->fetch(); 
                    if ($res2 != false) {
                        do { 
                            if ($res2['statut'] == "Actif") { ?>
                                <option value='<?php $res2['numLicence'] ?>'><?php echo $res2['nom']." ".$res2['prenom'] ?></option>
                            
                            <?php }
                        } while($res2=$req2->fetch());
                    }
                ?>
            </select><br />
            Attaquant centre :
            <select name='AC' required>
                <option></option>
                <?php
                    $req2->execute();
                    $res2=$req2->fetch(); 
                    if ($res2 != false) {
                        do { 
                            if ($res2['statut'] == "Actif") { ?>
                                <option value='<?php $res2['numLicence'] ?>'><?php echo $res2['nom']." ".$res2['prenom'] ?></option>
                            <?php }
                        } while($res2=$req2->fetch());
                    }
                ?>
            </select><br />
            Défenseur droit :
            <select name='DD' required>
                <option></option>
                <?php
                    $req2->execute();
                    $res2=$req2->fetch(); 
                    if ($res2 != false) {
                        do { 
                            if ($res2['statut'] == "Actif") { ?>
                                <option value='<?php $res2['numLicence'] ?>'><?php echo $res2['nom']." ".$res2['prenom'] ?></option>
                            <?php }
                        } while($res2=$req2->fetch());
                    }
                ?>
            </select><br />
            Défenseur gauche :
            <select name='DG' required>
                <option></option>
                <?php
                    $req2->execute();
                    $res2=$req2->fetch(); 
                    if ($res2 != false) {
                        do { 
                            if ($res2['statut'] == "Actif") { ?>
                                <option value='<?php $res2['numLicence'] ?>'><?php echo $res2['nom']." ".$res2['prenom'] ?></option>
                            <?php }
                        } while($res2=$req2->fetch());
                    }
                ?>
            </select><br />
            Défenseur centre :
            <select name='DC' required>
                <option></option>
                <?php
                    $req2->execute();
                    $res2=$req2->fetch(); 
                    if ($res2 != false) {
                        do { 
                            if ($res2['statut'] == "Actif") { ?>
                                <option value='<?php $res2['numLicence'] ?>'><?php echo $res2['nom']." ".$res2['prenom'] ?></option>
                            <?php }
                        } while($res2=$req2->fetch());
                    }
                ?>
            </select><br />
            Gardien de but :
            <select name='GB' required>
                <option></option>
                <?php
                    $req2->execute();
                    $res2=$req2->fetch();
                    if ($res2 != false) {
                        do { 
                            if ($res2['statut'] == "Actif") { ?>
                                <option value='<?php $res2['numLicence'] ?>'><?php echo $res2['nom']." ".$res2['prenom'] ?></option>
                            <?php }
                        } while($res2=$req2->fetch());
                    }
                ?>
            </select><br />
            <input type="hidden" name='id' value=<?php echo $id_rencontre ?>>
            <input type="submit" value="Valider">
        </form>
    </body>
</html>