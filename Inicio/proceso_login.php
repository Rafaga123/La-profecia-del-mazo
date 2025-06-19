<?php
session_start();
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "sistema_registro";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

$usuario = isset($_POST['usuario']) ? $_POST['usuario'] : '';
$password = isset($_POST['password']) ? $_POST['password'] : '';

$query = "SELECT * FROM usuarios WHERE usuario = ?";
$stmt = $conn->prepare($query);
$stmt->bind_param("s", $usuario);
$stmt->execute();
$result = $stmt->get_result();
$usuario_info = $result->fetch_assoc();

if ($usuario_info && password_verify($password, $usuario_info['password'])) {
    $_SESSION['usuario'] = $usuario_info['usuario'];
    if ($usuario_info['es_admin'] == 1) {
        header("Location: ../Menu/MenuAdmin.php");
    } else {
        header("Location: ../Menu/Mainmenu.php");
    }
    exit();
} else {
    $_SESSION['error'] = "Usuario o contraseña incorrectos.";
    header("Location: ../index.php");
    exit();
}

$conn->close();
?>
