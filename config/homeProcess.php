<?php

session_start();

$nte_search_home = filter_input(INPUT_POST, "nte_search_home");
$type = filter_input(INPUT_POST, "type");

if ($type == 'search') {
    $_SESSION['nte_info_status'] = $nte_search_home;
    header("Location: ../home.php");
}
