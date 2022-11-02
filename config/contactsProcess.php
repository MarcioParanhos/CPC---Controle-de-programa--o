<?php
// INclude dos arquivos nescessarios
session_start();
require_once("../models/Contacts.php");
require_once("../models/Message.php");
require_once("../dao/ContactsDAO.php");
require_once("conect.php");
require_once("url.php");

$message = new Message($BASE_URL);
$contactsDao = new ContactsDAO($conn, $BASE_URL);

// PEGA OS DADOS VINDOS DO FORM

$nte = filter_input(INPUT_POST, "nte");
$municipio = filter_input(INPUT_POST, "municipio");
$unidade_escolar = filter_input(INPUT_POST, "unidade_escolar");
$cod_unidade = filter_input(INPUT_POST, "cod_unidade");
$gestor = filter_input(INPUT_POST, "gestor");
$tel_gestor = filter_input(INPUT_POST, "tel_gestor");
$tel_unidade = filter_input(INPUT_POST, "tel_unidade");
$email_gestor = filter_input(INPUT_POST, "email_gestor");
$vice_gestor = filter_input(INPUT_POST, "vice_gestor");
$tel_vice_gestor = filter_input(INPUT_POST, "tel_vice_gestor");
$vice_gestor_2 = filter_input(INPUT_POST, "vice_gestor_2");
$tel_vice_gestor_2 = filter_input(INPUT_POST, "tel_vice_gestor_2");
$responsavel_pch = filter_input(INPUT_POST, "responsavel_pch");
$obs = filter_input(INPUT_POST, "obs");
$id = filter_input(INPUT_POST, "id");
$type = filter_input(INPUT_POST, "type");

if ($type === "create") {


} else if ($type === "update") {

        $contacts = new Contacts();
        $contacts->id = $id;
        $contacts->nte = $nte;
        $contacts->municipio = $municipio;
        $contacts->unidade_escolar = $unidade_escolar;
        $contacts->cod_unidade = $cod_unidade;
        $contacts->gestor = $gestor;
        $contacts->tel_gestor = $tel_gestor;
        $contacts->tel_unidade = $tel_unidade;
        $contacts->email_gestor = $email_gestor;
        $contacts->vice_gestor = $vice_gestor;
        $contacts->tel_vice_gestor = $tel_vice_gestor;
        $contacts->vice_gestor_2 = $vice_gestor_2;
        $contacts->tel_vice_gestor_2 = $tel_vice_gestor_2;
        $contacts->responsavel_pch = $responsavel_pch;
        $contacts->obs = $obs;
    
        //Chama a função update responsavel pela alteração dos dados no banco em contactsDAO.php
        $contactsDao->update($contacts);
    

}
