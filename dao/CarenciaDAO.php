<?php


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
                $_SESSION["info_msg"] = 'alert-success';
                die();
            } else {
                header("Location: ../include-carencia-temporaria.php?id=" .   $carencia->id_ref . "");
                $_SESSION["msg"] =  "Registro Inserido com Sucesso !";
                $_SESSION["info_msg"] = 'alert-success';
            }
        } else {
            echo "Ocorreu um erro: " . $stmt->errorInfo();
        }
    }

    public function update(Carencia $carencia)
    {
        

        $stmt = $this->conn->prepare("INSERT INTO carencia_suprimentos (
            id_ref,
            nte,
            unidade_escolar,
            cod_unidade,
            motivo_suprimento,
            servidor_suprimento,
            cadastro_suprimento,
            disciplina,
            mat_suprimento,
            vesp_suprimento,
            not_suprimento,
            data_suprimento)
            VALUES (
            :id_ref,
            :nte,
            :unidade_escolar,
            :cod_unidade,
            :motivo_suprimento,
            :servidor_suprimento,
            :cadastro_suprimento,
            :disciplina,
            :mat_suprimento,
            :vesp_suprimento,
            :not_suprimento,
            :data_suprimento)
         ");

        $stmt->bindParam(":id_ref", $carencia->id);
        $stmt->bindParam(":nte", $carencia->nte);
        $stmt->bindParam(":unidade_escolar", $carencia->unidade_escolar);
        $stmt->bindParam(":cod_unidade", $carencia->cod_unidade);
        $stmt->bindParam(":motivo_suprimento", $carencia->motivo_suprimento);
        $stmt->bindParam(":servidor_suprimento", $carencia->servidor_suprimento);
        $stmt->bindParam(":cadastro_suprimento", $carencia->cadastro_suprimento);
        $stmt->bindParam(":disciplina", $carencia->disciplina);
        $stmt->bindParam(":mat_suprimento", $carencia->mat_suprimento);
        $stmt->bindParam(":vesp_suprimento", $carencia->vesp_suprimento);
        $stmt->bindParam(":not_suprimento", $carencia->not_suprimento);
        $stmt->bindParam(":data_suprimento", $carencia->data_suprimento);
        $stmt->execute();


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
            $_SESSION["info_msg"] = 'alert-success';
            die();
        } else {
            echo "Ocorreu um erro: " . $stmt->errorInfo();
        }
    }

    public function getCarenciasById($id, $type)
    {

        if ($type == "R") {
            $real_carencias = [];
            $stmt = $this->conn->prepare("SELECT * FROM carencias WHERE id_ref = :id AND tipo_vaga = 'R' AND ano_ref = '2022'");
            $stmt->bindParam(":id", $id);
            $stmt->execute();

            if ($stmt->rowCount() > 0) {
                $carenciasArray = $stmt->fetchAll();
                foreach ($carenciasArray as $real_carencia) {
                    $real_carencias[] = $this->bildCarencia($real_carencia);
                    $_SESSION['pdf'] = 0;
                }
            }

            return $real_carencias;
        } else if ($type == "T") {
            $temp_carencias = [];
            $stmt = $this->conn->prepare("SELECT * FROM carencias WHERE id_ref = :id AND tipo_vaga = 'T' AND ano_ref = '2022'");
            $stmt->bindParam(":id", $id);
            $stmt->execute();

            if ($stmt->rowCount() > 0) {
                $carenciasArray = $stmt->fetchAll();
                foreach ($carenciasArray as $temp_carencia) {
                    $temp_carencias[] = $this->bildCarencia($temp_carencia);
                    $_SESSION['pdf'] = 0;
                }
            }

            return $temp_carencias;
        }
    }

    public function countCarenciaMatById($id, $type)
    {
        if ($type == "R") {
            $stmt = $this->conn->prepare("SELECT sum(matutino) FROM carencias WHERE id_ref =:id AND tipo_vaga = 'R' ");
            $stmt->bindParam(":id", $id);
            $stmt->execute();
            $countMatReal = $stmt->fetch();
            return $countMatReal[0];
        } else if ($type == "T") {
            $stmt = $this->conn->prepare("SELECT sum(matutino) FROM carencias WHERE id_ref =:id AND tipo_vaga = 'T' ");
            $stmt->bindParam(":id", $id);
            $stmt->execute();
            $countMatTemp = $stmt->fetch();
            return $countMatTemp[0];
        }
    }

    public function countCarenciaVespById($id, $type)
    {
        if ($type == "R") {
            $stmt = $this->conn->prepare("SELECT sum(vespertino) FROM carencias WHERE id_ref =:id AND tipo_vaga = 'R' ");
            $stmt->bindParam(":id", $id);
            $stmt->execute();
            $countVespReal = $stmt->fetch();
            return $countVespReal[0];
        } else if ($type == "T") {
            $stmt = $this->conn->prepare("SELECT sum(vespertino) FROM carencias WHERE id_ref =:id AND tipo_vaga = 'T' ");
            $stmt->bindParam(":id", $id);
            $stmt->execute();
            $countVespTemp = $stmt->fetch();
            return $countVespTemp[0];
        }
    }

    public function countCarenciaNotById($id, $type)
    {
        if ($type == "R") {
            $stmt = $this->conn->prepare("SELECT sum(noturno) FROM carencias WHERE id_ref =:id AND tipo_vaga = 'R' ");
            $stmt->bindParam(":id", $id);
            $stmt->execute();
            $countNotReal = $stmt->fetch();
            return $countNotReal[0];
        } else if ($type == "T") {
            $stmt = $this->conn->prepare("SELECT sum(noturno) FROM carencias WHERE id_ref =:id AND tipo_vaga = 'T' ");
            $stmt->bindParam(":id", $id);
            $stmt->execute();
            $countNotTemp = $stmt->fetch();
            return $countNotTemp[0];
        }
    }

    public function updateCarencia($id)
    {

        // Atualiza dados se a unidade possuir carencia ou não
        $sql = "SELECT sum(total) as total FROM carencias WHERE id_ref = :id_ref ";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(":id_ref", $id);
        $stmt->execute();
        $stmt = $stmt->fetch();
        $countCarencia_real = $stmt['total'];

        if ($countCarencia_real > 0) {
            $sql = "SELECT tipo_vaga FROM carencias WHERE id_ref = :id_ref AND tipo_vaga = 'T' ";
            $stmt = $this->conn->prepare($sql);
            $stmt->bindParam(":id_ref", $id);
            $stmt->execute();
            $tipo_temp = $stmt->fetch();
            if ($tipo_temp == null) {
                $tipo_carencia_T = 0;
            } else if ($tipo_temp != null) {
                $tipo_carencia_T = $tipo_temp[0];
            }

            $sql = "SELECT tipo_vaga FROM carencias WHERE id_ref = :id_ref AND tipo_vaga = 'R' ";
            $stmt = $this->conn->prepare($sql);
            $stmt->bindParam(":id_ref", $id);
            $stmt->execute();
            $tipo_real = $stmt->fetch();
            if ($tipo_real == null) {
                $tipo_carencia_R = 0;
            } else if ($tipo_real != null) {
                $tipo_carencia_R = $tipo_real[0];
            }
        }

        if (($countCarencia_real > 0) && ($tipo_carencia_T == "T") && ($tipo_carencia_R == "R")) {
            $carencia = "T - R";
            $sql = "UPDATE controle_ntes SET carencia = :carencia WHERE id = :id";
            $stmt = $this->conn->prepare($sql);
            $stmt->bindParam(":id", $id);
            $stmt->bindParam(":carencia", $carencia);
            $stmt->execute();
        } else if (($countCarencia_real > 0) && ($tipo_carencia_R == "R")) {
            $carencia = "R";
            $sql = "UPDATE controle_ntes SET carencia = :carencia WHERE id = :id";
            $stmt = $this->conn->prepare($sql);
            $stmt->bindParam(":id", $id);
            $stmt->bindParam(":carencia", $carencia);
            $stmt->execute();
        } else if (($countCarencia_real > 0) && ($tipo_carencia_T == "T")) {
            $carencia = "T";
            $sql = "UPDATE controle_ntes SET carencia = :carencia WHERE id = :id";
            $stmt = $this->conn->prepare($sql);
            $stmt->bindParam(":id", $id);
            $stmt->bindParam(":carencia", $carencia);
            $stmt->execute();
        } else {
            $carencia = "Não";
            $sql = "UPDATE controle_ntes SET carencia = :carencia WHERE id = :id";
            $stmt = $this->conn->prepare($sql);
            $stmt->bindParam(":id", $id);
            $stmt->bindParam(":carencia", $carencia);
            $stmt->execute();
        }
    }

    public function getDisciplinas()
    {
        $query = "SELECT nome FROM disciplinas";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        $disciplinas = $stmt->fetchAll();
        return $disciplinas;
    }

    public function getMotivoVagas($type)
    {

        if ($type == "R") {
            $query = "SELECT motivo FROM motivo_vaga ORDER BY motivo ASC";
            $stmt = $this->conn->prepare($query);
            $stmt->execute();
            $motivo_vagas = $stmt->fetchAll();
            return $motivo_vagas;
        } else if ($type == "T") {
            $query = "SELECT motivo FROM motivo_vaga_temp";
            $stmt = $this->conn->prepare($query);
            $stmt->execute();
            $motivo_vagas = $stmt->fetchAll();
            return $motivo_vagas;
        }
    }

    public function getCarenciaUnicById($id)
    {
        $query = "SELECT * FROM carencias WHERE id = :id ";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(":id", $id);
        $stmt->execute();
        $vagas = $stmt->fetch();
        return $vagas;
    }

    public function getSuprimentos($id) {

        $query = "SELECT * FROM carencia_suprimentos WHERE id_ref = :id ";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(":id", $id);
        $stmt->execute();
        $suprimentos = $stmt->fetchAll();
        return $suprimentos;

    }
}
