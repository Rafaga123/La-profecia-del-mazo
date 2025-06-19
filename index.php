<!DOCTYPE html>
<html lang="es">
    <head>
        <meta charset="UTF-8">
		<title>La Profecia del Mazo</title>
		<link rel="shortcut icon" sizes="60x60" href="images/icon.png">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="CSS/estilologin.css">
    </head>
<body>
    <!--Inicia el audio de fondo y en repeticion -->
    <audio id="base" autoplay loop>
        <source src="Soundtrack/pistalogin.mp3" type="audio/mpeg">
    </audio>

    <div class="container">
        <h1>Inicio de sesión</h1>
        <?php
        // Mostrar mensajes de error o éxito del inicio de sesion
        session_start();
        if (isset($_SESSION['mensaje'])) {
            echo '<div style="color: yellow; background-color: grey; padding: 10px;">' . $_SESSION['mensaje'] . '</div>';
            unset($_SESSION['mensaje']);
        }
        if (isset($_SESSION['error'])) {
            echo '<div style="color: red; background-color: grey; padding: 10px;">' . $_SESSION['error'] . '</div>';
            unset($_SESSION['error']);
        }
        ?>
        <!-- Formulario de inicio de sesion -->
        <form method="post" action="Inicio/proceso_login.php">
            <div class="Usuario">
                <input type="text" name="usuario" required>
                <label>Usuario</label>
            </div>
            <div class="password">
                <input type="password" name="password" required>
                <label>Contraseña</label>
            </div>
            <input type="submit" value="Iniciar">
            <div class="recordar"><a href="Inicio/olvidocontra_usuario.html">¿Olvidó su contraseña?</a></div>
            <div class="registrarse"><a href="Inicio/registro.html">Registrarme</a></div>
        </form>
    </div>
</body>
</html>