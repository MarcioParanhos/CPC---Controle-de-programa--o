<?php

include_once("layouts/header.php");
require_once("dao/DiaryDAO.php");

$diaryDao = new DiaryDAO($conn, $BASE_URL);

$usuario = $_SESSION['name'] . " " . $_SESSION['lastname'];

$id = $_GET['id'];

$diary = $diaryDao->getDiaryById($id);

?>
<!-- Conteudo da Pagina-->
<div class="container-fluid" id="container-wrapper">
   <div class="d-sm-flex align-items-center justify-content-between mb-4">
      <h1 class="h3 mb-0 text-gray-800">DETALHES DO DIARIO </h1>
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
               <a title="Voltar" href="diary-consult.php"><button class=" btn btn-sm btn-success">Voltar <i class="fa-solid fa-rotate-left"></i></button></a>
            </div>
            <div class="content-wrapper">
               <div class="row">
                  <div class="col-md-12 grid-margin">
                     <div class="row">
                        <div class="col-12 grid-margin stretch-card">
                           <div class="card">
                              <div class="card-body">
                                 <form class="forms-sample" action="<?= $BASE_URL ?>config/diaryProcess.php" method="post">
                                    <div class="py-3 d-flex flex-row align-items-end justify-content-end">
                                    <h6><i class="fa-solid fa-user-pen"></i> <?= $diary['usuario'] ?></h6> &nbsp;&nbsp; 
                                    <h6><i class="fa-solid fa-calendar-day"></i> <?= date('d/m/Y', strtotime($diary["data_modificacao"])); ?></h6>
                                    </div>
                                    <input type="hidden" name="type" value="update">
                                    <input hidden value="<?= $usuario ?>" name="usuario" type="text">
                                    <input type="hidden" name="id" value="<?= $diary['id'] ?>">
                                    <div class="form-row">
                                       <div class="col-md-2">
                                          <div class="position-relative form-group">
                                             <label for="nte" class="">NTE</label>
                                             <input readonly value="0<?= $diary['nte'] ?>" name="nte" id="nte" type="text" class="form-control form-control-sm">
                                          </div>
                                       </div>
                                    </div>
                                    <div class="form-row">
                                       <div class="col-md-3">
                                          <div class="position-relative form-group">
                                             <label for="municipio" class="">Municipio</label>
                                             <input value="<?= $diary['municipio'] ?>" name="municipio" id="municipio" type="text" class="form-control form-control-sm">
                                          </div>
                                       </div>
                                       <div class="col-md-6">
                                          <div class="position-relative form-group">
                                             <label for="unidade_escolar" class="">Unidade Escolar</label>
                                             <input value="<?= $diary['unidade_escolar'] ?>" name="unidade_escolar" id="unidade_escolar" type="text" class="form-control form-control-sm">
                                          </div>
                                       </div>
                                       <div class="col-md-3">
                                          <div class="form-group">
                                             <label for="cod_unidade" class="">Cod. Unidade</label>
                                             <input value="<?= $diary['cod_unidade'] ?>" id="cod_unidade" name="cod_unidade" type="text" class="form-control form-control-sm" aria-label="Amount (to the nearest dollar)">
                                          </div>
                                       </div>
                                    </div>
                                    <div class="form-row">
                                       <div class="col-md-3">
                                          <div class="position-relative form-group">
                                             <label for="cadastro" class="">Cadastro</label>
                                             <input value="<?= $diary['cadastro'] ?>" name="cadastro" id="cadastro" type="text" class="form-control form-control-sm">
                                          </div>
                                       </div>
                                       <div class="col-md-6">
                                          <div class="position-relative form-group">
                                             <label for="nome" class="">Nome</label>
                                             <input value="<?= $diary['nome'] ?>" name="nome" id="nome" type="text" class="form-control form-control-sm">
                                          </div>
                                       </div>
                                       <div class="col-md-3">
                                          <div class="form-group">
                                             <label for="data_diario" class="">Data do Diario</label>
                                             <input value="<?= $diary['data_diario'] ?>" id="data_diario" name="data_diario" type="date" class="form-control form-control-sm">
                                          </div>
                                       </div>
                                    </div>
                                    <div class="form-row">
                                       <div class="col-md-3">
                                          <div class="position-relative form-group">
                                             <label for="periodo" class="">Periodo / Data</label>
                                             <input value="<?= $diary['periodo'] ?>" name="periodo" id="periodo" type="date" class="form-control form-control-sm">
                                          </div>
                                       </div>
                                       <div class="col-md-3">
                                          <div class="position-relative form-group">
                                             <label for="contato" class="">Contato com:</label>
                                             <input value="<?= $diary['contato'] ?>" name="contato" id="contato" type="text" class="form-control form-control-sm">
                                          </div>
                                       </div>
                                       <div class="position-relative col-md-3">
                                          <div class="form-group">
                                             <label class="control-label" for="disciplina_id">Metodo do Contato</label>
                                             <select name="modo_contato" id="vinculo" class="form-control form-control-sm">
                                                <option value="<?= $diary['modo_contato'] ?>" selected><?= $diary['modo_contato'] ?></option>
                                                <option value="Email">Email</option>
                                                <option value="Telefone">Telefone</option>
                                                <option value="">Sinal de fumação</option>
                                             </select>
                                          </div>
                                       </div>
                                       <div class="col-md-3">
                                          <div class="position-relative form-group">
                                             <label for="dia_contato" class="">Dia do contato</label>
                                             <input value="<?= $diary['dia_contato'] ?>" name="dia_contato" id="dia_contato" type="date" class="form-control form-control-sm">
                                          </div>
                                       </div>
                                    </div>
                                    <div class="form-row">
                                       <div class="mt-0 col-md-3">
                                          <div class="position-relative form-group">
                                             <label for="tipo" class="">Tipo</label>
                                             <select id="tipo" name="tipo" class="form-control" value="">
                                                <option class="text-dark" value="<?= $diary['tipo'] ?>" selected><?= $diary['tipo'] ?></option>
                                                <option class="" value="Aposentadoria">Aposentadoria</option>
                                                <option class="" value="Licença para curso">Licença para curso</option>
                                             </select>
                                          </div>
                                       </div>
                                       <div class="mt-0 col-md-3">
                                          <div class="position-relative form-group">
                                             <label for="situacao" class="">Situação</label>
                                             <select id="situacao" name="situacao" class="form-control" value="">
                                                <option class="text-dark" value="<?= $diary['situacao'] ?>" selected><?= $diary['situacao'] ?></option>
                                                <option class="" value="Pendente">Pendente</option>
                                                <option class="" value="Resolvido">Resolvido</option>
                                             </select>
                                          </div>
                                       </div>
                                    </div>
                                    <div class="form-group">
                                       <label for="obs">Observação</label>
                                       <textarea name="obs" class="form-control" id="obs" rows="5"><?= $diary['obs'] ?></textarea>
                                    </div>
                                    <a title="Salvar"><button type="submit" class=" btn bg-purple btn-primary mr-2 add-btn">Atualizar <i class="fa-solid fa-arrows-rotate"></i></button></a>
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