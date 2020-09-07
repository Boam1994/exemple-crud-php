<?php
 include_once '../db/connect.php';

$database = new Database();
$db = $database->getConnection();

if(isset($_GET['id']) && !empty($_GET['id'])){
    $id = strip_tags($_GET['id']);
    $sql = "SELECT * FROM `liste` WHERE `id`=:id;";

    $query = $db->prepare($sql);

    $query->bindValue(':id', $id, PDO::PARAM_INT);
    $query->execute();

    $result = $query->fetch();
}

/* require_once('close.php'); */
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Liste des produits</title>

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
</head>
<body>
    <h1>Modifier un produit</h1>
    <form action="server/api/update.php?id=<?= $id?>" method="post">
        <p>
            <label for="produit">Produit</label>
            <input type="text" name="produit" id="produit" value="<?= $result['produit'] ?>">
        </p>
        <p>
            <label for="prix">Prix</label>
            <input type="text" name="prix" id="prix" value="<?= $result['prix'] ?>">
        </p>
        <p>
            <label for="nombre">Nombre</label>
            <input type="number" name="nombre" id="nombre" value="<?= $result['nombre'] ?>">
        </p>
        <p>
            <button>Enregistrer</button>
        </p>
        <input type="hidden" name="id" value="<?= $result['id'] ?>">
    </form>
</body>
</html>