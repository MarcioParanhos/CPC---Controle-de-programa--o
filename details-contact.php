<?php

// include_once('./crud/read-contacts.php');
include("./layouts/header.php");
require_once("./dao/ContactsDAO.php");

$usuario = $_SESSION['name'] . " " . $_SESSION['lastname'];

$contactDao = new ContactsDAO($conn, $BASE_URL);

$id = $_GET['id'];

// passa o perfil do usuario como parametro para buscar os dados de determinado perfil
$contact = $contactDao->getContactsById($id);

?>
<!-- Conteudo da Pagina-->
<div class="container-fluid" id="container-wrapper">
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Contatos | <?= $contact["unidade_escolar"] ?> - 0<?= $contact["nte"] ?> </h1>
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="<?= $BASE_URL ?>home.php">Home</a></li>
            <li class="breadcrumb-item">Ntes</li>
            <li class="breadcrumb-item active" aria-current="page">Contatos</li>
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
                    <h6 class="m-0 font-weight-bold text-primary">NTE <?= $_SESSION['nte'] ?></h6>
                    <a title="Voltar" href="contacts.php?nte=<?= $_SESSION['nte'] ?>"><button class=" btn btn-sm btn-success voltar-btn">Voltar <i class="fa-solid fa-rotate-left"></i></button></a>
                </div>
                <div class="content-wrapper">
                    <div class="row">
                        <div class="col-md-12 grid-margin">
                            <div class="row">
                                <div class="col-12 grid-margin stretch-card">
                                    <div class="card">
                                        <div class="card-body">
                                            <form class="forms-sample" action="<?= $BASE_URL ?>config/contactsProcess.php" method="post">
                                                <div class="form-row">
                                                    <input type="hidden" name="type" value="update">
                                                    <input id="id" hidden value="<?= $contact['id'] ?>" name="id" type="number" class="form-control form-control-sm">
                                                    <input id="id" hidden value="<?= $contact['nte'] ?>" name="nte" type="number" class="form-control form-control-sm">
                                                    <div class="col-md-3">
                                                        <div class="position-relative form-group"><label for="municipio" class="">Municipio</label>
                                                            <input readonly value="<?= $contact["municipio"] ?>" name="municipio" id="municipio" type="text" class="form-control form-control-sm">
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="position-relative form-group"><label for="unidade_escolar" class="">Unidade
                                                                Escolar</label>
                                                            <input readonly value="<?= $contact["unidade_escolar"] ?>" name="unidade_escolar" required id="unidade_escolar" type="text" class="form-control form-control-sm">
                                                        </div>
                                                    </div>
                                                    <div class="col-md-3">
                                                        <div class="form-group">
                                                            <label for="cod_unidade" class="">Cod. Unidade</label>
                                                            <input readonly value="<?= $contact["cod_unidade"] ?>" name="cod_unidade" type="text" class="form-control form-control-sm" aria-label="Amount (to the nearest dollar)">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="form-row">
                                                    <div class="col-md-3">
                                                        <div class="position-relative form-group"><label for="gestor" class="">Diretor</label>
                                                            <input value="<?= $contact["gestor"] ?>" name="gestor" id="gestor" type="text" class="form-control form-control-sm">
                                                        </div>
                                                    </div>
                                                    <div class="col-md-2">
                                                        <div class="position-relative form-group"><label for="tel_gestor" class="">Tel.
                                                                Diretor</label>
                                                            <input value="<?= $contact["tel_gestor"] ?>" name="tel_gestor" id="tel" type="tel" class="form-control form-control-sm" pattern="\(\d{2}\)\s*\d{5}-\d{4}" required placeholder="(XX) XXXXX-XXXX">
                                                        </div>

                                                    </div>
                                                    <div class="col-md-3">
                                                        <div class="position-relative form-group"><label for="tel_unidade" class="">Tel. Unidade</label>
                                                            <input value="<?= $contact["tel_unidade"] ?>" name="tel_unidade" id="tel_unidade" type="tel" class="form-control form-control-sm" pattern="\(\d{2}\)\s*\d{4}-\d{4}" placeholder="(XX) XXXX-XXXX">
                                                        </div>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <div class="position-relative form-group"><label for="email_gestor" class="">E-mail Diretor</label>
                                                            <input value="<?= $contact["email_gestor"] ?>" name="email_gestor" id="email_gestor" type="text" class="form-control form-control-sm">
                                                        </div>

                                                    </div>

                                                </div>
                                                <div class="form-row">
                                                    <div class="col-md-3">
                                                        <div class="position-relative form-group"><label for="vice_gestor" class="">Vice-Diretor 1</label>
                                                            <input value="<?= $contact["vice_gestor"] ?>" name="vice_gestor" id="vice_gestor" type="text" class="form-control form-control-sm">
                                                        </div>
                                                    </div>
                                                    <div class="col-md-3">
                                                        <div class="position-relative form-group"><label for="tel_vice_gestor" class="">Tel. Vice-Diretor 1</label>
                                                            <input value="<?= $contact["tel_vice_gestor"] ?>" name="tel_vice_gestor" id="tel_vice_gestor" type="tel" class="form-control form-control-sm" placeholder="(XX) XXXXX-XXX">
                                                        </div>
                                                    </div>
                                                    <div class="col-md-3">
                                                        <div class="position-relative form-group"><label for="vice_gestor_2" class="">Vice-Diretor 2</label>
                                                            <input value="<?= $contact["vice_gestor_2"] ?>" name="vice_gestor_2" id="vice_gestor_2" type="text" class="form-control form-control-sm">
                                                        </div>
                                                    </div>
                                                    <div class="col-md-3">
                                                        <div class="position-relative form-group"><label for="tel_vice_gestor_2" class="">Tel. Vice-Diretor 2</label>
                                                            <input value="<?= $contact["tel_vice_gestor_2"] ?>" name="tel_vice_gestor_2" id="tel_vice_gestor_2" type="tel" class="form-control form-control-sm" placeholder="(XX) XXXXX-XXXX">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="form-row">
                                                    <div class="col-md-4">
                                                        <div class="position-relative form-group"><label for="responsavel_pch" class=""><strong>Responsavel pela programação</strong></label>
                                                            <input value="<?= $contact["responsavel_pch"] ?>" name="responsavel_pch" id="responsavel_pch" type="text" class="form-control form-control-sm">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label for="obs">Observação</label>
                                                    <textarea name="obs" class="form-control" id="obs" rows="5"><?= $contact["obs"] ?></textarea>
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
<!---Fim do Conteudo da Pagina-->
<?php

include("layouts/footer.php")

?>