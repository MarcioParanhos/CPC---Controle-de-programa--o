<?php


class ContactsDAO implements ContactsDAOInterface {

    private $conn;
    private $url;
    private $message;

    public function __construct(PDO $conn, $url) {
        $this->conn = $conn;
        $this->url = $url;
        $this->Message = new Message($url);
    }

    public function bildContacts($data) {
        //Cria o objeto do Contacts
        $contacts = new Contacts();
        $contacts->id = $data["id"];
        $contacts->nte = $data["nte"];
        $contacts->municipio = $data["municipio"];
        $contacts->unidade_escolar = $data["unidade_escolar"];
        $contacts->cod_unidade = $data["cod_unidade"];
        $contacts->gestor = $data["gestor"];
        $contacts->tel_gestor = $data["tel_gestor"];
        $contacts->tel_unidade = $data["tel_unidade"];
        $contacts->email_gestor = $data["email_gestor"];
        $contacts->vice_gestor = $data["vice_gestor"];
        $contacts->tel_vice_gestor = $data["tel_vice_gestor"];
        $contacts->vice_gestor_2 = $data["vice_gestor_2"];
        $contacts->tel_vice_gestor_2 = $data["tel_vice_gestor_2"];
        $contacts->responsavel_pch = $data["responsavel_pch"];
        $contacts->obs = $data["obs"];
        // retorna o objeto para insersão no banco de dados
        return $contacts;
    }

    // função de criação onde recebe o parametro Contacts vindo da função Bild
    public function create(Contacts $contacts) {
       
    }

    public function update(Contacts $contacts) {

        // Sql de alterar os dados no banco
        $sql = "UPDATE contatos SET
        nte = :nte,
        municipio = :municipio,
        unidade_escolar = :unidade_escolar,
        cod_unidade = :cod_unidade,
        gestor = :gestor,
        tel_gestor = :tel_gestor,
        tel_unidade = :tel_unidade,
        email_gestor = :email_gestor,
        vice_gestor = :vice_gestor,
        tel_vice_gestor = :tel_vice_gestor,
        vice_gestor_2 = :vice_gestor_2,
        tel_vice_gestor_2 = :tel_vice_gestor_2,
        responsavel_pch = :responsavel_pch,
        obs = :obs
        WHERE 
        id = :id";

        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(":nte", $contacts->nte);
        $stmt->bindParam(":municipio", $contacts->municipio);
        $stmt->bindParam(":unidade_escolar", $contacts->unidade_escolar);
        $stmt->bindParam(":cod_unidade", $contacts->cod_unidade);
        $stmt->bindParam(":gestor", $contacts->gestor);
        $stmt->bindParam(":tel_gestor", $contacts->tel_gestor);
        $stmt->bindParam(":tel_unidade", $contacts->tel_unidade);
        $stmt->bindParam(":email_gestor", $contacts->email_gestor);
        $stmt->bindParam(":vice_gestor", $contacts->vice_gestor);
        $stmt->bindParam(":tel_vice_gestor", $contacts->tel_vice_gestor);
        $stmt->bindParam(":vice_gestor_2", $contacts->vice_gestor_2);
        $stmt->bindParam(":tel_vice_gestor_2", $contacts->tel_vice_gestor_2);
        $stmt->bindParam(":responsavel_pch", $contacts->responsavel_pch);
        $stmt->bindParam(":obs", $contacts->obs);
        $stmt->bindParam(":id", $contacts->id);

        // redireciona para a pagina de registro informando a mensagem de registro
        if($stmt->execute()){
        header("Location: ../details-contact.php?id=".$contacts->id."");
        $_SESSION["msg"] =  "Registros Alterados com Sucesso";
        die();
        } else {
        echo "Ocorreu um erro: ". $stmt->errorInfo();
        }
    }

    public function getContacts($nte) {
        
        $contacts = [];
        $stmt = $this->conn->prepare("SELECT * FROM contatos WHERE nte = :nte");
        $stmt->bindParam(":nte", $nte);
        $stmt->execute();

        if ($stmt->rowCount() > 0) {

            $contactsArray = $stmt->fetchAll();

            foreach ($contactsArray as $contact) {

                $contacts[] = $this->bildContacts($contact);
            }
        }

        return $contacts;
    }

    public function getContactsById($id) {
        
        $stmt = $this->conn->prepare("SELECT * FROM contatos WHERE id =:id");
        $stmt->bindParam(":id", $id);
        $stmt->execute();

        $contact = $stmt->fetch();

        return $contact;
    }
}
