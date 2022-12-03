<?php
// Include dos arquivos nescessarios
session_start();
require_once("../models/Excedentes.php");
require_once("../models/Message.php");
require_once("../dao/ExcedenteDAO.php");
require_once("conect.php");
require_once("url.php");

$message = new Message($BASE_URL);
$excedenteDao = new ExcedenteDAO($conn, $BASE_URL);

$nte = filter_input(INPUT_POST, "nte");
$municipio = filter_input(INPUT_POST, "municipio");
$unidade_escolar = filter_input(INPUT_POST, "unidade_escolar");
$cod_unidade = filter_input(INPUT_POST, "cod_unidade");
$cadastro = filter_input(INPUT_POST, "cadastro");
$nome = filter_input(INPUT_POST, "nome");
$vinculo = filter_input(INPUT_POST, "vinculo");
$ch = filter_input(INPUT_POST, "ch");
$qtd_horas = filter_input(INPUT_POST, "qtd_horas");
$formacao = filter_input(INPUT_POST, "formacao");
$usuario = filter_input(INPUT_POST, "usuario");
$data_add_user = filter_input(INPUT_POST, "data_add_user");
$type = filter_input(INPUT_POST, "type");
$id = filter_input(INPUT_POST, "id");
$motivo_excedencia = filter_input(INPUT_POST, "motivo_excedencia");
$obs = filter_input(INPUT_POST, "obs");
$motivo_fim_excedencia = filter_input(INPUT_POST, "motivo_fim_excedencia");
$data_fim_excedente = filter_input(INPUT_POST, "data_fim_excedente");

if ($type === "create") {

    $excedente = new Excedente();
    $excedente->nte = $nte;
    $excedente->municipio = $municipio;
    $excedente->unidade_escolar = $unidade_escolar;
    $excedente->cod_unidade = $cod_unidade;
    $excedente->cadastro = $cadastro;
    $excedente->nome = $nome;
    $excedente->vinculo = $vinculo;
    $excedente->ch = $ch;
    $excedente->qtd_horas = $qtd_horas;
    $excedente->formacao = $formacao;
    $excedente->usuario = $usuario;
    $excedente->data_add_user = $data_add_user;
    $excedente->motivo_excedencia = $motivo_excedencia;
    //Chama a função create responsavel pela criação dos dados no banco em ExcedenteDAO.php
    $excedenteDao->create($excedente);

} else if ($type === "update") {

    $excedente = new Excedente();
    $excedente->id = $id;
    $excedente->nte = $nte;
    $excedente->municipio = $municipio;
    $excedente->unidade_escolar = $unidade_escolar;
    $excedente->cod_unidade = $cod_unidade;
    $excedente->cadastro = $cadastro;
    $excedente->nome = $nome;
    $excedente->vinculo = $vinculo;
    $excedente->ch = $ch;
    $excedente->qtd_horas = $qtd_horas;
    $excedente->formacao = $formacao;
    $excedente->usuario = $usuario;
    $excedente->obs = $obs;
    $excedente->motivo_fim_excedencia = $motivo_fim_excedencia;
    $excedente->data_fim_excedente = $data_fim_excedente;

    //Chama a função update responsavel pela alteração dos dados no banco em contactsDAO.php
    $excedenteDao->update($excedente);

} else {

    $idDelete;
    // Pega o ID passado por parametro na url e salva na variavel
    if (!empty($_GET)) {
        $idDelete = $_GET['id'];
    }

    // Retorna os dados do contato com a ID passado por parametro
    if (!empty($idDelete)) {
        $query = "DELETE  FROM excedentes WHERE id = :id";
        $stmt = $conn->prepare($query);
        $stmt->bindParam(":id", $idDelete);
        if ($stmt->execute()) {
            header("Location: ../excedentes.php");
            $_SESSION["msg"] =  "Registro Excluido com Sucesso";
            die();
        } else {
            echo "Ocorreu um erro: " . $stmt->errorInfo();
        }
    }
    
}

$id = $_POST['id'];

    if (!empty($id)) {

        $resultado = '';

        $query = "SELECT * FROM excedentes WHERE id = :id";
        $stmt = $conn->prepare($query);
        $stmt->bindParam(":id", $id);
        $stmt->execute();
        $excedente = $stmt->fetch();

        $resultado .= '<dl class="row">';
        $resultado .= '<dt class="col-sm-2">NTE</dt>';
        $resultado .= '<dd class="col-sm-1">' . $excedente['nte'] . '</dd>';
        $resultado .= '</dl>';

        $resultado .= '<dl class="row">';
        $resultado .= '<dt class="col-sm-2">MUNICIPIO</dt>';
        $resultado .= '<dd class="col-sm-10">' . $excedente['municipio'] . '</dd>';
        $resultado .= '</dl>';

        $resultado .= '<dl class="row">';
        $resultado .= '<dt class="col-sm-2">UEE</dt>';
        $resultado .= '<dd class="col-sm-10">' . $excedente['unidade_escolar'] . '</dd>';
        $resultado .= '</dl>';

        $resultado .= '<dl class="row">';
        $resultado .= '<dt class="col-sm-2">COD. UEE</dt>';
        $resultado .= '<dd class="col-sm-2">' . $excedente['cod_unidade'] . '</dd>';
        $resultado .= '</dl>';

        $resultado .= '<dl class="row">';
        $resultado .= '<dt class="col-sm-2">NOME</dt>';
        $resultado .= '<dd class="col-sm-10">' . $excedente['nome'] . '</dd>';
        $resultado .= '</dl>';

        $resultado .= '<dl class="row">';
        $resultado .= '<dt class="col-sm-2">CADASTRO</dt>';
        $resultado .= '<dd class="col-sm-10">' . $excedente['cadastro'] . '</dd>';
        $resultado .= '</dl>';

        $resultado .= '<dl class="row">';
        $resultado .= '<dt class="col-sm-2">VINCULO</dt>';
        $resultado .= '<dd class="col-sm-1">' . $excedente['vinculo'] . '</dd>';
        $resultado .= '</dl>';

        $resultado .= '<dl class="row">';
        $resultado .= '<dt class="col-sm-2">CH</dt>';
        $resultado .= '<dd class="col-sm-1">' . $excedente['ch'] . 'H</dd>';
        $resultado .= '</dl>';

        $resultado .= '<dl class="row">';
        $resultado .= '<dt class="col-sm-2">CH. EXCEDENTE</dt>';
        $resultado .= '<dd class="col-sm-1">' . $excedente['qtd_horas'] . 'H</dd>';
        $resultado .= '</dl>';

        $resultado .= '<dl class="row">';
        $resultado .= '<dt class="col-sm-2">FORMAÇÃO</dt>';
        $resultado .= '<dd class="col-sm-1">' . $excedente['formacao'] . '</dd>';
        $resultado .= '</dl>';

        echo $resultado;
    };
