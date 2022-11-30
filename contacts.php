<?php

// include_once('./crud/read-contacts.php');
include("./layouts/header.php");
require_once("./dao/ContactsDAO.php");

$usuario = $_SESSION['name'] . " " . $_SESSION['lastname'];

$contactDao = new ContactsDAO($conn, $BASE_URL);

$nte = $_GET['nte'];

// passa o perfil do usuario como parametro para buscar os dados de determinado perfil
$contacts = $contactDao->getContacts($nte);


?>
<!-- Conteudo da Pagina-->
<div class="container-fluid" id="container-wrapper">
  <div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">Contatos Unidades Escolares</h1>
    <ol class="breadcrumb">
      <li class="breadcrumb-item"><a href="./">Home</a></li>
      <li class="breadcrumb-item">Ntes</li>
      <li class="breadcrumb-item active" aria-current="page">Contatos</li>
    </ol>
  </div>
  <div class="row">
    <div class="col-lg-12 mb-4">
      <!-- Simple Tables -->
      <div class="card">
        <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
          <h6 class="m-0 font-weight-bold text-primary">NTE <?= $_SESSION['nte'] ?></h6>
          <a title="Voltar" href="nte.php?nte=<?= $_SESSION['nte'] ?>"><button class="btn btn-sm btn-success voltar-btn">Voltar <i class="fa-solid fa-rotate-left"></i></button></a>
        </div>
        <div class="table-responsive mt-2 p-1 compact">
          <table id="myTable" class="table table-hover align-items-center table-flush">
            <thead class="thead-light">
              <tr>
                <th>Municipio</th>
                <th>Unidade</th>
                <th>Cod. Unidade</th>
                <th>Diretor</th>
                <th>Tel. Diretor</th>
                <th class="text-center">Detalhar Contatos</th>
              </tr>
            </thead>
            <tbody>
              <?php foreach ($contacts as $contact) : ?>
                <tr class="">
                  <td class=""><?= $contact->municipio ?></td>
                  <td class=""><?= $contact->unidade_escolar ?></td>
                  <td class=""><?= $contact->cod_unidade ?></td>
                  <td class=""><?= $contact->gestor ?></td>
                  <td class=""><?= $contact->tel_gestor ?></td>
                  <td class="text-center"><a href="details-contact.php?id=<?= $contact->id ?>"><button class="btn btn-sm btn-primary"><i class="fas fa-search"></i></button></a></td>
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
<!---Fim do Conteudo da Pagina-->
<?php

include("layouts/footer.php")

?>