<html>
    <body>
        hello world
        <form action="<?php $_SERVER['PHP_SELF']?>" method="post">
            Nom : <input type="text" name="nom"><br />
            Prenom : <input type="text" name="prenom"><br />
            Date de naissance : <input type="text" name="dateDeNaissance"><br />
            Poids : <input type="text" name="poids"><br />
            Poste Préféré : <input type="text" name="postePrefere"><br />
            Taille : <input type="text" name="taille"><br />
            photo : <input type="text" name="photo"><br />
            <input type="submit" value="Valider">
        </form>
    </body>
</html>