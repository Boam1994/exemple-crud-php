<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-nombre: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
include_once '../../db/connect.php';
include_once '../class/produits.php';

$database = new Database();
$db = $database->getConnection();

$item = new Produits($db);
echo $_GET['id'];
if(isset($_GET['id']) && !empty($_GET['id'])){
    $id = strip_tags($_GET['id']);
    $produit= $_POST['produit'];
    $prix= $_POST['prix'];
    $nombre= $_POST['nombre'];
    $item->id = $id;
    $item->produit = $produit;
    $item->prix = $prix;
    $item->nombre = $nombre;

    if($item->updateProduct()){
        echo "Product update.";
    } else{
        echo "Data could not be updated";
    }
};
?>