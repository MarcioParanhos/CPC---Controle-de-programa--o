<?php

include('config/conect.php');

$id;

// Pega o ID do NTE passado por parametro na url e salva na variavel
if (!empty($_GET)) {
    $id = $_GET['id'];
}


if (!empty($id)) {

    // Retorna os dados de carencia REAL com a ID do NTE passado por parametro
    $querry = "SELECT * FROM carencias WHERE id_ref = :id_ref AND tipo_vaga = 'R' AND ano_ref = '2022'";
    $stmt = $conn->prepare($querry);
    $stmt->bindParam(":id_ref", $id);
    $stmt->execute();
    $real_carencias = $stmt->fetchAll();
    // Retorna os dados de carencia TEMPORARIA com a ID do NTE passado por parametro
    $querry = "SELECT * FROM carencias WHERE id_ref = :id_ref AND tipo_vaga = 'T' AND ano_ref = '2022'";
    $stmt = $conn->prepare($querry);
    $stmt->bindParam(":id_ref", $id);
    $stmt->execute();
    $temp_carencias = $stmt->fetchAll();

    // Atualiza dados se a unidade possuir carencia ou não
    $sql = "SELECT sum(total) as total FROM carencias WHERE id_ref = :id_ref ";
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(":id_ref", $id);
    $stmt->execute();
    $stmt = $stmt->fetch();
    $countCarencia_real = $stmt['total'];
    
    if ($countCarencia_real > 0) {
        $carencia = "Sim";
        $sql = "UPDATE controle_ntes SET carencia = :carencia WHERE id = :id";
        $query = $conn->prepare($sql);
        $query->bindParam(":id", $id);
        $query->bindParam(":carencia", $carencia);
        $query->execute();
    } else {
        $carencia = "Não";
        $sql = "UPDATE controle_ntes SET carencia = :carencia WHERE id = :id";
        $query = $conn->prepare($sql);
        $query->bindParam(":id", $id);
        $query->bindParam(":carencia", $carencia);
        $query->execute();
    }

    // Evia para a pagina do NTE a informação de qual nte as informações pertemcem via sessão.
    $_SESSION['id'] = $id;
        // Soma a quantidade de carencia no matutino passando ref_id como parametro
        $sql = "SELECT sum(matutino) as total FROM carencias WHERE id_ref = :id_ref AND tipo_vaga = 'T'";
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(":id_ref", $id);
        $stmt->execute();
        $stmt = $stmt->fetch();
        $countMatTemp = $stmt['total'];
    
        // Soma a quantidade de carencia no vespertino passando ref_id como parametro
        $sql = "SELECT sum(vespertino) as total FROM carencias WHERE id_ref = :id_ref AND tipo_vaga = 'T'";
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(":id_ref", $id);
        $stmt->execute();
        $stmt = $stmt->fetch();
        $countVespTemp = $stmt['total'];
    
        // Soma a quantidade de carencia no noturno passando ref_id como parametro
        $sql = "SELECT sum(noturno) as total FROM carencias WHERE id_ref = :id_ref AND tipo_vaga = 'T'";
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(":id_ref", $id);
        $stmt->execute();
        $stmt = $stmt->fetch();
        $countNotTemp = $stmt['total'];

    // Soma a quantidade de carencia no matutino passando ref_id como parametro
    $sql = "SELECT sum(matutino) as total FROM carencias WHERE id_ref = :id_ref AND tipo_vaga = 'R'";
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(":id_ref", $id);
    $stmt->execute();
    $stmt = $stmt->fetch();
    $countMatReal = $stmt['total'];

    // Soma a quantidade de carencia no vespertino passando ref_id como parametro
    $sql = "SELECT sum(vespertino) as total FROM carencias WHERE id_ref = :id_ref AND tipo_vaga = 'R'";
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(":id_ref", $id);
    $stmt->execute();
    $stmt = $stmt->fetch();
    $countVespReal = $stmt['total'];

    // Soma a quantidade de carencia no noturno passando ref_id como parametro
    $sql = "SELECT sum(noturno) as total FROM carencias WHERE id_ref = :id_ref AND tipo_vaga = 'R'";
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(":id_ref", $id);
    $stmt->execute();
    $stmt = $stmt->fetch();
    $countNotReal = $stmt['total'];

    // Select das informações da unidade passando id como parametro
    $querry = "SELECT * FROM controle_ntes WHERE id = :id";
    $stmt = $conn->prepare($querry);
    $stmt->bindParam(":id", $id);
    $stmt->execute();
    $controle_nte = $stmt->fetch();


    $query = "SELECT nome FROM disciplinas";
    $stmt = $conn->prepare($query);
    $stmt->execute();
    $disciplinas = $stmt->fetchAll();

    $query = "SELECT motivo FROM motivo_vaga";
    $stmt = $conn->prepare($query);
    $stmt->execute();
    $motivo_vagas = $stmt->fetchAll();

    $query = "SELECT motivo FROM motivo_vaga_temp";
    $stmt = $conn->prepare($query);
    $stmt->execute();
    $motivo_vagas_temps = $stmt->fetchAll();

    $querry = "SELECT * FROM carencias WHERE id = :id ";
    $stmt = $conn->prepare($querry);
    $stmt->bindParam(":id", $id);
    $stmt->execute();
    $vagas = $stmt->fetch();
}
