<?php
session_start();
include 'connection.php';

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit;
}
if ($_SESSION['role'] != 'secretaria' && $_SESSION['role'] != 'admin') {
    die("Acesso negado");
}

$id = $_GET['id'];
$sql = "DELETE FROM pacientes WHERE id=$id";
mysqli_query($conn, $sql);

header("Location: paciente.php");
exit;
