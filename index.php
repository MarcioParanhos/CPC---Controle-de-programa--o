<?php
session_start();
require_once("./config/conect.php");
require_once("./config/url.php");
require_once("./models/Message.php");

$message = new Message($BASE_URL);

$flassMessage = $message->getMessage();

if (!empty($flassMessage["mensagem"])) {
    // Limpar a menssagem
    $message->clearMessage();
}

?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CPC - Controle de programação e carencia</title>
    <link rel="stylesheet" href="assets/css/login.css">
</head>

<body>
    <div class="container">
        <div class="message-login">
            <?php if (!empty($flassMessage["mensagem"])) : ?>
                <div class="green text-center alert <?= $flassMessage["type"] ?> alert-dismissible fade show" role="alert">
                    <p class="msg"><?= $flassMessage["mensagem"] ?></p>
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            <?php endif; ?>
        </div>
        <div class="login-content">
            <section class="logo-img">
                <img src="assets/img/Logo Sistema CPC.gif" alt="">
            </section>
            <section class="form-container">
                <h1>Login</h1>
                <form action="<?= $BASE_URL ?>config/auth.php" method="post" class="form">
                    <input type="hidden" name="type" value="login">
                    <div class="form-inputs">
                        <div class="form-control">
                            <!-- <label class="label-email" for="">E-mail</label> -->
                            <input name="email" type="text" required>
                            <span>E-mail</span>
                        </div>
                        <div class="form-control">
                            <!-- <label class="label-password" for="">Senha</label> -->
                            <input name="password" type="password" required>
                            <span>Senha</span>
                        </div>
                    </div>
                    <div class="btn-login">
                        <input class="login-btn" type="submit" value="Acessar">
                        <p class="register">Ainda não possui conta? <a href="register.php">Cadastre-se aqui !</a></p>
                    </div>
                </form>
            </section>
        </div>
    </div>
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="vendor/jquery-easing/jquery.easing.min.js"></script>
    <script src="assets/js/scripts.js"></script>
</body>

</html>