<?php
$host = "localhost";
$user = "root"; // seu usuário
$pass = "";     // sua senha
$dbname = "saude";

$conn = mysqli_connect($host, $user, $pass, $dbname);

if (!$conn) {
    die("Erro na conexão: " . mysqli_connect_error());
} else {
    echo "Conexão OK!";
}
?>
