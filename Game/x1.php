<?php
session_start();
if (!isset($_SESSION['usuario'])) {
    header("Location: ../index.php");
    exit();
}

$usuario = $_SESSION['usuario'];
$pagina_actual = basename(__FILE__);
$tiempo_inicio = time(); // Tiempo de inicio de la página

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "sistema_registro";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

// Actualizar progreso
$sql = "UPDATE progreso SET pagina_actual = ? WHERE usuario = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("ss", $pagina_actual, $usuario);
$stmt->execute();
$stmt->close();

// Al salir de la página, actualizar estadísticas
register_shutdown_function(function() use ($conn, $usuario, $tiempo_inicio) {
    // Reiniciar progreso
    $sql_reiniciar = "UPDATE progreso SET pagina_actual = 0 WHERE usuario = ?";
    $stmt_reiniciar = $conn->prepare($sql_reiniciar);
    $stmt_reiniciar->bind_param("s", $usuario);
    $stmt_reiniciar->execute();
    $stmt_reiniciar->close();
    
    // Redirigir al mainmenu
    echo "<script>alert('Final obtenido, La Eternidad Perdida. Redirigiendo al menú principal...'); window.location.href = '../Menu/mainmenu.php';</script>";

    $conn->close();
});
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>La Profecia del Mazo</title>
    <link rel="shortcut icon" sizes="60x60" href="../images/icon.png">
    <link rel="stylesheet" href="../CSS/style.css">
</html>