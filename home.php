<?php

include("layouts/header.php");
require_once("./dao/NteDAO.php");
require_once("./dao/CarenciaDAO.php");

$nte = $_SESSION['nte_info_status'];

if ($nte == 'Todos') {
  $nteDao = new Controle_nteDAO($conn, $BASE_URL);
  $sedes_homologadas = $nteDao->getSedesHomologadas('Homologada');
  $anexos_homologados = $nteDao->getAnexosHomologados('Homologada');
  $sedes_digitadas = $nteDao->getSedesDigitadas();
  $anexos_digitados = $nteDao->getAnexosDigitados();
  $sedes_pendente_homologar = $nteDao->getSedesHomologadas('Pendente');
  $anexos_pendente_homologar = $nteDao->getAnexosHomologados('Pendente');
  $carenciaDao = new CarenciaDAO($conn, $BASE_URL);
  $vagasReais = $carenciaDao->getVagas('R');
  $vagasTemp = $carenciaDao->getVagas('T');
} else {
  $nteDao = new Controle_nteDAO($conn, $BASE_URL);
  $sedes_homologadas = $nteDao->getSedesHomologadasByNte('Homologada', $nte);
  $anexos_homologados = $nteDao->getAnexosHomologadosByNte('Homologada', $nte);
  $sedes_digitadas = $nteDao->getSedesDigitadasByNte($nte);
  $anexos_digitados = $nteDao->getAnexosDigitadoByNte($nte);
  $sedes_pendente_homologar = $nteDao->getSedesHomologadasByNte('Pendente', $nte);
  $anexos_pendente_homologar = $nteDao->getAnexosHomologadosByNte('Pendente', $nte);
  $carenciaDao = new CarenciaDAO($conn, $BASE_URL);
  $vagasReais = $carenciaDao->getVagasReaisByNte('R', $nte);
  $vagasTemp = $carenciaDao->getVagasTempByNte('T', $nte);
}



?>
<?php if ($_SESSION['perfil'] != 10) { ?>
  <!-- Container Fluid-->
  <div class="container-fluid" id="container-wrapper">
    <!-- <div class="alert alert-warning alert-dismissible fade show" role="alert">
      <strong>Bem vindo!</strong> Sua sessão irá encerrar automaticamente em <?= $number_format ?> minutos! 
      <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
      </button>
    </div> -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
      <h1 class="h3 mb-0 text-gray-800">Sintese de Programação - Nte ( <?= $nte ?> )</h1>
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="./home.php">Home</a></li>
        <li class="breadcrumb-item active" aria-current="page">Sintese de Programação</li>
      </ol>
    </div>
    <?php if (isset($printMsg) && $printMsg != '') : ?>
      <div class="green text-center alert alert-success alert-dismissible fade show" role="alert">
        <h5"><?= $printMsg ?></h5>
          <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
      </div>
    <?php endif; ?>
    <!-- SEARCH PARA SELECIONAR O GERAL DE CADA NTE -->
    <div class="d-flex flex-row align-items-center justify-content-end">
      <form class="navbar-search" action="<?= $BASE_URL ?>config/homeProcess.php" method="post">
        <div class="input-group-append">
          <select name="nte_search_home" id="nte_search_home" class="form-control-sm">
            <option value="" selected>Selecione o NTE</option>
            <option value="Todos">Todos</option>
            <option value="01">01</option>
            <option value="05">05</option>
            <option value="06">06</option>
            <option value="07">07</option>
            <option value="16">16</option>
            <option value="22">22</option>
          </select>
          <input hidden value="search" name="type" type="text">
          <button class="btn btn-sm btn-primary" type="submit">
            <i class="fa-solid fa-search"></i>
          </button>
        </div>
      </form>
    </div>
    <br>
    <div class="row mb-3">
      <div class="col-xl-3 col-md-6 mb-4">
        <div class="card h-100">
          <div class="card-body borded-left">
            <div class="row align-items-center">
              <div class="col mr-2">
                <div class="text-xs font-weight-bold text-uppercase mb-1">Sedes Homologadas</div>
                <div class="h5 mb-0 font-weight-bold text-gray-800"><?= $sedes_homologadas ?></div>
                <div class="mt-2 mb-0 text-muted text-xs">
                </div>
              </div>
              <div class="col-auto">
                <i class="fas fa-calendar fa-2x text-primary"></i>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="col-xl-3 col-md-6 mb-4">
        <div class="card h-100">
          <div class="card-body borded-left">
            <div class="row no-gutters align-items-center">
              <div class="col mr-2">
                <div class="text-xs font-weight-bold text-uppercase mb-1">Unidades Sede Digitadas</div>
                <div class="h5 mb-0 font-weight-bold text-gray-800"><?= $sedes_digitadas ?></div>
                <div class="mt-2 mb-0 text-muted text-xs">
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="col-xl-3 col-md-6 mb-4">
        <div class="card h-100">
          <div class="card-body borded-left">
            <div class="row no-gutters align-items-center">
              <div class="col mr-2">
                <div class="text-xs font-weight-bold text-uppercase mb-1">Sedes Pendentes Homologar</div>
                <div class="h5 mb-0 font-weight-bold text-gray-800"><?= $sedes_pendente_homologar ?></div>
                <div class="mt-2 mb-0 text-muted text-xs">
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="col-xl-3 col-md-6 mb-4">
        <div class="card h-100">
          <div class="card-body borded-left">
            <div class="row no-gutters align-items-center">
              <div class="col mr-2">
                <div class="text-xs font-weight-bold text-uppercase mb-1">Total de Carencia Real</div>
                <div class="h5 mb-0 mr-3 font-weight-bold text-gray-800"><?= $vagasReais ?></div>
                <div class="mt-2 mb-0 text-muted text-xs">
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="col-xl-3 col-md-6 mb-4">
        <div class="card h-100">
          <div class="card-body borded-left">
            <div class="row no-gutters align-items-center">
              <div class="col mr-2">
                <div class="text-xs font-weight-bold text-uppercase mb-1">Anexos Homologados</div>
                <div class="h5 mb-0 font-weight-bold text-gray-800"><?= $anexos_homologados ?></div>
                <div class="mt-2 mb-0 text-muted text-xs">
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="col-xl-3 col-md-6 mb-4">
        <div class="card h-100">
          <div class="card-body borded-left">
            <div class="row no-gutters align-items-center">
              <div class="col mr-2">
                <div class="text-xs font-weight-bold text-uppercase mb-1">Anexos Digitados</div>
                <div class="h5 mb-0 font-weight-bold text-gray-800"><?= $anexos_digitados ?></div>
                <div class="mt-2 mb-0 text-muted text-xs">
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="col-xl-3 col-md-6 mb-4">
        <div class="card h-100">
          <div class="card-body borded-left">
            <div class="row no-gutters align-items-center">
              <div class="col mr-2">
                <div class="text-xs font-weight-bold text-uppercase mb-1">Anexos Pendentes Homologar</div>
                <div class="h5 mb-0 font-weight-bold text-gray-800"><?= $anexos_pendente_homologar ?></div>
                <div class="mt-2 mb-0 text-muted text-xs">
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="col-xl-3 col-md-6 mb-4">
        <div class="card h-100">
          <div class="card-body borded-left">
            <div class="row no-gutters align-items-center">
              <div class="col mr-2">
                <div class="text-xs font-weight-bold text-uppercase mb-1">Total de Carencia Temporaria</div>
                <div class="h5 mb-0 font-weight-bold text-gray-800"><?= $vagasTemp ?></div>
                <div class="mt-2 mb-0 text-muted text-xs">
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
      <?php if ($_SESSION['perfil'] != 0) { ?>
        <div class="table-responsive mt-2 p-1 ">
          <table class="table compact table-hover  align-items-center table-flush">
            <thead class="bg-primary">
              <tr>
                <th id="th-start" class="text-center">NTE</th>
                <th class="text-center">QTD. UNIDADES</th>
                <th class="text-center">SEDES</th>
                <th class="text-center">ANEXOS</th>
                <th class="text-center">EMITEC</th>
                <th class="text-center">SEDES DIGITADAS</th>
                <th class="text-center">ANEXOS DIGITADOS</th>
                <th class="text-center">SEDES HOMOLOGADAS</th>
                <th id="th-end" class="text-center">ANEXOS HOMOLOGADOS</th>
              </tr>
            </thead>
            <?php if ($_SESSION['perfil'] == 4) { ?>
              <tbody>
                <td class="text-center"><strong>01</strong></td>
                <td class="text-center"><?= $countUnidadesNte01 ?></td>
                <td class="text-center"><?= $countUnidadesNte01Sedes ?></td>
                <td class="text-center"><?= $countUnidadesNte01Anexos ?></td>
                <td class="text-center">0</td>
                <td class="text-center"><?= $countDigitadasSedeNte01 ?></td>
                <td class="text-center"><?= $countDigitadasAnexoNte01 ?></td>
                <td class="text-center"><?= $countHomologadasSedeNte01 ?></td>
                <td class="text-center"><?= $countHomologadasAnexoNte01 ?></td>
                </tr>
              </tbody>
            <?php } ?>
            <?php if ($_SESSION['perfil'] == 3) { ?>
              <tbody>
                <td class="text-center">02</td>
                <td class="text-center">29</td>
                <td class="text-center">15</td>
                <td class="text-center">7</td>
                <td class="text-center">0</td>
                <td class="text-center">0</td>
                <td class="text-center">0</td>
                <td class="text-center">0</td>
                <td class="text-center">0</td>
                </tr>
              </tbody>
            <?php } ?>
            <?php if ($_SESSION['perfil'] == 1) { ?>
              <tbody>
                <td class="text-center">03</td>
                <td class="text-center">29</td>
                <td class="text-center">15</td>
                <td class="text-center">7</td>
                <td class="text-center">0</td>
                <td class="text-center">0</td>
                <td class="text-center">0</td>
                <td class="text-center">0</td>
                <td class="text-center">0</td>
                </tr>
              </tbody>
            <?php } ?>
            <?php if ($_SESSION['perfil'] == 1) { ?>
              <tbody>
                <td class="text-center">04</td>
                <td class="text-center">29</td>
                <td class="text-center">15</td>
                <td class="text-center">7</td>
                <td class="text-center">0</td>
                <td class="text-center">0</td>
                <td class="text-center">0</td>
                <td class="text-center">0</td>
                <td class="text-center">0</td>
                </tr>
              </tbody>
            <?php } ?>
            <?php if ($_SESSION['perfil'] == 4) { ?>
              <tbody>
                <td class="text-center"><strong>05</strong></td>
                <td class="text-center"><?= $countUnidadesNte05 ?></td>
                <td class="text-center"><?= $countUnidadesNte05Sedes ?></td>
                <td class="text-center"><?= $countUnidadesNte05Anexos ?></td>
                <td class="text-center">0</td>
                <td class="text-center"><?= $countDigitadasSedeNte05 ?></td>
                <td class="text-center"><?= $countDigitadasAnexoNte05 ?></td>
                <td class="text-center"><?= $countHomologadasSedeNte05 ?></td>
                <td class="text-center"><?= $countHomologadasAnexoNte05 ?></td>
                </tr>
              </tbody>
            <?php } ?>
            <?php if ($_SESSION['perfil'] == 4) { ?>
              <tbody>
                <td class="text-center"><strong>06</strong></td>
                <td class="text-center">29</td>
                <td class="text-center">15</td>
                <td class="text-center">7</td>
                <td class="text-center">0</td>
                <td class="text-center">0</td>
                <td class="text-center">0</td>
                <td class="text-center">0</td>
                <td class="text-center">0</td>
                </tr>
              </tbody>
            <?php } ?>
            <?php if ($_SESSION['perfil'] == 4) { ?>
              <tbody>
                <td class="text-center"><strong>07</strong></td>
                <td class="text-center">29</td>
                <td class="text-center">15</td>
                <td class="text-center">7</td>
                <td class="text-center">0</td>
                <td class="text-center">0</td>
                <td class="text-center">0</td>
                <td class="text-center">0</td>
                <td class="text-center">0</td>
                </tr>
              </tbody>
            <?php } ?>
            <?php if ($_SESSION['perfil'] == 1) { ?>
              <tbody>
                <td class="text-center">08</td>
                <td class="text-center">29</td>
                <td class="text-center">15</td>
                <td class="text-center">7</td>
                <td class="text-center">0</td>
                <td class="text-center">0</td>
                <td class="text-center">0</td>
                <td class="text-center">0</td>
                <td class="text-center">0</td>
                </tr>
              </tbody>
            <?php } ?>
            <?php if ($_SESSION['perfil'] == 1) { ?>
              <tbody>
                <td class="text-center">09</td>
                <td class="text-center">29</td>
                <td class="text-center">15</td>
                <td class="text-center">7</td>
                <td class="text-center">0</td>
                <td class="text-center">0</td>
                <td class="text-center">0</td>
                <td class="text-center">0</td>
                <td class="text-center">0</td>
                </tr>
              </tbody>
            <?php } ?>
            <?php if ($_SESSION['perfil'] == 3) { ?>
              <tbody>
                <td class="text-center">10</td>
                <td class="text-center">29</td>
                <td class="text-center">15</td>
                <td class="text-center">7</td>
                <td class="text-center">0</td>
                <td class="text-center">0</td>
                <td class="text-center">0</td>
                <td class="text-center">0</td>
                <td class="text-center">0</td>
                </tr>
              </tbody>
            <?php } ?>
            <?php if ($_SESSION['perfil'] == 1) { ?>
              <tbody>
                <td class="text-center">11</td>
                <td class="text-center">29</td>
                <td class="text-center">15</td>
                <td class="text-center">7</td>
                <td class="text-center">0</td>
                <td class="text-center">0</td>
                <td class="text-center">0</td>
                <td class="text-center">0</td>
                <td class="text-center">0</td>
                </tr>
              </tbody>
            <?php } ?>
            <?php if ($_SESSION['perfil'] == 1) { ?>
              <tbody>
                <td class="text-center">12</td>
                <td class="text-center">29</td>
                <td class="text-center">15</td>
                <td class="text-center">7</td>
                <td class="text-center">0</td>
                <td class="text-center">0</td>
                <td class="text-center">0</td>
                <td class="text-center">0</td>
                <td class="text-center">0</td>
                </tr>
              </tbody>
            <?php } ?>
            <?php if ($_SESSION['perfil'] == 1) { ?>
              <tbody>
                <td class="text-center">13</td>
                <td class="text-center">29</td>
                <td class="text-center">15</td>
                <td class="text-center">7</td>
                <td class="text-center">0</td>
                <td class="text-center">0</td>
                <td class="text-center">0</td>
                <td class="text-center">0</td>
                <td class="text-center">0</td>
                </tr>
              </tbody>
            <?php } ?>
            <?php if ($_SESSION['perfil'] == 3) { ?>
              <tbody>
                <td class="text-center">14</td>
                <td class="text-center">29</td>
                <td class="text-center">15</td>
                <td class="text-center">7</td>
                <td class="text-center">0</td>
                <td class="text-center">0</td>
                <td class="text-center">0</td>
                <td class="text-center">0</td>
                <td class="text-center">0</td>
                </tr>
              </tbody>
            <?php } ?>
            <?php if ($_SESSION['perfil'] == 1) { ?>
              <tbody>
                <td class="text-center">15</td>
                <td class="text-center">29</td>
                <td class="text-center">15</td>
                <td class="text-center">7</td>
                <td class="text-center">0</td>
                <td class="text-center">0</td>
                <td class="text-center">0</td>
                <td class="text-center">0</td>
                <td class="text-center">0</td>
                </tr>
              </tbody>
            <?php } ?>
            <?php if ($_SESSION['perfil'] == 4) { ?>
              <tbody>
                <td class="text-center"><strong>16</strong></td>
                <td class="text-center">29</td>
                <td class="text-center">15</td>
                <td class="text-center">7</td>
                <td class="text-center">0</td>
                <td class="text-center">0</td>
                <td class="text-center">0</td>
                <td class="text-center">0</td>
                <td class="text-center">0</td>
                </tr>
              </tbody>
            <?php } ?>
            <?php if ($_SESSION['perfil'] == 1) { ?>
              <tbody>
                <td class="text-center">17</td>
                <td class="text-center">29</td>
                <td class="text-center">15</td>
                <td class="text-center">7</td>
                <td class="text-center">0</td>
                <td class="text-center">0</td>
                <td class="text-center">0</td>
                <td class="text-center">0</td>
                <td class="text-center">0</td>
                </tr>
              </tbody>
            <?php } ?>
            <?php if ($_SESSION['perfil'] == 3) { ?>
              <tbody>
                <td class="text-center">18</td>
                <td class="text-center">29</td>
                <td class="text-center">15</td>
                <td class="text-center">7</td>
                <td class="text-center">0</td>
                <td class="text-center">0</td>
                <td class="text-center">0</td>
                <td class="text-center">0</td>
                <td class="text-center">0</td>
                </tr>
              </tbody>
            <?php } ?>
            <?php if ($_SESSION['perfil'] == 1) { ?>
              <tbody>
                <td class="text-center">19</td>
                <td class="text-center">29</td>
                <td class="text-center">15</td>
                <td class="text-center">7</td>
                <td class="text-center">0</td>
                <td class="text-center">0</td>
                <td class="text-center">0</td>
                <td class="text-center">0</td>
                <td class="text-center">0</td>
                </tr>
              </tbody>
            <?php } ?>
            <?php if ($_SESSION['perfil'] == 1) { ?>
              <tbody>
                <td class="text-center">20</td>
                <td class="text-center">29</td>
                <td class="text-center">15</td>
                <td class="text-center">7</td>
                <td class="text-center">0</td>
                <td class="text-center">0</td>
                <td class="text-center">0</td>
                <td class="text-center">0</td>
                <td class="text-center">0</td>
                </tr>
              </tbody>
            <?php } ?>
            <?php if ($_SESSION['perfil'] == 1) { ?>
              <tbody>
                <td class="text-center">21</td>
                <td class="text-center">29</td>
                <td class="text-center">15</td>
                <td class="text-center">7</td>
                <td class="text-center">0</td>
                <td class="text-center">0</td>
                <td class="text-center">0</td>
                <td class="text-center">0</td>
                <td class="text-center">0</td>
                </tr>
              </tbody>
            <?php } ?>
            <?php if ($_SESSION['perfil'] == 4) { ?>
              <tbody>
                <td class="text-center"><strong>22</strong></td>
                <td class="text-center">29</td>
                <td class="text-center">15</td>
                <td class="text-center">7</td>
                <td class="text-center">0</td>
                <td class="text-center">0</td>
                <td class="text-center">0</td>
                <td class="text-center">0</td>
                <td class="text-center">0</td>
                </tr>
              </tbody>
            <?php } ?>
            <?php if ($_SESSION['perfil'] == 3) { ?>
              <tbody>
                <td class="text-center">23</td>
                <td class="text-center">29</td>
                <td class="text-center">15</td>
                <td class="text-center">7</td>
                <td class="text-center">0</td>
                <td class="text-center">0</td>
                <td class="text-center">0</td>
                <td class="text-center">0</td>
                <td class="text-center">0</td>
                </tr>
              </tbody>
            <?php } ?>
            <?php if ($_SESSION['perfil'] == 1) { ?>
              <tbody>
                <td class="text-center">24</td>
                <td class="text-center">29</td>
                <td class="text-center">15</td>
                <td class="text-center">7</td>
                <td class="text-center">0</td>
                <td class="text-center">0</td>
                <td class="text-center">0</td>
                <td class="text-center">0</td>
                <td class="text-center">0</td>
                </tr>
              </tbody>
            <?php } ?>
            <?php if ($_SESSION['perfil'] == 1) { ?>
              <tbody>
                <td class="text-center">25</td>
                <td class="text-center">29</td>
                <td class="text-center">15</td>
                <td class="text-center">7</td>
                <td class="text-center">0</td>
                <td class="text-center">0</td>
                <td class="text-center">0</td>
                <td class="text-center">0</td>
                <td class="text-center">0</td>
                </tr>
              </tbody>
            <?php } ?>
            <?php if ($_SESSION['perfil'] == 1) { ?>
              <tbody>
                <td class="text-center">26</td>
                <td class="text-center">29</td>
                <td class="text-center">15</td>
                <td class="text-center">7</td>
                <td class="text-center">0</td>
                <td class="text-center">0</td>
                <td class="text-center">0</td>
                <td class="text-center">0</td>
                <td class="text-center">0</td>
                </tr>
              </tbody>
            <?php } ?>
            <?php if ($_SESSION['perfil'] == 3) { ?>
              <tbody>
                <td class="text-center">27</td>
                <td class="text-center">29</td>
                <td class="text-center">15</td>
                <td class="text-center">7</td>
                <td class="text-center">0</td>
                <td class="text-center">0</td>
                <td class="text-center">0</td>
                <td class="text-center">0</td>
                <td class="text-center">0</td>
                </tr>
              </tbody>
            <?php } ?>
          </table>
          <div class="card-footer"></div>
        </div>
      <?php } ?>
    </div>
    <!-- </div>
  </div>
  </div> -->
    <!--Row-->
  </div>
<?php } ?>
<?php if ($_SESSION['perfil'] == 10) { ?>
  <div class="container-fluid">
    <h1>SOLICITE AO ADMINISTRADOR A MUDANÇA DE PERFIL PARA ULTILIZAR O SISTEMA</h1>
    <h2>Você será redirecionado em breve para a tela de login</h2>
  </div>
<?php } ?>
<!---Container Fluid-->

<?php


include("layouts/footer.php")

?>