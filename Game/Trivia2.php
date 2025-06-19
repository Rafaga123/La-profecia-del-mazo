<?php
session_start();

// Definir las preguntas
$preguntas = [
    [
        "pregunta" => "¿Cuál es el animal más valiente del bosque según los conejos?",
        "respuestas" => [
            "A" => "El ratón.",
            "B" => "El león.",
            "C" => "El gato sin miedo.",
            "D" => "La ardilla ninja.",
        ],
        "respuesta_correcta" => "D"
    ],
    [
        "pregunta" => "¿Qué pesa más: una pluma mágica o una espada maldita?",
        "respuestas" => [
            "A" => "Depende del hechizo.",
            "B" => "La espada.",
            "C" => "La pluma, porque tiene sabiduría.",
            "D" => "Ninguna.",
        ],
        "respuesta_correcta" => "A"
    ],
    [
        "pregunta" => "¿Qué hace un mago cuando pierde su sombrero?",
        "respuestas" => [
            "A" => "Usa un hechizo para encontrarlo.",
            "B" => "Compra uno nuevo en la tienda mágica.",
            "C" => "Le pide a su dragón que lo busque.",
            "D" => "Se convierte en un sombrero.",
        ],
        "respuesta_correcta" => "A"
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
            header("Location: e2.php");
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
    <link rel="stylesheet" href="../CSS/estilotrivia.css">
    <title>La Profecia del Mazo</title>
    <link rel="shortcut icon" sizes="60x60" href="../images/icon.png">
</head>
<body>
    <audio id="base" autoplay loop>
        <source src="../Soundtrack/trivia.mp3" type="audio/mpeg">
    </audio>
    <div class="container">
        <h1>Trivia 2</h1>
        <p><?php echo $pregunta; ?></p>
        <form method="post">
            <?php foreach ($respuestas as $letra => $respuesta): ?>
                <label>
                    <input type="radio" name="respuesta" value="<?php echo $letra; ?>" required>
                    <?php echo "$letra: $respuesta"; ?>
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