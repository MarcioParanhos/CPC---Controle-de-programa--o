<?php
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

    // Definimos o nome do arquivo que será exportado
    $arquivo = 'CARÊNCIA DETALHADA.xls';

    // Criamos uma tabela HTML com o formato da planilha
    $html = '';
    $html .= '<table border="1">';
    $html .= '<tr>';
    $html .= '<td bgcolor="##9cc2e5" align="center" colspan="10"><b><font size="4">CARÊNCIA REAL DETALHADA - </font></b></tr>';
    $html .= '</tr>';


    $html .= '<tr>';
    $html .= '<td bgcolor="##9cc2e5" align="center"><b>NTE</b></td>';
    $html .= '<td bgcolor="##9cc2e5" align="center"><b>MUNICIPIO</b></td>';
    $html .= '<td bgcolor="##9cc2e5" align="center"><b>UEE</b></td>';
    $html .= '<td bgcolor="##9cc2e5" align="center"><b>COD.UNIDADE</b></td>';
    $html .= '<td bgcolor="##9cc2e5" align="center"><b>NOME</b></td>';
    $html .= '<td bgcolor="##9cc2e5" align="center"><b>CADASTRO</b></td>';
    $html .= '<td bgcolor="##9cc2e5" align="center"><b>VINCULO</b></td>';
    $html .= '<td bgcolor="##9cc2e5" align="center"><b>CH</b></td>';
    $html .= '<td bgcolor="##9cc2e5" align="center"><b>QTD. EXCEDENTES</b></td>';
    $html .= '<td bgcolor="##9cc2e5" align="center"><b>FORMAÇÃO</b></td>';




    $html .= '<tr>';
    $html .= '<td align="center">Teste</td>';
    $html .= '<td>teste</td>';
    $html .= '<td>teste</td>';
    $html .= '<td align="center">teste</td>';
    $html .= '<td align="center">teste</td>';
    $html .= '<td align="center">teste</td>';
    $html .= '<td align="center">teste</td>';
    $html .= '<td align="center">teste</td>';
    $html .= '<td align="center">teste</td>';
    $html .= '<td align="center">teste</td>';
    $html .= '</tr>';;


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