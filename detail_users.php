<?php

include_once("layouts/header.php");
require_once("dao/UserDAO.php");

$id = $_GET['id'];

$userDao = new UserDAO($conn, $BASE_URL);
$user = $userDao->getUserById($id);

$message = new Message($BASE_URL);
$flassMessage = $message->getMessage();
if (!empty($flassMessage["mensagem"])) {
    // Limpa a menssagem
    $message->clearMessage();
}

?>
<!-- Conteudo da Pagina-->
<div class="container-fluid" id="container-wrapper">
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">EDITAR USUARIO</h1>
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="<?= $BASE_URL ?>home.php">Home</a></li>
            <li class="breadcrumb-item">usuario</li>
            <li class="breadcrumb-item active" aria-current="page">Incluir</li>
        </ol>
    </div>
    <!-- Mensagem do crud vinda do arquivo -->
    <?php if (!empty($flassMessage["mensagem"])) : ?>
        <div class="green text-center alert <?= $flassMessage["type"] ?> alert-dismissible fade show" role="alert">
            <p class="msg"><?= $flassMessage["mensagem"] ?></p>
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    <?php endif; ?>
    <!-- fim da mensagem do crud vinda do arquivo -->
    <!--Row-->
    <div class="row">
        <div class="col-lg-12 mb-4">
            <div class="card">
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                    <h6 class="m-0 font-weight-bold text-primary"></h6>
                    <a title="Voltar" href="users.php"><button class=" btn btn-sm btn-success"><i class="fa-solid fa-rotate-left"></i></button></a>
                </div>
                <div class="content-wrapper">
                    <div class="row">
                        <div class="col-md-12 grid-margin">
                            <div class="row">
                                <div class="col-12 grid-margin stretch-card">
                                    <div class="card">
                                        <div class="card-body">
                                            <form class="forms-sample" action="<?= $BASE_URL ?>config/auth.php" method="post">
                                                <div class="py-3 d-flex flex-row align-items-end justify-content-end">
                                                </div>
                                                <input type="hidden" name="type" value="update">
                                                <input type="hidden" name="id" value="<?= $user['id'] ?>">
                                                <div class="form-row">
                                                    <div class="col-md-2">
                                                        <div class="position-relative form-group">
                                                            <label for="name" class="">Nome</label>
                                                            <input value="<?= $user['name'] ?>" name="name" id="name" type="text" class="form-control form-control-sm">
                                                        </div>
                                                    </div>
                                                    <div class="col-md-2">
                                                        <div class="position-relative form-group">
                                                            <label for="lastname" class="">Sobrenome</label>
                                                            <input value="<?= $user['lastname'] ?>" name="lastname" id="lastname" type="text" class="form-control form-control-sm">
                                                        </div>
                                                    </div>
                                                    <div class="col-md-3">
                                                        <div class="form-group">
                                                            <label for="cadastro_cpf" class="">Cadastro/CPF</label>
                                                            <input value="<?= $user['cadastro_cpf'] ?>" id="cadastro_cpf" name="cadastro_cpf" type="text" class="form-control form-control-sm" aria-label="Amount (to the nearest dollar)">
                                                        </div>
                                                    </div>
                                                    <div class="col-md-1">
                                                        <div class="form-group">
                                                            <label for="perfil" class="">Perfil</label>
                                                            <select name="perfil" id="perfil" class="form-control form-control-sm">
                                                                <option value="<?= $user['perfil'] ?>" selected><?= $user['perfil'] ?></option>
                                                                <option value="0">0</option>
                                                                <option value="1">1</option>
                                                                <option value="2">2</option>
                                                                <option value="3">3</option>
                                                                <option value="4">4</option>
                                                                <option value="5">5</option>
                                                                <option value="6">6</option>
                                                                <option value="7">7</option>
                                                                <option value="8">8</option>
                                                                <option value="9">9</option>
                                                                <option value="10">10</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <div class="form-group">
                                                            <label for="email" class="">E-mail</label>
                                                            <input value="<?= $user['email'] ?>" id="email" name="email" type="text" class="form-control form-control-sm" aria-label="Amount (to the nearest dollar)">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label for="obs">Observação</label>
                                                    <textarea name="obs" class="form-control" id="obs" rows="5"><?= $user['obs'] ?></textarea>
                                                </div>
                                                <a title="Salvar"><button type="submit" class=" btn bg-purple btn-primary  mr-2"><i class="fa-solid fa-arrows-rotate"></i></button></a>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-footer"></div>
            </div>
        </div>
    </div>
    <!--Row-->
</div>
<!---Fim do Conteudo da Pagina-->
<?php

include("layouts/footer.php")

?>