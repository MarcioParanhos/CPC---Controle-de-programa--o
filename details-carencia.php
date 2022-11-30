<?php
// Import dos arquivos necessarios
include("layouts/header.php");
require_once("./dao/CarenciaDAO.php");


$type_vaga = $_SESSION["tipo_vaga"];
$usuario = $_SESSION['name'] . " " . $_SESSION['lastname'];
$id = $_GET['id'];

$carenciaDao = new CarenciaDAO($conn, $BASE_URL);
$vagas = $carenciaDao->getCarenciaUnicById($id);

?>
<!-- Container Fluid -->
<div class="container-fluid" id="container-wrapper">
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Vaga Detalhada</h1>
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="./">Home</a></li>
            <li class="breadcrumb-item">Carencia</li>
            <li class="breadcrumb-item active" aria-current="page">Detalhes</li>
        </ol>
    </div>
    <!-- Mensagem do crud vinda do arquivo -->
    <?php if (isset($printMsg) && $printMsg != '') : ?>
        <div class="green text-center alert <?= $info_msg ?> alert-dismissible fade show" role="alert">
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
    <div class="row">
        <div class="col-lg-12 mb-4">
            <div class="card">
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                    <h6 class="m-0 font-weight-bold text-primary">NTE 1</h6>
                    <div>
                        <?php if ($type_vaga === "R") { ?>
                            <a title="Voltar" href="include-carencia.php?id=<?= $vagas['id_ref'] ?>"><button class=" btn btn-sm btn-success voltar-btn">Voltar <i class="fa-solid fa-rotate-left"></i></button></a>
                        <?php } ?>
                        <?php if ($type_vaga === "T") { ?>
                            <a title="Voltar" href="include-carencia-temporaria.php?id=<?= $vagas['id_ref'] ?>"><button class=" btn btn-sm btn-success"><i class="fa-solid fa-rotate-left"></i></button></a>
                        <?php } ?>
                    </div>
                </div>

                <div class="content-wrapper">
                    <div class="row">
                        <div class="col-md-12 grid-margin">
                            <div class="row">
                                <div class="col-12 grid-margin stretch-card">
                                    <div class="card">
                                        <div class="card-body">
                                            <form class="forms-sample" action="<?= $BASE_URL ?>config/carenciaProcess.php" method="post">
                                                <div class="py-3 d-flex flex-row align-items-end justify-content-end">
                                                    <h6><i class="fa-solid fa-user-pen"></i> <?= $vagas['usuario'] ?></h6> &nbsp;&nbsp;
                                                    <h6><i class="fa-solid fa-calendar-day"></i> <?= date('d/m/Y', strtotime($vagas["data_modificacao"])); ?></h6>
                                                </div>
                                                <div class="form-row">
                                                    <input type="hidden" name="type" value="update">
                                                    <input hidden value="<?= $usuario ?>" name="usuario" type="text">
                                                    <div class="col-md-3">
                                                        <div class="position-relative form-group"><label for="municipio" class="">Municipio</label>
                                                            <input readonly value="<?= $vagas['municipio'] ?>" name="municipio" id="municipio" type="text" class="form-control form-control-sm">
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="position-relative form-group">
                                                            <label for="unidade_escolar" class="">Unidade Escolar</label>
                                                            <input readonly value="<?= $vagas['unidade_escolar'] ?>" name="unidade_escolar" required id="unidade_escolar" type="text" class="form-control form-control-sm">
                                                        </div>
                                                    </div>
                                                    <div class="col-md-3">
                                                        <input id="id" hidden value="<?= $vagas['id'] ?>" name="id" type="number" class="form-control form-control-sm">
                                                        <input id="nte" hidden value="<?= $vagas['nte'] ?>" name="nte" type="number" class="form-control form-control-sm">
                                                        <input id="id_ref" hidden value="<?= $vagas['id_ref'] ?>" name="id_ref" type="number" class="form-control form-control-sm">
                                                        <div class="form-group">
                                                            <label for="cod_unidade" class="">Cod.
                                                                Unidade</label>
                                                            <input readonly id="cod_unidade" value="<?= $vagas['cod_unidade'] ?>" name="cod_unidade" type="number" class="form-control form-control-sm">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="form-row">
                                                    <div class="col-md-6">
                                                        <div class="position-relative form-group">
                                                            <label for="nome" class="">VAGA VINCULADA AO SERVIDOR</label>
                                                            <input value="<?= $vagas['nome'] ?>" name="nome" required id="nome" type="text" class="form-control form-control-sm">
                                                        </div>
                                                    </div>
                                                    <div class="col-md-3">
                                                        <div class="position-relative form-group"><label for="cadastro" class="">cadastro</label>
                                                            <input minlength="8" maxlength="9" value="<?= $vagas['cadastro'] ?>" name="cadastro" id="cadastro" type="text" class="form-control form-control-sm">
                                                        </div>
                                                    </div>
                                                    <div class="col-md-3">
                                                        <div class="form-group">
                                                            <label class="control-label" for="disciplina_id">Vinculo</label>
                                                            <select name="vinculo" id="vinculo" class="form-control form-control-sm" required>
                                                                <option value="<?= $vagas['vinculo'] ?>" selected><?= $vagas['vinculo'] ?></option>
                                                                <option value="Estatutário">Estatutário</option>
                                                                <option value="Reda">Reda</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="form-row">
                                                    <div class="position-relative col-md-2">
                                                        <div class="form-group">
                                                            <label class="control-label" for="disciplina_id">Disciplina</label>
                                                            <select readonly name="disciplina" id="disciplina" class="form-control form-control-sm" required>
                                                                <option value="<?= $vagas['disciplina'] ?>" selected><?= $vagas['disciplina'] ?></option>
                                                                <?php foreach ($disciplinas as $disciplina) : ?>
                                                                    <option value="<?= $disciplina['nome'] ?>"><?= $disciplina['nome'] ?></option>
                                                                <?php endforeach; ?>
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-1">
                                                        <div class="position-relative form-group">
                                                            <label for="matutino" class="">Mat</label>
                                                            <input readonly min="0" value="<?= $vagas['matutino'] ?>" name="before_mat" required id="matutino" type="number" class="form-control text-center form-control-sm">
                                                        </div>
                                                    </div>
                                                    <div class="col-md-1">
                                                        <div class="form-group">
                                                            <label for="vespertino" class="">Vesp</label>
                                                            <input readonly min="0" id="vespertino" value="<?= $vagas['vespertino'] ?>" name="before_vesp" type="number" class="form-control text-center form-control-sm" aria-label="Amount (to the nearest dollar)">
                                                        </div>
                                                    </div>
                                                    <div class="col-md-1">
                                                        <div class="form-group">
                                                            <label for="noturno" class="text-center">Not</label>
                                                            <input readonly min="0" id="noturno" value="<?= $vagas['noturno'] ?>" name="before_not" type="number" class="form-control text-center form-control-sm" aria-label="Amount (to the nearest dollar)">
                                                        </div>
                                                    </div>
                                                    <?php if ($type_vaga === "R") { ?>
                                                        <div class="position-relative col-md-2">
                                                            <div class="form-group">
                                                                <label class="control-label" for="disciplina_id">Motivo da Vaga</label>
                                                                <select readonly name="motivo_vaga" id="motivo_vaga" class="form-control form-control-sm" required>
                                                                    <option value="<?= $vagas['motivo_vaga'] ?>" selected><?= $vagas['motivo_vaga'] ?></option>
                                                                    <?php foreach ($motivo_vagas as $motivo_vaga) : ?>
                                                                        <option value="<?= $motivo_vaga['motivo'] ?>"><?= $motivo_vaga['motivo'] ?></option>
                                                                    <?php endforeach; ?>
                                                                </select>
                                                            </div>
                                                        </div>
                                                    <?php } ?>
                                                    <?php if ($type_vaga === "T") { ?>
                                                        <div class="position-relative col-md-2">
                                                            <div class="form-group">
                                                                <label class="control-label" for="disciplina_id">Motivo da Vaga</label>
                                                                <select name="motivo_vaga" id="motivo_vaga" class="form-control form-control-sm" required>
                                                                    <option value="<?= $vagas['motivo_vaga'] ?>" selected><?= $vagas['motivo_vaga'] ?></option>
                                                                    <?php foreach ($motivo_vagas_temps as $motivo_vaga_temp) : ?>
                                                                        <option value="<?= $motivo_vaga_temp['motivo'] ?>"><?= $motivo_vaga_temp['motivo'] ?></option>
                                                                    <?php endforeach; ?>
                                                                </select>
                                                            </div>
                                                        </div>
                                                    <?php } ?>
                                                    <div class="col-md-2">
                                                        <div class="form-group">
                                                            <label for="inicio_vaga" class="text-center">Inicio da Vaga</label>
                                                            <input readonly id="inicio_vaga" value="<?= $vagas['inicio_vaga'] ?>" name="inicio_vaga" type="date" class="form-control form-control-sm" aria-label="Amount (to the nearest dollar)">
                                                        </div>
                                                    </div>
                                                    <?php if ($type_vaga === "T") { ?>
                                                        <div class="col-md-2">
                                                            <div class="form-group">
                                                                <label for="fim_vaga" class="text-center">Fim da vaga</label>
                                                                <input id="fim_vaga" value="<?= $vagas['fim_vaga'] ?>" name="fim_vaga" type="date" class="form-control form-control-sm" aria-label="Amount (to the nearest dollar)">
                                                            </div>
                                                        </div>
                                                    <?php } ?>
                                                    <div class="col-md-1">
                                                        <div class="form-group">
                                                            <label for="tipo_vaga" class="">Tipo</label>
                                                            <input readonly id="tipo_vaga" value="<?= $vagas['tipo_vaga'] ?>" name="tipo_vaga" type="text" class="form-control text-center form-control-sm" aria-label="Amount (to the nearest dollar)">
                                                        </div>
                                                    </div>
                                                </div><br>
                                                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                                                    <h6 class="m-0 font-weight-bold text-primary">SUPRIR</h6>
                                                </div><br>
                                                <div class="form-row">
                                                    <div class="col-md-3">
                                                        <div class="position-relative form-group"><label for="motivo_suprimento" class="">Motivo Suprimento</label>
                                                            <input value="AULAS EXTRAS" name="motivo_suprimento" id="motivo_suprimento" type="text" class="form-control form-control-sm">
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="position-relative form-group">
                                                            <label for="servidor_suprimento" class="">Nome</label>
                                                            <input value="" name="servidor_suprimento" id="servidor_suprimento" type="text" class="form-control form-control-sm">
                                                        </div>
                                                    </div>
                                                    <div class="col-md-3">
                                                        <div class="form-group">
                                                            <label for="cadastro_suprimento" class="">Cadastro</label>
                                                            <input id="cadastro_suprimento" value="" name="cadastro_suprimento" type="number" class="form-control form-control-sm">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="form-row">
                                                    <div class="col-md-1">
                                                        <div class="position-relative form-group">
                                                            <label for="matutino" class="">Mat</label>
                                                            <input min="0" value="0" name="after_mat" required id="matutino" type="number" class="form-control text-center form-control-sm">
                                                        </div>
                                                    </div>
                                                    <div class="col-md-1">
                                                        <div class="form-group">
                                                            <label for="vespertino" class="">Vesp</label>
                                                            <input min="0" id="vespertino" value="0" name="after_vesp" type="number" class="form-control text-center form-control-sm" aria-label="Amount (to the nearest dollar)">
                                                        </div>
                                                    </div>
                                                    <div class="col-md-1">
                                                        <div class="form-group">
                                                            <label for="noturno" class="text-center">Not</label>
                                                            <input min="0" id="noturno" value="0" name="after_not" type="number" class="form-control text-center form-control-sm" aria-label="Amount (to the nearest dollar)">
                                                        </div>
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="data_suprimento" class="text-center">Data do suprimento</label>
                                                        <input id="data_suprimento" value="" name="data_suprimento" type="date" class="form-control form-control-sm" aria-label="Amount (to the nearest dollar)">
                                                    </div>
                                                </div>
                                                <br>
                                                <div class="table-responsive mt-2 p-1 table-sm">
                                                    <table class="table compact nowrap table-hover align-items-center table-flush">
                                                        <thead class="thead-light">
                                                            <tr>
                                                                <th>CADASTRO</th>
                                                                <th>NOME</th>
                                                                <th>MOTIVO</th>
                                                                <th>DISCIPLINA</th>
                                                                <th>MAT</th>
                                                                <th>VESP</th>
                                                                <th>NOT</th>
                                                                <th>DATA</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            <tr>
                                                                <td>92854568</td>
                                                                <td>MARCIO VINICIUS DE BORBA PARANHOS</td>
                                                                <td>REMOÇÃO</td>
                                                                <td class="text-center">FISICA</td>
                                                                <td class="text-center">2</td>
                                                                <td class="text-center">2</td>
                                                                <td class="text-center">2</td>
                                                                <td>31/11/2022</td>
                                                            </tr>
                                                            <tr>
                                                                <td>115788954</td>
                                                                <td>VERA LUCIA DE BORBA</td>
                                                                <td>AULA EXTRA</td>
                                                                <td class="text-center">FISICA</td>
                                                                <td class="text-center">4</td>
                                                                <td class="text-center">4</td>
                                                                <td class="text-center">4</td>
                                                                <td>03/12/2022</td>
                                                            </tr>
                                                        </tbody>
                                                    </table>
                                                    <br><br>
                                                </div>
                                                <a title="Atualizar"><button type="submit" class=" btn bg-purple btn-primary mr-2 add-btn">Atualizar <i class="fa-solid fa-arrows-rotate"></i></button></a>
                                            </form>
                                            <br>
                                            R - Real <br>
                                            T - Temporária
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
<?php

include("layouts/footer.php")

?>