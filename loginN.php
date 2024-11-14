<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" href="estilos11.css">
    <link rel="stylesheet" type="text/css" href="login.css">
    <title>Inicio de sesión</title>
</head>
<body>
   

    <div class="login-container">
    <form method="post" action="loginN.php">
        <h1>Sistema de Inicio de Sesión</h1>
        <div class="input-group">
            <input type="text" name="name" placeholder="Nombre" required>
        </div>
        <div class="input-group">
            <input type="password" name="key" placeholder="Contraseña" required>
        </div>
        <div class="submit-group">
            <input type="submit" value="Iniciar sesión">
        </div>
        <div class="image-container">
            <img src="fotos/[ra].png" height="200px">
        </div>
        <p>¿No cuentas con una cuenta? <a href="crear.php">Crear cuenta</a></p>
    </form>
</div>


    <?php 
    session_start(); // Iniciar la sesión al principio
    include 'conexion.php';

    if ($_SERVER['REQUEST_METHOD'] == "POST") {
        if (!empty($_POST['name']) && !empty($_POST['key'])) {
            $user = htmlspecialchars($_POST['name']);
            $key = htmlspecialchars($_POST['key']);

            // Verificar si el usuario existe
            $sql = "SELECT * FROM users WHERE name = ?";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("s", $user);
            $stmt->execute();
            $result = $stmt->get_result();

            if ($result->num_rows > 0) {
                $row = $result->fetch_assoc();
                // Comprobar si la contraseña coincide        
                if ($row['password'] === $key) {
                    echo "Inicio de sesión exitoso. ¡Bienvenido, $user!";
                    $_SESSION['nombre'] = $user;
                    $_SESSION['user_id'] = $row['Id']; // Guardar ID del usuario como user_id
                    header("Location: menu.php"); // Redirige a la página principal
                    exit();
                } else {
                    echo "Contraseña incorrecta.";
                }
            } else {
                echo "El nombre de usuario no existe.";
            }

            $stmt->close();
        }
    } 
    ?>
</body>
</html>
