<?php

session_start();
require_once("./config/conect.php");
require_once("./config/url.php");
require_once("./models/Message.php");

$message = new Message($BASE_URL);

$flassMessage = $message->getMessage();

if (!empty($flassMessage["msg"])) {
    // Limpar a menssagem
    $message->clearMessage();
}

?>

<!DOCTYPE html>
<html lang="pt-br">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <link href="img/logo/logo.png" rel="icon">
    <title>CPC - Controle de Programação</title>
    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css">
    <link href="assets/css/styles.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">

</head>

<body class="bg-gradient-login">
    <!-- Login Content -->
    <div class="container-login">
        <div class="header">
            <h3><i class="fa-solid fa-feather-pointed"></i></i></h3>
            <h5><strong>CONTROLE DE PROGRAMAÇÃO E CARÊNCIA</strong></h5>
        </div>
        <div class="container">
        </div>
        <div class="row form justify-content-center">
            <div class="col-xl-6 col-lg-12 col-md-9">
                <?php if (!empty($flassMessage["msg"])) : ?>
                    <div class="green text-center alert alert-danger alert-dismissible fade show" role="alert">
                        <p class="msg"><?= $flassMessage["msg"] ?></p>
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                <?php endif; ?>
                <div class="card shadow-sm my-5">
                    <div class="card-body p-0">
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="login-form">
                                    <div class="text-center">
                                        <h1 class="h4 text-gray-900 mb-4">Registrar</h1>
                                    </div>
                                    <form action="<?= $BASE_URL ?>config/auth.php" method="post" class="user">
                                        <input type="hidden" name="type" value="register">
                                        <div class="input-group mb-3">
                                            <div class="input-group-prepend">
                                                <span class=" input-group-text" id="basic-addon1"><i class="fa-regular fa-user"></i></span>
                                            </div>
                                            <input type="text" name="name" class="form-control" placeholder="Nome" aria-label="Usuário" aria-describedby="basic-addon1">
                                        </div>
                                        <div class="input-group mb-3">
                                            <div class="input-group-prepend">
                                                <span class=" input-group-text" id="basic-addon1"><i class="fa-regular fa-user"></i></span>
                                            </div>
                                            <input type="text" name="lastname" class="form-control" placeholder="Sobrenome" aria-label="Usuário" aria-describedby="basic-addon1">
                                        </div>
                                        <div class="input-group mb-3">
                                            <div class="input-group-prepend">
                                                <span class=" input-group-text" id="basic-addon1"><i class="fa-solid fa-envelope"></i></span>
                                            </div>
                                            <input type="email" name="email" class="form-control" placeholder="Email" aria-label="Usuário" aria-describedby="basic-addon1">
                                        </div>
                                        <div class="input-group mb-3">
                                            <div class="input-group-prepend">
                                                <span class=" input-group-text" id="basic-addon1"><i class="fa-solid fa-user-lock"></i></span>
                                            </div>
                                            <input type="password" name="password" class="form-control" placeholder="Senha" aria-label="Usuário" aria-describedby="basic-addon1">
                                        </div>
                                        <div class="input-group mb-3">
                                            <div class="input-group-prepend">
                                                <span class=" input-group-text" id="basic-addon1"><i class="fa-solid fa-user-tag"></i></span>
                                            </div>
                                            <input type="cadastro_cpf" name="cadastro_cpf" class="form-control" placeholder="Cadastro / CPF" aria-label="Usuário" aria-describedby="basic-addon1">
                                        </div>
                                        <div>
                                            <button type="submit" class="text-center btn btn-primary btn-block">Registrar</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>
    <!-- Login Content -->
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="vendor/jquery-easing/jquery.easing.min.js"></script>
    <script src="assets/js/scripts.js"></script>
</body>

</html>