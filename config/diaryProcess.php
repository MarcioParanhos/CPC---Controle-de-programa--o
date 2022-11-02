<?php
// INclude dos arquivos nescessarios
session_start();
require_once("../models/Diary.php");
require_once("../models/Message.php");
require_once("../dao/DiaryDAO.php");
require_once("conect.php");
require_once("url.php");

$message = new Message($BASE_URL);
$diaryDao = new DiaryDAO($conn, $BASE_URL);

// PEGA OS DADOS VINDOS DO FORM

$nte = filter_input(INPUT_POST, "nte");
$municipio = filter_input(INPUT_POST, "municipio");
$unidade_escolar = filter_input(INPUT_POST, "unidade_escolar");
$cod_unidade = filter_input(INPUT_POST, "cod_unidade");
$cadastro = filter_input(INPUT_POST, "cadastro");
$nome = filter_input(INPUT_POST, "nome");
$contato = filter_input(INPUT_POST, "contato");
$modo_contato = filter_input(INPUT_POST, "modo_contato");
$dia_contato = filter_input(INPUT_POST, "dia_contato");
$data_diario = filter_input(INPUT_POST, "data_diario");
$periodo = filter_input(INPUT_POST, "periodo");
$tipo = filter_input(INPUT_POST, "tipo");
$situacao = filter_input(INPUT_POST, "situacao");
$obs = filter_input(INPUT_POST, "obs");
$id = filter_input(INPUT_POST, "id");
$type = filter_input(INPUT_POST, "type");
$usuario = filter_input(INPUT_POST, "usuario");


if ($type === "create") {
    // Valida se esta vindo dados
    if ($nte && $municipio && $unidade_escolar && $nome && $periodo) {
        //Cria o objeto
        $diary = new Diary();
        $diary->nte = $nte;
        $diary->municipio = $municipio;
        $diary->unidade_escolar = $unidade_escolar;
        $diary->cod_unidade = $cod_unidade;
        $diary->cadastro = $cadastro;
        $diary->nome = $nome;
        $diary->contato = $contato;
        $diary->modo_contato = $modo_contato;
        $diary->dia_contato = $dia_contato;
        $diary->data_diario = $data_diario;
        $diary->periodo = $periodo;
        $diary->tipo = $tipo;
        $diary->situacao = $situacao;
        $diary->obs = $obs;
        $diary->usuario = $usuario;
        //Chama a função create responsavel pela criação dos dados no banco em DiaryDAO.php
        $diaryDao->create($diary);
    }
} else if ($type === "update") {

    $diary = new Diary();
    $diary->id = $id;
    $diary->nte = $nte;
    $diary->municipio = $municipio;
    $diary->unidade_escolar = $unidade_escolar;
    $diary->cod_unidade = $cod_unidade;
    $diary->cadastro = $cadastro;
    $diary->nome = $nome;
    $diary->contato = $contato;
    $diary->modo_contato = $modo_contato;
    $diary->dia_contato = $dia_contato;
    $diary->data_diario = $data_diario;
    $diary->periodo = $periodo;
    $diary->tipo = $tipo;
    $diary->situacao = $situacao;
    $diary->obs = $obs;
    $diary->usuario = $usuario;

    //Chama a função update responsavel pela alteração dos dados no banco em contactsDAO.php
    $diaryDao->update($diary);
    
} else {
    $id;
    $type_vaga = $_SESSION["tipo_vaga"];
    // Pega o ID passado por parametro na url e salva na variavel
    if (!empty($_GET)) {
        $id = $_GET['id'];
    }

    // Retorna os dados do contato com a ID passado por parametro
    if (!empty($id)) {
        $query = "DELETE  FROM diarios WHERE id = :id";
        $stmt = $conn->prepare($query);
        $stmt->bindParam(":id", $id);
        if ($stmt->execute()) {
            header("Location: ../diary-consult.php");
            $_SESSION["msg"] =  "Registro Excluido com Sucesso";
            die();
        } else {
            echo "Ocorreu um erro: " . $stmt->errorInfo();
        }
    }
}
