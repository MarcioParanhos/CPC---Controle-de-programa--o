<?php

class Diary {

    public $id;
    public $nte;
    public $municipio;
    public $unidade_escolar;
    public $cod_unidade;
    public $cadastro;
    public $nome;
    public $data_diario;
    public $contato;
    public $modo_contato;
    public $dia_contato;
    public $periodo;
    public $tipo;
    public $situacao;
    public $obs;
    public $usuario;
}

interface DiaryDAOInterface {

    public function bildDiary($data);
    public function create(Diary $diary);
    public function update(Diary $diary);
    public function getDiaryById($id);

}