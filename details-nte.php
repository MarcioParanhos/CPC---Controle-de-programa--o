<?php
// Import dos arquivos necessarios

include("./layouts/header.php");
require_once("./dao/NteDAO.php");

$usuario = $_SESSION['name'] . " " . $_SESSION['lastname'];
$id = $_GET['id'];

$nteDao = new Controle_nteDAO($conn, $BASE_URL);

// passa o perfil do usuario como parametro para buscar os dados de determinado perfil
$controle_nte = $nteDao->getNtesById($id);

?>
<!-- Container Fluid -->
<div class="container-fluid" id="container-wrapper">
  <div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="title_style h3 mb-0 text-gray-800">Detalhes | <?= $controle_nte["unidade_escolar"] ?></h1>
    <ol class="breadcrumb">
      <li class="breadcrumb-item"><a href="<?= $BASE_URL ?>home.php">Home</a></li>
      <li class="breadcrumb-item">Ntes</li>
      <li class="breadcrumb-item active" aria-current="page">Controle</li>
      <li class="breadcrumb-item active" aria-current="page">Detalhes</li>
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
  <!-- Inicio do form de edição -->
  <div class="row">
    <div class="col-lg-12 mb-4">
      <div class="card">
        <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
          <h6 class="m-0 font-weight-bold text-primary">NTE 0<?= $controle_nte["nte"] ?></h6>
          <div>
            <button title="Carência - Adicionar / Consultar" data-target="#ExemploModalCentralizado" data-toggle="modal" class=" btn btn-sm btn-success">Carência <i class="fa-solid fa-magnifying-glass-plus"></i></button>
            <a title="Voltar" href="nte.php?nte=<?= $controle_nte["nte"] ?>"><button class="btn-sm btn btn-success voltar-btn">Voltar <i class=" fa-solid fa-rotate-left"></i></button></a>
          </div>
        </div>
        <div class="content-wrapper">
          <div class="row">
            <div class="col-md-12 grid-margin">
              <div class="row">
                <div class="col-12 grid-margin stretch-card">
                  <div class="card">
                    <div class="card-body">
                      <form class="forms-sample" action="<?= $BASE_URL ?>config/nteProcess.php" method="post">
                        <input type="hidden" name="type" value="update">
                        <input id="id" hidden value="<?= $contato_nte['id'] ?>" name="id" type="number" class="form-control form-control-sm">
                        <input id="nte" hidden value="<?= $contato_nte['nte'] ?>" name="nte" type="number" class="form-control form-control-sm">
                        <div class="form-row">
                          <div class="col-md-3">
                            <div class="position-relative form-group"><label for="municipio" class="">Municipio</label>
                              <input value="<?= $controle_nte["municipio"] ?>" name="municipio" readonly id="municipio" type="text" class="form-control form-control-sm">
                            </div>
                          </div>
                          <div class="col-md-6">
                            <div class="position-relative form-group">
                              <label for="unidade_escolar" class="">Unidade
                                Escolar</label>
                              <input value="<?= $controle_nte["unidade_escolar"] ?>" name="unidade_escolar" readonly required id="unidade_escolar" type="text" class="form-control form-control-sm">
                            </div>
                          </div>
                          <div class="col-md-3">
                            <div class="form-group">
                              <label for="cod_unidade" class="">Cod.
                                Unidade</label>
                              <input type="number" name="id" value="<?= $controle_nte["id"] ?>" hidden>
                              <input type="number" name="nte" value="<?= $controle_nte["nte"] ?>" hidden>
                              <input id="cod_unidade" value="<?= $controle_nte["cod_unidade"] ?>" name="cod_unidade" readonly type="number" class="form-control form-control-sm" aria-label="Amount (to the nearest dollar)">
                            </div>
                          </div>
                        </div>
                        <?php if ($controle_nte["digitacao"] === "Concluida") { ?>
                          <div class="form-row">
                            <div class="mt-4 col-md-2">
                              <div class="position-relative form-group">
                                <label for="digitacao" class="">Digitação</label>
                                <select id="digitacao" name="digitacao" class="form-control" value="" required>
                                  <option class="" value="<?= $controle_nte["digitacao"] ?>" selected><?= $controle_nte["digitacao"] ?></option>
                                  <option class="" value="Pendente">Pendente</option>
                                </select>
                              </div>
                            </div>
                          </div>
                        <?php } ?>
                        <?php if ($controle_nte["digitacao"] === "Pendente") { ?>
                          <div class="form-row">
                            <div class="mt-4 col-md-2">
                              <div class="position-relative form-group">
                                <label for="digitacao" class="">Digitação</label>
                                <select id="digitacao" name="digitacao" class="form-control" value="" required>
                                  <option class="" value="<?= $controle_nte["digitacao"] ?>" selected><?= $controle_nte["digitacao"] ?></option>
                                  <option class="" value="Concluida">Concluida</option>
                                </select>
                              </div>
                            </div>
                          </div>
                        <?php } ?>
                        <div class="form-group">
                          <label for="desc_digitacao">Descrição da Digitação</label>
                          <textarea name="desc_digitacao" class="form-control" id="desc_digitacao" rows="5"><?= $controle_nte["desc_digitacao"] ?></textarea>
                        </div>
                        <?php if ($controle_nte["homologacao"] === "Homologada") { ?>
                          <div class="form-row">
                            <div class="mt-4 col-md-2">
                              <div class="position-relative form-group"><label for="homologacao" class="">Situação da homologação:</label>
                                <select id="homologacao" name="homologacao" class="form-control" value="" required>
                                  <option class="text-dark" value="<?= $controle_nte["homologacao"] ?>" selected><?= $controle_nte["homologacao"] ?>
                                  </option>
                                  <option class="" value="Pendente">Pendente</option>
                                </select>
                              </div>
                            </div>
                          </div>
                        <?php } ?>
                        <?php if ($controle_nte["homologacao"] === "Pendente") { ?>
                          <div class="form-row">
                            <div class="mt-4 col-md-2">
                              <div class="position-relative form-group"><label for="homologacao" class="">Situação da homologação:</label>
                                <select id="homologacao" name="homologacao" class="form-control" value="" required>
                                  <option class="text-dark" value="<?= $controle_nte["homologacao"] ?>" selected><?= $controle_nte["homologacao"] ?>
                                  </option>
                                  <option class="" value="Homologada">Homologada</option>
                                </select>
                              </div>
                            </div>
                          </div>
                        <?php } ?>
                        <div class="form-group">
                          <label for="desc_homologacao">Descrição da
                            Homologação</label>
                          <textarea name="desc_homologacao" class="form-control" id="desc_homologacao" rows="5"><?= $controle_nte["desc_homologacao"] ?></textarea>
                        </div>
                        <div class="form-row">
                          <div class="mt-4 col-md-4">
                            <div class="position-relative form-group">
                              <label for="componente" class="">Componente</label>
                              <select id="componente" name="componente" class="form-control" value="" required>
                                <option class="text-dark" value="<?= $controle_nte["componente"] ?>" selected><?= $controle_nte["componente"] ?>
                                </option>
                                <option class="" value="Fechado">Fechado</option>
                                <option class="" value="Aberto">Aberto</option>
                              </select>
                            </div>
                          </div>
                        </div>
                        <div class="form-group">
                          <label for="desc_componente">Descrição do
                            Componente</label>
                          <textarea name="desc_componente" class="form-control" id="desc_componente" rows="5"><?= $controle_nte["desc_componente"] ?></textarea>
                        </div>
                        <a title="Atualizar"><button type="submit" class=" btn bg-purple btn-primary mr-2 add-btn">Atualizar <i class="fa-solid fa-arrows-rotate"></i></button></a>
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
<!---Container Fluid-->
<!-- Modal de Incluir carencia  -->
<div class="modal fade" id="ExemploModalCentralizado" tabindex="-1" role="dialog" aria-labelledby="TituloModalCentralizado" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header d-flex justify-content-center">
        <h4 class="modal-title text-center text-dark" id="TituloModalCentralizado"><strong>TIPO DE CARÊNCIA</strong></h4>
      </div>
      <div class="modal-body">
        <div class="d-flex justify-content-around">
          <a class="btn-carencia" title="Adicionar Carência" href="include-carencia.php?id=<?= $controle_nte["id"] ?>"><button type="button" class="btn btn-carencia btn-primary"><i class="fa-solid fa-hourglass-end"></i> REAL</button></a>
          <a class="btn-carencia" title="Adicionar Carência" href="include-carencia-temporaria.php?id=<?= $controle_nte["id"] ?>"><button type="button" class="btn btn-carencia float-right btn-primary"><i class="fa-solid fa-hourglass"></i> TEAMPORARIA</button></a>
        </div>
      </div>
    </div>
  </div>
</div>
<?php

include("layouts/footer.php")

?>