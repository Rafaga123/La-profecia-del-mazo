<?php
session_start();

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

// Obtener datos del formulario
$nombre = $_POST['nombre'];
$apellido = $_POST['apellido'];
$correo = $_POST['correo'];
$usuario = $_POST['usuario'];
$password = $_POST['password'];
$es_admin = 0; // Por defecto, no es administrador

// Función para validar la contraseña
function validar_contraseña($password) {
    if (strlen($password) < 12) {
        return "La contraseña debe tener al menos 12 caracteres.";
    }
    if (!preg_match('/[A-Z]/', $password)) {
        return "La contraseña debe contener al menos una letra mayúscula.";
    }
    if (!preg_match('/[a-z]/', $password)) {
        return "La contraseña debe contener al menos una letra minúscula.";
    }
    if (!preg_match('/[0-9]/', $password)) {
        return "La contraseña debe contener al menos un número.";
    }
    if (!preg_match('/[\W]/', $password)) {
        return "La contraseña debe contener al menos un símbolo.";
    }
    if (preg_match('/\b(?:password|123456|qwerty|admin|user|nombre|apellido|correo|usuario|drop|delete)\b/i', $password)) {
        return "La contraseña no debe contener palabras comunes o nombres.";
    }
    return true;
}

// Validar la contraseña
$validacion_contraseña = validar_contraseña($password);
if ($validacion_contraseña !== true) {
    $_SESSION['error'] = $validacion_contraseña;
    header("Location: ../index.php");
    exit();
}

// Verificar si el correo o usuario ya están registrados
$sql = "SELECT * FROM usuarios WHERE correo = ? OR usuario = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("ss", $correo, $usuario);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    $_SESSION['error'] = "El correo o usuario ya están registrados.";
    header("Location: ../index.php");
    exit();
} else {
    $hashed_password = password_hash($password, PASSWORD_DEFAULT);

    $sql = "INSERT INTO usuarios (nombre, apellido, correo, usuario, password, es_admin) VALUES (?, ?, ?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sssssi", $nombre, $apellido, $correo, $usuario, $hashed_password, $es_admin);

    if ($stmt->execute() === TRUE) {
        // Insertar progreso inicial
        $sql_progreso = "INSERT INTO progreso (usuario, pagina_actual) VALUES (?, 'agame.php')";
        $stmt_progreso = $conn->prepare($sql_progreso);
        $stmt_progreso->bind_param("s", $usuario);
        $stmt_progreso->execute();

        // Insertar estadísticas iniciales
        $sql_estadisticas = "INSERT INTO estadisticas (usuario, tiempo_total, finales_conseguidos, opciones_usadas, final_mas_rapido, fallas_trivias, tiempo_memorias) VALUES (?, 0, 0, 0, 0, 0, 0)";
        $stmt_estadisticas = $conn->prepare($sql_estadisticas);
        $stmt_estadisticas->bind_param("s", $usuario);
        $stmt_estadisticas->execute();

        $_SESSION['success'] = "Registro exitoso. ¡Bienvenido!";
        header("Location: ../index.php");
        exit();
    } else {
        $_SESSION['error'] = "Error en el registro. Por favor, inténtelo de nuevo.";
        header("Location: ../index.php");
        exit();
    }
}
?>
