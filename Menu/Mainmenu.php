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

if ($usuario_info['es_admin'] == 1) {
    $stmt->close();
    $conn->close();
    header("Location: MenuAdmin.php");
    exit();
}

// Obtener la página en la cual quedo la ultima sesión del usuario
$sql = "SELECT pagina_actual FROM progreso WHERE usuario = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("s", $usuario);
$stmt->execute();
$stmt->bind_result($pagina_actual);
$stmt->fetch();

if (empty($pagina_actual)) {
    $pagina_actual = 'agame.php'; // Página inicial por defecto
}

$stmt->close();
$conn->close();
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Menú</title>
    <link rel="shortcut icon" sizes="60x60" href="../images/icon.png">
    <link rel="stylesheet" href="../CSS/stylemain.css">
    <link rel="stylesheet" href="../CSS/bootstrap.min.css">
    <link rel="stylesheet" href="../CSS/bulma.min.css">
    <header>
        <a href="usuario.php" class="nav-link"><img src="../Images/cuentaitem.png"></a>
    </header>
</head>

<body>
    <audio id="base" autoplay loop>
        <source src="../Soundtrack/pistamenu.mp3" type="audio/mpeg">
    </audio>
    <div class="container">
        <!-- Menú principal -->

        <main>
            <div class="titulo">
                <h1><img src="../Images/titulo.png"></h1>
            </div>
            <div class="menu">

                <a href="../Game/<?php echo htmlspecialchars($pagina_actual); ?>" class="nws"><img src="../Images/jugar.png"></a>
                <a href="stats.php" class="sts"><img src="../Images/estadísticas.png"></a>
                <a href="cards.html" class="beg"><img src="../images/cartas.png"></a>
            </div>
        </main>

    </div>
    <footer>
        <p>Copyright 2025</p>
        <!-- Menú de pie de página -->
        <a href="Footer/creators.html">Creadores</a>
        <a href="Footer/inform.html">Información</a>
        <a href="Footer/credits.html">Creditos</a>
    </footer>
</body>

</html>