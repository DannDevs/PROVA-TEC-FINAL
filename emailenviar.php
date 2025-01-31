<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'vendor/autoload.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nome = $_POST["nome"];
    $telefone = $_POST["telefone"];
    $email = $_POST["email"];
    $mensagem = $_POST["mensagem"];

    // VALIDAÇAO NOME

    if (!preg_match("/^[a-zA-ZÀ-ÿ\s]{3,}$/", $nome)) {
        die("Nome inválido!");
    }

     //VALIDAÇAO TELEFONE 
     if (!preg_match("/^[0-9]{10,}$/", $telefone)) {
        die("Telefone inválido!");
    }

    // VALIDAÇAO EMAIL

    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        die("E-mail inválido!");
    }
    

    $mail = new PHPMailer(true);

    try {
        // Configuração do servidor SMTP
        $mail->isSMTP();
        $mail->Host = 'smtp.gmail.com'; // Servidor SMTP
        $mail->SMTPAuth = true;
        $mail->Username = 'dannvendas0@gmail.com'; // E-mail que enviará
        $mail->Password = 'oxvj auri yhxd jovo'; // Senha do e-mail
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
        $mail->Port = 587; 

        // Remetente e destinatário
        $mail->setFrom('dannvendas0@gmail.com', 'DanielTest'); // aqui o email que ira enviar
        $mail->addAddress('kentplaysgg@gmail.com', 'Admin'); // coloque aqui o email que ira receber

        // Conteúdo do e-mail
        $mail->isHTML(true);
        $mail->Subject = 'Nova Mensagem'; //
        $mail->Body    = "<strong>Nome:</strong> $nome <br>
                          <strong>Telefone:</strong> $telefone <br>
                          <strong>Email:</strong> $email <br>
                          <strong>Mensagem:</strong> <br> $mensagem"; // corpo do email 

        $mail->send();
        echo "Mensagem enviada ao email $email !";
    } catch (Exception $e) {
        echo "Erro ao enviar mensagem: {$mail->ErrorInfo}";
    }
}
?>