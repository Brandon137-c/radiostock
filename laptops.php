<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Tu Tienda en Línea</title>
    <link rel="stylesheet" href="estilos11.css">
    <link rel="stylesheet" href="botones5.css">
    <script src="fun83.js" ></script>
    <style>
        .producto {
            display: inline-block;
            margin: 10px;
            text-align: center;
            cursor: pointer;
        }
        .imagen-producto {
            width: 100px;
            height: auto;
            transition: transform 0.3s ease;
        }
        .producto:hover .imagen-producto,
        .producto:active .imagen-producto {
            transform: scale(1.1);
        }

        .btn-detalle {
    background: none; /* Quita el fondo predeterminado */
    border: none; /* Elimina el borde del botón */
    padding: 0; /* Elimina el padding interno del botón */
    cursor: pointer; /* Mantén el cursor de "puntero" para indicar que es clickeable */
    outline: none; /* Quita el borde de enfoque */
}
    </style>
</head>
<body>
    <header>
        <div class="logo">
            <a href="menu.php" class="sindec"><h1>RadioStock</h1></a>
        </div>

        <?php
            session_start();
            include 'conexion.php';
            echo "<script>
            sessionStorage.setItem('user_id', '" . htmlspecialchars($_SESSION['user_id']) . "');
            </script>";

            echo "<h1>" . htmlspecialchars($_SESSION['nombre']) . " (ID: " . htmlspecialchars($_SESSION['user_id']) . ")</h1>";
            if ($_SESSION['nombre'] !== "Brandon Andres") {
            // Solo muestra esto si el usuario no es el administrador
                echo '<button class="btn-detalle" id="show-cart-button"><img height="50px"; src="fotos/cart.png"></button>';
                echo "<div id='cart-container' style='display: none;'></div>";
            }   


            if ($_SESSION['nombre'] == "Brandon Andres") {
                echo '<button class="boton2" onclick="mostrarPopupf()">Subir producto</button>';
            }

            // Código para subir el producto
            

            $sql = "SELECT * FROM products WHERE tipo = 'laptop'";
            $resultado = $conn->query($sql);
            if ($resultado->num_rows > 0) {
                $productos = [];
                while ($row = $resultado->fetch_assoc()) {
                    $productos[] = $row;
                }
            }

        ?>

    </header>

    <div class="productos">
    <?php if (!empty($productos)): ?>
        <h2>Productos</h2>
        <ul>
            <?php foreach ($productos as $producto): ?>
                <li class="producto">
                    <button class="btn-detalle" onclick="mostrarPopup(<?php echo htmlspecialchars(json_encode($producto)); ?>)"><img src="<?php echo htmlspecialchars($producto['imagen']); ?>" alt="<?php echo htmlspecialchars($producto['nombre']); ?>" class="imagen-producto"></button>
                    
                    <p><?php echo htmlspecialchars($producto['nombre']); ?> - $<?php echo htmlspecialchars($producto['precio']); ?></p>
                    
                    
                </li>
            <?php endforeach; ?>
        </ul>
    <?php else: ?>
        <p>No hay productos disponibles.</p>
    <?php endif; ?>
    </div>

    <div id="ventana" class="ventanaE1" style="display: none;">
        <center>
        <p>¡Hola!</p>
        <h1>Subir un producto</h1>
        <form id="form-subir-producto" enctype="multipart/form-data">

            <input type="text" name="nombre" placeholder="Nombre del producto" required><br>
            <input type="number" name="precio" placeholder="Precio del producto" required><br>
            <label for="tipo">Tipo de Producto:</label>
            <select name="tipo" id="tipo" required>
                <option value="celular">Celular</option>
                <option value="computadora">Computadora</option>
                <option value="laptop">Laptop</option>
                <option value="pantalla">Pantalla</option>
                <option value="periferico">Periferico</option>
    </select><br>
    <input type="text" name="marca" placeholder="Marca del producto" required><br>
    <input type="number" name="cantidad" placeholder="Cantidad de unidades" required><br>
    <textarea name="descripcion" required></textarea><br>
    <label for="imagen">Selecciona una imagen:</label>
    <input type="file" name="imagen" accept="image/*" required><br>
    <button type="button" onclick="subirProducto()">Subir Producto</button>
</form>

        <button onclick="cerrarPopup()">Cerrar</button>
        </center>
    </div>

    <div id="actualizar" class="ventanaE1" style="display: none;">
    <center>
    <p>¡Hola!</p>
    <h1>Actualizar producto</h1>
    <form id="form-actualizar-producto" enctype="multipart/form-data">
        <input type="hidden" name="id_producto" id="id_producto"> <!-- Guardamos el ID del producto -->
        <input type="number" name="cantidad" placeholder="Actualizar cantidad" required><br>
        <input type="number" name="precio" placeholder="Actualizar precio" required><br>
        <input type="submit" value="Actualizar producto">
    </form>
    <div id="respuesta"></div> <!-- Aquí mostramos la respuesta del servidor -->
    <button onclick="cerrarPopup1()">Cerrar</button>
    </center>
</div>


    <div id="popupDetalles" class="ventanaE" style="display: none;">
        <center>
        <div class="ventanaE-content"> 
        <div id="contenido-popup"></div>
        <button class="boton2" onclick="cerrarPopup()">Cerrar</button>
        
       <?php
    if ($_SESSION['nombre'] == "Brandon Andres") {
        // Si es el admin, muestra los botones de "Eliminar" y "Actualizar"
        echo '<button class="boton2" onclick="bajarProducto(' . htmlspecialchars($producto['Id']) . ')">Eliminar</button>';
        echo '<button class="boton2" onclick="mostrarActualizar(' . htmlspecialchars($producto['Id']) . ')">Actualizar</button>';
    } else {
        // Si no es el admin, muestra los botones de "Añadir al carrito" y "Comprar"
        echo '<button class="boton2" onclick="anadirAlCarrito(' . htmlspecialchars($producto['Id']) . ', event)">Añadir al carrito</button>';
        echo '<button class="boton2" onclick="comprarProducto(' . htmlspecialchars($producto['Id']) . ', 1)">Comprar</button>';
    }
    ?>



        </div>
        </center>
    </div>


    <div id="cart-display"></div>

    <div class="footer">
        <div class="footer-container">
            <div class="footer-column">
                <div class="footer-title">Conócenos</div>
                <ul>
                    <li><a href="#">Acerca de Radiostock</a></li>
                    <li><a href="#">Carreras</a></li>
                    <li><a href="#">Prensa</a></li>
                </ul>
            </div>
            <div class="footer-column">
                <div class="footer-title">Políticas</div>
                <ul>
                    <li><a href="#">Política de Privacidad</a></li>
                    <li><a href="#">Términos de Uso</a></li>
                    <li><a href="#">Aviso de Cookies</a></li>
                </ul>
            </div>
            <div class="footer-column">
                <div class="footer-title">Redes Sociales</div>
                <ul>
                    <li><a href="#">Facebook</a></li>
                    <li><a href="#">Twitter</a></li>
                    <li><a href="#">Instagram</a></li>
                </ul>
            </div>
            <div class="footer-column">
                <div class="footer-title">Ayuda</div>
                <ul>
                    <li><a href="#">Centro de Ayuda</a></li>
                    <li><a href="#">Contáctanos</a></li>
                    <li><aq href="#">Envíos y Devoluciones</a></li>
                </ul>
            </div>
        </div>
        <div class="footer-bottom">
            <a href="inicio.html">Volver a la página principal</a>
        </div>
        <footer>
            <center><h1>No desperdicies tu dinero, mejor ven a RadioStock!</h1></center>
            <p>&copy; 2024 Tu Tienda en Línea. Todos los derechos reservados.</p>
        </footer>
    </div>


</body>
</html>
