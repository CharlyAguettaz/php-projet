<?php
    if (!empty($_POST['id'] && isset($_POST['id']))) {
        $id_rencontre = htmlentities($_POST['id']);

        $db = 'football';
        $login="root";
        $mdp="";
        try {
            $linkpdo = new PDO("mysql:host=localhost;dname=$db",$login, $mdp);
        }
        catch (Exeption $e) {
            die('Error :' . $e->getMessage());
        }

        $req = $linkpdo->prepare("SELECT * FROM football.rencontre WHERE Id_rencontre LIKE ?");
        $req->execute(array($id_rencontre));
        $res=$req->fetch();
    }
?>

<html>
    <head>
        <h1>Detail de la rencontre entre Agen - <?php echo $res['Nom_adversaire'] ?></h1>
    </head>
    <body>
        <p>
            Score du match : Agen <?php echo $res['Points_equipe']." - ".echo $res['Points_adversaire']." ".echo $res['Nom_adversaire'] ?>
        </p>
    </body>
</html>