<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Shop</title>
    <link rel="stylesheet" href="style.css">
    <script src="https://cdn.tailwindcss.com"></script>
    
</head>
<body>
    <div class="w-4/5 mx-auto mt-32">
        <h2>List of Clients : </h2><br>
        <a href="/create.php" class="bg-blue-500 px-4 py-2 text-white my-12">New Client</a>
        <br><br>
        <table class="w-full text-center">
            <thead class="bg-gray-300">
                <tr>
                    <th>ID</th>
                    <th>Nom</th>
                    <th>E-mail</th>
                    <th>Phone</th>
                    <th>Address</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                
                <?php
                    require_once "connexion.php";

                    try{

                        $affiche = "select * from clients"; 
                        $result = $connexion->query($affiche);
                        $count = 0;
                        while($row = $result->fetch(PDO::FETCH_ASSOC)){
                            $count++; // Incrémente le compteur à chaque itération
                            $class = ($count % 2 == 0) ? 'bg-gray-100' : 'bg-white';
                            
                            echo "
                                    <tr class='  py-12 $class'>
                                        <td>$row[id]</td>
                                        <td>$row[nom]</td>
                                        <td>$row[email]</td>
                                        <td>$row[phone]</td>
                                        <td>$row[address]</td>
                                        <td>
                                            <a href='/edite.php?id=$row[id]' class='bg-green-400 px-4 text-white'>Edit</a>
                                            <a href='/delete.php?id=$row[id]' class='bg-red-400 px-4 text-white '>Delete</a>
                                        </td>
                                    </tr>
                                ";
                        }

                    }catch(PDOException $e){
                        echo "Erreur de connexion : " . $e->getMessage();
                    }
                ?>
                
            </tbody>
        </table>
    </div>
</body>
</html>