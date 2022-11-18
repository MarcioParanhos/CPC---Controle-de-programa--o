<?php

include("./layouts/header.php");
require_once("./dao/UserDAO.php");
require_once("./models/Message.php");

$userDao = new UserDAO($conn, $BASE_URL);
$usuarios = $userDao->getUsers();

?>
<!-- Conteudo da Pagina-->
<div class="container-fluid" id="container-wrapper">
  <?php if (isset($printMsg) && $printMsg != '') : ?>
    <div class="green text-center alert alert-success alert-dismissible fade show" role="alert">
      <h5"><?= $printMsg ?></h5>
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
    </div>
  <?php endif; ?>
  <div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">Usuarios</h1>
    <ol class="breadcrumb">
      <li class="breadcrumb-item"><a href="./">Home</a></li>
      <li class="breadcrumb-item">Usuarios</li>
    </ol>
  </div>
  <!--Row-->
  <div class="row">
    <div class="col-lg-12 mb-4">
      <!-- Tabela Simples -->
      <div class="card">
        <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
          <h6 class="m-0 font-weight-bold text-primary"></h6>
          <button class="btn btn-sm btn-success" data-toggle="modal" data-target="#ExemploModalCentralizado"><i class="fa-solid fa-plus"> </i></button>
          <!-- <a title="Novo Usuario" href="#"><button class=" btn btn-sm btn-success"><i class="fa-solid fa-plus"> </i></button></a> -->
        </div>
        <div class="table-responsive mt-2 p-1 table-sm">
          <table id="myTable" class="table table-hover align-items-center table-flush">
            <thead class="thead-light">
              <tr>
                <th class="text-center">#</th>
                <th class="text-center">Nome</th>
                <th class="text-center">Sobrenome</th>
                <th class="text-center">E-mail</th>
                <th class="text-center">Perfil</th>
                <th class="text-center"></th>
              </tr>
            </thead>
            <tbody>
              <?php foreach ($usuarios as $usuario) : ?>
                <tr class="">
                  <td class="text-center"><?= $usuario["id"] ?></td>
                  <td class="text-center"><?= $usuario["name"] ?></td>
                  <td class="text-center"><?= $usuario["lastname"] ?></td>
                  <td class="text-center"><?= $usuario["email"] ?></td>
                  <td class="text-center"><?= $usuario["perfil"] ?></td>
                  <td class="text-center">
                    <button title="Detalhar" class="btn btn-sm btn-primary" onclick="modalUser(<?= $usuario['id'] ?>)"><i class="fa-solid fa-eye"></i></button>
                    <button title="Detalhar" class="btn btn-sm btn-primary" onclick="modalUser(<?= $usuario['id'] ?>)"><i class="fa-solid fa-edit"></i></button>
                    <a title="Excluir" id="btn-delete" onclick="abrirModalDeleteUser(<?= $usuario['id'] ?>)" type="button" class="btn text-white btn-sm btn-danger"><i class="fa-solid fa-trash"></i></a>
                  </td>
                </tr>
              <?php endforeach; ?>
            </tbody>
          </table>
        </div>
        <div class="card-footer"></div>
      </div>
    </div>
  </div>
  <!--Row-->
</div>
<!-- MODAL CADASTRAR -->
<div class="modal fade " id="ExemploModalCentralizado" tabindex="-1" role="dialog" aria-labelledby="TituloModalCentralizado" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header bg-primary">
        <h4 class="modal-title" id="TituloModalCentralizado"><strong>Novo Usuário</strong></h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Fechar">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form action="<?= $BASE_URL ?>config/auth.php" method="POST">
          <input type="hidden" name="type" value="register">
          <div class="row">
            <div class="col-md-6">
              <label for="name" class="col-form-label">Nome</label>
              <input name="name" type="text" class="form-control" id="name">
            </div>
            <div class="col-md-6">
              <label for="lastname" class="col-form-label">Sobrenome</label>
              <input name="lastname" type="text" class="form-control" id="lastname">
            </div>
          </div>
          <div class="form-group">
            <label for="email" class="col-form-label">Email:</label>
            <input name="email" type="email" class="form-control" id="email">
          </div>
          <div class="row">
            <div class="col-md-4">
              <label for="cadastro_cpf" class="col-form-label">Cadastro ou CPF:</label>
              <input name="cadastro_cpf" type="text" class="form-control" id="cadastro_cpf">
            </div>
            <div class="col-md-4">
              <label for="password" class="col-form-label">Senha:</label>
              <input name="password" type="text" class="form-control" id="password">
            </div>
          </div>
          <div class="mt-4 pt-4 modal-footer">
            <button type="button" class="btn btn-danger" data-dismiss="modal"><i class="fa-solid fa-xmark"></i></button>
            <button type="submit" class="btn btn-primary"><i class="fa-regular fa-floppy-disk"></i></button>
          </div>
        </form>
      </div>

    </div>
  </div>
</div>
<!-- FIM DO MODAL CADASTRAR -->
<!-- MODAL VIZUALIZAR -->
<div class="modal fade " id="ExemploModalCentralizadoUser" tabindex="-1" role="dialog" aria-labelledby="TituloModalCentralizadoUser" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header bg-primary">
        <h4 class="modal-title" id="TituloModalCentralizadoUser"><strong>Detalhes do Usuario</strong></h4>
      </div>
      <div class="modal-body">
        <span id="modal_body"></span>
      </div>
      <div class="mt-4 pt-4 modal-footer">
        <button type="button" class="btn btn-danger" data-dismiss="modal">Fechar</button>
      </div>
    </div>
  </div>
</div>
<!-- FIM DO MODAL EXCLUIR -->
<div class="modal fade" id="ExemploModalCentralizadoDeleteUser" tabindex="-1" role="dialog" aria-labelledby="TituloModalCentralizadoDeleteUser" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header d-flex justify-content-center">
        <h4 class="modal-title text-center text-dark" id="TituloModalCentralizadoDeleteUser"><strong>Excluir Dados</strong></h4>
      </div>
      <div class="modal-body">
        <strong>O registro sera excluido permanentemente !</strong>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-primary" data-dismiss="modal">Fechar</button>
        <a title="Excluir Carência"><button id="btn-delete" type="button" class="btn float-right btn-danger"><i class="fa-solid fa-trash"></i> Excluir</button></a>
      </div>
    </div>
  </div>
</div>
<!---Fim do Conteudo da Pagina-->
<?php

include("layouts/footer.php")

?>