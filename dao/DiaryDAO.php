<?php


class DiaryDAO implements DiaryDAOInterface
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

    public function bildDiary($data)
    {
        //Cria o objeto do diario
        $diary = new Diary();
        $diary->id = $data["id"];
        $diary->nte = $data["nte"];
        $diary->municipio = $data["municipio"];
        $diary->unidade_escolar = $data["unidade_escolar"];
        $diary->cod_unidade = $data["cod_unidade"];
        $diary->cadastro = $data["cadastro"];
        $diary->nome = $data["nome"];
        $diary->data_diario = $data["data_diario"];
        $diary->periodo = $data["periodo"];
        $diary->contato = $data["contato"];
        $diary->modo_contato = $data["modo_contato"];
        $diary->dia_contato = $data["dia_contato"];
        $diary->tipo = $data["tipo"];
        $diary->situacao = $data["situacao"];
        $diary->obs = $data["obs"];
        $diary->obs = $data["usuario"];
        // retorna o objeto para insersão no banco de dados
        return $diary;
    }

    // função de criação onde recebe o parametro Diary vindo da função Bild
    public function create(Diary $diary)
    {

        //Sql para insersão no banco
        $stmt = $this->conn->prepare("INSERT INTO diarios (
        nte,
        municipio,
        unidade_escolar,
        cod_unidade,
        cadastro,
        nome,
        data_diario,
        contato,
        modo_contato,
        dia_contato,
        periodo,
        tipo,
        situacao,
        obs,
        usuario )
        VALUES (
        :nte,
        :municipio,
        :unidade_escolar,
        :cod_unidade,
        :cadastro,
        :nome,
        :data_diario,
        :contato,
        :modo_contato,
        :dia_contato,
        :periodo,
        :tipo,
        :situacao,
        :obs,
        :usuario )
            ");

        $stmt->bindParam(":nte", $diary->nte);
        $stmt->bindParam(":municipio", $diary->municipio);
        $stmt->bindParam(":unidade_escolar", $diary->unidade_escolar);
        $stmt->bindParam(":cod_unidade", $diary->cod_unidade);
        $stmt->bindParam(":cadastro", $diary->cadastro);
        $stmt->bindParam(":nome", $diary->nome);
        $stmt->bindParam(":contato", $diary->contato);
        $stmt->bindParam(":modo_contato", $diary->modo_contato);
        $stmt->bindParam(":dia_contato", $diary->dia_contato);
        $stmt->bindParam(":data_diario", $diary->data_diario);
        $stmt->bindParam(":periodo", $diary->periodo);
        $stmt->bindParam(":tipo", $diary->tipo);
        $stmt->bindParam(":situacao", $diary->situacao);
        $stmt->bindParam(":obs", $diary->obs);
        $stmt->bindParam(":usuario", $diary->usuario);
        // se o Sql deu certo retorna para a tela de cadastro com uma mensagem de sucesso
        if ($stmt->execute()) {
            header('Location: ../include-diary.php');
            $_SESSION["msg"] =  "Registro Inserido com Sucesso";
            die();
        } else {
            echo "Ocorreu um erro: " . $stmt->errorInfo();
        }
    }

    public function update(Diary $diary)
    {

        // Sql de alterar os dados no banco
        $sql = "UPDATE diarios SET
        nte = :nte,
        municipio = :municipio,
        unidade_escolar = :unidade_escolar,
        cod_unidade = :cod_unidade,
        cadastro = :cadastro,
        nome = :nome,
        contato = :contato,
        modo_contato = :modo_contato,
        dia_contato = :dia_contato,
        data_diario = :data_diario,
        periodo = :periodo,
        tipo = :tipo,
        situacao = :situacao,
        obs = :obs,
        usuario = :usuario
        WHERE 
        id = :id";

        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(":nte", $diary->nte);
        $stmt->bindParam(":municipio", $diary->municipio);
        $stmt->bindParam(":unidade_escolar", $diary->unidade_escolar);
        $stmt->bindParam(":cod_unidade", $diary->cod_unidade);
        $stmt->bindParam(":cadastro", $diary->cadastro);
        $stmt->bindParam(":nome", $diary->nome);
        $stmt->bindParam(":contato", $diary->contato);
        $stmt->bindParam(":modo_contato", $diary->modo_contato);
        $stmt->bindParam(":dia_contato", $diary->dia_contato);
        $stmt->bindParam(":data_diario", $diary->data_diario);
        $stmt->bindParam(":periodo", $diary->periodo);
        $stmt->bindParam(":tipo", $diary->tipo);
        $stmt->bindParam(":situacao", $diary->situacao);
        $stmt->bindParam(":obs", $diary->obs);
        $stmt->bindParam(":usuario", $diary->usuario);
        $stmt->bindParam(":id", $diary->id);

        // redireciona para a pagina de registro informando a mensagem de registro
        if ($stmt->execute()) {
            header("Location: ../details-diary.php?id=" . $diary->id . "");
            $_SESSION["msg"] =  "Registros Alterados com Sucesso";
            die();
        } else {
            echo "Ocorreu um erro: " . $stmt->errorInfo();
        }
    }

    public function getDiarys($perfil)
    {
        if ($perfil == 4) {

            $diarys = [];
            $stmt = $this->conn->prepare("SELECT * FROM diarios WHERE nte = '5' OR nte = '1' OR nte = '6' OR nte = '7' OR nte = '16' OR nte = '22' ORDER BY id DESC");
            $stmt->execute();

            if ($stmt->rowCount() > 0) {

                $diarysArray = $stmt->fetchAll();

                foreach ($diarysArray as $diary) {

                    $diarys[] = $this->bildDiary($diary);
                }
            }

            return $diarys;
        }
    }

    public function getDiaryById($id)
    {

        $stmt = $this->conn->prepare("SELECT * FROM diarios WHERE id =:id");
        $stmt->bindParam(":id", $id);
        $stmt->execute();

        $diario = $stmt->fetch();

        return $diario;
    }
}
