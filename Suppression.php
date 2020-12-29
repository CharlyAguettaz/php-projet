
<?php

$nom = '';
$prenom = '';

if  (isset($_POST['nom']) && !empty($_POST['nom']) && isset($_POST['prenom']) && !empty($_POST['prenom'])) {  

    $nom = $_POST['nom'];
    $prenom = $_POST['prenom'];

    $db = 'football';
    $login = 'root';

    try  {
        $linkpdo = new PDO("mysql:host=localhost;dbname=$db",$login);
    }
    catch (Exception $e) { 
        die('Erreur : '. $e->getMessage());    
    } 
    
    $req = $linkpdo->prepare("DELETE * FROM joueur WHERE nom = ? AND prenom = ?");
    $req->execute(array(htmlentities($_POST['nom'])));
    $res = $req->fetch();

    if ($res == false) {
        echo "Aucun joueur de ce nom n'existe !";
    } 
        $id = $res['id'];

        } 
      
?>

<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Document sans titre</title>
</head>

<body>
	
	<h1>Suppression de joueur</h1>
		<form action= "<?php $_SERVER['PHP_SELF']?>" method="post">
             <p>nom : <input type="text" name="nom" /></p>
             <p>prenom : <input type="text" name="nom" /></p>
			<p> <input type="submit" value="supprimer" name="supprimer" > 
				<input type="submit" value="reset" name="reset" >
			</p>
		</form>
</body>
</html>