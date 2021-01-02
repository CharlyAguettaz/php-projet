<html>
     <body>
          <p>
               <a href="http://localhost/php-projet/ajoutRencontre.php">Ajouter une rencontre</a> 
               
          </p>
          <head>Rencontre</head>
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
                    $req = $linkpdo->prepare("SELECT * FROM football.rencontre");
                    $req->execute();
                    $res=$req->fetch();
                    if ($res == false) {
                         echo "Aucun joueur de ce nom n'existe !";
                    } else {
                         do {
                              echo "Adversaire : ".$res['Nom_adversaire']."<br />";
                              echo $res['Date_rencontre']." ";
                              echo $res['Heure_rencontre']."<br />";
                              echo "Lieu : ".$res['Lieu_de_rencontre']."<br />";
                              echo "Score : Agen ".$res['Point_equipe']." / ".$res['Point_adversaire']." ".$res['Nom_adversaire'];
                              ?>
                              <form action="modifierRencontre.php" method="post">
                                   <input type='hidden' value="<?php echo $id ?>" name='id'>
                                   <input type='submit' value='Modifier'>
                              <form action="Suppression.php" method="post">
                                   <input type='hidden' value="<?php echo $id ?>" name='id'>
                                   <input type='submit' value='Supprimer'><br />
                              </form>
                              <?php
                              echo "<br />";
                         } while ($res = $req->fetch());
                    }
               
          ?>