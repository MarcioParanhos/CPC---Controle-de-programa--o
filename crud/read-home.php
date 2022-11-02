<?php

include('config/conect.php');

// CONCLUIDAS SEDE
$sql = "SELECT homologacao, count(*) as total FROM controle_ntes WHERE homologacao = 'Homologada' AND tipologia = 'Sede'";
$sql = $conn->query($sql);
$sql = $sql->fetch();
$countHomologadasSede = $sql['total'];
// CONCLUIDAS ANEXO
$sql = "SELECT homologacao, count(*) as total FROM controle_ntes WHERE homologacao = 'Homologada' AND tipologia = 'Anexo'";
$sql = $conn->query($sql);
$sql = $sql->fetch();
$countHomologadasAnexo = $sql['total'];
// CONCLUIDAS DIGITAÇÃO SEDE
$sql = "SELECT digitacao, count(*) as total FROM controle_ntes WHERE digitacao = 'Concluida' AND tipologia = 'Sede'";
$sql = $conn->query($sql);
$sql = $sql->fetch();
$countDigitadasSede = $sql['total'];
// CONCLUIDAS DIGITAÇÃO ANEXO
$sql = "SELECT digitacao, count(*) as total FROM controle_ntes WHERE digitacao = 'Concluida' AND tipologia = 'Anexo'";
$sql = $conn->query($sql);
$sql = $sql->fetch();
$countDigitadasAnexo = $sql['total'];
// CARENCIA REAL
$sql = "SELECT sum(total) as total FROM carencias WHERE tipo_vaga = 'R' ";
$stmt = $conn->prepare($sql);
$stmt->execute();
$stmt = $stmt->fetch();
$countCarencia_real = $stmt['total'];
// CARENCIA TEMPORARIA
$sql = "SELECT sum(total) as total FROM carencias WHERE tipo_vaga = 'T' ";
$stmt = $conn->prepare($sql);
$stmt->execute();
$stmt = $stmt->fetch();
$countCarencia_temp = $stmt['total'];
// PENDENTE HOMOLOGAR SEDE
$sql = "SELECT homologacao, count(*) as total FROM controle_ntes WHERE homologacao = 'Pendente' AND tipologia = 'Sede'";
$sql = $conn->query($sql);
$sql = $sql->fetch();
$countHomologadasPendentesSedes = $sql['total'];
// PENDENTE HOMOLOGAR ANEXO
$sql = "SELECT homologacao, count(*) as total FROM controle_ntes WHERE homologacao = 'Pendente' AND tipologia = 'Anexo'";
$sql = $conn->query($sql);
$sql = $sql->fetch();
$countHomologadasPendentesAnexos = $sql['total'];


// INFORMAÇÕES DO NTE 01
$sql = "SELECT homologacao, count(*) as total FROM controle_ntes WHERE nte = '1'";
$sql = $conn->query($sql);
$sql = $sql->fetch();
$countUnidadesNte01 = $sql['total'];
// QUANT TOTAL DE UNIDADES SEDES
$sql = "SELECT homologacao, count(*) as total FROM controle_ntes WHERE tipologia = 'Sede' AND nte = '1'";
$sql = $conn->query($sql);
$sql = $sql->fetch();
$countUnidadesNte01Sedes = $sql['total'];
// QUANT TOTAL DE UNIDADES ANEXO
$sql = "SELECT homologacao, count(*) as total FROM controle_ntes WHERE tipologia = 'Anexo' AND nte = '1'";
$sql = $conn->query($sql);
$sql = $sql->fetch();
$countUnidadesNte01Anexos = $sql['total'];
// QUANT TOTAL DE UNIDADES SEDES DIGITADAS
$sql = "SELECT digitacao, count(*) as total FROM controle_ntes WHERE digitacao = 'Concluida' AND tipologia = 'Sede' AND nte = '1'";
$sql = $conn->query($sql);
$sql = $sql->fetch();
$countDigitadasSedeNte01 = $sql['total'];
// QUANT TOTAL DE UNIDADES ANEXOS DIGITADAS
$sql = "SELECT digitacao, count(*) as total FROM controle_ntes WHERE digitacao = 'Concluida' AND tipologia = 'Anexo' AND nte = '1'";
$sql = $conn->query($sql);
$sql = $sql->fetch();
$countDigitadasAnexoNte01 = $sql['total'];
// CONCLUIDAS SEDE
$sql = "SELECT homologacao, count(*) as total FROM controle_ntes WHERE homologacao = 'Concluida' AND tipologia = 'Sede' AND nte = '1'";
$sql = $conn->query($sql);
$sql = $sql->fetch();
$countHomologadasSedeNte01 = $sql['total'];
// CONCLUIDAS Anexo
$sql = "SELECT homologacao, count(*) as total FROM controle_ntes WHERE homologacao = 'Concluida' AND tipologia = 'Anexo' AND nte = '1'";
$sql = $conn->query($sql);
$sql = $sql->fetch();
$countHomologadasAnexoNte01 = $sql['total'];



// INFOS NTE 05
$sql = "SELECT homologacao, count(*) as total FROM controle_ntes WHERE nte = '5'";
$sql = $conn->query($sql);
$sql = $sql->fetch();
$countUnidadesNte05 = $sql['total'];
// QUANT TOTAL DE UNIDADES SEDES
$sql = "SELECT homologacao, count(*) as total FROM controle_ntes WHERE tipologia = 'Sede' AND nte = '5'";
$sql = $conn->query($sql);
$sql = $sql->fetch();
$countUnidadesNte05Sedes = $sql['total'];
// QUANT TOTAL DE UNIDADES ANEXO
$sql = "SELECT homologacao, count(*) as total FROM controle_ntes WHERE tipologia = 'Anexo' AND nte = '5'";
$sql = $conn->query($sql);
$sql = $sql->fetch();
$countUnidadesNte05Anexos = $sql['total'];
// QUANT TOTAL DE UNIDADES SEDES DIGITADAS
$sql = "SELECT digitacao, count(*) as total FROM controle_ntes WHERE digitacao = 'Concluida' AND tipologia = 'Sede' AND nte = '5'";
$sql = $conn->query($sql);
$sql = $sql->fetch();
$countDigitadasSedeNte05 = $sql['total'];
// QUANT TOTAL DE UNIDADES ANEXOS DIGITADAS
$sql = "SELECT digitacao, count(*) as total FROM controle_ntes WHERE digitacao = 'Concluida' AND tipologia = 'Anexo' AND nte = '5'";
$sql = $conn->query($sql);
$sql = $sql->fetch();
$countDigitadasAnexoNte05 = $sql['total'];
// CONCLUIDAS SEDE
$sql = "SELECT homologacao, count(*) as total FROM controle_ntes WHERE homologacao = 'Concluida' AND tipologia = 'Sede' AND nte = '5'";
$sql = $conn->query($sql);
$sql = $sql->fetch();
$countHomologadasSedeNte05 = $sql['total'];
// CONCLUIDAS Anexo
$sql = "SELECT homologacao, count(*) as total FROM controle_ntes WHERE homologacao = 'Concluida' AND tipologia = 'Anexo' AND nte = '5'";
$sql = $conn->query($sql);
$sql = $sql->fetch();
$countHomologadasAnexoNte05 = $sql['total'];