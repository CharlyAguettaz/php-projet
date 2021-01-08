<?php
    session_start();
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
        $req = $linkpdo->prepare("SELECT * FROM football.users WHERE username LIKE :username AND password LIKE :password");
        $req->execute(array('username' => $username, 'password' => $password));
        $res=$req->fetch();
        if ($req == true) {
            do {
                if ($res == false) {
                    echo "Identifiant ou mot de passe inconnue";
                } else {
                    $user = "root";
                    $_SESSION['user'] = $user;
                    header('location:ajoutJoueur.php');
                }
            } while($res=$req->fetch());
        } else {
            echo "Erreur de connexion";
        }
    }
?>
<html>
    <head>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1" crossorigin="anonymous">
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.bundle.min.js" integrity="sha384-ygbV9kiqUc6oa4msXn9868pTtWMgiQaeYH7/t7LECLbyPA2x65Kgf80OJFdroafW" crossorigin="anonymous"></script>
        <link rel="stylesheet" href="style.css" />
    </head>
    <body>
        <p>
            <h1>Page de connexion</h1>
        </p>
        <form action="<?php $_SERVER['PHP_SELF']?>" method='post'>
            Identifiant : <input type='text' required name='username'><br />
            Mot de passe : <input type='password' required name='password'><br />
            <input type='submit' value='Connexion'>
        </form>
    </body>
</html>
