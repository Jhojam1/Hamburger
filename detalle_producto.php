<?php
header("Access-Control-Allow-Origin: https://hamburger3d.netlify.app");
header("Access-Control-Allow-Methods: GET, POST, OPTIONS");
header("Access-Control-Allow-Headers: Content-Type");

require_once 'db.php';
header('Content-Type: application/json');

try {
    if (!isset($_GET['nombre'])) {
        throw new Exception("Nombre de producto no proporcionado");
    }

    $nombre = $_GET['nombre'];

    $sql = "SELECT ID_PRODUCTO, NOMBRE_PRODUCTO, DESCRIPCION_PRODUCTO, PRECIO
            FROM productos
            WHERE NOMBRE_PRODUCTO = :nombre
            LIMIT 1";
    
    $stmt = $pdo->prepare($sql);
    $stmt->execute([':nombre' => $nombre]);
    $producto = $stmt->fetch(PDO::FETCH_ASSOC);

    if (!$producto) {
        echo json_encode(null);
    } else {
        echo json_encode($producto);
    }

} catch (Exception $e) {
    http_response_code(500);
    echo json_encode(["error" => $e->getMessage()]);
}
?>