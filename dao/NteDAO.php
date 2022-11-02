<?php


class Controle_nteDAO implements Controle_nteDAOInterface
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

    public function bildNte($data)
    {

        $controle_nte = new Controle_nte();
        $controle_nte->id = $data["id"];
        $controle_nte->nte = $data["nte"];
        $controle_nte->municipio = $data["municipio"];
        $controle_nte->unidade_escolar = $data["unidade_escolar"];
        $controle_nte->cod_unidade = $data["cod_unidade"];
        $controle_nte->digitacao = $data["digitacao"];
        $controle_nte->desc_digitacao = $data["desc_digitacao"];
        $controle_nte->homologacao = $data["homologacao"];
        $controle_nte->desc_homologacao = $data["desc_homologacao"];
        $controle_nte->carencia = $data["carencia"];
        $controle_nte->tipologia = $data["tipologia"];
        $controle_nte->componente = $data["componente"];
        $controle_nte->desc_componente = $data["desc_componente"];

        // retorna o objeto para insersão no banco de dados
        return $controle_nte;
    }
    public function create(Controle_nte $controle_nte)
    {
    }
    public function update(Controle_nte $controle_nte)
    {

        $sql = "UPDATE controle_ntes SET
        nte = :nte,
        municipio = :municipio,
        unidade_escolar = :unidade_escolar,
        cod_unidade = :cod_unidade,
        digitacao = :digitacao,
        desc_digitacao = :desc_digitacao,
        homologacao = :homologacao,
        desc_homologacao = :desc_homologacao,
        componente = :componente,
        desc_componente = :desc_componente
        WHERE 
        id = :id";

        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(":municipio", $controle_nte->municipio);
        $stmt->bindParam(":unidade_escolar", $controle_nte->unidade_escolar);
        $stmt->bindParam(":cod_unidade", $controle_nte->cod_unidade);
        $stmt->bindParam(":digitacao", $controle_nte->digitacao);
        $stmt->bindParam(":desc_digitacao", $controle_nte->desc_digitacao);
        $stmt->bindParam(":homologacao", $controle_nte->homologacao);
        $stmt->bindParam(":desc_homologacao", $controle_nte->desc_homologacao);
        $stmt->bindParam(":componente", $controle_nte->componente);
        $stmt->bindParam(":desc_componente", $controle_nte->desc_componente);
        $stmt->bindParam(":id", $controle_nte->id);
        $stmt->bindParam(":nte", $controle_nte->nte);


        // redireciona para a pagina de registro informando a mensagem de registro
        if ($stmt->execute()) {
            header("Location: ../details-nte.php?id=" . $controle_nte->id . "");
            $_SESSION["msg"] =  "Registros Alterados com Sucesso";
            die();
        } else {
            echo "Ocorreu um erro: " . $stmt->errorInfo();
        }
    }

    public function getNtes($nte)
    {

        $ntes = [];
        $stmt = $this->conn->prepare("SELECT * FROM controle_ntes WHERE nte = :nte");
        $stmt->bindParam(":nte", $nte);
        $stmt->execute();

        if ($stmt->rowCount() > 0) {

            $ntesArray = $stmt->fetchAll();

            foreach ($ntesArray as $nte) {

                $ntes[] = $this->bildNte($nte);
            }
        }

        return $ntes;
    }
    public function getNtesById($id)
    {

        $stmt = $this->conn->prepare("SELECT * FROM controle_ntes WHERE id =:id");
        $stmt->bindParam(":id", $id);
        $stmt->execute();

        $nte = $stmt->fetch();

        return $nte;
    }
}
