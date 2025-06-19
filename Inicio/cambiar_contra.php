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
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../CSS/bootstrap.min.css">
    <link rel="stylesheet" href="../CSS/cambiarcontra.css">
    <link rel="stylesheet" href="../CSS/bulma.min.css">
    <title>Cambiar Contraseña</title>
    <link rel="shortcut icon" sizes="60x60" href="../images/icon.png">
</head>
<body>
    <audio id="base" autoplay loop>
        <source src="../Soundtrack/pistalogin.mp3" type="audio/mpeg">
    </audio>
    <div class="container">
        <h1>Cambiar Contraseña</h1>
        <?php
        if (isset($_SESSION['mensaje'])) {
            echo "<div class='alert alert-danger'>" . $_SESSION['mensaje'] . "</div>";
            unset($_SESSION['mensaje']);
        }
        ?>
        <form method="post" action="proceso_cambiar_contraseña.php">
            <div class="form-group">
                <label for="new_password">Nueva Contraseña:</label>
                <input type="password" name="new_password" class="form-control" autocomplete="off" required>
            </div>
            <button type="submit" class="btn btn-primary">Cambiar</button>
        </form>
    </div>
    <div class="menu"> 
        <a class="nav-link" href="../Menu/usuario.php">Volver</a>       
    </div>
</body>
</html>