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
          if(isset($_POST['id']) && !empty($_POST['id'])){
            $id = $_POST['id'];
                    
            $req2 = $linkpdo->prepare("SELECT * FROM football.players WHERE players.numLicence = ?");
            $req2->execute(array($id));
            $res2 = $req2->fetch();

            $req3 = $linkpdo->prepare("SELECT COUNT(*) FROM football.participant, football.players, football.rencontre 
                                          WHERE players.numLicence = ?
                                          AND Titulaire = TRUE
                                          AND rencontre.Date_rencontre < DATE( NOW() )
                                          AND players.numLicence = participant.numlicence
                                          AND rencontre.Id_rencontre = participant.Id_rencontre");
            $req3->execute(array($id));
            $res3 = $req3->fetch();
  
            $req4 = $linkpdo->prepare("SELECT COUNT(*) FROM football.participant, football.players, football.rencontre 
                                          WHERE players.numLicence = ? 
                                          AND Titulaire = FALSE
                                          AND rencontre.Date_rencontre < DATE( NOW() )
                                          AND players.numLicence = participant.numlicence
                                          AND rencontre.Id_rencontre = participant.Id_rencontre");
            $req4->execute(array($id));
            $res4 = $req4->fetch();
            
  
            $req5 = $linkpdo->prepare("SELECT SUM(Note) / COUNT(*) FROM football.participant, football.players, football.rencontre 
                                          WHERE players.numLicence = ? 
                                          AND rencontre.Date_rencontre < DATE( NOW() )
                                          AND players.numLicence = participant.numlicence
                                          AND rencontre.Id_rencontre = participant.Id_rencontre");
            $req5->execute(array($id));
            $res5 = $req5->fetch();
  
            $req6 = $linkpdo->prepare("SELECT COUNT(*) FROM football.participant, football.players, football.rencontre 
                                          WHERE players.numLicence = ? 
                                          AND rencontre.Date_rencontre < DATE( NOW() )
                                          AND players.numLicence = participant.numlicence
                                          AND rencontre.Id_rencontre = participant.Id_rencontre
                                          AND Points_equipe > Points_adversaire");
            $req6->execute(array($id));
            $res6 = $req6->fetch();

            $req7 = $linkpdo->prepare("SELECT COUNT(*) FROM football.participant, football.players, football.rencontre 
                                          WHERE players.numLicence = ? 
                                          AND rencontre.Date_rencontre < DATE( NOW() )
                                          AND participant.Position = 'AT'
                                          AND players.numLicence = participant.numlicence
                                          AND rencontre.Id_rencontre = participant.Id_rencontre");
            $req7->execute(array($id));
            $res7 = $req7->fetch();

            $req8 = $linkpdo->prepare("SELECT COUNT(*) FROM football.participant, football.players, football.rencontre 
                                          WHERE players.numLicence = ? 
                                          AND rencontre.Date_rencontre < DATE( NOW() )
                                          AND participant.Position = 'ML'
                                          AND players.numLicence = participant.numlicence
                                          AND rencontre.Id_rencontre = participant.Id_rencontre");
            $req8->execute(array($id));
            $res8 = $req8->fetch();

            $req9 = $linkpdo->prepare("SELECT COUNT(*) FROM football.participant, football.players, football.rencontre 
                                          WHERE players.numLicence = ? 
                                          AND rencontre.Date_rencontre < DATE( NOW() )
                                          AND participant.Position = 'DF'
                                          AND players.numLicence = participant.numlicence
                                          AND rencontre.Id_rencontre = participant.Id_rencontre");
            $req9->execute(array($id));
            $res9 = $req9->fetch();

            $req10 = $linkpdo->prepare("SELECT COUNT(*) FROM football.participant, football.players, football.rencontre 
                                          WHERE players.numLicence = ? 
                                          AND rencontre.Date_rencontre < DATE( NOW() )
                                          AND participant.Position = 'GB'
                                          AND players.numLicence = participant.numlicence
                                          AND rencontre.Id_rencontre = participant.Id_rencontre");
            $req10->execute(array($id));
            $res10 = $req10->fetch();

            $req11 = $linkpdo->prepare("UPDATE football.players SET postePrefere = 'AT' WHERE players.numLicence = ?");
            
            $req12 = $linkpdo->prepare("UPDATE football.players SET postePrefere = 'ML' WHERE players.numLicence = ?");
            
            $req13 = $linkpdo->prepare("UPDATE football.players SET postePrefere = 'DF' WHERE players.numLicence = ?");
            
            $req14 = $linkpdo->prepare("UPDATE football.players SET postePrefere = 'GB' WHERE players.numLicence = ?");

            $req15 = $linkpdo->prepare("UPDATE football.players SET postePrefere = 'NA' WHERE players.numLicence = ?");
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
          <h1>Stats de <?php echo $res2['nom'] . " " . $res2['prenom'] ?></h1><br/>

                         <table class='table'>
                              <thead>
                                   <tr>
                                        <th scope="col">Titularisation</th>
                                        <th scope="col">Remplacent</th>
                                        <th scope="col">Note moyenne</th>
                                        <th scope="col">% de victoire</th>
                                        <th scope="col">Poste préféré</th>

                                   </tr>
                              </thead>
                                   <tbody>
                                        <tr>
                                             <td><?php echo $res3[0] ?></td>
                                             <td><?php echo $res4[0] ?></td>
                                             <td><?php echo $res5[0] ?></td>
                                             <td><?php 
                                             if($res3[0] == 0){
                                                 echo "0%";
                                            }
                                             else{
                                                 echo $res6[0] / $res3[0] * 100 . "%"; 
                                            } ?></td>
                                            <td><?php 
                                            if($res7[0] >= $res8[0] && $res7[0] >= $res9[0]){
                                                echo "Attaquant";
                                                $req11->execute(array($id));
                                            }   
                                            elseif($res8[0] >= $res9[0]){
                                                echo "Millieu";
                                                $req12->execute(array($id));
                                            }
                                            elseif($res9[0] > $res10[0]){
                                                echo "Defenceur";
                                                $req13->execute(array($id));
                                            }
                                            elseif($res10[0] > 0){
                                                echo "Gardien de But";
                                                $req14->execute(array($id));
                                            }
                                            else{
                                                echo "Pas encore joué";
                                                $req15->execute(array($id));
                                            }
                                            ?></td>
                                                
                                        </tr>
                                   </tbody>
          
     </body>
</html>