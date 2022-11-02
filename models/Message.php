<?php

class Message
{

    private $url;
    public function __construct($url)
    {
        $this->url = $url;
    }

    public function setMessage($mensagem, $type, $redirect = "index.php")
    {

        $_SESSION["mensagem"] = $mensagem;
        $_SESSION["type"] = $type;

        if ($redirect != "back") {
            header("Location: $this->url" . $redirect);
        } else {
            header("Location: " . $_SERVER["HTTP_REFERER"]);
        }
    }

    public function getMessage()
    {

        if (!empty($_SESSION["mensagem"])) {
            return [
                "mensagem" => $_SESSION["mensagem"],
                "type" => $_SESSION["type"]
            ];
        } else {
            return false;
        }
    }

    public function clearMessage()
    {

        $_SESSION["mensagem"] = "";
        $_SESSION["type"] = "";

    }
}
