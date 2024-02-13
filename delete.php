<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Delete</title>
</head>
<body>
<div class="container">
        <h1>Supprimer un client</h1>
        <?php
            require_once 'connexion.php';

            if(isset($_GET["id"])){
                $id = $_GET["id"];
                $delete = "DELETE FROM clients WHERE id = :id";
                $statement = $connexion->prepare($delete);
                $statement->bindParam(':id', $id);
                $statement->execute();
                echo "<p>Le client a été supprimé avec succès.</p>";
            } else {
                echo "<p>Une erreur est survenue. Veuillez réessayer.</p>";
            }
        ?>
    </div>
</body>
</html>