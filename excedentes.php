<?php

include("./layouts/header.php");
require_once("./dao/ExcedenteDAO.php");

$usuario = $_SESSION['name'] . " " . $_SESSION['lastname'];

$excedenteDao = new ExcedenteDAO($conn, $BASE_URL);

// passa o perfil do usuario como parametro para buscar os dados de determinado perfil
$excedentes = $excedenteDao->getExcedentes($_SESSION['perfil']);


?>
<!-- Conteudo da Pagina-->
<div class="container-fluid" id="container-wrapper">
  <div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="title_style h3 mb-0 text-gray-800">Relação de Excedentes</h1>
    <ol class="breadcrumb">
      <li class="breadcrumb-item"><a href="./">Home</a></li>
      <li class="breadcrumb-item">Excedentes</li>
    </ol>
    <!-- Mensagem do crud vinda do arquivo -->
    <!-- fim da mensagem do crud vinda do arquivo -->
  </div>
  <?php if (isset($printMsg) && $printMsg != '') : ?>
    <div class="green text-center alert alert-success alert-dismissible fade show" role="alert">
      <h5"><?= $printMsg ?></h5>
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
    </div>
  <?php endif; ?>
  <!--Row-->
  <div class="row">
    <div class="col-lg-12 mb-4">
      <!-- Tabela Simples -->
      <div class="card">
        <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
          <h6 class="m-0 font-weight-bold text-primary"></h6>
          <div>
            <button title="Adicionar" class="btn btn-sm btn-success" data-toggle="modal" data-target="#ExemploModalCentralizado">Adicionar <i class="fa-solid fa-plus"> </i></button>
            <a title="Gerar Excel" href="./relatorios/planilha_excedente.php"><button class="btn-sm btn btn-success">Excel <i class="fa-solid fa-file-export"></i></button></a>
          </div>
          <!-- <a title="Novo Usuario" href="#"><button class=" btn btn-sm btn-success"><i class="fa-solid fa-plus"> </i></button></a> -->
        </div>
        <div class="table-responsive  mt-2 p-1 table-sm">
          <table id="myTable" class="compact nowrap table table-hover align-items-center table-flush">
            <thead class="thead-light">
              <tr>
                <th class="text-center">NTE</th>
                <th class="text-center">MUNICIPIO</th>
                <th class="text-center">UEE</th>
                <th class="text-center">SERVIDOR</th>
                <th class="text-center">CADASTRO</th>
                <th class="text-center">VINCULO</th>
                <th class="text-center">CH</th>
                <th class="text-center">CH. EXCEDENTE</th>
                <th class="text-center">DETALHAR</th>
              </tr>
            </thead>
            <tbody>
              <?php foreach ($excedentes as $excedente) : ?>
                <tr class="">
                  <td class="text-center"><?= $excedente->nte ?></td>
                  <td class="text-center"><?= $excedente->municipio ?></td>
                  <td class="text-center"><?= $excedente->unidade_escolar ?></td>
                  <td class="text-center"><?= $excedente->nome ?></td>
                  <td class="text-center"><?= $excedente->cadastro ?></td>
                  <td class="text-center"><?= $excedente->vinculo ?></td>
                  <td class="text-center"><?= $excedente->ch ?></td>
                  <td class="text-center"><?= $excedente->qtd_horas ?></td>
                  <td class="text-center">
                    <div class="gap">
                      <button title="Detalhar" class="btn btn-sm btn-primary" onclick="modalExcedentes(<?= $excedente->id ?>)"><i class="fa-solid fa-eye"></i></button>
                      <a href="details_excedentes.php?id=<?= $excedente->id ?>"><button title="Editar" class="btn btn-sm btn-warning"><i class="fa-solid fa-pencil"></i></button></a>
                      <button title="Excluir" class="btn btn-sm btn-danger" onclick="abrirModalExcedente(<?= $excedente->id ?>)"><i class="fa-solid fa-trash"></i></button>
                    </div>
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
    <div class="modal-content ">
      <div class="modal-header bg-primary">
        <h4 class="modal-title" id="TituloModalCentralizado"><strong>Novo Registro</strong></h4>
        <button type="button" class="close bg-primary" data-dismiss="modal" aria-label="Fechar">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form class="forms-sample" action="./config/excedentesProcess.php" method="POST">
          <input type="hidden" name="type" value="create" class="form-control form-control-sm" id="usuario">
          <input hidden value="<?= $usuario ?>" name="usuario" type="text">
          <div class="form-row excedentes-row">
            <div class="col-md-2">
              <label for="nte" class="control-label">NTE</label>
              <input type="text" name="nte" class="form-control form-control-sm" id="nte" require>
            </div>
            <div class="col-md-6">
              <label for="municipio" class="control-label">MUNICIPIO</label>
              <input type="text" name="municipio" class="form-control form-control-sm" id="municipio" require>
            </div>
            <div class="col-md-4">
              <label for="cod_unidade" class="control-label">COD. UNIDADE</label>
              <input type="text" name="cod_unidade" class="form-control form-control-sm" id="cod_unidade" require>
            </div>
          </div>
          <div class="form-row excedentes-row">
            <div class="col-md-12">
              <label for="unidade_escolar" class="control-label">UNIDADE ESCOLAR</label>
              <input type="text" name="unidade_escolar" class="form-control form-control-sm" id="unidade_escolar" require>
            </div>
          </div>
          <div class="form-row excedentes-row">
            <div class="col-md-9">
              <label for="nome" class="control-label">SERVIDOR</label>
              <input type="text" name="nome" class="form-control form-control-sm" id="nome" require>
            </div>
            <div class="col-md-3">
              <label for="cadastro" class="control-label">CADASTRO</label>
              <input type="text" name="cadastro" class="form-control form-control-sm" id="cadastro" require>
            </div>
          </div>
          <div class="form-row excedentes-row">
            <div class="position-relative col-md-4">
              <div class="form-group">
                <label class="control-label" for="disciplina_id">VINCULO</label>
                <select name="vinculo" id="vinculo" class="form-control form-control-sm">
                  <option value="" selected>Selecione ...</option>
                  <option value="Estatutário">Estatutário</option>
                  <option value="Reda">Reda</option>
                </select>
              </div>
            </div>
            <div class="position-relative col-md-2">
              <div class="form-group">
                <label class="control-label" for="ch">REGIME</label>
                <select name="ch" id="cg" class="form-control form-control-sm">
                  <option value="" selected>Selecione ...</option>
                  <option value="20">20</option>
                  <option value="40">40</option>
                </select>
              </div>
            </div>
            <div class="position-relative col-md-2">
              <div class="form-group">
                <label class="control-label" for="qtd_horas">CH. EXCEDENTE</label>
                <input value="" name="qtd_horas" id="qtd_horas" type="text" class="form-control form-control-sm">
              </div>
            </div>
            <div class="position-relative col-md-4">
              <div class="form-group">
                <label class="control-label" for="formacao">FORMAÇÃO</label>
                <input value="" name="formacao" id="formacao" type="text" class="form-control form-control-sm">
              </div>
            </div>
          </div>
          <div class="form-row excedentes-row">
            <div class="position-relative col-md-4">
              <div class="form-group">
                <label class="control-label" for="motivo_excedencia">MOTIVO DA EXCEDENCIA</label>
                <input value="" name="motivo_excedencia" id="motivo_excedencia" type="text" class="form-control form-control-sm">
              </div>
            </div>
          </div>
          <div class="mt-4 pt-4 modal-footer">
            <button type="button" class="btn btn-danger" data-dismiss="modal">FECHAR <i class="fa-solid fa-xmark"></i></button>
            <button type="submit" class="btn btn-primary">SALVAR <i class="fa-regular fa-floppy-disk"></i></button>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>
<!-- FIM DO MODAL CADASTRAR -->
<!-- MODAL VIZUALIZAR -->
<div class="modal fade " id="ExemploModalCentralizado2" tabindex="-1" role="dialog" aria-labelledby="TituloModalCentralizado2" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-xl" role="document">
    <div class="modal-content">
      <div class="modal-header bg-primary">
        <h4 class="modal-title " id="TituloModalCentralizado"><strong>Detalhes do Servidor</strong></h4>
      </div>
      <div class="modal-body">
        <span id="modal_body"></span>
      </div>
      <div class="modal-footer ">
        <button type="button" class="btn btn-danger" data-dismiss="modal">Fechar</button>
      </div>
    </div>
  </div>
</div>
<!-- FIM DO MODAL VIZUALIZAR -->
<!-- Modal -->
<div class="modal fade" id="ModalDeleteExcedente" tabindex="-1" role="dialog" aria-labelledby="ModalDeleteExcedente" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header d-flex justify-content-center">
        <h4 class="modal-title text-center text-dark" id="ModalDeleteExcedente"><strong>Excluir Dados</strong></h4>
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