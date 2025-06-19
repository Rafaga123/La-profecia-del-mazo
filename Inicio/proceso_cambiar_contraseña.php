<?php
session_start();
if (!isset($_SESSION['usuario'])) {
    header("Location: ../index.php");
    exit();
}

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "sistema_registro";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

$usuario = $_SESSION['usuario'];
$new_password = isset($_POST['new_password']) ? $_POST['new_password'] : '';

// Define los criterios de validación de la contraseña
$errors = [];
if (strlen($new_password) < 8) {
    $errors[] = "La contraseña debe tener al menos 8 caracteres.";
}
if (!preg_match('/[A-Z]/', $new_password)) {
    $errors[] = "La contraseña debe contener al menos una letra mayúscula.";
}
if (!preg_match('/[a-z]/', $new_password)) {
    $errors[] = "La contraseña debe contener al menos una letra minúscula.";
}
if (!preg_match('/[0-9]/', $new_password)) {
    $errors[] = "La contraseña debe contener al menos un número.";
}
if (!preg_match('/[\W]/', $new_password)) {
    $errors[] = "La contraseña debe contener al menos un carácter especial.";
}

// Si hay errores, muestra el mensaje de error y detén el proceso
if (!empty($errors)) {
    $_SESSION['mensaje'] = implode("<br>", $errors);
    header("Location: cambiar_contra.php");
    exit();
}

$hashed_password = password_hash($new_password, PASSWORD_DEFAULT);

$sql = "UPDATE usuarios SET password = ? WHERE usuario = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("ss", $hashed_password, $usuario);

if ($stmt->execute() === TRUE) {
    $_SESSION['mensaje'] = "Contraseña actualizada exitosamente.";
} else {
    $_SESSION['mensaje'] = "Error al actualizar la contraseña.";
}

$stmt->close();
$conn->close();

header("Location: cambiar_contra.php");
exit();
?>