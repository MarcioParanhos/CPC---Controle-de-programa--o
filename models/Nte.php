<?php

class Controle_nte {

    public $id;
    public $nte;
    public $municipio;
    public $unidade_escolar;
    public $cod_unidade;
    public $digitacao;
    public $desc_digitacao;
    public $homologacao;
    public $desc_homologacao;
    public $componente;
    public $desc_componente;
}

interface Controle_nteDAOInterface {

    public function bildNte($data);
    public function create(Controle_nte $controle_nte);
    public function update(Controle_nte $controle_nte);

}