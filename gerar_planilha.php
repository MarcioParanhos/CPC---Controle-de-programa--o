<?php
ob_start();
include_once("config/conect.php");
include_once("config/url.php");
?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <?php
    // Pega o ID do NTE passado por parametro na url e salva na variavel
    $id;
    $tipo;

    if (!empty($_GET)) {
        $id = $_GET['id'];
        $tipo = $_GET['tipo'];
    }

    $querry = "SELECT * FROM controle_ntes WHERE id = :id";
    $stmt = $conn->prepare($querry);
    $stmt->bindParam(":id", $id);
    $stmt->execute();
    $controle_nte = $stmt->fetch();

    // Definimos o nome do arquivo que será exportado
    $arquivo = 'CARÊNCIA DETALHADA ' . $controle_nte['unidade_escolar'] . '.xls';

    // Criamos uma tabela HTML com o formato da planilha
    $html = '';
    $html .= '<table border="1">';
    $html .= '<tr>';
    if ($tipo === "r") {
        $html .= '<td bgcolor="##9cc2e5" align="center" colspan="16"><b><font size="4">CARÊNCIA REAL DETALHADA - ' . $controle_nte['unidade_escolar'] . '</font></b></tr>';
    } else if ($tipo === "t") {
        $html .= '<td bgcolor="##9cc2e5" align="center" colspan="16"><b><font size="4">CARÊNCIA TEMPORARIA DETALHADA - ' . $controle_nte['unidade_escolar'] . '</font></b></tr>';
    }
    $html .= '</tr>';


    $html .= '<tr>';
    $html .= '<td bgcolor="##9cc2e5" align="center"><b>NTE</b></td>';
    $html .= '<td bgcolor="##9cc2e5" align="center"><b>MUNICIPIO</b></td>';
    $html .= '<td bgcolor="##9cc2e5" align="center"><b>UEE</b></td>';
    $html .= '<td bgcolor="##9cc2e5" align="center"><b>COD.UNIDADE</b></td>';
    $html .= '<td bgcolor="##9cc2e5" align="center"><b>TIPO</b></td>';
    $html .= '<td bgcolor="##9cc2e5" align="center"><b>DISCIPLINA</b></td>';
    $html .= '<td bgcolor="##9cc2e5" align="center"><b>MAT</b></td>';
    $html .= '<td bgcolor="##9cc2e5" align="center"><b>VESP</b></td>';
    $html .= '<td bgcolor="##9cc2e5" align="center"><b>NOT</b></td>';
    $html .= '<td bgcolor="##9cc2e5" align="center"><b>TOTAL</b></td>';
    $html .= '<td bgcolor="##9cc2e5" align="center"><b>MATRICULA</b></td>';
    $html .= '<td bgcolor="##9cc2e5" align="center"><b>NOME</b></td>';
    $html .= '<td bgcolor="##9cc2e5" align="center"><b>VINCULO</b></td>';
    $html .= '<td bgcolor="##9cc2e5" align="center"><b>MOTIVO</b></td>';
    $html .= '<td bgcolor="##9cc2e5" align="center"><b>INICIO</b></td>';
    $html .= '<td bgcolor="##9cc2e5" align="center"><b>FIM</b></td>';

    //Selecionar todos os itens da tabela 
    $id;
    $tipo;

    // Pega o ID do NTE passado por parametro na url e salva na variavel
    if (!empty($_GET)) {
        $id = $_GET['id'];
        $tipo = $_GET['tipo'];
    }
    if ($tipo === "r") {

        $querry = "SELECT * FROM carencias WHERE id_ref = :id_ref AND tipo_vaga = 'R' AND ano_ref = '2022'";
        $stmt = $conn->prepare($querry);
        $stmt->bindParam(":id_ref", $id);
        $stmt->execute();
        $real_carencias = $stmt->fetchAll();

        foreach ($real_carencias as $real_carencia) {
            $total = $real_carencia["matutino"] + $real_carencia["vespertino"] + $real_carencia["noturno"];
            $html .= '<tr>';
            $html .= '<td align="center">' . $real_carencia['nte'] . '</td>';
            $html .= '<td>' . $real_carencia['municipio'] . '</td>';
            $html .= '<td>' . $real_carencia['unidade_escolar'] . '</td>';
            $html .= '<td align="center">' . $real_carencia['cod_unidade'] . '</td>';
            $html .= '<td align="center">' . $real_carencia['tipo_vaga'] . '</td>';
            $html .= '<td>' . $real_carencia['disciplina'] . '</td>';
            $html .= '<td align="center">' . $real_carencia['matutino'] . '</td>';
            $html .= '<td align="center">' . $real_carencia['vespertino'] . '</td>';
            $html .= '<td align="center">' . $real_carencia['noturno'] . '</td>';
            $html .= '<td align="center">' . $total . '</td>';
            $html .= '<td align="center">' . $real_carencia['cadastro'] . '</td>';
            $html .= '<td>' . $real_carencia['nome'] . '</td>';
            $html .= '<td>' . $real_carencia['vinculo'] . '</td>';
            $html .= '<td>' . $real_carencia['motivo_vaga'] . '</td>';
            $html .= '<td align="center">' . date('d/m/Y', strtotime($real_carencia["inicio_vaga"])) . '</td>';
            $html .= '<td align="center">' . date('d/m/Y', strtotime($real_carencia["fim_vaga"])) . '</td>';
            $html .= '</tr>';;
        }
    } else if ($tipo === "t") {

        $querry = "SELECT * FROM carencias WHERE id_ref = :id_ref AND tipo_vaga = 'T' AND ano_ref = '2022'";
        $stmt = $conn->prepare($querry);
        $stmt->bindParam(":id_ref", $id);
        $stmt->execute();
        $temp_carencias = $stmt->fetchAll();

        

        foreach ($temp_carencias as $temp_carencia) {
            $total = $temp_carencia["matutino"] + $temp_carencia["vespertino"] + $temp_carencia["noturno"];
            $html .= '<tr>';
            $html .= '<td align="center">' . $temp_carencia['nte'] . '</td>';
            $html .= '<td>' . $temp_carencia['municipio'] . '</td>';
            $html .= '<td>' . $temp_carencia['unidade_escolar'] . '</td>';
            $html .= '<td align="center">' . $temp_carencia['cod_unidade'] . '</td>';
            $html .= '<td align="center">' . $temp_carencia['tipo_vaga'] . '</td>';
            $html .= '<td>' . $temp_carencia['disciplina'] . '</td>';
            $html .= '<td align="center">' . $temp_carencia['matutino'] . '</td>';
            $html .= '<td align="center">' . $temp_carencia['vespertino'] . '</td>';
            $html .= '<td align="center">' . $temp_carencia['noturno'] . '</td>';
            $html .= '<td align="center">' . $total . '</td>';
            $html .= '<td align="center">' . $temp_carencia['cadastro'] . '</td>';
            $html .= '<td>' . $temp_carencia['nome'] . '</td>';
            $html .= '<td>' . $temp_carencia['vinculo'] . '</td>';
            $html .= '<td>' . $temp_carencia['motivo_vaga'] . '</td>';
            $html .= '<td align="center">' . date('d/m/Y', strtotime($temp_carencia["inicio_vaga"])) . '</td>';
            $html .= '<td align="center">' . date('d/m/Y', strtotime($temp_carencia["fim_vaga"])) . '</td>';
            $html .= '</tr>';;
        }
    }

    // Configurações header para forçar o download
    header("Expires: Mon, 26 Jul 1997 05:00:00 GMT");
    header("Last-Modified: " . gmdate("D,d M YH:i:s") . " GMT");
    header("Cache-Control: no-cache, must-revalidate");
    header("Pragma: no-cache");
    header("Content-type: application/x-msexcel");
    header("Content-Disposition: attachment; filename=\"{$arquivo}\"");
    header("Content-Description: PHP Generated Data");
    // Envia o conteúdo do arquivo
    echo $html;
    exit; ?>
</body>

</html>