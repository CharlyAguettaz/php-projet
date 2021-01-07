<script>
    var myModal = document.getElementById('myModal');
    var myInput = document.getElementById('myInput');
    
    myModal.addEventListener('shown.bs.modal', function () {
      myInput.focus()
    })
</script>
<?php
    if (isset($_POST['id']) && !empty($_POST['id'] )) {
        $id_rencontre = htmlentities($_POST['id']);
    }
    $db = 'football';
    $login="root";
    $mdp="";
    try {
        $linkpdo = new PDO("mysql:host=localhost;dname=$db",$login, $mdp);
    }
    catch (Exeption $e) {
        die('Error :' . $e->getMessage());
    }

    $req = $linkpdo->prepare("SELECT * FROM football.rencontre WHERE Id_rencontre LIKE ?");
    $req->execute(array($id_rencontre));
    $res=$req->fetch();
    $req2 = $linkpdo->prepare("SELECT nom,prenom,numLicence,statut FROM football.players");
    $req4 = $linkpdo->prepare("SELECT * FROM football.participant WHERE Id_rencontre LIKE ?");
    $req4->execute(array($id_rencontre));
    $res4 = $req4->fetch();
    
    if (isset($_POST['Points_equipe']) && isset($_POST['Points_adversaire'])) {
        $Points_equipe=htmlentities($_POST['Points_equipe']);
        $Points_adversaire=htmlentities($_POST['Points_adversaire']);
        $req3 = $linkpdo->prepare("UPDATE football.rencontre SET Points_equipe = :points_equipe, Points_adversaire = :points_adversaire WHERE Id_rencontre = :Id_rencontre");
        $req3->execute(array('points_adversaire' => $Points_adversaire,'points_equipe' => $Points_equipe,'Id_rencontre' => $id_rencontre));
    }

    if (isset($_POST['ajoutJoueur']) && !empty($_POST['ajoutJoueur'])) {
        $numLicence = $_POST['ajoutJoueur'];
        $req5 = $linkpdo->prepare("INSERT INTO football.participant(Id_rencontre,numLicence,Position,Commentaire,Note,Titulaire) VALUES(?,?,'','','',?)");
        $req5->execute(array($id_rencontre,$numLicence));
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
            Score du match : Agen 
            <input type="number" value="<?php echo $res['Points_equipe'] ?>" name='Points_equipe' > - 
            <input type ="number" value=<?php echo $res['Points_adversaire']?> name ='Points_adversaire' > <?php echo $res['Nom_adversaire'] ?>
            <input type="hidden" name='id' value="<?php echo $id_rencontre ?>">
            <input type="submit" value="Sauvegarder">
        </form>
        <!-- Button trigger modal -->
        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">
            Ajouter une participant
        </button>

        <!-- Modal -->
        <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="<?php $_SERVER['PHP_SELF']?>" method="post">
                    <div>
                        <div class="col-auto">
                            <label for="nom" class="form-label">Nom</label>
                            <select name='JoueurAjoutee' id="nom" required class="form-control">
                                <option></option>
                                <?php
                                    $req2->execute();
                                    $res2=$req2->fetch();
                                    if ($res2 != false) {
                                        do { 
                                            if ($res2['statut'] == "Actif" && $req4 != false) { ?>
                                                <option value='<?php echo $res2['numLicence'] ?>'><?php echo $res2['nom']." ".$res2['prenom'] ?></option>
                                            <?php }
                                        } while($res2=$req2->fetch());
                                    }
                                ?>
                            </select>
                            <label for="Titulaire" class="form-label">Titulaire ou remplaçant?</label>
                            <select name='Titulaire' id='Titulaire' required class="form-control">
                                    <option></option>
                                    <option value="1">Titulaire</option>
                                    <option value="0">Remplaçant</option>
                            </select>
                        </div>
                    </div>
                    <div class="mt-3">
                        <div class="col-auto">
                            <button type="submit" class="btn btn-primary">Ajouter</button>
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Annuler</button>
                        </div >
                    </div>
                    <input type="hidden" value="<?php echo $id_rencontre ?>" name="id">
                </form>
            </div>
        </div>
    </body>
</html>