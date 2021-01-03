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
        $req2 = $linkpdo->prepare("SELECT nom,prenom,numLicence FROM football.players");
        
    }
?>

<html>
    <head>
        <h1>Details de la rencontre entre Agen - <?php echo $res['Nom_adversaire'] ?></h1>
    </head>
    <body>
            <p>
               <a href="http://localhost/php-projet/ajoutJoueur.php">Ajouter un joueur</a> /
               <a href="http://localhost/php-projet/recherche.php">Rechercher un joueur</a> /
               <a href="http://localhost/php-projet/ajoutRencontre.php">Ajouter une rencontre</a> /
               <a href="http://localhost/php-projet/rencontre.php">Rechercher une rencontre</a>
            </p>
        <form action="<?php $_SERVER['PHP_SELF']?>" method="post">
            <p>
                Score du match : Agen <?php echo $res['Points_equipe']." - ".$res['Points_adversaire']." ".$res['Nom_adversaire'] ?>
            </p>
            Attaquant droit :
            <select name='AD' required>
                <option></option>
                <?php
                    $req2->execute();
                    $res2=$req2->fetch(); 
                    if ($res2 != false) {
                        do { ?>
                            <option value='<?php $res2['numLicence'] ?>'><?php echo $res2['nom']." ".$res2['prenom'] ?></option>
                        <?php } while($res2=$req2->fetch());
                    }
                ?>
            </select><br />
            Attaquant gauche :
            <select name='AG' required>
                <option></option>
                <?php
                    $req2->execute();
                    $res2=$req2->fetch(); 
                    if ($res2 != false) {
                        do { ?>
                            <option value='<?php $res2['numLicence'] ?>'><?php echo $res2['nom']." ".$res2['prenom'] ?></option>
                        <?php } while($res2=$req2->fetch());
                    }
                ?>
            </select><br />
            Attaquant centre :
            <select name='AC' required>
                <option></option>
                <?php
                    $req2->execute();
                    $res2=$req2->fetch(); 
                    if ($res2 != false) {
                        do { ?>
                            <option value='<?php $res2['numLicence'] ?>'><?php echo $res2['nom']." ".$res2['prenom'] ?></option>
                        <?php } while($res2=$req2->fetch());
                    }
                ?>
            </select><br />
            Défenseur droit :
            <select name='DD' required>
                <option></option>
                <?php
                    $req2->execute();
                    $res2=$req2->fetch(); 
                    if ($res2 != false) {
                        do { ?>
                            <option value='<?php $res2['numLicence'] ?>'><?php echo $res2['nom']." ".$res2['prenom'] ?></option>
                        <?php } while($res2=$req2->fetch());
                    }
                ?>
            </select><br />
            Défenseur gauche :
            <select name='DG' required>
                <option></option>
                <?php
                    $req2->execute();
                    $res2=$req2->fetch(); 
                    if ($res2 != false) {
                        do { ?>
                            <option value='<?php $res2['numLicence'] ?>'><?php echo $res2['nom']." ".$res2['prenom'] ?></option>
                        <?php } while($res2=$req2->fetch());
                    }
                ?>
            </select><br />
            Défenseur centre :
            <select name='DC' required>
                <option></option>
                <?php
                    $req2->execute();
                    $res2=$req2->fetch(); 
                    if ($res2 != false) {
                        do { ?>
                            <option value='<?php $res2['numLicence'] ?>'><?php echo $res2['nom']." ".$res2['prenom'] ?></option>
                        <?php } while($res2=$req2->fetch());
                    }
                ?>
            </select><br />
            Gardien de but :
            <select name='GB' required>
                <option></option>
                <?php
                    $req2->execute();
                    $res2=$req2->fetch(); 
                    if ($res2 != false) {
                        do { ?>
                            <option value='<?php $res2['numLicence'] ?>'><?php echo $res2['nom']." ".$res2['prenom'] ?></option>
                        <?php } while($res2=$req2->fetch());
                    }
                ?>
            </select><br />
            <input type="hidden" name='id' value=<?php echo $id_rencontre ?>>
            <input type="submit" value="Valider">
        </form>
    </body>
</html>