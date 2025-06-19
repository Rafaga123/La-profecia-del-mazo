<?php
session_start();

// Verificar si el usuario está logeado
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

// Obtener la información del usuario desde la base de datos
$usuario = $_SESSION['usuario'];
$query = "SELECT nombre, apellido, correo, password FROM usuarios WHERE usuario = ?";
$stmt = $conn->prepare($query);
$stmt->bind_param("s", $usuario);
$stmt->execute();
$result = $stmt->get_result();
$usuario_info = $result->fetch_assoc();

// Tapar el correo y la clave
$correo_tapado = preg_replace('/(?<=.).(?=.*@)/u', '*', $usuario_info['correo']);
$clave_tapada = str_repeat('*', strlen($usuario_info['password']));

?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Informacón</title>
    <link rel="shortcut icon" sizes="60x60" href="../images/icon.png">
    <link rel="stylesheet" href="../CSS/estilomenuadmin.css">
</head>
<body>
    <style>
        body {
            color: #f3f3f3;
        }
    </style>
    <h1>Información del Usuario</h1>
    <div class="admin-menu">
        <!-- Mostrar la información del usuario en una tabla -->
        <table border="1">
            <tr>
                <th>Nombre</th>
                <td><?php echo htmlspecialchars($usuario_info['nombre']); ?></td>
            </tr>
            <tr>
                <th>Apellido</th>
                <td><?php echo htmlspecialchars($usuario_info['apellido']); ?></td>
            </tr>
            <tr>
                <th>Correo</th>
                <td><?php echo htmlspecialchars($correo_tapado); ?></td>
            </tr>
            <tr>
                <th>Clave</th>
                <td><?php echo htmlspecialchars($clave_tapada); ?></td>
            </tr>
        </table>
    </div>
    <div class="menu"> 
        <a class="nav-link" href="usuario.php">Volver</a>       
     </div>
</body>
</html>
<?php
// Cerrar la conexión
$conn->close();
?>