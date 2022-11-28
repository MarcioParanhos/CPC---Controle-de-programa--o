<?php


session_start();
// if (!isset($_SESSION['start_login'])) { // se não tiver pego tempo que logou
//     $_SESSION['start_login'] = time(); //pega tempo que logou
//     // adiciona 30 segundos ao tempo e grava em outra variável de sessão
//     $_SESSION['logout_time'] = $_SESSION['start_login'] + 30 * 120;
// }
// // se o tempo atual for maior que o tempo de logout
// if (time() >= $_SESSION['logout_time']) {
//     header("location:./config/auth.php"); //vai para logout
//     session_destroy();
// }else {
//     $red = $_SESSION['logout_time'] - time(); // tempo que falta
// }

require_once("./models/Nte.php");
require_once("./models/Excedentes.php");
require_once("./models/Diary.php");
require_once("./models/Contacts.php");
require_once("./models/Message.php");
require_once("./models/Carencia.php");
require_once("./models/User.php");
// Import dos arquivos necessarios
require_once('./config/url.php');
require_once('./config/conect.php');
require_once('dompdf/autoload.inc.php');
// Reseta a mensagem que aparece no crud
if (isset($_SESSION['msg'])) {
    // Exibe a mensagem de registro
    $printMsg = $_SESSION['msg'];
    // Logo apos imprimir a mensagem de registro a mensagem e resetada
    $_SESSION['msg'] = '';
    // fim do reseta a mensagem que aparece no crud
}

if (!$_SESSION['name']) {
    header('Location: index.php');
    exit();
}
if ($_SESSION['perfil'] == 10) {
    header('Refresh: 10; URL=index.php');
}


?>
<!-- Inicio do Header do sistema -->
<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <link href="img/logo/logo.png" rel="icon">
    <title>CPC - Controle de Programação</title>
    <!-- Link do Arquivo BootsTrap onde são feitas as alterações no cod. do bootstrap -->
    <link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css">
    <!-- Link do CSS do Sistema -->
    <link href="assets/css/styles.css" rel="stylesheet">
    <!-- Import do DataTables -->
    <link rel="stylesheet" href="//cdn.datatables.net/1.12.1/css/jquery.dataTables.min.css">
    <!-- Icones do sistema -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">
</head>

<body id="page-top">
    <div id="wrapper">
        <!-- Sidebar -->
        <ul class="navbar-nav sidebar sidebar-light accordion" id="accordionSidebar">
            <a class="sidebar-brand d-flex align-items-center justify-content-center" href="home.php">
                <div class="sidebar-brand-icon">
                </div>
                <div class="sidebar-brand-text mx-3">CPC Programação</div>
            </a>
            <hr class="sidebar-divider my-0">
            <li class="nav-item active">
                <a class="nav-link" href="home.php"><i class="fas fa-home"></i><span>HOME</span></a>
            </li>
            <?php if ($_SESSION['perfil'] != 10 && $_SESSION['perfil'] != 0) { ?>
                <hr class="sidebar-divider">
                <div class="sidebar-heading">Gerencial</div>
                <li class=" nav-item">
                    <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseBootstrap" aria-expanded="true" aria-controls="collapseBootstrap">
                        <i class="far fa-fw fa-window-maximize"></i>
                        <span>NTES</span>
                    </a>
                    <div id="collapseBootstrap" class="collapse" aria-labelledby="headingBootstrap" data-parent="#accordionSidebar">
                        <div class="bg-white py-2 collapse-inner rounded">
                            <h6 class="collapse-header">Controle</h6>
                            <?php if ($_SESSION['perfil'] == 4) { ?>
                                <a class="collapse-item" href="nte.php?nte=1"><i class="fa-solid fa-angle-right"></i> 01</a>
                                <?php } ?><?php if ($_SESSION['perfil'] == 3) { ?>
                                <a class="collapse-item" href="nte.php?nte=2"><i class="fa-solid fa-angle-right"></i> 02</a>
                                <?php } ?><?php if ($_SESSION['perfil'] == 1) { ?>
                                <a class="collapse-item" href="nte.php?nte=3"><i class="fa-solid fa-angle-right"></i> 03</a>
                                <?php } ?><?php if ($_SESSION['perfil'] == 1) { ?>
                                <a class="collapse-item" href="nte.php?nte=4"><i class="fa-solid fa-angle-right"></i> 04</a>
                                <?php } ?><?php if ($_SESSION['perfil'] == 4) { ?>
                                <a class="collapse-item" href="nte.php?nte=5"><i class="fa-solid fa-angle-right"></i> 05</a>
                                <?php } ?><?php if ($_SESSION['perfil'] == 4) { ?>
                                <a class="collapse-item" href="nte.php?nte=6"><i class="fa-solid fa-angle-right"></i> 06</a>
                                <?php } ?><?php if ($_SESSION['perfil'] == 4) { ?>
                                <a class="collapse-item" href="nte.php?nte=7"><i class="fa-solid fa-angle-right"></i> 07</a>
                                <?php } ?><?php if ($_SESSION['perfil'] == 1) { ?>
                                <a class="collapse-item" href="nte.php?nte=8"><i class="fa-solid fa-angle-right"></i> 08</a>
                                <?php } ?><?php if ($_SESSION['perfil'] == 1) { ?>
                                <a class="collapse-item" href="nte.php?nte=9"><i class="fa-solid fa-angle-right"></i> 09</a>
                                <?php } ?><?php if ($_SESSION['perfil'] == 3) { ?>
                                <a class="collapse-item" href="nte.php?nte=10"><i class="fa-solid fa-angle-right"></i> 10</a>
                                <?php } ?><?php if ($_SESSION['perfil'] == 1) { ?>
                                <a class="collapse-item" href="nte.php?nte=11"><i class="fa-solid fa-angle-right"></i> 11</a>
                                <?php } ?><?php if ($_SESSION['perfil'] == 1) { ?>
                                <a class="collapse-item" href="nte.php?nte=12"><i class="fa-solid fa-angle-right"></i> 12</a>
                                <?php } ?><?php if ($_SESSION['perfil'] == 1) { ?>
                                <a class="collapse-item" href="nte.php?nte=13"><i class="fa-solid fa-angle-right"></i> 13</a>
                                <?php } ?><?php if ($_SESSION['perfil'] == 3) { ?>
                                <a class="collapse-item" href="nte.php?nte=14"><i class="fa-solid fa-angle-right"></i> 14</a>
                                <?php } ?><?php if ($_SESSION['perfil'] == 1) { ?>
                                <a class="collapse-item" href="nte.php?nte=15"><i class="fa-solid fa-angle-right"></i> 15</a>
                                <?php } ?><?php if ($_SESSION['perfil'] == 4) { ?>
                                <a class="collapse-item" href="nte.php?nte=16"><i class="fa-solid fa-angle-right"></i> 16</a>
                                <?php } ?><?php if ($_SESSION['perfil'] == 1) { ?>
                                <a class="collapse-item" href="nte.php?nte=17"><i class="fa-solid fa-angle-right"></i> 17</a>
                                <?php } ?><?php if ($_SESSION['perfil'] == 3) { ?>
                                <a class="collapse-item" href="nte.php?nte=18"><i class="fa-solid fa-angle-right"></i> 18</a>
                                <?php } ?><?php if ($_SESSION['perfil'] == 1) { ?>
                                <a class="collapse-item" href="nte.php?nte=19"><i class="fa-solid fa-angle-right"></i> 19</a>
                                <?php } ?><?php if ($_SESSION['perfil'] == 1) { ?>
                                <a class="collapse-item" href="nte.php?nte=20"><i class="fa-solid fa-angle-right"></i> 20</a>
                                <?php } ?><?php if ($_SESSION['perfil'] == 1) { ?>
                                <a class="collapse-item" href="nte.php?nte=21"><i class="fa-solid fa-angle-right"></i> 21</a>
                                <?php } ?><?php if ($_SESSION['perfil'] == 4) { ?>
                                <a class="collapse-item" href="nte.php?nte=22"><i class="fa-solid fa-angle-right"></i> 22</a>
                                <?php } ?><?php if ($_SESSION['perfil'] == 3) { ?>
                                <a class="collapse-item" href="nte.php?nte=23"><i class="fa-solid fa-angle-right"></i> 23</a>
                                <?php } ?><?php if ($_SESSION['perfil'] == 1) { ?>
                                <a class="collapse-item" href="nte.php?nte=24"><i class="fa-solid fa-angle-right"></i> 24</a>
                                <?php } ?><?php if ($_SESSION['perfil'] == 1) { ?>
                                <a class="collapse-item" href="nte.php?nte=25"><i class="fa-solid fa-angle-right"></i> 25</a>
                                <?php } ?><?php if ($_SESSION['perfil'] == 1) { ?>
                                <a class="collapse-item" href="nte.php?nte=26"><i class="fa-solid fa-angle-right"></i> 26</a>
                                <?php } ?><?php if ($_SESSION['perfil'] == 3) { ?>
                                <a class="collapse-item" href="nte.php?nte=27"><i class="fa-solid fa-angle-right"></i> 27</a>
                            <?php } ?>
                        </div>
                    </div>
                </li>
                <li class="nav-item">
                    <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#CollapseCarencia" aria-expanded="true" aria-controls="collapseForms">
                        <i class="fa-solid fa-chalkboard-user"></i><span>CARÊNCIA</span></a>
                    <div id="CollapseCarencia" class="collapse" aria-labelledby="headingForm" data-parent="#accordionSidebar">
                        <div class="bg-white py-2 collapse-inner rounded">
                            <h6 class="collapse-header">Real e Temporária</h6>
                            <a class="collapse-item" href="include-carencia.php?id="><i class="fa-solid fa-magnifying-glass-plus"></i> REAL</a>
                            <a class="collapse-item" href="include-carencia-temporaria.php?id="><i class="fa-solid fa-magnifying-glass-plus"></i> TEMPORÁRIA</a>
                        </div>
                    </div>
                </li>
                <li class="nav-item">
                    <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#CollapseExedentes" aria-expanded="true" aria-controls="collapseForms">
                        <i class="fa-solid fa-user-large-slash"></i>
                        <span>EXCEDENTES</span>
                    </a>
                    <div id="CollapseExedentes" class="collapse" aria-labelledby="headingForm" data-parent="#accordionSidebar">
                        <div class="bg-white py-2 collapse-inner rounded">
                            <h6 class="collapse-header">Controle de Excedentes</h6>
                            <!-- <a class="collapse-item" href="#"><i class="fa-solid fa-plus"></i> INCLUIR</a> -->
                            <a class="collapse-item" href="excedentes.php"><i class="fa-solid fa-magnifying-glass-plus"></i> CONSULTAR / ADICIONAR</a>
                        </div>
                    </div>
                </li>
                <li class="nav-item">
                    <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#CollapseRegFuncional" aria-expanded="true" aria-controls="collapseForms">
                        <i class="fa-solid fa-users"></i>
                        <span>REG. FUNCIONAL</span>
                    </a>
                    <div id="CollapseRegFuncional" class="collapse" aria-labelledby="headingForm" data-parent="#accordionSidebar">
                        <div class="bg-white py-2 collapse-inner rounded">
                            <h6 class="collapse-header">Regularização Funcional</h6>
                            <a class="collapse-item" href="#"><i class="fa-solid fa-plus"></i> INCLUIR</a>
                            <a class="collapse-item" href="excedentes.php"><i class="fa-solid fa-magnifying-glass"></i> CONSULTAR</a>
                        </div>
                    </div>
                </li>
                <li class="nav-item">
                    <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseForms" aria-expanded="true" aria-controls="collapseForms">
                        <i class="fab fa-fw fa-wpforms"></i>
                        <span>DIARIO</span>
                    </a>
                    <div id="collapseForms" class="collapse" aria-labelledby="headingForm" data-parent="#accordionSidebar">
                        <div class="bg-white py-2 collapse-inner rounded">
                            <h6 class="collapse-header">Diario Oficial</h6>
                            <a class="collapse-item" href="include-diary.php"><i class="fa-solid fa-plus"></i> INCLUIR</a>
                            <a class="collapse-item" href="diary-consult.php"><i class="fa-solid fa-magnifying-glass"></i> CONSULTAR</a>
                        </div>
                    </div>
                </li>
                <li class="nav-item">
                    <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseForm" aria-expanded="true" aria-controls="collapseForm">
                        <i class="fa-solid fa-file-waveform"></i>
                        <span>RELATORIOS</span>
                    </a>
                    <div id="collapseForm" class="collapse" aria-labelledby="headingForm" data-parent="#accordionSidebar">
                        <div class="bg-white py-2 collapse-inner rounded">
                            <h6 class="collapse-header">Gerenciais</h6>
                            <a class="collapse-item" href="<?= $BASE_URL ?>searchCarencias.php"><i class="fa-solid fa-file-waveform"></i></i> CARÊNCIA</a>
                            <a class="collapse-item" href="#"><i class="fa-solid fa-file-waveform"></i></i> EXEDENTES</a>
                            <a class="collapse-item" href="#"><i class="fa-solid fa-file-waveform"></i></i> REG. FUNCIONAL</a>
                        </div>
                    </div>
                </li>
            <?php } ?>
            <hr class="sidebar-divider">
            <?php if ($_SESSION['perfil'] == 0) { ?>
                <div class="sidebar-heading">
                    Configuração
                </div>
                <li class="nav-item">
                    <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapsePage" aria-expanded="true" aria-controls="collapsePage">
                        <i class="fa-solid fa-user"></i>
                        <span>USUARIOS</span>
                    </a>
                    <div id="collapsePage" class="collapse" aria-labelledby="headingPage" data-parent="#accordionSidebar">
                        <div class="bg-white py-2 collapse-inner rounded">
                            <a class="collapse-item" href="./users.php"><i class="fa-solid fa-user-gear"></i> EDITAR USUARIO</a>
                        </div>
                    </div>
                </li>
                <hr class="sidebar-divider">
            <?php } ?>
            <div class="version" id="version-ruangadmin"></div>
        </ul>
        <!-- Sidebar -->
        <div id="content-wrapper" class=" d-flex flex-column">
            <div id="content">
                <!-- TopBar -->
                <nav class="navbar navbar-expand navbar-light bg-navbar topbar mb-4 static-top">
                    <button id="sidebarToggleTop" class="btn btn-link rounded-circle mr-3">
                        <i class="fa fa-bars"></i>
                    </button>
                    <ul class="navbar-nav ml-auto">
                        <li class="nav-item dropdown no-arrow">
                            <a class="nav-link dropdown-toggle" href="#" id="searchDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <strong><?php echo date('Y')  ?>&nbsp;</strong>
                                <i class="fa-solid fa-angle-down"></i>
                            </a>
                            <div class="dropdown-menu dropdown-menu-right p-3 shadow animated--grow-in" aria-labelledby="searchDropdown">
                                <form class="navbar-search">
                                    <div class="input-group">
                                        <select id="Digitaçao" name="tipo_movimento" class="form-control" value="" required>
                                            <option class="" value="Pendente" selected>2022
                                            </option>
                                            <option class="" value="Concluida">2021
                                            </option>
                                        </select>
                                        <div class="input-group-append">
                                            <button class="btn btn-primary" type="button">
                                                <i class="fa-solid fa-angles-right"></i>
                                            </button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </li>
                        <div class="topbar-divider d-none d-sm-block"></div>
                        <li class="nav-item dropdown no-arrow">
                            <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <span class="ml-2 d-none d-lg-inline text-white uppercase"><?= $_SESSION['name'] ?> <?= $_SESSION['lastname'] ?> &nbsp;</span>
                                <i class="fa-solid fa-ellipsis-vertical"></i>
                            </a>
                            <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="userDropdown">
                                <a class="dropdown-item" href="user_config.php">
                                    <i class="fas fa-cogs fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Configurações
                                </a>
                                <a class="dropdown-item" href="#">
                                    <div class="dropdown-divider"></div>
                                    <a class="dropdown-item" href="javascript:void(0);" data-toggle="modal" data-target="#logoutModal">
                                        <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                                        Logout
                                    </a>
                            </div>
                        </li>
                    </ul>
                </nav>
                <!-- Topbar -->