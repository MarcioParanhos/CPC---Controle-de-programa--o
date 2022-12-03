<?php

session_start();
require_once("../models/Carencia.php");
require_once("../dao/CarenciaDAO.php");
require_once("conect.php");
require_once("url.php");

$id = $_GET['id'];

$query = "SELECT * FROM carencia_suprimentos WHERE id = :id";
$stmt = $conn->prepare($query);
$stmt->bindParam(":id", $id);
$stmt->execute();
$suprimento = $stmt->fetch();

$id_ref = $suprimento['id_ref'];

$query = "SELECT * FROM carencias WHERE id = $id_ref";
$stmt = $conn->prepare($query);
$stmt->execute();
$carencia = $stmt->fetch();

$matutino = ($suprimento['mat_suprimento'] + $carencia['matutino']);
$vespertino = ($suprimento['vesp_suprimento'] + $carencia['vespertino']);
$noturno = ($suprimento['not_suprimento'] + $carencia['noturno']);
$total = $matutino + $vespertino + $noturno;

$query = "DELETE  FROM carencia_suprimentos WHERE id = :id";
$stmt = $conn->prepare($query);
$stmt->bindParam(":id", $id);

if ($stmt->execute()) {
    $sql = "UPDATE carencias SET
        matutino = :matutino,
        vespertino = :vespertino,
        noturno = :noturno,
        total = :total 
        WHERE 
        id = $id_ref";
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(":matutino", $matutino);
    $stmt->bindParam(":vespertino", $vespertino);
    $stmt->bindParam(":noturno", $noturno);
    $stmt->bindParam(":total", $total);
    if ($stmt->execute()) {
        header("Location: ../details-carencia.php?id=" .  $suprimento['id_ref'] . "");
        $_SESSION["msg"] =  "Registro Excluido com Sucesso, Quantitativo de carencia atualizado!";
        $_SESSION["info_msg"] = 'alert-success';
        die();
    }
}
