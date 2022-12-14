<?php

include("layouts/header.php");
require_once("./dao/CarenciaDAO.php");
require_once("./dao/NteDAO.php");

$_SESSION["tipo_vaga"] = "T";
$type = "T";
$id = $_GET['id'];
$usuario = $_SESSION['name'] . " " . $_SESSION['lastname'];

// Funções de Read do modulo de carencia 
$carenciaDao = new CarenciaDAO($conn, $BASE_URL);
$temp_carencias = $carenciaDao->getCarenciasById($id, $type);
$countMatTemp = $carenciaDao->countCarenciaMatById($id, $type);
$countVespTemp = $carenciaDao->countCarenciaVespById($id, $type);
$countNotTemp = $carenciaDao->countCarenciaNotById($id, $type);
$carenciaDao->updateCarencia($id);
$disciplinas = $carenciaDao->getDisciplinas();
$motivo_vagas = $carenciaDao->getMotivoVagas($type);

$nteDao = new Controle_nteDAO($conn, $BASE_URL);
$controle_nte = $nteDao->getNtesById($id);

?>
<!-- Conteudo da Pagina-->
<div class="container-fluid" id="container-wrapper">
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="title_style h3 mb-0 text-gray-800">INCLUIR CARÊNCIA TEMPORÁRIA</h1>
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="<?= $BASE_URL ?>home.php">Home</a></li>
            <li class="breadcrumb-item">Carência</li>
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
    <!-- Mensagem do crud vinda do arquivo -->
    <?php $ref = $_GET['id'] ?>
    <?php if ($ref == '?') : ?>
        <div class="green text-center alert alert-danger alert-dismissible fade show" role="alert">
            <h5">Unidade não localizada !</h5>
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
                    <?php if (!empty($controle_nte["id"])) { ?>
                        <div>
                        <a target="_blank" title="Gerar PDF" href="pdfCarencia.php?id=<?= $controle_nte["id"] ?>&type=t"><button class="btn-sm btn btn-success">PDF <i class="fa-solid fa-file-export"></i></button></a>
                        <a title="Gerar Excell" href="gerar_planilha.php?tipo=t&id=<?= $controle_nte["id"] ?>"><button class="btn-sm btn btn-success">Excel <i class="fa-solid fa-file-export"></i></button></a>
                            <a title="Adicionar Carência Real" href="include-carencia.php?id=<?= $controle_nte["id"] ?>"><button class="btn-sm btn btn-success">Real <i class="fa-solid fa-magnifying-glass-plus"></i></button></a>
                        </div>
                    <?php } ?>
                </div>
                <div class="content-wrapper">
                    <div class="row">
                        <div class="col-md-12 grid-margin">
                            <div class="row">
                                <div class="col-12 grid-margin stretch-card">
                                    <div class="card">
                                        <div class="card-body">
                                            <form class="navbar-search" action="<?= $BASE_URL ?>config/carenciaProcess.php" method="post">
                                                <label for="cod_unidade">Busque pelo Cod. da Unidade</label>
                                                <div class="input-group-append">
                                                    <input type="text" name="cod_unidade" id="cod_unidade">
                                                    <input hidden value="search" name="type" type="text">
                                                    <button class="btn btn-primary" type="submit">
                                                        <i class="fa-solid fa-search"></i>
                                                    </button>
                                                </div>
                                            </form>
                                            <form class="forms-sample" action="<?= $BASE_URL ?>config/carenciaProcess.php" method="post">
                                                <div class="form-row">
                                                    <div class="mt-0 col-md-2">
                                                        <div class="position-relative form-group">

                                                        </div>
                                                    </div>
                                                </div>
                                                <!-- div que aparece ao fazer a pesquisa da unidade -->
                                                <?php if (empty($controle_nte["id"])) { ?>
                                                    <div hidden>
                                                    <?php } ?>
                                                    <?php if (!empty($controle_nte["id"])) { ?>
                                                        <div>
                                                        <?php } ?>
                                                        <div class="form-row">
                                                            <input type="hidden" name="type" value="create">
                                                            <div class="col-md-1">
                                                                <div class="position-relative form-group">
                                                                    <label for="nte" class="">NTE</label>
                                                                    <input hidden value="<?= $controle_nte["id"] ?>" name="id_ref" type="text">
                                                                    <input hidden value="<?= $usuario ?>" name="usuario" type="text">
                                                                    <input value="0<?= $controle_nte["nte"] ?>" name="nte" id="nte" type="text" class="form-control form-control-sm" readonly>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-3">
                                                                <div class="position-relative form-group">
                                                                    <label for="municipio" class="">Municipio</label>
                                                                    <input value="<?= $controle_nte["municipio"] ?>" readonly name="municipio" id="municipio" type="text" class="form-control form-control-sm">
                                                                </div>
                                                            </div>
                                                            <div class="col-md-6">
                                                                <div class="position-relative form-group">
                                                                    <label for="unidade_escolar" class="">Unidade
                                                                        Escolar</label>
                                                                    <input value="<?= $controle_nte["unidade_escolar"] ?>" readonly name="unidade_escolar" required id="unidade_escolar" type="text" class="form-control form-control-sm">
                                                                </div>
                                                            </div>
                                                            <div class="col-md-2">
                                                                <div class="form-group">
                                                                    <label for="cod_unidade" class="">Cod.Unidade</label>
                                                                    <input value="<?= $controle_nte["cod_unidade"] ?>" readonly id="cod_unidade" name="cod_unidade" type="text" class="form-control form-control-sm" aria-label="Amount (to the nearest dollar)">
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="form-row">
                                                            <div class="col-md-3">
                                                                <div class="position-relative form-group">
                                                                    <label for="cadastro" class="">Cadastro</label>
                                                                    <input value="" minl ength="8" maxlength="9" name="cadastro" id="cadastro" type="text" class="form-control form-control-sm">
                                                                </div>
                                                            </div>
                                                            <div class="col-md-6">
                                                                <div class="position-relative form-group">
                                                                    <label for="nome" class="">Nome</label>
                                                                    <input value="" name="nome" id="nome" type="text" class="form-control form-control-sm">
                                                                </div>
                                                            </div>
                                                            <div class="position-relative col-md-3">
                                                                <div class="form-group">
                                                                    <label class="control-label" for="disciplina_id">Vinculo</label>
                                                                    <select name="vinculo" id="vinculo" class="form-control form-control-sm" required>
                                                                        <option value="-" selected>Selecione ...</option>
                                                                        <option value="Estatutário">Estatutário</option>
                                                                        <option value="Reda">Reda</option>
                                                                    </select>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="form-row">
                                                            <div class="position-relative col-md-3">
                                                                <div class="form-group">
                                                                    <label class="control-label" for="disciplina_id">Disciplina</label>
                                                                    <select name="disciplina" id="disciplina" class="form-control form-control-sm" required>
                                                                        <option value="" selected>Selecione ...</option>
                                                                        <?php foreach ($disciplinas as $disciplina) : ?>
                                                                            <option value="<?= $disciplina['nome'] ?>"><?= $disciplina['nome'] ?></option>
                                                                        <?php endforeach; ?>
                                                                    </select>
                                                                </div>
                                                            </div>
                                                            <div class="position-relative col-md-3">
                                                                <div class="form-group">
                                                                    <label class="control-label" for="disciplina_id">Motivo da Vaga</label>
                                                                    <select name="motivo_vaga" id="motivo_vaga" class="form-control form-control-sm" required>
                                                                        <option value="" selected>Selecione ...</option>
                                                                        <?php foreach ($motivo_vagas as $motivo_vaga) : ?>
                                                                            <option value="<?= $motivo_vaga['motivo'] ?>"><?= $motivo_vaga['motivo'] ?></option>
                                                                        <?php endforeach; ?>
                                                                    </select>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-3">
                                                                <div class="position-relative form-group">
                                                                    <label for="inicio_vaga" class="">Inicio da vaga</label>
                                                                    <input value="" name="inicio_vaga" required id="inicio_vaga" type="date" class="form-control form-control-sm">
                                                                </div>
                                                            </div>
                                                            <div class="col-md-3">
                                                                <div class="position-relative form-group">
                                                                    <label for="inicio_vaga" class="">Fim da vaga</label>
                                                                    <input value="" name="fim_vaga" required id="inicio_vaga" type="date" class="form-control form-control-sm">
                                                                </div>
                                                            </div>
                                                            <div class="position-relative col-md-3">
                                                                <div hidden class="form-group">
                                                                    <label class="control-label" for="tipo_vaga">Tipo da Vaga</label>
                                                                    <select name="tipo_vaga" id="tipo_vaga" class="form-control form-control-sm" required>
                                                                        <option value="T" selected>Temporaria</option>
                                                                    </select>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <!-- incluir o quantitativo de disciplina -->
                                                        <div class="form-row">
                                                            <div class="col-md-1">
                                                                <div class="position-relative form-group">
                                                                    <label for="matutino" class="">Matutino</label>
                                                                    <input min="0" value="" name="matutino" required id="matutino" type="number" class="form-control form-control-sm">
                                                                </div>
                                                            </div>
                                                            <div class="col-md-1">
                                                                <div class="position-relative form-group">
                                                                    <label for="vespertino" class="">vespertino</label>
                                                                    <input min="0" value="" name="vespertino" required id="vespertino" type="number" class="form-control form-control-sm">
                                                                </div>
                                                            </div>
                                                            <div class="col-md-1">
                                                                <div class="position-relative form-group">
                                                                    <label for="noturno" class="">Noturno</label>
                                                                    <input min="0" value="" name="noturno" required id="noturno" type="number" class="form-control form-control-sm">
                                                                </div>
                                                            </div>
                                                            <div hidden class="col-md-1">
                                                                <div class="position-relative form-group">
                                                                    <label for="total" class="">Total</label>
                                                                    <input value="" name="total" readonly id="total" type="number" class="form-control form-control-sm">
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <a title="Adicionar"><button type="submit" class="btn bg-purple btn-primary mr-2 add-btn">Cadastrar <i class="fa-solid fa-plus"></i></button></a>
                                            </form>
                                            <div class="card-header mb-2 mt-2 py-3 d-flex flex-row align-items-center justify-content-between">
                                                <h6 class="m-0 font-weight-bold text-primary">VAGAS DETALHADAS</h6>
                                            </div>
                                            <div class="table-responsive mt-2 p-1 table-lg">
                                                <table id="myTable" class="table compact nowrap table-hover align-items-center table-flush">
                                                    <thead class="thead-light">
                                                        <tr>
                                                            <th class="text-center">Tipo</th>
                                                            <th>Disciplina</th>
                                                            <th class="text-center">MAT</th>
                                                            <th class="text-center">VESP</th>
                                                            <th class="text-center">NOT</th>
                                                            <th class="text-center">TOTAL</th>
                                                            <th class="text-center">Cadastro</th>
                                                            <th class="text-center">Nome</th>
                                                            <th class="text-center">Motivo</th>
                                                            <th class="text-center">Data Inicio</th>
                                                            <th class="text-center">Detalhar</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <?php foreach ($temp_carencias as $temp_carencia) : ?>
                                                            <tr class="">
                                                                <td class="text-center"><?= $temp_carencia->tipo_vaga ?></td>
                                                                <td class=""><?= $temp_carencia->disciplina ?></td>
                                                                <td class="text-center"><?= $temp_carencia->matutino ?></td>
                                                                <td class="text-center"><?= $temp_carencia->vespertino ?></td>
                                                                <td class="text-center"><?= $temp_carencia->noturno ?></td>
                                                                <td class="text-center"><?= $temp_carencia->matutino + $temp_carencia->vespertino + $temp_carencia->noturno ?></td>
                                                                <td class="text-center"><?= $temp_carencia->cadastro ?></td>
                                                                <td class="text-center"><?= $temp_carencia->nome ?></td>
                                                                <td class="text-center"><?= $temp_carencia->motivo_vaga ?></td>
                                                                <td class="text-center"><?= date('d/m/Y', strtotime($temp_carencia->inicio_vaga)); ?></td>
                                                                <td class="text-center">
                                                                    <a class="btn btn-primary btn-sm" href="./details-carencia.php?id=<?= $temp_carencia->id ?>"><i class="fa-solid fa-eye"></i></a>
                                                                    <a title="Excluir" id="btn-delete" onclick="abrirModal(<?= $temp_carencia->id ?>)" type="button" class="btn text-white btn-sm btn-danger"><i class="fa-solid fa-trash"></i></a>
                                                                </td>
                                                            </tr>
                                                        <?php endforeach; ?>
                                                        <tr class="">
                                                            <td id="start-local-table" class="bg-primary">TOTAL</td>
                                                            <td class="bg-primary"></td>
                                                            <td class="bg-primary text-center"><?= $countMatTemp ?></td>
                                                            <td class="bg-primary text-center"><?= $countVespTemp ?></td>
                                                            <td class="bg-primary text-center"><?= $countNotTemp ?></td>
                                                            <td id="end-local-table" class="border-left bg-primary text-center"><?= $countMatTemp + $countNotTemp + $countVespTemp ?></td>
                                                            <td class="text-center"></td>
                                                            <td class="text-center"></td>
                                                            <td class="text-center"></td>
                                                            <td class="text-center"></td>
                                                        </tr>
                                                    </tbody>
                                                </table>
                                                <br>
                                                <table class="table table-sm table-bordered">
                                                    <thead>
                                                        <tr class="bg-primary text-center">
                                                            <th scope="col">REDA 20H</th>
                                                            <th scope="col">REDA 40H</th>
                                                            <th scope="col">EFETIVO 20H</th>
                                                            <th scope="col">EFETIVO 40H</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <br>
                                                    <h6 class="m-b-1 font-weight-bold">QUANTITATIVO DE SERVIDOR POR REGIME</h6>
                                                        <tr class="text-center">
                                                            <td><?= number_format(($countMatTemp + $countNotTemp + $countVespTemp) / 16, 1, '.', ''); ?></td>
                                                            <td><?= number_format(($countMatTemp + $countNotTemp + $countVespTemp) / 32, 1, '.', ''); ?></td>
                                                            <td><?= number_format(($countMatTemp + $countNotTemp + $countVespTemp) / 13, 1, '.', ''); ?></td>
                                                            <td><?= number_format(($countMatTemp + $countNotTemp + $countVespTemp) / 26, 1, '.', ''); ?></td>
                                                        </tr>
                                                    </tbody>
                                                </table>
                                                <br>
                                                R - Real <br>
                                                T - Temporária
                                            </div>
                                        </div>
                                        <!-- fim da div que aparece ao fazer a pesquisa da unidade -->
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
<!-- Modal -->
<div class="modal fade" id="ExemploModalCentralizado" tabindex="-1" role="dialog" aria-labelledby="TituloModalCentralizado" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header d-flex justify-content-center">
                <h4 class="modal-title text-center text-dark" id="TituloModalCentralizado"><strong>Excluir Dados</strong></h4>
            </div>
            <div class="modal-body">
                <strong>O registro será excluido permanentemente !</strong>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary" data-dismiss="modal">Fechar</button>
                <a title="Excluir Carência"><button type="button" class="btn float-right btn-danger"><i class="fa-solid fa-trash"></i> Excluir</button></a>
            </div>
        </div>
    </div>
</div>
<!---Fim do Conteudo da Pagina-->
<?php

include("layouts/footer.php")

?>