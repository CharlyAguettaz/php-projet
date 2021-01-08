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
        
        $req = $linkpdo->prepare("DELETE FROM football.rencontre WHERE Id_rencontre = ?");
        $req->execute(array($id));
        $req2 = $linkpdo->prepare("DELETE FROM football.participant WHERE Id_rencontre = ?")
        $req2->execute(array($id));

        if ($req == false && $req2 == false) {
            echo "Erreur lors de la suppression";
        } else {
            echo "Rencontre supprimé avec succés";
        }

        header("location:".  $_SERVER['HTTP_REFERER']); 
    }  
      
?>
