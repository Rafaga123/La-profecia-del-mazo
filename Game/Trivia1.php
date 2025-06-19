<?php
session_start();

// Preguntas y respuestas
$preguntas = [
    [
        "pregunta" => "¿Qué pesa más, un hechizo de fuego o un dragón volador?",
        "respuestas" => [
            "A" => "El dragón.",
            "B" => "El hechizo.",
            "C" => "Depende si el dragón desayunó.",
        ],
        "respuesta_correcta" => "C"
    ],
    [
        "pregunta" => "¿Cómo saludas a una bruja amigable?",
        "respuestas" => [
            "A" => "“Hola”.",
            "B" => "“¡No me conviertas en sapo!”",
            "C" => "“¿Té o café?”",
        ],
        "respuesta_correcta" => "C"
    ],
    [
        "pregunta" => "¿Cuántos unicornios caben en un castillo mágico?",
        "respuestas" => [
            "A" => "Ninguno, están extintos.",
            "B" => "Todos los que quieras, si usas magia.",
            "C" => "Uno, pero solo si tiene buena actitud.",
        ],
        "respuesta_correcta" => "B"
    ]
];

// Inicializar variables
$mensaje = '';
$intentos = isset($_SESSION['intentos']) ? $_SESSION['intentos'] : 0;
$pregunta_actual = isset($_SESSION['pregunta_actual']) ? $_SESSION['pregunta_actual'] : 0;

// Procesar la respuesta del jugador
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $respuesta_usuario = $_POST['respuesta'];
    $intentos++;

    if ($respuesta_usuario === $preguntas[$pregunta_actual]['respuesta_correcta']) {
        $mensaje = "¡Correcto! Respondiste en $intentos intentos.";
        $intentos = 0; // Reiniciar intentos para la siguiente pregunta
        $pregunta_actual++;

        if ($pregunta_actual >= count($preguntas)) {
            $mensaje = "¡Felicidades! Has completado todas las preguntas.";
            // Reiniciar el progreso de la trivia
            unset($_SESSION['intentos']);
            unset($_SESSION['pregunta_actual']);
            header("Location: agame1.php");
            exit();
        }
    } else {
        $mensaje = "Incorrecto. Inténtalo de nuevo.";
    }

    $_SESSION['intentos'] = $intentos;
    $_SESSION['pregunta_actual'] = $pregunta_actual;
}

// Obtener la pregunta y respuestas actuales
$pregunta = $preguntas[$pregunta_actual]['pregunta'];
$respuestas = $preguntas[$pregunta_actual]['respuestas'];
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>La Profecia del Mazo</title>
    <link rel="shortcut icon" sizes="60x60" href="../images/icon.png">
    <link rel="stylesheet" href="../CSS/estilotrivia.css">
</head>
<body>
    <audio id="base" autoplay loop>
        <source src="../Soundtrack/trivia.mp3" type="audio/mpeg">
    </audio>
    <div class="container">
        <h1>Trivia</h1>
        <p><?php echo $pregunta; ?></p>
        <form method="post">
            <?php foreach ($respuestas as $letra => $respuesta): ?>
                <label>
                    <input type="radio" name="respuesta" value="<?php echo $letra; ?>" required>
                    <?php echo $respuesta; ?>
                </label>
            <?php endforeach; ?>
            <button type="submit">Enviar</button>
        </form>
        <p><?php echo $mensaje; ?></p>
        
    </div>
    <div class="menu"> 
        <a class="nav-link" href="../Menu/Mainmenu.php">Menú Principal</a>       
     </div>
</body>
</html>