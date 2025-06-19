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

// Función para eliminar un usuario, su progreso y estadísticas
function eliminar_usuario($conn, $usuario) {
    $conn->begin_transaction();
    try {
        // Eliminar progreso del usuario
        $query = "DELETE FROM progreso WHERE usuario = ?";
        $stmt = $conn->prepare($query);
        $stmt->bind_param("s", $usuario);
        if (!$stmt->execute()) {
            throw new Exception("Error al eliminar el progreso del usuario.");
        }

        // Eliminar usuario
        $query = "DELETE FROM usuarios WHERE usuario = ?";
        $stmt = $conn->prepare($query);
        $stmt->bind_param("s", $usuario);
        if (!$stmt->execute()) {
            throw new Exception("Error al eliminar el usuario.");
        }

        $conn->commit();
        return "Usuario y estadísticas eliminados exitosamente.";
    } catch (Exception $e) {
        $conn->rollback();
        return $e->getMessage();
    }
}
// Obtener todos los usuarios
$query = "SELECT usuario FROM usuarios";
$result = $conn->query($query);
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Eliminar usuario</title>
    <link rel="shortcut icon" sizes="60x60" href="../images/icon.png">
    <link rel="stylesheet" href="../CSS/estilomenuadmin.css">
</head>
<body>
    <!--Menu de limpieza de usuarios-->
    
    <h1>Eliminar Usuarios</h1>
    <div class="admin-menu">
    <?php if (isset($mensaje)): ?>
        <p><?php echo htmlspecialchars($mensaje); ?></p>
    <?php endif; ?>
    <form method="post" action="eliminar_usuarios.php">
        <label for="usuario">Selecciona un usuario para eliminar:</label>
        <select name="usuario" id="usuario">
            <?php while ($row = $result->fetch_assoc()): ?>
                <option value="<?php echo htmlspecialchars($row['usuario']); ?>"><?php echo htmlspecialchars($row['usuario']); ?></option>
            <?php endwhile; ?>
        </select>
        <button type="submit">Eliminar Usuario</button>
    </form>
    <button onclick="location.href='MenuAdmin.php'">Volver al Menú Principal</button>
    </div>
    
</body>
</html>
<?php
// Cerrar la conexión
$conn->close();
?>