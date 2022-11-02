
<?php
session_start();
include('../config/conect.php');

$cod_unidade;
$type_vaga = $_SESSION["tipo_vaga"];

// Pega o ID passado por parametro na url e salva na variavel
if (!empty($_POST)) {
    $cod_unidade = $_POST['cod_unidade'];
}

// Retorna os dados do contato com a ID passado por parametro
if (!empty($cod_unidade)) {


    $query = "SELECT id FROM controle_ntes WHERE cod_unidade = :cod_unidade";

    $stmt = $conn->prepare($query);

    $stmt->bindParam(":cod_unidade", $cod_unidade);

    $stmt->execute();

    $controle_nte = $stmt->fetch(PDO::FETCH_ASSOC);
}

// redireciona para a pagina de registro informando a mensagem de registro
if (!empty($controle_nte['id'])) {

    if ($type_vaga === "R") {
        header("Location: ../include-carencia.php?id=" .  $controle_nte['id'] . "");
    } else {
        header("Location: ../include-carencia-temporaria.php?id=" .  $controle_nte['id'] . "");
    }
} else if ($type_vaga === "R") {
    header("Location: ../include-carencia.php?id=?");
} else {
    header("Location: ../include-carencia-temporaria.php?id=?");
}
