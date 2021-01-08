<?php
    session_start();
    if ($_SESSION['user'] != 'root') {
        header("location:index.php");
    }
    if (!empty($_POST['nom']) && !empty($_POST['prenom']) && !empty($_POST['dateDeNaissance']) && !empty($_POST['poids']) && !empty($_POST['taille']) && !empty($_POST['numLicence'])) {
        $numLicence = htmlentities($_POST['numLicence']);
        $nom = htmlentities($_POST['nom']);
        $prenom = htmlentities($_POST['prenom']); 
        $dateDeNaissance = htmlentities($_POST['dateDeNaissance']);
        $poids = htmlentities($_POST['poids']);
        $taille = htmlentities($_POST['taille']);
        $statut = htmlentities($_POST['statut']);

        $db = 'football';
        $login = 'root';
        $mdp = '';
        try {
            $linkpdo = new PDO("mysql:host=localhost;dname=$db",$login,$mdp);
        }
        catch (Exception $e) {
             die('Error :' . $e->getMessage());
        }
        if (!empty($_FILES['photo'])) {
            $req2 = $linkpdo->prepare("SELECT * FROM football.players WHERE numLicence = ?");
            $req2->execute(array($numLicence));
            $res2 = $req2->fetch();
            if ($req2 != false){
                $filename= $res2['photo'];
                unlink("photos-m3104/".$filename);
            }
            $filename=$_FILES['photo']['name'];
            $fileExt = "." . strtolower(substr(strchr($filename, "."), 1));
            $uniqueName = md5(uniqid(rand(), true));
            $newFileName = $uniqueName . $fileExt;
            move_uploaded_file($_FILES["photo"]["tmp_name"], "photos-m3104/" . $newFileName);
            $req = $linkpdo->prepare("UPDATE football.players SET nom = :nom, prenom = :prenom, photo = :photo, dateDeNaissance = :dateDeNaissance, taille = :taille, poids = :poids, statut = :statut WHERE numLicence = :numLicence");
            $req->execute(array('nom' => $nom, 'prenom' => $prenom, 'photo' => $newFileName, 'dateDeNaissance' => $dateDeNaissance,  'taille' => $taille, 'poids' => $poids, 'statut' => $statut, 'numLicence' => $numLicence));
            header("location:recherche.php");
        } else {
            $req = $linkpdo->prepare("UPDATE football.players SET nom = :nom, prenom = :prenom, dateDeNaissance = :dateDeNaissance, taille = :taille, poids = :poids, postePrefere = :postePrefere, statut = :statut WHERE numLicence = :numLicence");
            $req->execute(array('nom' => $nom, 'prenom' => $prenom, 'dateDeNaissance' => $dateDeNaissance,  'taille' => $taille, 'poids' => $poids, 'postePrefere' => $postePrefere, 'statut' => $statut, 'numLicence' => $numLicence));
            header("location:recherche.php");
        }
    } 
?>