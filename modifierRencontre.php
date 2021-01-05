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
        $req = $linkpdo->prepare("SELECT * FROM football.rencontre WHERE Id_rencontre LIKE ?");
        $req->execute(array(htmlentities($_POST['id'])));
        $res=$req->fetch();
    }
?>

<html>
<link rel="stylesheet" href="style.css" />
    <head> 
  
    </head>
    <body>  
    <header>
    <nav class="menu">
               <a href="http://localhost/php-projet/ajoutJoueur.php">Ajouter un joueur</a> /
               <a href="http://localhost/php-projet/recherche.php">Rechercher un joueur</a> /
               <a href="http://localhost/php-projet/ajoutRencontre.php">Ajouter une rencontre</a> /
               <a href="http://localhost/php-projet/rencontre.php">Rechercher une rencontre</a>
         </nav>    
        <h1>Modifier une rencontre<br /></h1>
          </header>       
        <form action="modificationRencontre.php" method="post">
            Date : <input type="date" value="<?php echo $res['Date_rencontre'] ?>" name="date" required><br />
            Heure : <input type="text" value="<?php echo $res['Heure_rencontre'] ?>" name="heure" required><br />
            Adversaire : <input type="text" value="<?php echo $res['Nom_adversaire'] ?>" name="adversaire" required><br />
            Lieu : <input type="text" value="<?php echo $res['Lieu_de_rencontre'] ?>" name="lieu" required><br />
            <input type="hidden" value="<?php echo $res['Id_rencontre'] ?>" name='Id_rencontre'>
            <input type='Submit' value='Valider'>
        </form>
        
    </body>
</html>