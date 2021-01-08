<?php
    $db = 'football';
    $login="root";
    $mdp="";
    try {
        $linkpdo = new PDO("mysql:host=localhost;dname=$db",$login, $mdp);
    }
    catch (Exeption $e) {
        die('Error :' . $e->getMessage());
    }

    if (isset($_POST['id']) && !empty($_POST['id'] && isset($_POST['numLicence']) && !empty($_POST['numLicence']))) {
        $id_rencontre = htmlentities($_POST['id']);
        $numLicence = htmlentities($_POST['numLicence']);
        $reqEditer = $linkpdo->prepare("SELECT * FROM football.participant WHERE Id_rencontre LIKE ? AND numLicence LIKE ?");
        $reqEditer->execute(array($id_rencontre,$numLicence));
        $resEditer = $reqEditer->fetch();
        $reqInfoJoueur = $linkpdo->prepare("SELECT nom,prenom FROM football.players WHERE numLicence LIKE ?");
        $reqInfoJoueur->execute(array($numLicence));
        $resInfoJoueur = $reqInfoJoueur->fetch();
        $reqInfoRencontre = $linkpdo->prepare("SELECT Nom_adversaire FROM football.rencontre WHERE Id_rencontre LIKE ?");
        $reqInfoRencontre->execute(array($id_rencontre));
        $resInfoRencontre = $reqInfoRencontre->fetch();
        if (isset($_POST['Position']) && isset($_POST['note']) && isset($_POST['commentaire'])) {
            $Position = $_POST['Position'];
            $note = $_POST['note'];
            $commentaire = $_POST['commentaire'];
            $Titulaire= $_POST['Titulaire'];
            $req = $linkpdo->prepare("UPDATE football.participant SET Position = ?, Note = ?, Commentaire = ?, Titulaire = ? WHERE Id_rencontre = ? AND numLicence = ?");
            $req->execute(array($Position,$note,$commentaire,$Titulaire,$id_rencontre,$numLicence));
            if ($req == true){
                echo "Modification effectué";
            } else {
                echo "Erreur modification";
            }
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
        <div class="ms-3 mt-3">
            <h2>Informations sur le joueur <?php echo $resInfoJoueur['nom']." ".$resInfoJoueur['prenom'] ?> pour le match contre <?php echo $resInfoRencontre['Nom_adversaire'] ?></h2>
        </div>
        <form action="<?php $_SERVER['PHP_SELF']?>" method="post" style="margin-left: 3%">
            <div class="row gy-3 gx-5 align-items-center">
                <div class="col-auto">
                    <label for="numLicence" class="form-label">Numéro de licence</label>
                    <input type="text" name="numLicence" id="numLicence" value="<?php echo $numLicence ?>" class="form-control" readonly required>
                </div>
                <div class="col-auto">
                    <label for="Titulaire" class="form-label">Titulaire ou remplaçant?</label>
                    <select name='Titulaire' id='Titulaire' required class="form-control">
                        <option value="<?php echo $resEditer['Titulaire'] ?>"><?php if($resEditer['Titulaire']){echo "Titulaire";} else {echo "Remplaçant";} ?></option>
                        <option value="1">Titulaire</option>
                        <option value="0">Remplaçant</option>
                    </select>
                </div>
            </div>
            <div class="row gy-3 gx-5 align-items-center">
                <div class="col-auto">
                    <label for="Position" class="form-label">Position</label>
                    <select name='Position' id='Position' class="form-control">
                        <option value="<?php echo $resEditer['Position']?>">Poste actuel : <?php echo $resEditer['Position']?></option>
                        <option value="AT">Attaquant</option>
                        <option value="ML">Milleu</option>
                        <option value="DF">Denfenseur</option>
                        <option value="GB">Gardien</option>
                    </select>
                </div>
                <div class="col-auto">
                    <label for="note" class="form-label">Note</label>
                    <input type="number" name="note" id="note" value="<?php echo $resEditer['Note']?>" min="0" max="10" required class="form-control">
                </div>
            </div>
            <div style="width: 30em;">
                <div class="col-auto">
                    <label for="commentaire" class="form-label">Commentaire</label>
                    <textarea class="form-control" aria-label="With textarea" name="commentaire" id="commentaire" ><?php echo $resEditer['Commentaire']?></textarea>
                </div>
            </div>
            <div class="mt-3">
                <div class="col-auto">
                    <input type="hidden" name="id" value="<?php echo $id_rencontre?>">
                    <button type="submit" class="btn btn-primary">Enregister</button>
                </div>
            </div>
        </form>
        <div class="me-5">
            <form action="detailsRencontre.php" method="post" style="margin-left: 40px;">
                <input type="hidden" name="id" value="<?php echo $id_rencontre ?>">
                <button type="submit" class="btn btn-secondary">Retour a la page précédente</button>
            </form>
        </div>
    </body>
</html>