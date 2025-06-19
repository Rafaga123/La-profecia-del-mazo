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


?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>La Profecia del Mazo</title>
    <link rel="shortcut icon" sizes="60x60" href="../images/icon.png">
    <link rel="stylesheet" href="../CSS/style.css">
</head>
<body>
    <audio id="base" autoplay loop>
        <source src="../Soundtrack/Background Music.mp3" type="audio/mpeg">
    </audio>
    <div class="container"><style>.container{background-color: black;}</style>
        <div class="game-area"> 
            <img src="../Images/scenes/oscuridad2.jpg" alt="Imagen del juego" class="game-image">
        </div>
        <div id="text-box">
            <p class="text" id="story-text"></p>
        </div>
        <button id="next-button">Next</button>

    </div>
    <div class="menu"> 
        <a class="nav-link" href="../Menu/Mainmenu.php">Menú principal</a>       
     </div>
    <script src="../Scripts/g1.js"></script>
</body>
</html>