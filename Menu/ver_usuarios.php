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

// Obtener todos los usuarios
$query = "SELECT id, nombre, apellido, correo, usuario FROM usuarios";
$result = $conn->query($query);
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Usuarios</title>
    <link rel="shortcut icon" sizes="60x60" href="../images/icon.png">
    <link rel="stylesheet" href="../CSS/estilomenuadmin.css"> 
</head>
<body>
    
    <!-- Mostrar la lista de usuarios en una tabla -->
    <h1>Lista de Usuarios</h1>
    <div class="admin-menu">
    <table border="1">
        <tr>
            <th>ID</th>
            <th>Nombre</th>
            <th>Apellido</th>
            <th>Correo</th>
            <th>Usuario</th>
        </tr>
        <?php while ($row = $result->fetch_assoc()): ?>
        <tr>
            <td><?php echo htmlspecialchars($row['id']); ?></td>
            <td><?php echo htmlspecialchars($row['nombre']); ?></td>
            <td><?php echo htmlspecialchars($row['apellido']); ?></td>
            <td><?php echo htmlspecialchars($row['correo']); ?></td>
            <td><?php echo htmlspecialchars($row['usuario']); ?></td>
        </tr>
        <?php endwhile; ?>
    </table>
    <button onclick="location.href='Mainmenu.php'">Volver al Menú Principal</button>
    </div>
</body>
</html>
<?php
// Cerrar la conexión
$conn->close();
?>