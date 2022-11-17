<?php
// INclude dos arquivos nescessarios
session_start();
require_once("../models/Carencia.php");
require_once("../models/Message.php");
require_once("../dao/CarenciaDAO.php");
require_once("conect.php");
require_once("url.php");

$message = new Message($BASE_URL);
$carenciaDao = new CarenciaDAO($conn, $BASE_URL);

// PEGA OS DADOS VINDOS DO FORM
$id_ref = filter_input(INPUT_POST, "id_ref");
$nte = filter_input(INPUT_POST, "nte");
$municipio = filter_input(INPUT_POST, "municipio");
$unidade_escolar = filter_input(INPUT_POST, "unidade_escolar");
$cod_unidade = filter_input(INPUT_POST, "cod_unidade");
$cadastro = filter_input(INPUT_POST, "cadastro");
$nome = filter_input(INPUT_POST, "nome");
$vinculo = filter_input(INPUT_POST, "vinculo");
$disciplina = filter_input(INPUT_POST, "disciplina");
$motivo_vaga = filter_input(INPUT_POST, "motivo_vaga");
$inicio_vaga = filter_input(INPUT_POST, "inicio_vaga");
$fim_vaga = filter_input(INPUT_POST, "fim_vaga");
$tipo_vaga = filter_input(INPUT_POST, "tipo_vaga");
$matutino = filter_input(INPUT_POST, "matutino");
$vespertino = filter_input(INPUT_POST, "vespertino");
$noturno = filter_input(INPUT_POST, "noturno");
$total = filter_input(INPUT_POST, "matutino") + filter_input(INPUT_POST, "vespertino") + filter_input(INPUT_POST, "noturno");
$type = filter_input(INPUT_POST, "type");
$id = filter_input(INPUT_POST, "id");
$usuario = filter_input(INPUT_POST, "usuario");

if ($type === "create") {
    // Valida se esta vindo dados
    if ($id_ref && $nte && $unidade_escolar && $unidade_escolar && $cod_unidade) {
        //Cria o objeto
        $carencia = new Carencia();
        $carencia->id_ref = $id_ref;
        $carencia->nte = $nte;
        $carencia->municipio = $municipio;
        $carencia->unidade_escolar = $unidade_escolar;
        $carencia->cod_unidade = $cod_unidade;
        $carencia->cadastro = $cadastro;
        $carencia->nome = $nome;
        $carencia->vinculo = $vinculo;
        $carencia->disciplina = $disciplina;
        $carencia->motivo_vaga = $motivo_vaga;
        $carencia->inicio_vaga = $inicio_vaga;
        $carencia->fim_vaga = $fim_vaga;
        $carencia->tipo_vaga = $tipo_vaga;
        $carencia->matutino = $matutino;
        $carencia->vespertino = $vespertino;
        $carencia->noturno = $noturno;
        $carencia->total = $total;
        $carencia->usuario = $usuario;
        //Chama a função create responsavel pela criação dos dados no banco em carenciaDAO.php
        $carenciaDao->create($carencia);
    }
} else if ($type === "update") {

    $carencia = new Carencia();
    $carencia->id_ref = $id_ref;
    $carencia->id = $id;
    $carencia->nte = $nte;
    $carencia->municipio = $municipio;
    $carencia->unidade_escolar = $unidade_escolar;
    $carencia->cod_unidade = $cod_unidade;
    $carencia->cadastro = $cadastro;
    $carencia->nome = $nome;
    $carencia->vinculo = $vinculo;
    $carencia->disciplina = $disciplina;
    $carencia->motivo_vaga = $motivo_vaga;
    $carencia->inicio_vaga = $inicio_vaga;
    $carencia->fim_vaga = $fim_vaga;
    $carencia->tipo_vaga = $tipo_vaga;
    $carencia->matutino = $matutino;
    $carencia->vespertino = $vespertino;
    $carencia->noturno = $noturno;
    $carencia->total = $total;
    $carencia->usuario = $usuario;
    //Chama a função update responsavel pela alteração dos dados no banco em carenciaDAO.php
    $carenciaDao->update($carencia);
    
} else if ($type === "search") {

    $type_vaga = $_SESSION["tipo_vaga"];
    $cod_unidade = filter_input(INPUT_POST, "cod_unidade");

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

} else {
    $id;
    $type_vaga = $_SESSION["tipo_vaga"];
    // Pega o ID passado por parametro na url e salva na variavel
    if (!empty($_GET)) {
        $id = $_GET['id'];
    }

    // Retorna os dados do contato com a ID passado por parametro
    if (!empty($id)) {
        //consulta a tabela de carencias para pegar o ID de referencia e passar para o header que atualiza a pagina
        $querry = "SELECT id_ref FROM carencias WHERE id = :id";
        $stmt = $conn->prepare($querry);
        $stmt->bindParam(":id", $id);
        $stmt->execute();
        $controle_nte = $stmt->fetch(PDO::FETCH_ASSOC);

        $query = "DELETE  FROM carencias WHERE id = :id";
        $stmt = $conn->prepare($query);
        $stmt->bindParam(":id", $id);
        if ($stmt->execute()) {
            if ($type_vaga === "R") {
                header("Location: ../include-carencia.php?id=" .  $controle_nte['id_ref'] . "");
                $_SESSION["msg"] =  "Registro Excluido com Sucesso";
                die();
            } else {
                header("Location: ../include-carencia-temporaria.php?id=" .  $controle_nte['id_ref'] . "");
                $_SESSION["msg"] =  "Registro Excluido com Sucesso";
                die();
            }
        } else {
            echo "Ocorreu um erro: " . $stmt->errorInfo();
        }
    }
}
