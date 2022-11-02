<?php

require_once("layouts/header.php");
require_once('./crud/read-home.php');
require_once("./config/url.php");
require_once("./models/Message.php");

$message = new Message($BASE_URL);

$flassMessage = $message->getMessage();

if (!empty($flassMessage["mensagem"])) {
    // Limpar a menssagem
    $message->clearMessage();
}

?>
<?php if ($_SESSION['perfil'] != 10) { ?>
    <!-- Container Fluid-->
    <div class="container-fluid" id="container-wrapper">
        <?php if (!empty($flassMessage["mensagem"])) : ?>
            <div class="green text-center alert <?= $flassMessage["type"] ?> alert-dismissible fade show" role="alert">
                <p class="msg"><?= $flassMessage["mensagem"] ?></p>
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        <?php endif; ?>
        <div class="card">
            <div class="centralizar">
                <img class="card-img-top" src="./assets/img/user.png" alt="Imagem de capa do card">
            </div>
            <div class="card-body">
                <h1 class="card-title"><strong><?= $_SESSION['name'] ?> <?= $_SESSION['lastname'] ?></strong></h1>
            </div>
            <ul class="list-group list-group-flush">
                <li class="list-group-item"><strong>E-mail:</strong> <?= $_SESSION['email'] ?></li>
                <li class="list-group-item"><strong>Cadastro/CPF:</strong> <?= $_SESSION['cadastro_cpf'] ?></li>
                <li class="list-group-item"><strong>Perfil:</strong> <?= $_SESSION['perfil'] ?></li>
                <?php if ($_SESSION['perfil'] == 4) { ?>
                    <li class="list-group-item"><strong>Ntes Atendidas:</strong> 1 - 5 - 6 - 7 - 16 - 22</li>
                <?php } ?>
            </ul>
            <div class="card-header">
                <h6 class="m-0 font-weight-bold text-primary">ALTERAR SENHA</h6>
            </div>
            <div class="card-body">
                <form action="<?= $BASE_URL ?>config/auth.php" method="POST">
                    <input type="hidden" name="type" value="update">
                    <input type="hidden" name="email" value="<?= $_SESSION['email'] ?>">
                    <div class="form-row">
                        <div class="col-md-3">
                            <label for="basic-url">Senha Atual</label>
                            <div class="input-group mb-3">
                                <input name="password" type="password" class="form-control" id="basic-url" aria-describedby="basic-addon3">
                            </div>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="col-md-3">
                            <label for="basic-url">Nova Senha</label>
                            <div class="input-group mb-3">
                                <input name="new_password" type="password" class="form-control" id="basic-url" aria-describedby="basic-addon3">
                            </div>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="col-md-3">
                            <label for="basic-url">Confirmar Senha</label>
                            <div class="input-group mb-3">
                                <input name="confirm_password" type="password" class="form-control" id="basic-url" aria-describedby="basic-addon3">
                            </div>
                        </div>
                    </div>
                    <hr>
                    <a title="Alterar"><button type="submit" class="btn bg-purple btn-primary  mr-2"><i class="fa-solid fa-arrows-rotate"></i></button></a>
                </form>
            </div>
            <div class="card-header hide">
                <h6 class="m-0 font-weight-bold text-primary">ALTERAR DADOS</h6>
            </div>
            <div class="card-body hide">
                <form action="#" class="hide">
                    <div class="form-row">
                        <div class="col-md-3">
                            <label for="basic-url">Nome</label>
                            <div class="input-group mb-3">
                                <input type="text" class="form-control" id="basic-url" value="Marcio" aria-describedby="basic-addon3">
                            </div>
                        </div>
                        <div class="col-md-3">
                            <label for="basic-url">Sobrenome</label>
                            <div class="input-group mb-3">
                                <input type="text" class="form-control" id="basic-url" value="Paranhos" aria-describedby="basic-addon3">
                            </div>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="col-md-3">
                            <label for="basic-url">Email</label>
                            <div class="input-group mb-3">
                                <input type="text" class="form-control" id="basic-url" value="marcio.naga@gmail.com" aria-describedby="basic-addon3">
                            </div>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="col-md-3">
                            <label for="basic-url">Cadastro/CPF</label>
                            <div class="input-group mb-3">
                                <input type="text" class="form-control" id="basic-url" value="05825957545" aria-describedby="basic-addon3">
                            </div>
                        </div>
                    </div>
                    <hr>
                    <a title="Alterar"><button type="submit" class="btn bg-purple btn-primary  mr-2"><i class="fa-solid fa-arrows-rotate"></i></button></a>
                </form>
            </div>
        </div>
    </div>
<?php } ?>
<br>
<!---Container Fluid-->

<?php


include("layouts/footer.php")

?>