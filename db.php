<?php
// Configuración de la base de datos
$host = 'sql209.infinityfree.com';
$dbname = 'if0_38928526_bd1_restaurante';
$user = 'if0_38928526'; 
$pass = 'Jhojam123';
$charset = 'utf8mb4';

// Mostrar errores para depuración
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// 1. Conexión MySQLi (para mantener compatibilidad con código existente)
try {
    $conexion = new mysqli($host, $user, $pass, $dbname);
    
    // Verificar conexión
    if ($conexion->connect_error) {
        throw new Exception("Error de conexión MySQLi: " . $conexion->connect_error);
    }
    
    // Establecer charset
    $conexion->set_charset($charset);
    
} catch (Exception $e) {
    echo 'Error de conexión: ' . $e->getMessage();
    exit;
}

// 2. Conexión PDO (mantenerla para nuevos scripts que puedan usarla)
try {
    $dsn = "mysql:host=$host;dbname=$dbname;charset=$charset";
    $pdo = new PDO($dsn, $user, $pass);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    echo 'Error de conexión PDO: ' . $e->getMessage();
    exit;
}
?>