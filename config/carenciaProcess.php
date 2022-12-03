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

        if (empty($nome) && empty($cadastro)) {
            $nome = "-";
            $cadastro = "-";
        }

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

    $before_mat = filter_input(INPUT_POST, "before_mat");
    $before_vesp = filter_input(INPUT_POST, "before_vesp");
    $before_not = filter_input(INPUT_POST, "before_not");
    $after_mat = filter_input(INPUT_POST, "after_mat");
    $after_vesp = filter_input(INPUT_POST, "after_vesp");
    $after_not = filter_input(INPUT_POST, "after_not");
    $motivo_suprimento = filter_input(INPUT_POST, "motivo_suprimento");
    $servidor_suprimento = filter_input(INPUT_POST, "servidor_suprimento");
    $cadastro_suprimento = filter_input(INPUT_POST, "cadastro_suprimento");
    $mat_suprimento = filter_input(INPUT_POST, "after_mat");
    $vesp_suprimento = filter_input(INPUT_POST, "after_vesp");
    $not_suprimento = filter_input(INPUT_POST, "after_not");
    $data_suprimento = filter_input(INPUT_POST, "data_suprimento");

    if ($before_mat - $after_mat < 0) {
        header("Location: ../details-carencia.php?id=" .  $id . "");
        $_SESSION["msg"] =  "A quantidade de carência por turno nao pode ser menor que 0, Tente novamente.";
        $_SESSION["info_msg"] = 'alert-danger';
        die();
    } else if ($before_mat - $after_mat > 0) {
        $new_matutino = ($before_mat - $after_mat);
    }

    if ($before_vesp - $after_vesp < 0) {
        header("Location: ../details-carencia.php?id=" .  $id . "");
        $_SESSION["msg"] =  "A quantidade de carência por turno nao pode ser menor que 0, Tente novamente.";
        $_SESSION["info_msg"] = 'alert-danger';
        die();
    } else if ($before_vesp - $after_vesp > 0) {
        $new_vespertino = ($before_vesp - $after_vesp);
    }

    if ($before_not - $after_not < 0) {
        header("Location: ../details-carencia.php?id=" .  $id . "");
        $_SESSION["msg"] =  "A quantidade de carência por turno nao pode ser menor que 0, Tente novamente.";
        $_SESSION["info_msg"] = 'alert-danger';
        die();
    } else if ($before_not - $after_not > 0) {
        $new_noturno = ($before_not - $after_not);
    }

    $total = $new_matutino + $new_vespertino + $new_noturno;

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
    $carencia->matutino = $new_matutino;
    $carencia->vespertino = $new_vespertino;
    $carencia->noturno = $new_noturno;
    $carencia->total = $total;
    $carencia->usuario = $usuario;
    $carencia->motivo_suprimento = $motivo_suprimento;
    $carencia->servidor_suprimento = $servidor_suprimento;
    $carencia->cadastro_suprimento = $cadastro_suprimento;
    $carencia->mat_suprimento = $mat_suprimento;
    $carencia->vesp_suprimento = $vesp_suprimento;
    $carencia->not_suprimento = $not_suprimento;
    $carencia->data_suprimento = $data_suprimento;
  
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
                $_SESSION["info_msg"] = 'alert-success';
                die();
            } else {
                header("Location: ../include-carencia-temporaria.php?id=" .  $controle_nte['id_ref'] . "");
                $_SESSION["msg"] =  "Registro Excluido com Sucesso";
                $_SESSION["info_msg"] = 'alert-success';
                die();
            }
        } else {
            echo "Ocorreu um erro: " . $stmt->errorInfo();
        }
    }
}
