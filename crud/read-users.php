<?php

include('config/conect.php');

$querry = "SELECT * FROM usuarios";

$stmt = $conn->prepare($querry);

$stmt->execute();

$usuarios = $stmt->fetchAll();