<html>
     <head>   
     <meta charset="utf-8" /> 
     <link rel="stylesheet" href="style.css" />
         
          <p>  <input type=button onclick=window.location.href='http://localhost/php-projet/ajoutRencontre.php'; value= "Ajouter une rencontre" />
          </p>
     </head>
     <body>
          <header>
          <nav class="menu">
               <a href="http://localhost/php-projet/ajoutJoueur.php">Ajouter un joueur</a> /
               <a href="http://localhost/php-projet/recherche.php">Rechercher un joueur</a> /
               <a href="http://localhost/php-projet/ajoutRencontre.php">Ajouter une rencontre</a> /
               <a href="http://localhost/php-projet/rencontre.php">Rechercher une rencontre</a>
         </nav>  
          <h1>Rechercher une rencontre<br /></h1>
          </header>

     </body>
</html>

          <?php
               ;
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
                    if ($res == false) {
                         echo "Aucune rencontre enregister pour le moment !"."<br />";
                    } else {
     
                         do {
                              $id = $res['Id_rencontre'];
                              echo "Adversaire : ".$res['Nom_adversaire']."<br />";
                              echo $res['Date_rencontre']." ";
                              echo $res['Heure_rencontre']."<br />";
                              echo "Lieu : ".$res['Lieu_de_rencontre']."<br />";
                              echo "Score : Agen ".$res['Points_equipe']." - ".$res['Points_adversaire']." ".$res['Nom_adversaire'];
                              ?>
                              <form action="modifierRencontre.php" method="post">
                                   <input type='hidden' value="<?php echo $id ?>" name='id'>
                                   <input type='submit' value='Modifier'>
                              </form>
                              <form action="suppressionRencontre.php" method="post">
                                   <input type='hidden' value="<?php echo $id ?>" name='id'>
                                   <input type='submit' value='Supprimer'><br />
                              </form>
                              <form action="detailsRencontre.php" method="post">
                                   <input type='hidden' value="<?php echo $id ?>" name ='id'>
                                   <input type='submit' value="Détails du match">
                              </form>
                              <?php
                              echo "<br />";
                         } while ($res = $req->fetch());
                    }
               
          ?>