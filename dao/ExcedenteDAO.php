<?php


class ExcedenteDAO implements ExcedenteDAOInterface
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

    public function bildExcedente($data)
    {

        //Cria o objeto
        $excedente = new Excedente();
        $excedente->id = $data["id"];
        $excedente->nte = $data["nte"];
        $excedente->municipio = $data["municipio"];
        $excedente->unidade_escolar = $data["unidade_escolar"];
        $excedente->cod_unidade = $data["cod_unidade"];
        $excedente->cadastro = $data["cadastro"];
        $excedente->nome = $data["nome"];
        $excedente->vinculo = $data["vinculo"];
        $excedente->ch = $data["ch"];
        $excedente->qtd_horas = $data["qtd_horas"];
        $excedente->formacao = $data["formacao"];
        $excedente->usuario = $data["usuario"];
        $excedente->data_add_user = $data["data_add_user"];
        // retorna o objeto para insersão no banco de dados
        return $excedente;
    }

    public function create(Excedente $excedente)
    {
        //Sql para insersão no banco
        $stmt = $this->conn->prepare("INSERT INTO excedentes (
          nte,
          municipio,
          unidade_escolar,
          cod_unidade,
          cadastro,
          nome,
          vinculo,
          ch,
          qtd_horas,
          formacao,
          usuario)
          VALUES (
          :nte,
          :municipio,
          :unidade_escolar,
          :cod_unidade,
          :cadastro,
          :nome,
          :vinculo,
          :ch,
          :qtd_horas,
          :formacao,
          :usuario)
          ");

        $stmt->bindParam(":nte", $excedente->nte);
        $stmt->bindParam(":municipio", $excedente->municipio);
        $stmt->bindParam(":unidade_escolar", $excedente->unidade_escolar);
        $stmt->bindParam(":cod_unidade", $excedente->cod_unidade);
        $stmt->bindParam(":cadastro", $excedente->cadastro);
        $stmt->bindParam(":nome", $excedente->nome);
        $stmt->bindParam(":vinculo", $excedente->vinculo);
        $stmt->bindParam(":ch", $excedente->ch);
        $stmt->bindParam(":qtd_horas", $excedente->qtd_horas);
        $stmt->bindParam(":formacao", $excedente->formacao);
        $stmt->bindParam(":usuario", $excedente->usuario);

        // se o Sql deu certo retorna para a tela de cadastro com uma mensagem de sucesso
        if ($stmt->execute()) {
            header('Location: ../excedentes.php');
            $_SESSION["msg"] =  "Registro Inserido com Sucesso";
            die();
        } else {
            echo "Ocorreu um erro: " . $stmt->errorInfo();
        }
    }

    public function update(Excedente $excedente)
    {

        // Sql de alterar os dados no banco
        $sql = "UPDATE excedentes SET
         nte = :nte,
         municipio = :municipio,
         unidade_escolar = :unidade_escolar,
         cod_unidade = :cod_unidade,
         cadastro = :cadastro,
         nome = :nome,
         vinculo = :vinculo,
         ch = :ch,
         qtd_horas = :qtd_horas,
         formacao = :formacao,
         usuario = :usuario
         WHERE 
         id = :id";

        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(":nte", $excedente->nte);
        $stmt->bindParam(":municipio", $excedente->municipio);
        $stmt->bindParam(":unidade_escolar", $excedente->unidade_escolar);
        $stmt->bindParam(":cod_unidade", $excedente->cod_unidade);
        $stmt->bindParam(":cadastro", $excedente->cadastro);
        $stmt->bindParam(":nome", $excedente->nome);
        $stmt->bindParam(":vinculo", $excedente->vinculo);
        $stmt->bindParam(":ch", $excedente->ch);
        $stmt->bindParam(":qtd_horas", $excedente->qtd_horas);
        $stmt->bindParam(":formacao", $excedente->formacao);
        $stmt->bindParam(":usuario", $excedente->usuario);
        $stmt->bindParam(":id", $excedente->id);

        // redireciona para a pagina de registro informando a mensagem de registro
        if ($stmt->execute()) {
            header("Location: ../details_excedentes.php?id=" . $excedente->id . "");
            $_SESSION["msg"] =  "Registros Alterados com Sucesso";
            die();
        } else {
            echo "Ocorreu um erro: " . $stmt->errorInfo();
        }
    }

    public function getExcedentes($perfil)
    {

        if ($perfil == 4) {

            $excedentes = [];
            $stmt = $this->conn->prepare("SELECT * FROM excedentes WHERE nte = '5' OR nte = '1' OR nte = '6' OR nte = '7' OR nte = '16' OR nte = '22' ORDER BY id DESC");
            $stmt->execute();

            if ($stmt->rowCount() > 0) {

                $excedentesArray = $stmt->fetchAll();

                foreach ($excedentesArray as $excedente) {

                    $excedentes[] = $this->bildExcedente($excedente);
                }
            }

            return $excedentes;
        }
    }

    public function getExcedenteById($id)
    {

        $stmt = $this->conn->prepare("SELECT * FROM excedentes WHERE id =:id");
        $stmt->bindParam(":id", $id);
        $stmt->execute();

        $excedente = $stmt->fetch();

        return $excedente;
    }
}
