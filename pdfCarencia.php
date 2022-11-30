<?php

use Dompdf\Dompdf;

require_once("./config/conect.php");
require_once("./config/url.php");
require_once('dompdf/autoload.inc.php');



$dompdf = new DOMPDF();

$type = $_GET['type'];
$id = $_GET['id'];

if ($type == "r") {
    $query = "SELECT * FROM carencias WHERE id_ref = :id_ref AND tipo_vaga = 'R' AND ano_ref = '2022'";
    $stmt = $conn->prepare($query);
    $stmt->bindParam(":id_ref", $id);
    $stmt->execute();
    $carencias = $stmt->fetchAll();

    $query = "SELECT * FROM controle_ntes WHERE id = :id";
    $stmt = $conn->prepare($query);
    $stmt->bindParam(":id", $id);
    $stmt->execute();
    $controle_nte = $stmt->fetch();
}


$html = '


<!DOCTYPE html>
<html lang="pt-br">



<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Relatorio de Carencia</title>

    <style>
    
        body {
            font-family: Helvetica, sans-serif;
        }
        #invoice {
            padding: 30px;
        }
        .invoice {
            position: relative;
            background-color: #FFF;
            min-height: 1200px;
      
        }
        .invoice header {
            padding: 10px 0;
            border-bottom: 1px solid #3989c6
        }
        .invoice .company-details {
            text-align: left;
            font-size: 14px;
            color: #232323
        }
        .invoice .company-details .name {
            margin-top: 0;
            margin-bottom: 0
        }
        .invoice .contacts {
            margin-bottom: 20px
        }
        .invoice .invoice-to {
            text-align: left
        }
        .invoice .invoice-to .to {
            margin-top: 0;
            margin-bottom: 0
        }
        .invoice .invoice-details {
            text-align: right
        }
        .invoice .invoice-details .invoice-id {
            margin-top: 0;
            color: #3989c6
        }
        .invoice main .thanks {
            margin-top: -100px;
            font-size: 2em;
            margin-bottom: 50px
        }
        .invoice main .notices {
            padding-left: 6px;
            border-left: 6px solid #3989c6
        }
        .invoice main .notices .notice {
            font-size: 1.2em
        }
        .invoice table {
            width: 100%;
            border-collapse: collapse;
            border-spacing: 0;
            margin-bottom: 20px
        }
        .invoice table td,
        .invoice table th {
            text-align: center;
            padding: 5px;
            background: #eee;
            border-bottom: 1px solid #fff;
            font-size: 13px;
        }
        .invoice table th {
            text-align: center;
            white-space: nowrap;
            font-weight: 400;
            font-size: 12px
        }
        .invoice table td h3 {
            text-align: center;
            margin: 0;
            font-weight: 400;
            color: #3989c6;
            font-size: 10px
        }

        .invoice table .qty,
        .invoice table .total,
        .invoice table .unit {
            text-align: center;
            font-size: 12px
        }
        .invoice table .no {
            color: #fff;
            text-align: center;
            font-size: 12px;
            background: #3989c6
        }
        .invoice table .unit {
            background: #ddd
        }
        .invoice table .total {
            background: #3989c6;
            color: #fff
        }
        .invoice table tbody tr:last-child td {
            border: none
        }
        .invoice table tfoot td {
            text-align: center;
            background: 0 0;
            border-bottom: none;
            white-space: nowrap;
            text-align: right;
            padding: 10px 20px;
            font-size: 1.2em;
            border-top: 1px solid #aaa
        }
        .invoice table tfoot tr:first-child td {
            border-top: none;
            text-align: center;
        }
        .invoice table tfoot tr:last-child td {
            color: #000000;
            text-align: center;
            font-size: 1.4em;
            border-top: 1px solid #3989c6
        }
        .invoice table tfoot tr td:first-child {
            border: none
        }
        .invoice footer {
            width: 100%;
            text-align: center;
            color: #777;
            border-top: 1px solid #aaa;
            padding: 8px 0
        }
        @media print {
            .invoice {
                font-size: 11px !important;
                overflow: hidden !important
            }
            .invoice footer {
                position: absolute;
                bottom: 10px;
                page-break-after: always
            }
            .invoice>div:last-child {
                page-break-before: always
            }
        }
    </style>
</head>
<body>
    <div class="row">
        <div class="col">
            <h3>Carência Escolar - Real</h3>
        </div>
        <div id="invoice">
            <div class="invoice overflow-auto">
                <div style="min-width: px">
                    <header>
                        <div class="row">
                            <div class="col company-details">
                                <div>NTE -  0' . $controle_nte["nte"] . '  </div>
                                <div>MUNICIPIO: ' . $controle_nte["municipio"] . '</div>
                                <div>UE: ' . $controle_nte["unidade_escolar"] . '  - ' . $controle_nte["cod_unidade"] . '</div>
                            </div>
                        </div>
                    </header>
                    <main>
                        <div class="row contacts">
                            <div class="col invoice-to">  
                            </div>
                            <div class="col invoice-details">
                                <h3 class="invoice-id"></h3>
                            </div>
                        </div>
                        <table  border="0" cellspacing="0" cellpadding="0">
                            <thead>
                                <tr>
                                    <th class="no">DISCIPLINA</th>
                                    <th class="no">MAT</th>
                                    <th class="no">VESP</th>
                                    <th class="no">NOT</th>
                                    <th class="no">TOTAL</th>
                                    <th class="no">SERVIDOR</th>
                                    <th class="no">CADASTRO</th>
                                    <th class="no">MOTIVO</th>
                                    <th class="no">TIPO DA VAGA</th>
                                    <th class="no">DATA INICIO</th>
                                </tr>
                            </thead>
                            <tbody>';
                                foreach ($carencias as $carencia) {
                                    $html .= '<tr>';
                                    $html .= '<td>' . $carencia["disciplina"] . '</td>';
                                    $html .= '<td>' . $carencia["matutino"] . '</td>';
                                    $html .= '<td>' . $carencia["vespertino"] . '</td>';
                                    $html .= '<td>' . $carencia["noturno"] . '</td>';
                                    $html .= '<td>' . $carencia["total"] . '</td>';
                                    $html .= '<td>' . $carencia["nome"] . '</td>';
                                    $html .= '<td>' . $carencia["cadastro"] . '</td>';
                                    $html .= '<td>' . $carencia["motivo_vaga"] . '</td>';
                                    $html .= '<td>' . 'Real' . '</td>';
                                    $html .= '<td>' . date('d/m/Y', strtotime($carencia["vespertino"])) . '</td>';
                                    $html .= '</tr>';
                                }
                                $html .= '<tr>
                                    <td class="no">TOTAL UEE</td>
                                    <td class="no">18</td>
                                    <td class="no">8</td>
                                    <td class="no">18</td>
                                    <td class="no">40</td>                          
                                </tr>
                            </tbody>
                            <tfoot>
                                <tr>
                                </tr>
                            </tfoot>
                        </table>  
                    </main>
                    <footer>
                    </footer>
                </div>
            <div>
        </div>
    </div>
</body>
</html>
';

$dompdf->load_html($html);

$dompdf->setPaper('A4', 'landscape');
$dompdf->render();
$dompdf->stream(
    "Relatorio de Carencia.pdf",
    array(
        "Attachment" => false
    )
);
