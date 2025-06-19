<?php
session_start();

if (!isset($_SESSION['usuario'])) {
    header("Location: ../index.php");
    exit();
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="../CSS/bootstrap.min.css">
    <link rel="stylesheet" href="../CSS/estilousuario.css">
    <link rel="stylesheet" href="../CSS/bulma.min.css">
    <title>Menú de Opciones</title>
    <link rel="shortcut icon" sizes="60x60" href="../images/icon.png">
</head>
<body>
    <audio id="base" autoplay loop>
        <source src="../Soundtrack/pistamenu.mp3" type="audio/mpeg">
    </audio>
    <div class="navegacion">
        <nav class="nav">
            <a class="nav-link" href="Mainmenu.php">Volver</a>
        </nav>
    </div>

    <!-- Menú de opciones del usuario -->
    <div class="menu">
        <h1>Menú de Opciones</h1>
        <form method="post" style="display:inline;">
            <button type="submit" name="cerrar_sesion" class="cls">Cerrar Sesión</button>
        </form>
        <button onclick="location.href='informacionusuario.php'">Ver información del Perfil</button>
        <button onclick="location.href='../Inicio/cambiar_contra.php'">Cambiar Contraseña</button>
    </div>
    
    <!-- Formulario para cambiar la contraseña -->

    <div id="changePasswordForm" style="display:none;">
        <form method="post" action="../Inicio/proceso_cambiar_contraseña.php">
            <label for="new_password">Nueva Contraseña:</label>
            <input type="password" id="new_password" name="new_password" required>
            <button type="submit">Cambiar Contraseña</button>
        </form>
    </div>
</body>
</html>
<?php
if (isset($_POST['cerrar_sesion'])) {
    session_destroy();
    header("Location: ../index.php");
    exit();
}
?>