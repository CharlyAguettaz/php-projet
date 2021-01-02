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
    <body>  
        <p>
            <a href="http://localhost/php-projet/rencontre.php">Rencontre</a> /
            <a href="http://localhost/php-projet/recherche.php">Rechercher un joueur</a>
        </p>            
        <form action="modificationRencontre.php" method="post">
            Date : <input type="date" value="<?php echo $res['Date_rencontre'] ?>" name="date"><br />
            Heure : <input type="text" value="<?php echo $res['Heure_rencontre'] ?>" name="heure"><br />
            Adversaire : <input type="text" value="<?php echo $res['Nom_adversaire'] ?>" name="adversaire" ><br />
            Lieu : <input type="text" value="<?php echo $res['Lieu_de_rencontre'] ?>" name="lieu"><br />
            But Pour : <input type="number" value="<?php echo $res['Points_equipe'] ?>" name="points_equipe" ><br />
            But Contre : <input type="number" value="<?php echo $res['Points_adversaire'] ?>" name="points_adversaire" ><br />
            <input type="hidden" value="<?php echo $res['Id_rencontre'] ?>" name='Id_rencontre'>

            <input type='Submit' value='Valider'>
        </form>
        
    </body>
</html>