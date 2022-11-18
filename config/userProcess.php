<?php

session_start();
require_once("../models/User.php");
require_once("../models/Message.php");
require_once("../dao/UserDAO.php");
require_once("conect.php");
require_once("url.php");


$message = new Message($BASE_URL);
$userDao = new UserDAO($conn, $BASE_URL);


// Pega o ID passado por parametro na url e salva na variavel
if (!empty($_GET)) {
    $idDelete = $_GET['id'];
}

// Deleta os dados do usuario com a ID passado por parametro
if (!empty($idDelete)) {
    $query = "DELETE  FROM usuarios WHERE id = :id";
    $stmt = $conn->prepare($query);
    $stmt->bindParam(":id", $idDelete);
    if ($stmt->execute()) {
        header("Location: ../users.php");
        $_SESSION["msg"] =  "Registro Excluido com Sucesso";
        die();
    } else {
        echo "Ocorreu um erro: " . $stmt->errorInfo();
    }
}


$id = $_POST['id'];

if (!empty($id)) {

    $resultado = '';

    $query = "SELECT * FROM usuarios WHERE id = :id";
    $stmt = $conn->prepare($query);
    $stmt->bindParam(":id", $id);
    $stmt->execute();
    $usuario = $stmt->fetch();

    $resultado .= '<dl class="row">';
    $resultado .= '<dt class="col-sm-2">Nome:</dt>';
    $resultado .= '<dd class="col-sm-6">' . $usuario['name'] . " " . $usuario['lastname'] . '</dd>';
    $resultado .= '</dl>';

    $resultado .= '<dl class="row">';
    $resultado .= '<dt class="col-sm-2">E-mail:</dt>';
    $resultado .= '<dd class="col-sm-6">' . $usuario['email'] . '</dd>';
    $resultado .= '</dl>';

    $resultado .= '<dl class="row">';
    $resultado .= '<dt class="col-sm-2">Perfil:</dt>';
    $resultado .= '<dd class="col-sm-6">' . $usuario['perfil'] . '</dd>';
    $resultado .= '</dl>';

    $resultado .= '<dl class="row">';
    $resultado .= '<dt class="col-sm-2">Cadastro/CPF:</dt>';
    $resultado .= '<dd class="col-sm-6">' . $usuario['cadastro_cpf'] . '</dd>';
    $resultado .= '</dl>';

    if ($usuario['perfil'] == 4) {
        $resultado .= '<dl class="row">';
        $resultado .= '<dt class="col-sm-2">Ntes:</dt>';
        $resultado .= '<dd class="col-sm-6">1 - 5 - 6 - 7 - 16 - 22</dd>';
        $resultado .= '</dl>';
    }

    if ($usuario['perfil'] == 3) {
        $resultado .= '<dl class="row">';
        $resultado .= '<dt class="col-sm-2">Ntes:</dt>';
        $resultado .= '<dd class="col-sm-6">2 - 5 - 6 - 7 - 16 - 22</dd>';
        $resultado .= '</dl>';
    }

    echo $resultado;
};
