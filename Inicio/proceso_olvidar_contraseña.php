<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'PHPMailer/src/Exception.php';
require 'PHPMailer/src/PHPMailer.php';
require 'PHPMailer/src/SMTP.php';

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "sistema_registro";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

$correo = isset($_POST['correo']) ? $_POST['correo'] : '';

$sql = "SELECT * FROM usuarios WHERE correo = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("s", $correo);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $usuario = $row['usuario'];

    $nueva_contraseña = bin2hex(random_bytes(4)); // Genera una contraseña de 8 caracteres
    $hashed_password = password_hash($nueva_contraseña, PASSWORD_DEFAULT);

    $sql = "UPDATE usuarios SET password = ? WHERE correo = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ss", $hashed_password, $correo);
    $stmt->execute();
    $mail = new PHPMailer(true);

    try {
        $mail->isSMTP();
        $mail->Host = 'smtp.gmail.com';
        $mail->SMTPAuth = true;
        $mail->Username = 'correoderecuperacion869@gmail.com'; 
        $mail->Password = 'nxbq bgjx qgez egck'; 
        $mail->SMTPSecure = 'tls';
        $mail->Port = 587;
        $mail->CharSet = 'UTF-8';

        // Remitente y destinatario
        $mail->setFrom('correoderecuperacion869@gmail.com', 'Recuperación de clave');
        $mail->addAddress($correo);

        // Contenido del correo
        $mail->isHTML(true);
        $mail->Subject = 'Restablecimiento de contraseña';
        $mail->Body    = "Hola $usuario,<br><br>Tu nueva contraseña es: <b>$nueva_contraseña</b><br><br>Por favor, cámbiala después de iniciar sesión.";

        $mail->send();
        session_start();
        $_SESSION['mensaje'] = 'Se ha enviado un correo con tu nueva contraseña.';
        header("Location: ../index.php");
        exit();
    } catch (Exception $e) {
        echo "Error al enviar el correo. Mailer Error: {$mail->ErrorInfo}";
    }
} else {
    echo "Correo no encontrado.";
}

$stmt->close();
$conn->close();
?>