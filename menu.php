<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Tu Tienda en Línea</title>
    <link rel="stylesheet" href="estilos11.css">

</head>
<body>
    

    <header><!-- barra de arriba de la pagina en general -->
        <div class="logo">
            <h1>RadioStock</h1>
        </div>

        <form action="buscar.php" method="GET">
            <input type="text" name="query" placeholder="Buscar productos..." required>
            <button type="submit">Buscar</button>
        </form>
        <?php

        session_start();
        echo "<h1>" . $_SESSION['nombre'] . "</h1>";
        ?>
         

        
    </header>

            <ul class="categories">
                <li><a href="celulares.php" style="background-image: url('fotos/celula.png');"></a></li>
                <li><a href="computadoras.php" style="background-image: url('fotos/computadoras.png');"></a></li>
                <li><a href="laptops.php" style="background-image: url('fotos/Laptop.png');"></a></li>
                <li><a href="perifericos.php" style="background-image: url('fotos/Perifericos.png');"></a></li>
                <li><a href="pantallas.php" style="background-image: url('fotos/Pantallas.png');"></a></li>

                <!-- Agrega más categorías si es necesario -->
            </ul>
    <main>
        <!-- Aquí irían los productos, categorías destacadas, ofertas, etc. -->
    </main>

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
                    <li><a href="#">Envíos y Devoluciones</a></li>
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
