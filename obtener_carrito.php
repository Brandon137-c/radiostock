<?php
session_start();
include 'conexion.php';

// Habilitar la visualización de errores
error_reporting(E_ALL);
ini_set('display_errors', 1);

header('Content-Type: application/json');

if (!isset($_SESSION['user_id'])) {
    echo json_encode(['success' => false, 'message' => 'No se encontró el ID de usuario en la sesión.']);
    exit;
}

$id_usuario = $_SESSION['user_id'];

// Modificar la consulta para seleccionar también el Id_carrito
$query = "SELECT c.Id_carrito, p.nombre, p.imagen, c.cantidad 
          FROM cart c 
          JOIN products p ON c.id_producto = p.Id 
          WHERE c.id_usuario = ?";

$stmt = $conn->prepare($query);
$stmt->bind_param("i", $id_usuario);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    $products = [];
    while ($row = $result->fetch_assoc()) {
        $products[] = [
            'Id_carrito' => $row['Id_carrito'], // Agregar el Id_carrito
            'nombre' => $row['nombre'],
            'imagen' => $row['imagen'],
            'cantidad' => $row['cantidad']
        ];
    }
    echo json_encode(['success' => true, 'products' => $products]);
} else {
    echo json_encode(['success' => false, 'message' => 'El carrito está vacío.']);
}

$stmt->close();
$conn->close();
?>
