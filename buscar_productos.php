<?php
header("Access-Control-Allow-Origin: https://hamburger3d.netlify.app");
header("Access-Control-Allow-Methods: GET, POST, OPTIONS");
header("Access-Control-Allow-Headers: Content-Type");

header('Content-Type: application/json');
include __DIR__ . '/db.php';

$nombre = $_GET['nombre'] ?? '';
$categoria = $_GET['categoria'] ?? '';

$sql = "SELECT p.* FROM productos p
        INNER JOIN categorias_prod c ON p.FK_ID_CATEGORIA = c.ID_CATEGORIA
        WHERE p.NOMBRE_PRODUCTO LIKE :nombre";

$params = [':nombre' => "%$nombre%"];

if (!empty($categoria)) {
    $sql .= " AND c.NOMBRE_CATEGORIA = :categoria";
    $params[':categoria'] = $categoria;
}

$stmt = $pdo->prepare($sql);
$stmt->execute($params);

$productos = $stmt->fetchAll(PDO::FETCH_ASSOC);

echo json_encode($productos);
?>
