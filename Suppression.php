<?php
    if  (isset($_POST['id']) && !empty($_POST['id'])) {  

        $id = htmlentities($_POST['id']);
        $db = 'football';
        $login = 'root';
        $mdp = '';

        try  {
            $linkpdo = new PDO("mysql:host=localhost;dbname=$db",$login,$mdp);
        }
        catch (Exception $e) { 
            die('Erreur : '. $e->getMessage());    
        } 
        $req2 = $linkpdo->prepare("SELECT * FROM football.players WHERE numLicence = ?");
        $req2->execute(array($id));
        $res2 = $req2->fetch();
        
        if ($req2 != false){
            $filename= $res2['photo'];
            unlink("photos-m3104/".$filename);
        }
        $req = $linkpdo->prepare("DELETE FROM football.players WHERE numLicence = ?");
        $req->execute(array($id));
        $res = $req->fetch();

        if ($req == false) {
            echo "Erreur lors de la suppression";
        } else {
            echo "Joueurs supprimé avec succés";
        }

        header("location:".  $_SERVER['HTTP_REFERER']); 
    }  
      
?>
