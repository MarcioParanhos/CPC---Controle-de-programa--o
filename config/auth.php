<?php

session_start();
require_once("../models/User.php");
require_once("../models/Message.php");
require_once("../dao/UserDAO.php");
require_once("conect.php");
require_once("url.php");


$message = new Message($BASE_URL);
$userDao = new UserDAO($conn, $BASE_URL);

//Resgata o tipo do formulario
$type = filter_input(INPUT_POST, "type");
// verificação do tipo de formulario
if ($type == "register") {

    $name = filter_input(INPUT_POST, "name");
    $lastname = filter_input(INPUT_POST, "lastname");
    $email = filter_input(INPUT_POST, "email");
    $password = filter_input(INPUT_POST, "password");
    $new_password = filter_input(INPUT_POST, "new_password");
    $confirm_password = filter_input(INPUT_POST, "confirm_password");
    $cadastro_cpf = filter_input(INPUT_POST, "cadastro_cpf");

    $passwordCodificado = md5($password);


    // //verificação de dados minimos
    if ($name && $lastname && $password && $email && $cadastro_cpf) {

        //verificar se o email ja esta cadastrado no sistema
        if ($userDao->findByEmail($email) == false) {

            $user = new User();

            // Criação de token e senha
            $userToken = $user->generateToken();
            $user->name = $name;
            $user->lastname = $lastname;
            $user->email = $email;
            $user->password = $passwordCodificado;
            $user->cadastro_cpf = $cadastro_cpf;
            $user->token = $userToken;

            $auth = true;
            $userDao->create($user, $auth);
        } else {

            // Enviar msg de erro caso tente cadastrar o mesmo email
            $message->setMessage("Email já cadastrado!", "alert-danger", "back");
        }
    } else {
        // Enviar msg de erro caso tente cadastrar faltando algum campo
        $message->setMessage("Por favor, Preencha todos os campos !", "alert-danger", "back");
    }
} else if ($type == "login") {

    $email = filter_input(INPUT_POST, "email");
    $pass = filter_input(INPUT_POST, "password");
    $password = md5($pass);

    $querry = "SELECT * FROM usuarios WHERE email = :email AND password = :password";
    $stmt = $conn->prepare($querry);
    $stmt->bindParam(":email", $email);
    $stmt->bindParam(":password", $password);
    $stmt->execute();
    $users = $stmt->fetchAll();

    //tenta autenticar usuario
    if ($stmt->rowCount() > 0) {
        header("Location: ../home.php");
        foreach ($users as $user) :
            $_SESSION['name'] = $user['name'];
            $_SESSION['lastname'] = $user['lastname'];
            $_SESSION['perfil'] = $user['perfil'];
            $_SESSION['email'] = $user['email'];
            $_SESSION['cadastro_cpf'] = $user['cadastro_cpf'];
            $_SESSION['nte_info_status'] = 'todos';
        endforeach;
    } else {
        //redireciona o usuario caso nao autentique
        $message->setMessage("Usuário e/ou senha incorretos !", "alert-danger", "back");
    }
} else if ($type == "update-password") {

    $name = filter_input(INPUT_POST, "name");
    $lastname = filter_input(INPUT_POST, "lastname");
    $email = filter_input(INPUT_POST, "email");
    $passMD5 = filter_input(INPUT_POST, "password");
    $newPassMD5 = filter_input(INPUT_POST, "new_password");
    $newConfirmPassMD5 = filter_input(INPUT_POST, "confirm_password");
    $cadastro_cpf = filter_input(INPUT_POST, "cadastro_cpf");

    $password = md5($passMD5);
    $new_password = md5($newPassMD5);
    $confirm_password = md5($newConfirmPassMD5);

    $query = "SELECT password FROM usuarios WHERE email = :email";
    $stmt = $conn->prepare($query);
    $stmt->bindParam(":email", $email);
    $stmt->execute();
    $stmt = $stmt->fetch();
    $password_confirm = $stmt['password'];

    if ($password  != $password_confirm) {

        $message->setMessage("Senha atual incorreta !", "alert-danger", "back");
    } else if ($new_password != $confirm_password) {

        $message->setMessage("Confirmação de senha incorreta !", "alert-danger", "back");
    } else if ($new_password === $confirm_password) {

        $sql = "UPDATE usuarios SET
        password = :password
        WHERE 
        email = :email";

        $stmt = $conn->prepare($sql);
        $stmt->bindParam(":email", $email);
        $stmt->bindParam(":password", $new_password);

        if ($stmt->execute()) {
            $message->setMessage("Senha alterada com sucesso !", "alert-success", "back");
            die();
        } else {
            echo "Ocorreu um erro: " . $stmt->errorInfo();
        }
    }
} else if ($type == "update") {

    $name = filter_input(INPUT_POST, "name");
    $lastname = filter_input(INPUT_POST, "lastname");
    $email = filter_input(INPUT_POST, "email");
    $perfil = filter_input(INPUT_POST, "perfil");
    $cadastro_cpf = filter_input(INPUT_POST, "cadastro_cpf");
    $obs = filter_input(INPUT_POST, "obs");
    $id = filter_input(INPUT_POST, "id");

    $sql = "UPDATE usuarios SET
        name = :name,
        lastname = :lastname,
        email = :email,
        perfil = :perfil,
        cadastro_cpf = :cadastro_cpf,
        obs = :obs
        WHERE 
        id = :id";

    $stmt = $conn->prepare($sql);
    $stmt->bindParam(":id", $id);
    $stmt->bindParam(":name", $name);
    $stmt->bindParam(":email", $email);
    $stmt->bindParam(":lastname", $lastname);
    $stmt->bindParam(":perfil", $perfil);
    $stmt->bindParam(":cadastro_cpf", $cadastro_cpf);
    $stmt->bindParam(":obs", $obs);

    if ($stmt->execute()) {
        $message->setMessage("Registro alterado com sucesso !", "alert-success", "back");
        die();
    } else {
        echo "Ocorreu um erro: " . $stmt->errorInfo();
    }
} else {
    session_destroy();
    header('Location: ../index.php');
    exit();
}
