<?php

include_once("layouts/header.php");
require_once("dao/ExcedenteDAO.php");

$excedenteDao = new ExcedenteDAO($conn, $BASE_URL);

$usuario = $_SESSION['name'] . " " . $_SESSION['lastname'];

$id = $_GET['id'];

$excedente = $excedenteDao->getExcedenteById($id);

?>
<!-- Conteudo da Pagina-->
<div class="container-fluid" id="container-wrapper">
   <div class="d-sm-flex align-items-center justify-content-between mb-4">
      <h1 class="h3 mb-0 text-gray-800">DETALHES</h1>
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
               <a title="Voltar" href="excedentes.php"><button class=" btn btn-sm btn-success"><i class="fa-solid fa-rotate-left"></i></button></a>
            </div>
            <div class="content-wrapper">
               <div class="row">
                  <div class="col-md-12 grid-margin">
                     <div class="row">
                        <div class="col-12 grid-margin stretch-card">
                           <div class="card">
                              <div class="card-body">
                                 <form class="forms-sample" action="<?= $BASE_URL ?>config/excedentesProcess.php" method="post">
                                    <div class="py-3 d-flex flex-row align-items-end justify-content-end">
                                    <h6><i class="fa-solid fa-user-pen"></i> <?= $excedente['usuario'] ?></h6> &nbsp;&nbsp; 
                                    <h6><i class="fa-solid fa-calendar-day"></i> <?= date('d/m/Y', strtotime($excedente["data_add_user"])); ?></h6>
                                    </div>
                                    <input type="hidden" name="type" value="update">
                                    <input hidden value="<?= $usuario ?>" name="usuario" type="text">
                                    <input type="hidden" name="id" value="<?= $excedente['id'] ?>">
                                    <div class="form-row">
                                       <div class="col-md-2">
                                          <div class="position-relative form-group">
                                             <label for="nte" class="">NTE</label>
                                             <input readonly value="0<?= $excedente['nte'] ?>" name="nte" id="nte" type="text" class="form-control form-control-sm">
                                          </div>
                                       </div>
                                    </div>
                                    <div class="form-row">
                                       <div class="col-md-3">
                                          <div class="position-relative form-group">
                                             <label for="municipio" class="">Municipio</label>
                                             <input value="<?= $excedente['municipio'] ?>" name="municipio" id="municipio" type="text" class="form-control form-control-sm">
                                          </div>
                                       </div>
                                       <div class="col-md-6">
                                          <div class="position-relative form-group">
                                             <label for="unidade_escolar" class="">Unidade Escolar</label>
                                             <input value="<?= $excedente['unidade_escolar'] ?>" name="unidade_escolar" id="unidade_escolar" type="text" class="form-control form-control-sm">
                                          </div>
                                       </div>
                                       <div class="col-md-3">
                                          <div class="form-group">
                                             <label for="cod_unidade" class="">Cod. Unidade</label>
                                             <input value="<?= $excedente['cod_unidade'] ?>" id="cod_unidade" name="cod_unidade" type="text" class="form-control form-control-sm" aria-label="Amount (to the nearest dollar)">
                                          </div>
                                       </div>
                                    </div>
                                    <div class="form-row">
                                       <div class="col-md-3">
                                          <div class="position-relative form-group">
                                             <label for="cadastro" class="">Cadastro</label>
                                             <input value="<?= $excedente['cadastro'] ?>" name="cadastro" id="cadastro" type="text" class="form-control form-control-sm">
                                          </div>
                                       </div>
                                       <div class="col-md-6">
                                          <div class="position-relative form-group">
                                             <label for="nome" class="">Nome</label>
                                             <input value="<?= $excedente['nome'] ?>" name="nome" id="nome" type="text" class="form-control form-control-sm">
                                          </div>
                                       </div>
                                       <div class="col-md-3">
                                          <div class="form-group">
                                             <label for="vinculo" class="">Vinculo</label>
                                             <input value="<?= $excedente['vinculo'] ?>" id="vinculo" name="vinculo" type="text" class="form-control form-control-sm">
                                          </div>
                                       </div>
                                    </div>
                                    <div class="form-row">
                                       <div class="col-md-3">
                                          <div class="position-relative form-group">
                                             <label for="ch" class="">CH DO SERVIDOR</label>
                                             <input value="<?= $excedente['ch'] ?>" name="ch" id="ch" type="text" class="form-control form-control-sm">
                                          </div>
                                       </div>
                                       <div class="col-md-3">
                                          <div class="position-relative form-group">
                                             <label for="qtd_horas" class="">QTD. AULAS EXCEDENTES</label>
                                             <input value="<?= $excedente['qtd_horas'] ?>" name="qtd_horas" id="qtd_horas" type="text" class="form-control form-control-sm">
                                          </div>
                                       </div>
                                       <div class="col-md-3">
                                          <div class="position-relative form-group">
                                             <label for="formacao" class="">FORMAÇÃO</label>
                                             <input value="<?= $excedente['formacao'] ?>" name="formacao" id="formacao" type="text" class="form-control form-control-sm">
                                          </div>
                                       </div>
                                    </div>
                                    <div class="form-group">
                                       <label for="obs">Observação</label>
                                       <textarea name="obs" class="form-control" id="obs" rows="5"></textarea>
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
