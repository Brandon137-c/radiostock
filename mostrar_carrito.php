<?php
session_start();
include 'conexion.php';

if (!isset($_SESSION['user_id'])) {
    echo json_encode(['success' => false, 'message' => 'No se encontró el ID de usuario en la sesión.']);
    exit;
}

$id_usuario = $_SESSION['user_id'];

$query = "SELECT id_producto, cantidad FROM carrito WHERE id_usuario = ?";
$stmt = $conn->prepare($query);
$stmt->bind_param("i", $id_usuario);
$stmt->execute();
$result = $stmt->get_result();

$carrito = [];
while ($row = $result->fetch_assoc()) {
    $carrito[] = $row;
}

echo json_encode(['success' => true, 'carrito' => $carrito]);
$stmt->close();
$conn->close();
?>
