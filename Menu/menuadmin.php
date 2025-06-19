<?php
session_start();

if (!isset($_SESSION['usuario'])) {
    header("Location: ../index.php");
    exit();
}

// Conectar a la base de datos
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "sistema_registro";

$conn = new mysqli($servername, $username, $password, $dbname);

// Verificar conexión
if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

// Verificar si el usuario es administrador
$usuario = $_SESSION['usuario'];
$query = "SELECT es_admin FROM usuarios WHERE usuario = ?";
$stmt = $conn->prepare($query);
$stmt->bind_param("s", $usuario);
$stmt->execute();
$result = $stmt->get_result();
$usuario_info = $result->fetch_assoc();

if ($usuario_info['es_admin'] != 1) {
    header("Location: Mainmenu.php");
    exit();
}

?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Menú</title>
    <link rel="shortcut icon" sizes="60x60" href="../images/icon.png">
    <link rel="stylesheet" href="../CSS/estilomenuadmin.css">
</head>
<body>
    <!-- Mostrar el menú de administrador -->

    <h1>Bienvenido, Administrador <?php echo htmlspecialchars($usuario); ?></h1>
    <div class="admin-menu">
        <h2>Menú de Administrador</h2>
        <button onclick="location.href='ver_usuarios.php'">Ver Usuarios</button>
        <button onclick="location.href='eliminar_usuarios.php'">Eliminar Usuarios</button>
        <form method="post" style="display:inline;">
            <button type="submit" name="cerrar_sesion">Cerrar Sesión</button>
        </form>
    </div>

</body>
</html>
<?php

// Cerrar la sesión
if (isset($_POST['cerrar_sesion'])) {
    session_destroy();
    header("Location: ../index.php");
    exit();
}

// Cerrar la conexión
$conn->close();
?>