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
        <h1>Modifier un joueur<br /></h1>     
        <form action="modification.php" method="post" enctype="multipart/form-data">
            <div class="row gy-3 gx-5 align-items-center">
                    <div class="col-auto">
                        <label for="nom" class="form-label">Nom</label>
                        <input type="text" value="<?php echo $res['nom'] ?>" name="nom" id="nom" class="form-control" required>
                    </div>
                    <div class="col-auto">
                        <label for="prenom" class="form-label">Prenom</label>
                        <input type="text" value="<?php echo $res['prenom'] ?>" name="prenom" id="prenom" class="form-control" required>
                    </div>
                </div>
                <div class="row gy-3 gx-5 align-items-center">
                    <div class="col-auto">
                        <label for="numLicence" class="form-label">Numéro de licence</label>
                        <input type="text" value="<?php echo $res['numLicence'] ?>" name="numLicence" required size="11" minlength ="10" maxlength="10" id="numLicence" class="form-control" readonly>
                    </div>
                    <div class="col-auto">
                        <label for="dateDeNaissance" class="form-label">Date de naissance</label>
                        <input type="date" value="<?php echo $res['dateDeNaissance'] ?>" name="dateDeNaissance" id="dateDeNaissance" class="form-control" required>
                    </div>
                </div>
                <div class="row gy-3 gx-5 align-items-center">
                    <div class="col-auto">
                        <label for="poids" class="form-label">Poids</label>
                        <input type="number" value="<?php echo $res['poids'] ?>" name="poids" id="poids" class="form-control" required >
                        
                    </div>
                    <div class="col-auto">
                        <label for="taille" class="form-label">Taille</label>
                        <input type="number" value="<?php echo $res['taille'] ?>" name="taille" id="taille" class="form-control" required>
                    </div>
                </div>
                <div class="row gy-3 gx-5 align-items-center">
                    <div class="col-auto">
                        <label for="statut" class="form-label">Statut</label>
                        <select name='statut' id="statut" class="form-select">
                            <option value="<?php echo $res['statut'] ?>"><?php echo $res['statut'] ?></option>
                            <option value='Actif'>Actif</option>
                            <option value='Blesse'>Bléssé</option>
                            <option value='Suspendu'>Suspendu</option>
                            <option value='Absent'>Absent</option>
                        </select>
                    </div>
                </div>
                <div class="col-md-3">
                        <img src="photos-m3104/<?php echo $res['photo'] ?>"  class="img-thumbnail rounded-0" style="margin-top: 20px; margin-bottom: 15px;">
                </div>
                <div class="row gy-3 gx-5 align-items-center">
                    <div class="col-auto">
                        <label for="photo" class="form-label">Photo</label>
                        <input type="file" name="photo" accept="image/png,image/jpg" id="photo" class="form-control">
                    </div>
                </div>
                <div class="col-auto">
                    <button type="submit" class="btn btn-light" style="margin-top: 30px;">Enregister</button>
                </div>
            </div>
        </form>
        
    </body>
</html>


                