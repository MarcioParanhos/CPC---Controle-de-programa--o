<?php

// require_once("../models/Carencia.php");
// require_once("../models/Message.php");


class CarenciaDAO implements CarenciaDAOInterface
{

    private $conn;
    private $url;
    private $message;

    public function __construct(PDO $conn, $url)
    {
        $this->conn = $conn;
        $this->url = $url;
        $this->Message = new Message($url);
    }

    public function bildCarencia($data)
    {
        //Cria o objeto do Carencia
        $carencia = new Carencia();
        $carencia->id = $data["id"];
        $carencia->id_ref = $data["id_ref"];
        $carencia->nte = $data["nte"];
        $carencia->municipio = $data["municipio"];
        $carencia->unidade_escolar = $data["unidade_escolar"];
        $carencia->cod_unidade = $data["cod_unidade"];
        $carencia->cadastro = $data["cadastro"];
        $carencia->nome = $data["nome"];
        $carencia->vinculo = $data["vinculo"];
        $carencia->disciplina = $data["disciplina"];
        $carencia->motivo_vaga = $data["motivo_vaga"];
        $carencia->inicio_vaga = $data["inicio_vaga"];
        $carencia->fim_vaga = $data["fim_vaga"];
        $carencia->tipo_vaga = $data["tipo_vaga"];
        $carencia->matutino = $data["matutino"];
        $carencia->vespertino = $data["vespertino"];
        $carencia->noturno = $data["noturno"];
        $carencia->total = $data["total"];
        $carencia->usuario = $data["usuario"];
        // retorna o objeto para insersão no banco de dados
        return $carencia;
    }

    // função de criação onde recebe o parametro Carencia vindo da função Bild
    public function create(Carencia $carencia)
    {
        $type_vaga = $_SESSION["tipo_vaga"];
        //Sql para insersão no banco
        $stmt = $this->conn->prepare("INSERT INTO carencias (
       id_ref,
       nte,
       municipio,
       unidade_escolar,
       cod_unidade,
       cadastro,
       nome,
       vinculo,
       disciplina,
       motivo_vaga,
       inicio_vaga,
       fim_vaga,
       tipo_vaga,
       matutino,
       vespertino,
       noturno,
       total,
       usuario )
       VALUES (
       :id_ref,
       :nte,
       :municipio,
       :unidade_escolar,
       :cod_unidade,
       :cadastro,
       :nome,
       :vinculo,
       :disciplina,
       :motivo_vaga,
       :inicio_vaga,
       :fim_vaga,
       :tipo_vaga,
       :matutino,
       :vespertino,
       :noturno,
       :total,
       :usuario )
            ");

        $stmt->bindParam(":id_ref", $carencia->id_ref);
        $stmt->bindParam(":nte", $carencia->nte);
        $stmt->bindParam(":municipio", $carencia->municipio);
        $stmt->bindParam(":unidade_escolar", $carencia->unidade_escolar);
        $stmt->bindParam(":cod_unidade", $carencia->cod_unidade);
        $stmt->bindParam(":cadastro", $carencia->cadastro);
        $stmt->bindParam(":nome", $carencia->nome);
        $stmt->bindParam(":vinculo", $carencia->vinculo);
        $stmt->bindParam(":disciplina", $carencia->disciplina);
        $stmt->bindParam(":motivo_vaga", $carencia->motivo_vaga);
        $stmt->bindParam(":inicio_vaga", $carencia->inicio_vaga);
        $stmt->bindParam(":fim_vaga", $carencia->fim_vaga);
        $stmt->bindParam(":tipo_vaga", $carencia->tipo_vaga);
        $stmt->bindParam(":matutino", $carencia->matutino);
        $stmt->bindParam(":vespertino", $carencia->vespertino);
        $stmt->bindParam(":noturno", $carencia->noturno);
        $stmt->bindParam(":total", $carencia->total);
        $stmt->bindParam(":usuario", $carencia->usuario);
        // se o Sql deu certo retorna para a tela de cadastro com uma mensagem de sucesso
        if ($stmt->execute()) {
            if ($type_vaga === "R") {
                header("Location: ../include-carencia.php?id=" .  $carencia->id_ref . "");
                $_SESSION["msg"] =  "Registro Inserido com Sucesso !";
                die();
            } else {
                header("Location: ../include-carencia-temporaria.php?id=" .   $carencia->id_ref . "");
                $_SESSION["msg"] =  "Registro Inserido com Sucesso !";
            }
        } else {
            echo "Ocorreu um erro: " . $stmt->errorInfo();
        }
    }

    public function update(Carencia $carencia)
    {

        // Sql de alterar os dados no banco
        $sql = "UPDATE carencias SET
        nte = :nte,
        municipio = :municipio,
        unidade_escolar = :unidade_escolar,
        cod_unidade = :cod_unidade,
        cadastro = :cadastro,
        vinculo = :vinculo,
        nome = :nome,
        disciplina = :disciplina,
        matutino = :matutino,
        vespertino = :vespertino,
        noturno = :noturno,
        motivo_vaga = :motivo_vaga,
        inicio_vaga = :inicio_vaga,
        fim_vaga = :fim_vaga,
        tipo_vaga = :tipo_vaga,
        total = :total,
        usuario = :usuario
        WHERE 
        id = :id";

        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(":nte", $carencia->nte);
        $stmt->bindParam(":municipio", $carencia->municipio);
        $stmt->bindParam(":unidade_escolar", $carencia->unidade_escolar);
        $stmt->bindParam(":cod_unidade", $carencia->cod_unidade);
        $stmt->bindParam(":cadastro", $carencia->cadastro);
        $stmt->bindParam(":vinculo", $carencia->vinculo);
        $stmt->bindParam(":nome", $carencia->nome);
        $stmt->bindParam(":disciplina", $carencia->disciplina);
        $stmt->bindParam(":matutino", $carencia->matutino);
        $stmt->bindParam(":vespertino", $carencia->vespertino);
        $stmt->bindParam(":noturno", $carencia->noturno);
        $stmt->bindParam(":motivo_vaga", $carencia->motivo_vaga);
        $stmt->bindParam(":inicio_vaga", $carencia->inicio_vaga);
        $stmt->bindParam(":fim_vaga", $carencia->fim_vaga);
        $stmt->bindParam(":tipo_vaga", $carencia->tipo_vaga);
        $stmt->bindParam(":total", $carencia->total);
        $stmt->bindParam(":id", $carencia->id);
        $stmt->bindParam(":usuario", $carencia->usuario);

        // redireciona para a pagina de registro informando a mensagem de registro
        if ($stmt->execute()) {
            header("Location: ../details-carencia.php?id=" . $carencia->id . "");
            $_SESSION["msg"] =  "Registros Alterados com Sucesso";
            die();
        } else {
            echo "Ocorreu um erro: " . $stmt->errorInfo();
        }
    }

    public function getCarenciasReaisById($id)
    {

        $real_carencias = [];
        $stmt = $this->conn->prepare("SELECT * FROM carencias WHERE id_ref = :id AND tipo_vaga = 'R' AND ano_ref = '2022'");
        $stmt->bindParam(":id", $id);
        $stmt->execute();

        if ($stmt->rowCount() > 0) {

            $carenciasArray = $stmt->fetchAll();

            foreach ($carenciasArray as $real_carencia) {

                $real_carencias[] = $this->bildCarencia($real_carencia);
            }
        }

        return $real_carencias;
    }

    public function countCarenciaMatById($id)
    {

        $stmt = $this->conn->prepare("SELECT sum(matutino) FROM carencias WHERE id_ref =:id AND tipo_vaga = 'R' ");
        $stmt->bindParam(":id", $id);
        $stmt->execute();
        $countMatReal = $stmt->fetch();
        return $countMatReal[0];
    }

    public function countCarenciaVespById($id)
    {
        
        $stmt = $this->conn->prepare("SELECT sum(matutino) FROM carencias WHERE id_ref =:id AND tipo_vaga = 'R' ");
        $stmt->bindParam(":id", $id);
        $stmt->execute();
        $countVespReal = $stmt->fetch();
        return $countVespReal[0];
    }

    public function countCarenciaNotById($id)
    {
        
        $stmt = $this->conn->prepare("SELECT sum(matutino) FROM carencias WHERE id_ref =:id AND tipo_vaga = 'R' ");
        $stmt->bindParam(":id", $id);
        $stmt->execute();
        $countNotReal = $stmt->fetch();
        return $countNotReal[0];
    }
}
