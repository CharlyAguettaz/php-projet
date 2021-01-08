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

            $req2 = $linkpdo->prepare("SELECT * FROM football.players");

            $req3 = $linkpdo->prepare("SELECT COUNT(*) FROM football.participant, football.players, football.rencontre 
                                          WHERE players.numLicence = ?
                                          AND Titulaire = TRUE
                                          AND players.numLicence = participant.numlicence
                                          AND rencontre.Id_rencontre = participant.Id_rencontre");
            $req3->execute(array($id));
            $res3 = $req3->fetch();
  
            $req4 = $linkpdo->prepare("SELECT COUNT(*) FROM football.participant, football.players, football.rencontre 
                                          WHERE players.numLicence = ? 
                                          AND Titulaire = FALSE
                                          AND players.numLicence = participant.numlicence
                                          AND rencontre.Id_rencontre = participant.Id_rencontre");
            $req4->execute(array($id));
            $res4 = $req4->fetch();
            
  
            $req5 = $linkpdo->prepare("SELECT SUM(Note) / COUNT(*) FROM football.participant, football.players, football.rencontre 
                                          WHERE players.numLicence = ? 
                                          AND players.numLicence = participant.numlicence
                                          AND rencontre.Id_rencontre = participant.Id_rencontre");
            $req5->execute(array($id));
            $res5 = $req5->fetch();
  
            $req6 = $linkpdo->prepare("SELECT COUNT(*) FROM football.participant, football.players, football.rencontre 
                                          WHERE players.numLicence = ? 
                                          AND players.numLicence = participant.numlicence
                                          AND rencontre.Id_rencontre = participant.Id_rencontre
                                          AND Points_equipe > Points_adversaire");
            $req6->execute(array($id));
            $res6 = $req6->fetch();
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
          <h1>Stats de Joueur<br /></h1>

                         <table class='table'>
                              <thead>
                                   <tr>
                                        <th scope="col">Titularisation</th>
                                        <th scope="col">Remplacent</th>
                                        <th scope="col">Note moyenne</th>
                                        <th scope="col">% de victoire</th>
                                        <th></th>
                                        <th></th>
                                   </tr>
                              </thead>
                                   <tbody>
                                        <tr>
                                             <td><?php echo $res3[0] ?></td>
                                             <td><?php echo $res4[0] ?></td>
                                             <td><?php echo $res5[0] ?></td>
                                             <td><?php if($res3[0] == 0){
                                                 echo "0%";
                                            }
                                             else{
                                                 echo $res6[0] / $res3[0] * 100 . "%"; 
                                            } ?></td>
                                                
                                        </tr>
                                   </tbody>
          
     </body>
</html>