<html>
     <body>
          <p>
               <a href="http://localhost/php-projet/ajoutJoueur.php">Ajouter un joueur</a> /
               <a href="http://localhost/php-projet/recherche.php">Rechercher un joueur</a>
          </p>
          <head>Rechercher joueurs</head>
          <form action="<?php $_SERVER['PHP_SELF']?>" method="post">
               <input type="text" name="nom">
               <input type="submit" value="Rechercher"><br />
          </form>
          <?php
               if (!empty($_POST['nom']) && isset($_POST['nom'])) {
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
                    $req->execute(array("%".htmlentities($_POST['nom'])."%"));
                    $res=$req->fetch();
                    if ($res == false) {
                         echo "Aucun joueur de ce nom n'existe !";
                    } else {
                         do {
                              $id = $res['numLicence'];
                              echo "Numéro de Licence : ".$res['numLicence']."<br />";
                              echo $res['nom']." ";
                              echo $res['prenom']."<br />";
                              echo "Date de naissance : ".$res['dateDeNaissance']."<br />";
                              echo "Poids : ".$res['poids']."<br />";
                              echo "Taille : ".$res['taille']."<br />";
                              echo "Photo : "."<br />";
                              echo "Poste préférer : ".$res['postePrefere']."<br />";
                              echo "Statut : ".$res['statut']."<br />";
                              ?>
                              <form action="modifier.php" method="post">
                                   <input type='hidden' value="<?php echo $id ?>" name='id'>
                                   <input type='submit' value='Modifier'>
                              </form>
                              <form action="Suppression.php" method="post">
                                   <input type='hidden' value="<?php echo $id ?>" name='id'>
                                   <input type='submit' value='Supprimer'><br />
                              </form>
                              <?php
                              echo "<br />";
                         } while ($res = $req->fetch());
                    }
               }
          ?>
     </body>
</html>