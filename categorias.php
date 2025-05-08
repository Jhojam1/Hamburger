<?php
header("Access-Control-Allow-Origin: https://hamburger3d.netlify.app");
header("Access-Control-Allow-Methods: GET, POST, OPTIONS");
header("Access-Control-Allow-Headers: Content-Type");

include 'db.php';

if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    $query = "SELECT NOMBRE_CATEGORIA FROM categorias_prod";
    $result = $conexion->query($query);
    
    $categorias = [];
    while ($row = $result->fetch_assoc()) {
        $categorias[] = $row;
    }
    
    echo json_encode($categorias);
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $data = json_decode(file_get_contents('php://input'), true);
    $nombre = $conexion->real_escape_string($data['NOMBRE_CATEGORIA']);
    
    $query = "INSERT INTO categorias_prod (NOMBRE_CATEGORIA) VALUES ('$nombre')";
    
    if ($conexion->query($query)) {
        echo json_encode(["success" => true]);
    } else {
        echo json_encode(["success" => false, "error" => $conexion->error]);
    }
    exit;
}
?>