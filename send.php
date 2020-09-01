<?php
require 'PHPMailer/PHPMailerAutoload.php';
require 'PHPMailer/class.smtp.php';

$mail = new PHPMailer(true);
$to = "mines1974@gmail.com"; // Nuestro correo de contacto


// tomar los datos del form
$nombre = isset($_POST['name']) ? $_POST['name']  : "" ;
$email = isset($_POST['email']) ? $_POST['email'] : "";
$mensaje = isset($_POST['mensaje']) ? nl2br($_POST['mensaje']) : "";

// /*/verify captcha*/
// $recaptcha_secret = "6Lfz4w4UAAAAAJblidt1sta2KB-wh07vNPmMmTVv";
// $captchaResponse = isset($_POST['g-recaptcha-response']) ? $_POST['g-recaptcha-response'] : false;

// if($captchaResponse){

//     $response = file_get_contents("https://www.google.com/recaptcha/api/siteverify?secret=".$recaptcha_secret."&response=".$_POST['g-recaptcha-response']);
//     $response = json_decode($response, true);
// }

// if(isset($response) && $response["success"] === true) {
//     // A - VERIFY CAPTCHA OK >> MANDAMOS MAIL
    // VALIDAMOS CAMPOS
    if($nombre == "" || $email == "" || $mensaje == ""):
        echo '<div class="alert alert-danger" style="margin-top:10px;"><strong>Atención!</strong> Todos los campos son requeridos.</div>';
    else:
        try{
            $mail->SMTPDebug = 0;
            $mail->isSMTP();
            $mail->Host = 'exmail3.exo.com.ar';
            $mail->SMTPAuth = false;
            $mail->SMTPSecure = "";
            $mail->From = $email;
            $mail->addAddress($to);
            $mail->Subject = 'Contacto desde el microsite LEDAR de EXO';
            $mail->isHtml(true);
            $mail->Body = '<strong>'.$nombre.'</strong> envía el siguiente mensaje: <br><p>'.$mensaje.'</p>';
            $mail->CharSet = 'UTF-8';
        // ENVIAMOS MAIL
            $mail->send();
            echo '<div class="alert alert-success" style="margin-top:10px;"><strong>OK!</strong> El mensaje fue enviado, le responderemos a la brevedad.</div>';

        }catch (phpmailerException $e){
            'Custom message';
             echo $e->errorMessage();
        }
        catch(Exception $e){
            // MOSTRAMOS MENSAJE DE EXITO O ERROR DE LA FUNCION MAIL del SERVER
            echo 'El mensaje no pudo ser enviado.';
            error_log($e->getMessage());
        }
    endif;
} else {
    // B - CAPTCHA WRONG, posible BOT >> NO HACEMOS NADA Y NO ENVIAMOS MAIL
     echo '<div class="alert alert-danger" style="margin-top:10px;"><strong>Atención!</strong> Tilda el casillero "I`m not a robot" y completa todos los campos</div>';
}

