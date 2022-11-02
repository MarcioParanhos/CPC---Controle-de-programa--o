<?php

    //Salva as informações do banco em variaveis
    $host = "localhost";
    $db = "cpc";
    $user = "root";
    $pass = "";

    //variavel de conexao do banco pegado como parametro as veriaveis salvas
    $conn = new PDO("mysql:host=$host;dbname=$db", $user, $pass);