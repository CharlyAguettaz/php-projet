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
    $req6 = $linkpdo->prepare("SELECT nom,prenom FROM football.players WHERE numLicence LIKE ?");
    $req4 = $linkpdo->prepare("SELECT * FROM football.participant WHERE Id_rencontre LIKE ?");
    $req4->execute(array($id_rencontre));
    $res4 = $req4->fetch();
    $req7 = $linkpdo->prepare("SELECT * FROM football.participant WHERE Id_rencontre LIKE ? AND numLicence LIKE ?");
    
    if (isset($_POST['Points_equipe']) && isset($_POST['Points_adversaire'])) {
        $Points_equipe=htmlentities($_POST['Points_equipe']);
        $Points_adversaire=htmlentities($_POST['Points_adversaire']);
        $req3 = $linkpdo->prepare("UPDATE football.rencontre SET Points_equipe = :points_equipe, Points_adversaire = :points_adversaire WHERE Id_rencontre = :Id_rencontre");
        $req3->execute(array('points_adversaire' => $Points_adversaire,'points_equipe' => $Points_equipe,'Id_rencontre' => $id_rencontre));
    }

    if (isset($_POST['joueurAjoutee']) && !empty($_POST['joueurAjoutee']) && isset($_POST['Titulaire']) && !empty($_POST['Titulaire'])) {
        $numLicence = $_POST['joueurAjoutee'];
        $titulaire= $_POST['Titulaire'];
        $req5 = $linkpdo->prepare("INSERT INTO football.participant(Id_rencontre,numLicence,Position,Commentaire,Note,Titulaire) VALUES(?,?,'','',0,?)");
        $req5->execute(array($id_rencontre,$numLicence,$titulaire));
    } 

    if(isset($_POST['supprimer']) && !empty($_POST['supprimer'])) {
        $numLicence=$_POST['supprimer'];
        $reqSupp = $linkpdo->prepare("DELETE FROM football.participant WHERE numLicence LIKE ?");
        $reqSupp->execute(array($numLicence));
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
            Ajouter un participant
        </button>

        <?php if ($res4['numLicence'] != '') { ?>
            <table class='table'>
                <thead>
                    <tr>
                        <th scope="col">Numéro de Licence</th>
                        <th scope="col">Nom</th>
                        <th scope="col">Prenom</th>
                        <th scope="col">Statut</th>
                        <th scope="col">Position</th>
                        <th scope="col">Note</th>
                        <th scope="col">Commentaire</th>
                        <th></th>
                        <th></th>
                    </tr>
                </thead>
                <?php do {
                    $id_numLicence = $res4['numLicence']; 
                    $req6->execute(array($id_numLicence));
                    $res6 = $req6->fetch(); ?>
                    <tbody>
                        <tr>
                            <td><?php echo $res4['numLicence'] ?></td>
                            <td><?php echo $res6['nom'] ?></td>
                            <td><?php echo $res6['prenom'] ?></td>
                            <td><?php if($res4['Titulaire']){echo "Titulaire";} else {echo "Remplaçant";} ?></td>
                            <td><?php if ($res4['Position'] == '') {echo "Position à éditer";} else {echo $res4['Position'];} ?></td>
                            <td><?php echo $res4['Note']."/10" ?></td>
                            <td><?php if ($res4['Commentaire'] == '') {echo "Commentaire à éditer";} else { ?> <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#CommentaireModal"> Voir le commentaire </button> <?php ;} ?></td>
                            <td><button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#EditerModal"> Editer </button></td>
                            <td><form action="<?php $_SERVER['PHP_SELF']?>" method="post"><input type="hidden" name="id" value="<?php echo $id_rencontre?>"><input type="hidden" name="supprimer" value="<?php echo $res4['numLicence']?>"><button type="submit" class="btn btn-primary">Supprimer</button></form></td>
                        <tr>
                    </tbody>
                <?php } while($res4 = $req4->fetch()); ?>
            </table>
        <?php } ?>

        <!-- Modal -->
        <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Ajouter un joueur</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="<?php $_SERVER['PHP_SELF']?>" method="post">
                        <div class="row gy-3 gx-5 align-items-center">
                            <div class="col-auto">
                                <label for="nom" class="form-label">Nom</label>
                                <select name='joueurAjoutee' id="nom" required class="form-control">
                                    <option>Choisir un joueur..</option>
                                    <?php
                                        $req2->execute();
                                        $res2=$req2->fetch();
                                        if ($res2 != false) {
                                            do { 
                                                $req7->execute(array($id_rencontre,$res2['numLicence']));
                                                $res7=$req7->fetch();
                                                if ($res2['statut'] == "Actif" && $res7 == FALSE) { ?>
                                                    <option value='<?php echo $res2['numLicence'] ?>'><?php echo $res2['nom']." ".$res2['prenom'] ?></option>
                                                <?php }
                                            } while($res2=$req2->fetch());
                                        }
                                    ?>
                                </select>
                            </div>
                            <div class="col-auto">
                                <label for="Titulaire" class="form-label">Titulaire ou remplaçant?</label>
                                <select name='Titulaire' id='Titulaire' required class="form-control">
                                        <option></option>
                                        <option value="1">Titulaire</option>
                                        <option value="0">Remplaçant</option>
                                </select>
                            </div>
                        </div>
                        <input type="hidden" value="<?php echo $id_rencontre ?>" name="id">
                        <div class="mt-3">
                            <div class="col-auto">
                                <button type="submit" class="btn btn-primary">Ajouter</button>
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Annuler</button>
                            </div >
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </body>
</html>