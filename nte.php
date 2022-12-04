<?php

include("./layouts/header.php");
require_once("./dao/NteDAO.php");

$usuario = $_SESSION['name'] . " " . $_SESSION['lastname'];
$nte = $_GET['nte'];
$_SESSION['nte'] = $nte;


$nteDao = new Controle_nteDAO($conn, $BASE_URL);

// passa o perfil do usuario como parametro para buscar os dados de determinado perfil
$ntes = $nteDao->getNtes($nte);

?>

<!-- Conteudo da Pagina-->
<div class="container-fluid" id="container-wrapper">
  <div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="title_style h3 mb-0 text-gray-800">CONTROLE DE PROGRAMAÇÃO - NTE 0<?= $nte ?></h1>
    <ol class="breadcrumb">
      <li class="breadcrumb-item"><a href="<?= $BASE_URL ?>home.php">Home</a></li>
      <li class="breadcrumb-item">Ntes</li>
      <li class="breadcrumb-item active" aria-current="page">Controle</li>
    </ol>
  </div>
  <!--Row-->
  <div class="row">
    <div class="col-lg-12 mb-4">
      <!-- Tabela Simples -->
      <div class="card">
        <div class="card-header py-3 d-flex flex-row align-items-center justify-content-end">
          <a title="Contatos Gestores" href="contacts.php?nte=<?= $_SESSION['nte'] ?>"><button class=" btn btn-sm btn-success">CONTATOS <i class="fa-solid fa-phone-volume"> </i></button></a>
          <a title="Gerar PDF" href="gerar_planilha.php?tipo=r&id=<?= $controle_nte["id"] ?>"><button class="btn-sm btn btn-success">Excel <i class="fa-solid fa-file-export"></i></button></a>
        </div>
        <div class="table-responsive mt-2 p-1 ">
          <table id="myTable" class="table compact table-hover align-items-center table-flush">
            <thead class="thead-light">
              <tr>
                <th class="text-center">Municipio</th>
                <th>Unidade Escolar</th>
                <th class="text-center">Cod. Sec</th>
                <th class="text-center">Sit. Digitação</th>
                <th class="text-center">Sit. Homologação</th>
                <th class="text-center">Carencia</th>
                <th class="text-center">Componente</th>
                <th class="text-center">Detalhar</th>
              </tr>
            </thead>
            <tbody>
              <?php foreach ($ntes as $nte) : ?>
                <tr class="">
                  <td class=""><?= $nte->municipio  ?></td>
                  <td class=""><?= $nte->unidade_escolar  ?></td>
                  <td class="text-center"><?= $nte->cod_unidade  ?></td>
                  <td class="text-center"><?= $nte->digitacao  ?></td>
                  <td class="text-center"><?= $nte->homologacao  ?></td>
                  <td class="text-center"><?= $nte->carencia  ?></td>
                  <td class="text-center"><?= $nte->componente  ?></td>
                  <td class="text-center"><a href="details-nte.php?id=<?= $nte->id  ?>"><button class="btn btn-sm btn-primary"><i class="fas fa-search"></i></button></a></td>
                </tr>
              <?php endforeach; ?>
            </tbody>
          </table>
          <br>
          R - Real <br>
          T - Temporária
          <br>
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