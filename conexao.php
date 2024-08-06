<?php

$servername = "localhost";
$username = "root";
$senha = "";
$dbname = "arquivoSessao";
$conn = mysqli_connect($servername, $username, $senha, $dbname);

if (!$conn) {
    die("Falha na conexão: " .mysqli_connect_error());
}
?>