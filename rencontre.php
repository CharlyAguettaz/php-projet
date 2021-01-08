<?php
     $db = 'football';
     $login = 'root';
     $mdp = '';
     try {
          $linkpdo = new PDO("mysql:host=localhost;dname=$db",$login,$mdp);
     }
     catch (Exeption $e) {
          die('Error :' . $e->getMessage());
     }
     $req = $linkpdo->prepare("SELECT * FROM football.rencontre ORDER BY Date_rencontre DESC" );
     $req->execute();
     $res=$req->fetch();
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
          <h1>Rechercher une rencontre</h1><br/>
          <?php
               if ($res == false) {
                    echo "Aucune rencontre enregister pour le moment !"."<br />";
               } else { ?>
                    <table class='table'>
                         <thead>
                              <tr>
                                   <th scope="col">Nom de l'adversaire</th>
                                   <th scope="col">Date de la rencontre</th>
                                   <th scope="col">Heure de la rencontre</th>
                                   <th scope="col">Lieu de la rencontre</th>
                                   <th scope="col">Score de l'équipe</th>
                                   <th scope="col">Score de l'adversaire</th>
                                   <th></th>
                                   <th></th>
                                   <th></th>
                              </tr>
                         </thead>
                    <?php do {
                         $id = $res['Id_rencontre']; ?>
                         <tbody>
                              <tr>
                                   <td><?php echo $res['Nom_adversaire'] ?></td>
                                   <td><?php echo $res['Date_rencontre'] ?></td>
                                   <td><?php echo $res['Heure_rencontre'] ?></td>
                                   <td><?php echo $res['Lieu_de_rencontre'] ?></td>
                                   <td><?php echo $res['Points_equipe'] ?></td>
                                   <td><?php echo $res['Points_adversaire'] ?></td>
                                   <td><form action="modifierRencontre.php" method="post">
                                        <input type='hidden' value="<?php echo $id ?>" name='id'>
                                        <input type='submit' value='Modifier'>
                                   </form><td>
                                   <td><form action="suppressionRencontre.php" method="post">
                                                  <input type='hidden' value="<?php echo $id ?>" name='id'>
                                                  <input type='submit' value='Supprimer'><br />
                                   </form><td>
                                   <td><form action="detailsRencontre.php" method="post">
                                        <input type='hidden' value="<?php echo $id ?>" name ='id'>
                                        <input type='submit' value="Détails du match">
                                   </form><td>
                              </tr>
                         </tbody>
                    <?php } while ($res = $req->fetch());
               }
          ?>
     </body>
</html>
          