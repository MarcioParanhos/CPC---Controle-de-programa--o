<?php

class Carencia
{

    public $id;
    public $id_ref;
    public $nte;
    public $municipio;
    public $unidade_escolar;
    public $cod_unidade;
    public $cadastro;
    public $nome;
    public $vinculo;
    public $disciplina;
    public $motivo_vaga;
    public $inicio_vaga;
    public $fim_vaga;
    public $tipo_vaga;
    public $matutino;
    public $vespertino;
    public $noturno;
    public $total;
    public $usuario;
}

interface CarenciaDAOInterface
{

    public function bildCarencia($data);
    public function create(Carencia $carencia);
    public function update(Carencia $carencia);
    public function getCarenciasById($id, $type);
    public function countCarenciaMatById($id, $type);
    public function countCarenciaVespById($id, $type);
    public function countCarenciaNotById($id, $type);
    public function getDisciplinas();
    public function getMotivoVagas($type);
    public function getCarenciaUnicById($id);
}
