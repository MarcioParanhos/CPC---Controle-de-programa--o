<?php
// INclude dos arquivos nescessarios
session_start();
require_once("../models/Nte.php");
require_once("../models/Message.php");
require_once("../dao/NteDAO.php");
require_once("conect.php");
require_once("url.php");

$message = new Message($BASE_URL);
$controle_nteDao = new Controle_nteDAO($conn, $BASE_URL);

// PEGA OS DADOS VINDOS DO FORM

$nte = filter_input(INPUT_POST, "nte");
$municipio = filter_input(INPUT_POST, "municipio");
$unidade_escolar = filter_input(INPUT_POST, "unidade_escolar");
$cod_unidade = filter_input(INPUT_POST, "cod_unidade");
$digitacao = filter_input(INPUT_POST, "digitacao");
$desc_digitacao = filter_input(INPUT_POST, "desc_digitacao");
$homologacao = filter_input(INPUT_POST, "homologacao");
$desc_homologacao = filter_input(INPUT_POST, "desc_homologacao");
$componente = filter_input(INPUT_POST, "componente");
$desc_componente = filter_input(INPUT_POST, "desc_componente");
$id = filter_input(INPUT_POST, "id");
$type = filter_input(INPUT_POST, "type");

if ($type === "create") {

    
} else if ($type === "update") {

    // Valida se esta vindo dados
    if ($nte && $municipio && $unidade_escolar && $cod_unidade) {
        //Cria o objeto
        $controle_nte = new Controle_nte();
        $controle_nte->id = $id;
        $controle_nte->nte = $nte;
        $controle_nte->municipio = $municipio;
        $controle_nte->unidade_escolar = $unidade_escolar;
        $controle_nte->cod_unidade = $cod_unidade;
        $controle_nte->digitacao = $digitacao;
        $controle_nte->desc_digitacao = $desc_digitacao;
        $controle_nte->homologacao = $homologacao;
        $controle_nte->desc_homologacao = $desc_homologacao;
        $controle_nte->componente = $componente;
        $controle_nte->desc_componente = $desc_componente;
        //Chama a função create responsavel pela criação dos dados no banco em nteDAO.php
        $controle_nteDao->update($controle_nte);
    }
}
