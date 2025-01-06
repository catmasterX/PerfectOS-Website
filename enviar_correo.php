<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Obtener y sanitizar los datos del formulario
    $nombre = filter_var(trim($_POST['name']), FILTER_SANITIZE_STRING);
    $email = filter_var(trim($_POST['email']), FILTER_SANITIZE_EMAIL);
    $mensaje = filter_var(trim($_POST['message']), FILTER_SANITIZE_STRING);

    // Validar dirección de correo
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        echo "<script>alert('Por favor, ingresa un correo electrónico válido.');</script>";
        exit;
    }

    // Dirección de correo electrónico donde se recibirán los mensajes
    $to = "pipelon896@hotmail.com";  // Cambia esta dirección por la tuya
    $subject = "PerfectOS Web";

    // Contenido del mensaje
    $body = "Nombre: " . $nombre . "\n" .
            "Correo Electrónico: " . $email . "\n" .
            "Mensaje: " . $mensaje;

    // Cabeceras del correo
    $headers = "From: " . $email . "\r\n";
    $headers .= "Reply-To: " . $email . "\r\n";
    $headers .= "Content-Type: text/plain; charset=UTF-8\r\n";

    // Enviar el correo
    $mail_sent = mail($to, $subject, $body, $headers);

    if ($mail_sent) {
        // Redirigir o mostrar mensaje de éxito
        echo "<script>alert('Gracias por contactarnos! Te responderemos pronto.'); window.location.href = 'index.html';</script>";
    } else {
        // Mostrar mensaje de error
        echo "<script>alert('Hubo un error al enviar el mensaje. Por favor, inténtalo de nuevo.'); window.location.href = 'index.html';</script>";
    }
}
?>