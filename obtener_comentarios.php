<?php
header('Content-Type: application/json');
include 'conexion.php';

if (isset($_GET['id_producto'])) {
    $id_producto = (int) $_GET['id_producto'];

    // Consulta para obtener los comentarios y el nombre del usuario, ahora usando "fecha"
    $sql = "SELECT c.comentario, u.name AS nombre_usuario FROM coments c
            JOIN users u ON c.id_usuario = u.Id
            WHERE c.id_producto = ?
            ORDER BY c.fecha DESC"; // Cambiado "fecha_comentario" por "fecha"

    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $id_producto);
    $stmt->execute();
    $result = $stmt->get_result();

    $comentarios = [];
    while ($row = $result->fetch_assoc()) {
        $comentarios[] = $row;
    }

    // Devolver los comentarios como JSON
    echo json_encode($comentarios);
} else {
    echo json_encode(['error' => 'No se especificó el producto']);
}

$stmt->close();
$conn->close();
?>
