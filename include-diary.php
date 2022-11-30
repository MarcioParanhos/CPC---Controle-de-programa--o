<?php

include("layouts/header.php");
include_once("config/url.php");

$usuario = $_SESSION['name'] . " " . $_SESSION['lastname'];

?>
<!-- Conteudo da Pagina-->
<div class="container-fluid" id="container-wrapper">
  <div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">INCLUIR MOVIMENTAÇÃO DO DIARIO</h1>
    <ol class="breadcrumb">
      <li class="breadcrumb-item"><a href="<?= $BASE_URL ?>home.php">Home</a></li>
      <li class="breadcrumb-item">Diario</li>
      <li class="breadcrumb-item active" aria-current="page">Incluir</li>
    </ol>
  </div>
  <!-- Mensagem do crud vinda do arquivo -->
  <?php if (isset($printMsg) && $printMsg != '') : ?>
    <div class="green text-center alert alert-success alert-dismissible fade show" role="alert">
      <h5"><?= $printMsg ?></h5>
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
          <a title="Consultar" href="diary-consult.php"><button class="btn btn-sm btn-success">Consultar <i class="fa-solid fa-search"></i></button></a>
        </div>
        <div class="content-wrapper">
          <div class="row">
            <div class="col-md-12 grid-margin">
              <div class="row">
                <div class="col-12 grid-margin stretch-card">
                  <div class="card">
                    <div class="card-body">
                      <form class="forms-sample" action="<?= $BASE_URL ?>config/diaryProcess.php" method="post">
                        <input type="hidden" name="type" value="create">
                        <input hidden value="<?= $usuario ?>" name="usuario" type="text">
                        <div class="form-row">
                          <div class="mt-0 col-md-2">
                            <div class="position-relative form-group">
                              <label for="nte" class="">NTE</label>
                              <select id="nte" name="nte" class="form-control" value="" required>
                                <option class="text-dark" value="# " selected>
                                  <strong>-</strong>
                                </option>
                                <option class="" value="05">05</option>
                                <option class="" value="01">01</option>
                              </select>
                            </div>
                          </div>
                        </div>
                        <div class="form-row">
                          <div class="col-md-3">
                            <div class="form-group">
                              <label for="municipio" class="">Municipio</label>
                              <input value="" name="municipio" id="municipio" type="text" class="form-control form-control-sm">
                            </div>
                          </div>
                          <div class="col-md-6">
                            <div class="position-relative form-group">
                              <label for="unidade_escolar" class="">Unidade
                                Escolar</label>
                              <input value="" name="unidade_escolar" required id="unidade_escolar" type="text" class="form-control form-control-sm">
                            </div>
                          </div>
                          <div class="col-md-3">
                            <div class="form-group">
                              <label for="cod_unidade" class="">Cod.
                                Unidade</label>
                              <input value="" id="cod_unidade" name="cod_unidade" type="text" class="form-control form-control-sm" aria-label="Amount (to the nearest dollar)">
                            </div>
                          </div>
                        </div>
                        <div class="form-row">
                          <div class="col-md-3">
                            <div class="position-relative form-group">
                              <label for="cadastro" class="">Cadastro</label>
                              <input value="" name="cadastro" id="cadastro" type="text" class="form-control form-control-sm">
                            </div>
                          </div>
                          <div class="col-md-6">
                            <div class="position-relative form-group">
                              <label for="nome" class="">Nome</label>
                              <input value="" name="nome" required id="nome" type="text" class="form-control form-control-sm">
                            </div>
                          </div>
                          <div class="col-md-3">
                            <div class="form-group">
                              <label for="data_diario" class="">Data do Diario</label>
                              <input value="" id="data_diario" name="data_diario" type="date" class="form-control form-control-sm">
                            </div>
                          </div>
                        </div>
                        <div class="form-row">
                          <div class="col-md-3">
                            <div class="position-relative form-group">
                              <label for="periodo" class="">Periodo / Data</label>
                              <input value="" name="periodo" id="periodo" type="date" class="form-control form-control-sm">
                            </div>
                          </div>
                          <div class="col-md-3">
                            <div class="position-relative form-group">
                              <label for="contato" class="">Contato com:</label>
                              <input value="" name="contato" id="contato" type="text" class="form-control form-control-sm">
                            </div>
                          </div>
                          <div class="position-relative col-md-3">
                            <div class="form-group">
                              <label class="control-label" for="disciplina_id">Metodo do Contato</label>
                              <select name="modo_contato" id="vinculo" class="form-control form-control-sm">
                                <option value="" selected>Selecione ...</option>
                                <option value="email">E-mail</option>
                                <option value="tel">Telefone</option>
                                <option value="tel">Sinal de fumaça</option>
                              </select>
                            </div>
                          </div>
                          <div class="col-md-3">
                            <div class="position-relative form-group">
                              <label for="dia_contato" class="">Dia do contato</label>
                              <input value="" name="dia_contato" id="dia_contato" type="date" class="form-control form-control-sm">
                            </div>
                          </div>
                        </div>
                        <div class="form-row">
                          <div class="mt-0 col-md-3">
                            <div class="position-relative form-group">
                              <label for="tipo" class="">Tipo</label>
                              <select id="tipo" name="tipo" class="form-control" value="" required>
                                <option class="text-dark" value="#" selected>
                                  <strong>-</strong>
                                </option>
                                <option class="" value="APOSENTADORIA">APOSENTADORIA
                                </option>
                                <option class="" value="LICENÇA PARA CURSO">LICENÇA PARA CURSO
                                </option>
                              </select>
                            </div>
                          </div>
                          <div class="mt-0 col-md-3">
                            <div class="position-relative form-group">
                              <label for="situacao" class="">Situação</label>
                              <select id="situacao" name="situacao" class="form-control" value="" required>
                                <option class="text-dark" value="#" selected>
                                  <strong>-</strong>
                                </option>
                                <option class="" value="Pendente">PENDENTE
                                </option>
                                <option class="" value="Concluida">RESOLVIDO
                                </option>
                              </select>
                            </div>
                          </div>
                        </div>
                        <div class="form-group">
                          <label for="obs">Observação</label>
                          <textarea name="obs" class="form-control" id="obs" rows="5"></textarea>
                        </div>
                        <a title="Salvar"><button type="submit" class=" btn bg-purple btn-primary mr-2 add-btn">Cadastrar <i class="fa-solid fa-plus"></i></button></a>
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