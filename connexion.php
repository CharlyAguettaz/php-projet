<?php
    if (!empty($_POST['username']) && !empty($_POST['password'])) {
        $username = htmlentities($_POST['username']);
        $password = htmlentities($_POST['password']); 
        
        $db = 'football';
        $login="root";
        $mdp="";
        try {
            $linkpdo = new PDO("mysql:host=localhost;dname=$db",$login, $mdp);
        }
        catch (Exeption $e) {
            die('Error :' . $e->getMessage());
        }
        $req = $linkpdo->prepare("SELECT * FROM football.players WHERE username LIKE :username AND password LIKE :password");
        $req->execute(array('username' => $username, 'password' => $password));
        $res=$req->fetch();
        if ($res == false) {
            echo "Identifiant ou mot de passe inconnue";
        } else {
            header('location:ajoutJoueur.php');
        }
    }
?>
<html>
    <head>
        <p>
            Page de connexion
        </p>
    </head>
    <body>
        <form action="<?php $_SERVER['PHP_SELF']?>" method='post'>
            Identifiant : <input type='email' required name='username'><br />
            Mot de passe : <input type='password' required name='password'><br />
            <input type='submit' value='Valider'>
        </form>
    </body>
</html>
