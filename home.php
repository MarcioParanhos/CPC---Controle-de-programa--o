<?php

include_once('./crud/read-home.php');
include("layouts/header.php");
// $time = $red / 60;
// $number_format = number_format($time, 2, '.', '');

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
      <h1 class="h3 mb-0 text-gray-800">Dashboard</h1>
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="./home.php">Home</a></li>
        <li class="breadcrumb-item active" aria-current="page">Dashboard</li>
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
    <div class="row mb-3">
      <!-- Earnings (Monthly) Card Example -->
      <div class="col-xl-3 col-md-6 mb-4">
        <div class="card h-100">
          <div class="card-body borded-left">
            <div class="row align-items-center">
              <div class="col mr-2">
                <div class="text-xs font-weight-bold text-uppercase mb-1">Sedes Homologadas</div>
                <div class="h5 mb-0 font-weight-bold text-gray-800"><?= $countHomologadasSede ?></div>
                <div class="mt-2 mb-0 text-muted text-xs">
                  <!-- <span class="text-success mr-2"><i class="fa fa-arrow-up"></i> 3.48%</span>
                        <span>Since last month</span> -->
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
                <div class="h5 mb-0 font-weight-bold text-gray-800"><?= $countDigitadasSede ?></div>
                <div class="mt-2 mb-0 text-muted text-xs">
                  <!-- <span class="text-success mr-2"><i class="fas fa-arrow-up"></i> 12%</span>
                        <span>Since last years</span> -->
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
                <div class="h5 mb-0 font-weight-bold text-gray-800"><?= $countHomologadasPendentesSedes ?></div>
                <div class="mt-2 mb-0 text-muted text-xs">
                  <!-- <span class="text-danger mr-2"><i class="fas fa-arrow-down"></i> 1.10%</span>
                        <span>Since yesterday</span> -->
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
                <div class="h5 mb-0 mr-3 font-weight-bold text-gray-800"><?= $countCarencia_real ?></div>
                <div class="mt-2 mb-0 text-muted text-xs">
                  <!-- <span class="text-success mr-2"><i class="fas fa-arrow-up"></i> 20.4%</span>
                        <span>Since last month</span>-->
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
                <div class="h5 mb-0 font-weight-bold text-gray-800"><?= $countHomologadasAnexo ?></div>
                <div class="mt-2 mb-0 text-muted text-xs">
                  <!-- <span class="text-danger mr-2"><i class="fas fa-arrow-down"></i> 1.10%</span>
                        <span>Since yesterday</span> -->
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
                <div class="h5 mb-0 font-weight-bold text-gray-800"><?= $countDigitadasAnexo ?></div>
                <div class="mt-2 mb-0 text-muted text-xs">
                  <!-- <span class="text-danger mr-2"><i class="fas fa-arrow-down"></i> 1.10%</span>
                        <span>Since yesterday</span> -->
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
                <div class="h5 mb-0 font-weight-bold text-gray-800"><?= $countHomologadasPendentesAnexos ?></div>
                <div class="mt-2 mb-0 text-muted text-xs">
                  <!-- <span class="text-danger mr-2"><i class="fas fa-arrow-down"></i> 1.10%</span>
                        <span>Since yesterday</span> -->
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
                <div class="h5 mb-0 font-weight-bold text-gray-800"><?= $countCarencia_temp ?></div>
                <div class="mt-2 mb-0 text-muted text-xs">
                  <!-- <span class="text-danger mr-2"><i class="fas fa-arrow-down"></i> 1.10%</span>
                        <span>Since yesterday</span> -->
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>

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