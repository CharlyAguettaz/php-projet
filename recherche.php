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
          $req = $linkpdo->prepare("SELECT * FROM football.players WHERE nom LIKE ?");
          $req2 = $linkpdo->prepare("SELECT * FROM football.players");

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
          <h1>Rechercher un joueur</h1><br/>
          <form action="<?php $_SERVER['PHP_SELF']?>" method="post">
               <input type="text" name="nom">
               <input type="submit" value="Rechercher"><br />
          </form>
          <?php 
               if (!empty($_POST['nom']) && isset($_POST['nom'])) {
                    $req->execute(array("%".htmlentities($_POST['nom'])."%"));
                    $res=$req->fetch();
                    if ($res == false) {
                         echo "Aucun joueur de ce nom n'existe !";
                    } else {
                         ?>
                         <table class='table'>
                              <thead>
                                   <tr>
                                        <th scope="col">Numéro de Licence</th>
                                        <th scope="col">Nom</th>
                                        <th scope="col">Prenom</th>
                                        <th scope="col">Date de naissance</th>
                                        <th scope="col">Poids</th>
                                        <th scope="col">Taille</th>
                                        <th scope="col">Poste préférer</th>
                                        <th scope="col">Statut</th>
                                        <th scope="col">Photo</th>
                                        <th></th>
                                        <th></th>
                                   </tr>
                              </thead>
                              <?php do {
                                   $id = $res['numLicence']; ?>
                                   <tbody>
                                        <tr>
                                             <td><?php echo $res['numLicence'] ?></td>
                                             <td><?php echo $res['nom'] ?></td>
                                             <td><?php echo $res['prenom'] ?></td>
                                             <td><?php echo $res['dateDeNaissance'] ?></td>
                                             <td><?php echo $res['poids'] ?></td>
                                             <td><?php echo $res['taille'] ?></td>
                                             <td><?php echo $res['postePrefere'] ?></td>
                                             <td><?php echo $res['statut'] ?></td>
                                             <td><?php echo $res['photo'] ?></td>
                                             <td><form action="modifier.php" method="post">
                                                  <input type='hidden' value="<?php echo $id ?>" name='id'>
                                                  <input type='submit' value='Modifier'>
                                             </form></td>
                                             <td><form action="Suppression.php" method="post">
                                                  <input type='hidden' value="<?php echo $id ?>" name='id'>
                                                  <input type='submit' value='Supprimer'><br />
                                             </form><td>
                                             <td><form action="statsJoueur.php" method="post">
                                                  <input type='hidden' value="<?php echo $id ?>" name='id'>
                                                  <input type='submit' value='Stats'><br />
                                             </form><td>
                                        </tr>
                                   </tbody>
                                   <?php
                              } while ($res = $req->fetch());
                         ?> </table> 
                    <?php }
               } else {
                    $req2->execute();
                    $res=$req2->fetch();
                    if ($res == false) {
                         echo "Aucun joueur enregister !";
                    } else {
                         ?>
                         <table class='table'>
                              <thead>
                                   <tr>
                                        <th scope="col">Numéro de Licence</th>
                                        <th scope="col">Nom</th>
                                        <th scope="col">Prenom</th>
                                        <th scope="col">Date de naissance</th>
                                        <th scope="col">Poids</th>
                                        <th scope="col">Taille</th>
                                        <th scope="col">Poste préférer</th>
                                        <th scope="col">Statut</th>
                                        <th scope="col">Photo</th>
                                        <th></th>
                                        <th></th>
                                   </tr>
                              </thead>
                              <?php do {
                                   $id = $res['numLicence']; ?>
                                   <tbody>
                                        <tr>
                                             <td><?php echo $res['numLicence'] ?></td>
                                             <td><?php echo $res['nom'] ?></td>
                                             <td><?php echo $res['prenom'] ?></td>
                                             <td><?php echo $res['dateDeNaissance'] ?></td>
                                             <td><?php echo $res['poids'] ?></td>
                                             <td><?php echo $res['taille'] ?></td>
                                             <td><?php echo $res['postePrefere'] ?></td>
                                             <td><?php echo $res['statut'] ?></td>
                                             <td class="col-mblank-1"><img src="photos-m3104/<?php echo $res['photo'] ?>"  style="width: 75px;"></td>
                                             <td><form action="modifier.php" method="post">
                                                  <input type='hidden' value="<?php echo $id ?>" name='id'>
                                                  <input type='submit' value='Modifier'>
                                             </form></td>
                                             <td><form action="Suppression.php" method="post">
                                                  <input type='hidden' value="<?php echo $id ?>" name='id'>
                                                  <input type='submit' value='Supprimer'><br />
                                             </form><td>
                                             <td><form action="statsJoueur.php" method="post">
                                                  <input type='hidden' value="<?php echo $id ?>" name='id'>
                                                  <input type='submit' value='Stats'><br />
                                             </form><td>
                                        </tr>
                                   </tbody>
                                   <?php
                              } while ($res = $req2->fetch());
                         ?> </table> 
                    <?php }
               }
          ?>
          
     </body>
</html>