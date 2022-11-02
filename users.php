<?php

include("layouts/header.php")

?>
<!-- Conteudo da Pagina-->
<div class="container-fluid" id="container-wrapper">
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
                  <button class="btn btn-sm btn-primary" data-toggle="modal" data-target="#ExemploModalCentralizado2"><i class="fa-solid fa-eye"></i></button>
                    <!-- <a href="./show-user.php?id=<?= $usuario["id"] ?>"><button class="btn btn-sm btn-primary"><i class="fa-solid fa-eye"></i></button></a> -->
                    <a href="details-nte.html"><button class="btn btn-sm btn-primary"><i class="fas fa-edit"></i></button></a>
                    <a href="details-nte.html"><button class="btn btn-sm btn-primary"><i class="fa-solid fa-trash"></i></button></a>
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
      <div class="modal-header">
        <h4 class="modal-title" id="TituloModalCentralizado"><strong>Novo Usuário</strong></h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Fechar">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form action="#" method="POST">
          <div class="form-group">
            <label for="full_name" class="col-form-label">Nome Completo:</label>
            <input type="text" class="form-control" id="full_name">
          </div>
          <div class="form-group">
            <label for="email" class="col-form-label">Email:</label>
            <input type="email" class="form-control" id="email">
          </div>
          <div class="row">
            <div class="col-md-6">
              <label for="usuario" class="col-form-label">Usuario:</label>
              <input type="text" class="form-control" id="usuario">
            </div>
            <div class="col-md-2">
              <label for="perfil" class="col-form-label">Perfil:</label>
              <input type="text" class="form-control" id="perfil">
            </div>
            <div class="col-md-4">
              <label for="password" class="col-form-label">Cadastro ou CPF:</label>
              <input type="text" class="form-control" id="perfil">
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
<div class="modal fade " id="ExemploModalCentralizado2" tabindex="-1" role="dialog" aria-labelledby="TituloModalCentralizado2" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title" id="TituloModalCentralizado"><strong>Detalhes do Usuario</strong></h4>
      </div>
      <div class="modal-body">
        <form action="#" method="POST">
          <div class="form-group">
            <label for="full_name" class="col-form-label">Nome completo:</label>
            <p><strong><?= $usuario["name"] ?> <?= $usuario["lastname"] ?></strong></p>
          </div>
          <div class="form-group">
            <label for="email" class="col-form-label">Email:</label>
            <p><strong><?= $usuario["email"] ?></strong></p>
          </div>
          <div class="row">
            <div class="col-md-2">
              <label for="perfil" class="col-form-label">Perfil:</label>
            <p><strong><?= $usuario["perfil"] ?></strong></p>
            </div>
            <div class="col-md-4">
              <label for="password" class="col-form-label">Cadastro ou CPF:</label>
              <p><strong><?= $usuario["cadastro_cpf"] ?></strong></p>
            </div>
          </div>
          <div class="mt-4 pt-4 modal-footer">
            <button type="button" class="btn btn-danger" data-dismiss="modal">Fechar</button>
          </div>
        </form>
      </div>

    </div>
  </div>
</div>
<!-- FIM DO MODAL VIZUALIZAR -->
<!---Fim do Conteudo da Pagina-->
<?php

include("layouts/footer.php")

?>