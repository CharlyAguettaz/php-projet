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
        $req = $linkpdo->prepare("SELECT * FROM football.players WHERE numLicence LIKE ?");
        $req->execute(array(htmlentities($_POST['id'])));
        $res=$req->fetch();
    }
?>

<html>
<link rel="stylesheet" href="style.css" />
    <head>    
    <p>
            <a href="http://localhost/php-projet/ajoutJoueur.php">Ajouter un joueur</a> /
            <a href="http://localhost/php-projet/recherche.php">Rechercher un joueur</a> /
            <a href="http://localhost/php-projet/ajoutRencontre.php">Ajouter une rencontre</a> /
            <a href="http://localhost/php-projet/rencontre.php">Rechercher une rencontre</a>
    </p>  
        <h1>Modifier un joueur<br /></h1>
    </head>
    <body>          
            <form action="modification.php" method="post">
                Numéro de Licence : <input readonly type="text" value="<?php echo $res['numLicence'] ?>" name='numLicence'><br />
                Nom : <input type="text" value="<?php echo $res['nom'] ?>" name='nom'><br /> 
                Prenom : <input type="text" value="<?php echo $res['prenom'] ?>" name='prenom'><br /> 
                Date de naissance : <input type="date" value="<?php echo $res['dateDeNaissance'] ?>" name='dateDeNaissance'><br /> 
                Poids : <input type="number" value="<?php echo $res['poids'] ?>" name='poids'><br />
                Taille : <input type="number" value="<?php echo $res['taille'] ?>" name='taille'><br />
                Poste Préféré : <select name='postePrefere' >
                                <option value='<?php echo $res['postePrefere'] ?>'>Valeur actuel : <?php echo $res['postePrefere'] ?></option>
                                <option value='AD'>Attaquant droit</option>
                                <option value='AG'>Attaquant gauche</option>
                                <option value='AC'>Attanquant centre</option>
                                <option value='DD'>Défenseur droit</option>
                                <option value='DG'>Défenseur gauche</option>
                                <option value='DC'>Défenseur centre</option>
                                <option value='GB'>Gardien de but</option>
                            </select><br />
                Photo : <input type="file" name="photo" accept="image/png,image/jpg" value=<?php echo $res['photo']?>> <br />
                Statut :<select name='statut' >
                            <option value='<?php echo $res['statut'] ?>'>Valeur actuel : <?php echo $res['statut'] ?></option>
                            <option value='Actif'>Actif</option>
                            <option value='Blesse'>Bléssé</option>
                            <option value='Suspendu'>Suspendu</option>
                            <option value='Absent'>Absent</option>
                        </select><br />
                <input type='Submit' value='Valider'>
            </form>
        
    </body>
</html>


                