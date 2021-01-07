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
                        </ul>
                    </ul>
                </div>
            </div>
        </nav>
    </header>
    <body>  
        <h1>Modifier un joueur<br /></h1>     
        <form action="modification.php" method="post" enctype="multipart/form-data">
            Numéro de Licence : <input readonly type="text" value="<?php echo $res['numLicence'] ?>" name='numLicence'><br />
            Nom : <input type="text" value="<?php echo $res['nom'] ?>" name='nom'><br /> 
            Prenom : <input type="text" value="<?php echo $res['prenom'] ?>" name='prenom'><br /> 
            Date de naissance : <input type="date" value="<?php echo $res['dateDeNaissance'] ?>" name='dateDeNaissance'><br /> 
            Poids : <input type="number" value="<?php echo $res['poids'] ?>" name='poids'><br />
            Taille : <input type="number" value="<?php echo $res['taille'] ?>" name='taille'><br />
            Poste Préféré : <select name='postePrefere' >
                            <option value='<?php echo $res['postePrefere'] ?>'>Valeur actuel : <?php echo $res['postePrefere'] ?></option>
                            <option value='AD'>Attaquant droit</option>
                            <option value='AG'>Attaquant gauche</option>
                            <option value='AC'>Attanquant centre</option>
                            <option value='DD'>Défenseur droit</option>
                            <option value='DG'>Défenseur gauche</option>
                            <option value='DC'>Défenseur centre</option>
                            <option value='GB'>Gardien de but</option>
                        </select><br />
            Photo : <input type="file" name="photo" accept="image/png,image/jpg" value=<?php echo $res['photo']?>> <br />
            Statut :<select name='statut' >
                        <option value='<?php echo $res['statut'] ?>'>Valeur actuel : <?php echo $res['statut'] ?></option>
                        <option value='Actif'>Actif</option>
                        <option value='Blesse'>Bléssé</option>
                        <option value='Suspendu'>Suspendu</option>
                        <option value='Absent'>Absent</option>
                    </select><br />
            <input type='Submit' value='Valider'>
        </form>
        
    </body>
</html>


                