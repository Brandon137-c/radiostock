<?php
include 'conexion.php';

$tipo_producto = 'celular'; // Ejemplo, puedes hacer dinámico el tipo de producto que se muestra
$query = "SELECT p.Id, p.nombre, p.precio, p.descripcion, p.imagen, p.marca 
          FROM products p 
          WHERE p.tipo = ?
          ORDER BY p.marca"; // Ordena los productos por marca

$stmt = $conn->prepare($query);
$stmt->bind_param("s", $tipo_producto);
$stmt->execute();
$result = $stmt->get_result();

$productosPorMarca = [];
while ($row = $result->fetch_assoc()) {
    $productosPorMarca[$row['marca']][] = $row;
}

echo json_encode([
    'success' => true,
    'productos' => $productosPorMarca
]);
?>