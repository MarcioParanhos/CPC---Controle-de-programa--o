<?php

class Excedente {

    public $id;
    public $nte;
    public $municipio;
    public $unidade_escolar;
    public $cod_unidade;
    public $nome;
    public $cadastro;
    public $vinculo;
    public $ch;
    public $qtd_horas;
    public $formacao;
    public $usuario;
    public $data_add_user;
    public $motivo_excedencia;
    public $obs;
    public $motivo_fim_excedencia;
    public $data_fim_excedente;
   
}

interface ExcedenteDAOInterface {

    public function bildExcedente($data);
    public function create(Excedente $excedente);
    public function update(Excedente $excedente);
    public function getExcedentes($perfil);
    public function getExcedenteById($id);
}