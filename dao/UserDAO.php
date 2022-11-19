<?php


class UserDAO implements UserDAOInterface
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

    public function bildUser($data)
    {

        $user = new User();
        $user->id = $data["id"];
        $user->name = $data["name"];
        $user->lastname = $data["lastname"];
        $user->email = $data["email"];
        $user->password = $data["password"];
        $user->cadastro_cpf = $data["cadastro_cpf"];
        $user->token = $data["token"];
        return $user;
    }

    public function create(User $user, $authUser = false)
    {

        $stmt = $this->conn->prepare("INSERT INTO usuarios (name, lastname, email, password, cadastro_cpf, token) VALUES (
            :name, :lastname, :email, :password, :cadastro_cpf, :token)");

        $stmt->bindParam(":name", $user->name);
        $stmt->bindParam(":lastname", $user->lastname);
        $stmt->bindParam(":email", $user->email);
        $stmt->bindParam(":password", $user->password);
        $stmt->bindParam(":cadastro_cpf", $user->cadastro_cpf);
        $stmt->bindParam(":token", $user->token);

        $stmt->execute();

        //Autenticar usuario caso seja true
        if ($authUser) {
            $this->setTokenToSession($user->token);
        }
    }

    public function update(User $user)
    {
    }

    public function verifyToken($protected = false)
    {
    }

    public function setTokenToSession($token, $redirect = true)
    {

        //Salvar Token na sessão
        $_SESSION["token"] = $token;

        if ($redirect) {
            header("Location: ../users.php");
            $_SESSION["msg"] =  "Usuário registrado com sucesso";
            $_SESSION["type"] = "alert-success";
        }
    }

    public function authenticateUser($email, $password)
    {
    }

    public function findByToken($token)
    {
    }

    public function findByEmail($email)
    {

        if ($email != "") {

            $stmt = $this->conn->prepare("SELECT * FROM usuarios WHERE email = :email");
            $stmt->bindParam(":email", $email);
            $stmt->execute();

            if ($stmt->rowCount() > 0) {

                $data = $stmt->fetch();
                $user = $this->bildUser($data);
                return $user;
            } else {
                return false;
            }
        } else {
            return false;
        }
    }

    public function findById($id)
    {
    }

    public function changePassword(User $user)
    {
    }

    public function getUsers()
    {
        $querry = "SELECT * FROM usuarios";
        $stmt = $this->conn->prepare($querry);
        $stmt->execute();
        $usuarios = $stmt->fetchAll();
        return $usuarios;
    }

    public function getUserById ($id) {

        $query = "SELECT * FROM usuarios WHERE id = :id ";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(":id", $id);
        $stmt->execute();
        $user = $stmt->fetch();
        return $user;

    }
}
