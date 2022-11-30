<?php

include_once("layouts/header.php");
require_once("dao/DiaryDAO.php");


$diaryDao = new DiaryDAO($conn, $BASE_URL);

// passa o perfil do usuario como parametro para buscar os dados de determinado perfil
$diarys = $diaryDao->getDiarys($_SESSION['perfil']);

?>
<!-- Conteudo da Pagina-->
<div class="container-fluid" id="container-wrapper">
  <div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800"></h1>
    <ol class="breadcrumb">
      <li class="breadcrumb-item"><a href="<?= $BASE_URL ?>home.php">Home</a></li>
      <li class="breadcrumb-item">Diario</li>
      <li class="breadcrumb-item active" aria-current="page">Consultar</li>
    </ol>
  </div>

  <div class="row">
    <div class="col-lg-12 mb-4">
      <!-- Simple Tables -->
      <div class="card">
        <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
          <h6 class="m-0 font-weight-bold text-primary">Diario Oficial - Controle</h6>
          <a title="Incluir" href="include-diary.php"><button class="btn btn-sm btn-success">Adicionar <i class="fa-solid fa-plus"></i></button></a>
        </div>
        <div class="table-responsive mt-2 p-1 table-sm">
          <table id="myTable" class="table compact nowrap table-hover align-items-center table-flush">
            
            <thead class="thead-light">
              <tr>
                <th class="text-center">Nte</th>
                <th>Municipio</th>
                <th>Unidade</th>
                <th class="text-center">Situação</th>
                <th class="text-center">Cadastro</th>
                <th class="text-center">Nome</th>
                <th class="text-center">Data Diario</th>
                <th class="text-center">Detalhar</th>
              </tr>
            </thead>
            <tbody>
              <?php foreach ($diarys as $diary) : ?>
                <tr class="">
                  <td class="text-center">0<?= $diary->nte ?></td>
                  <td><?= $diary->municipio ?></td>
                  <td class=""><?= $diary->unidade_escolar ?></td>
                  <td class="text-center"><?= $diary->tipo ?></td>
                  <td class="text-center"><?= $diary->cadastro ?></td>
                  <td class="text-center"><?= $diary->nome ?></td>
                  <td class="text-center"><?= date('d/m/Y', strtotime($diary->data_diario )); ?></td>
                  <td class="text-center">
                    <a href="<?= $BASE_URL ?>details-diary.php?id=<?= $diary->id  ?>"><button class="btn btn-sm btn-primary"><i class="fa-solid fa-eye"></i></button></a>
                    <a title="Excluir" id="btn-delete" onclick="abrirModalDiary(<?= $diary->id  ?>)" type="button" class="btn text-white btn-sm btn-danger"><i class="fa-solid fa-trash"></i></a>
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
<!-- Modal -->
<div class="modal fade" id="ExemploModalCentralizado" tabindex="-1" role="dialog" aria-labelledby="TituloModalCentralizado" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header d-flex justify-content-center">
                <h4 class="modal-title text-center text-dark" id="TituloModalCentralizado"><strong>Excluir Dados</strong></h4>
            </div>
            <div class="modal-body">
                <strong>O registro sera excluido permanentemente !</strong>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary" data-dismiss="modal">Fechar</button>
                <a title="Excluir Carência" ><button id="btn-delete" type="button" class="btn float-right btn-danger"><i class="fa-solid fa-trash"></i> Excluir</button></a>
            </div>
        </div>
    </div>
</div>
<!---Container Fluid-->
<?php

include("layouts/footer.php")

?>