<?php

class Contacts {

    public $id;
    public $nte;
    public $municipio;
    public $unidade_escolar;
    public $cod_unidade;
    public $gestor;
    public $tel_gestor;
    public $tel_unidade;
    public $email_gestor;
    public $vice_gestor;
    public $tel_vice_gestor;
    public $vice_gestor_2;
    public $tel_vice_gestor_2;
    public $responsavel_pch;
    public $obs;
}

interface ContactsDAOInterface {

    public function bildContacts($data);
    public function create(Contacts $contacts);
    public function update(Contacts $contacts);
   

}