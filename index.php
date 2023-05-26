<?php

require("./vendor/mail.php");

function validate($name, $mail, $subject, $message, $form) {
    return !empty($name) && !empty($mail) && !empty($subject) && !empty($message);

}
$status = "";

if( isset($_POST["form"]) ) {
    if ( validate(...$_POST) ) {
        $name = $_POST["name"];
        $mail = $_POST["mail"];
        $subject = $_POST["subject"];
        $message = $_POST["message"];

        $body = "$name <$mail> te envía el siguiente mensaje: <br><br> $message";

        //mandar el correo
        sendMail($subject, $body, $mail, $name, true);

        $status = "success";
    }
    else {
        $status = "danger";
    }
}

?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Formulario de contacto</title>
    <link rel="stylesheet" href="./styles/styles.css">
</head>
<body>

    <?php if($status == "danger"): ?>
        <div class="alert-danger">
            <span>Surgió un problema</span>
        </div>
    <?php endif; ?>
    <?php if($status == "success"): ?>
        <div class="alert-success">
            <span>Su correo se ha enviado</span>
        </div>
    <?php endif; ?>

    
    <div class="form-container">
            <form action="./index.php" method="POST">
                <h1>Contáctanos</h1>
                <div class="input-group">
                    <label for="name">Nombre</label>
                    <input type="text" name="name" id="name">
                </div>
                <div class="input-group">
                    <label for="mail">Correo</label>
                    <input type="email" name="mail" id="mail">
                </div>
                <div class="input-group">
                    <label for="subject">Asunto</label>
                    <input type="text" name="subject" id="subject">
                </div>
                <div class="texta">
                    <label for="message">Mensaje</label>
                    <textarea name="message" id="message"></textarea>
                </div>
                <div class="btn-container">
                    <button name="form" type="submit">Enviar</button>
                </div>
            </form>
    </div>
</body>
</html>