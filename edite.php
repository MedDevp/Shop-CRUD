<?php
require_once "connexion.php"; 

$erreurmsg = $successmsg = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id = $_POST["id"];
    $nom = $_POST["nom"];
    $email = $_POST["email"];
    $phone = $_POST["phone"];
    $address = $_POST["address"];

    if (empty($nom) || empty($email) || empty($phone) || empty($address)) {
        $erreurmsg = "Erreur : Tous les champs sont obligatoires !!";
    } else {
        try {
            $update_sql = "UPDATE clients SET nom = :nom, email = :email, phone = :phone, address = :address WHERE id = :id";
            $stmt = $connexion->prepare($update_sql);
            $stmt->bindParam(':nom', $nom);
            $stmt->bindParam(':email', $email);
            $stmt->bindParam(':phone', $phone);
            $stmt->bindParam(':address', $address);
            $stmt->bindParam(':id', $id);
            $stmt->execute();

            $successmsg = "Les informations du client ont été mises à jour avec succès.";
        } catch (PDOException $e) {
            $erreurmsg = "Erreur lors de la mise à jour dans la base de données : " . $e->getMessage();
        }
    }
}

// Récupérer les données du client à partir de la base de données en fonction de l'ID fourni dans l'URL
if(isset($_GET["id"])){
    $id = $_GET["id"];
    $select_sql = "select * from clients where id=:id";
    $statement = $connexion->prepare($select_sql);
    $statement->bindParam(':id', $id);
    $statement->execute();
    $client = $statement->fetch(PDO::FETCH_ASSOC);
}

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Client</title>
    <link rel="stylesheet" href="style.css">
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body>
<body class="bg-gray-100">
    <div class="w-4/5 mx-auto mt-16 bg-white p-8 rounded-lg shadow-md">
        <h2 class="text-2xl mb-4">Edit Client</h2>
            <?php 
                if(!empty($erreurmsg)) {
                    echo '<div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative" role="alert">
                    <span class="block sm:inline"> ' . $erreurmsg . '</span>
                    </div>';
                } elseif (!empty($successmsg)) {
                    echo '<div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative" role="alert">
                    <span class="block sm:inline"> ' . $successmsg . '</span>
                    </div>';
                }
            ?>
        <form method="POST">
            <input type="hidden" name="id" value="<?php echo $client['id']; ?>">
            <div class="my-4">
                <label for="nom" class="block text-gray-700">Name:</label>
                <input type="text" id="nom" name="nom" class="border border-gray-400 rounded px-4 py-2 w-full" value="<?php echo $client['nom']; ?>">
            </div>
            <div class="my-4">
                <label for="email" class="block text-gray-700">Email:</label>
                <input type="email" id="email" name="email" class="border border-gray-400 rounded px-4 py-2 w-full" value="<?php echo $client['email']; ?>">
            </div>
            <div class="my-4">
                <label for="phone" class="block text-gray-700">Phone:</label>
                <input type="text" id="phone" name="phone" class="border border-gray-400 rounded px-4 py-2 w-full" value="<?php echo $client['phone']; ?>">
            </div>
            <div class="my-4">
                <label for="address" class="block text-gray-700">Address:</label>
                <textarea id="address" name="address" class="border border-gray-400 rounded px-4 py-2 w-full"><?php echo $client['address']; ?></textarea>
            </div>
            
            <button type="submit" class="bg-blue-500 px-4 py-2 text-white rounded">Save Changes</button>
        </form>
    </div>
</body>
</html>
