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

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id = $_POST["id"];
    $nome = $_POST["nome"];
    $cpf = $_POST["cpf"];
    $data_nasc = $_POST["data_nascimento"];
    $telefone = $_POST["telefone"];

    $sql = "UPDATE pacientes SET nome='$nome', cpf='$cpf', data_nascimento='$data_nasc', telefone='$telefone' WHERE id=$id";
    mysqli_query($conn, $sql);

    header("Location: paciente.php");
    exit;
}

$sql = "SELECT * FROM pacientes WHERE id=$id";
$result = mysqli_query($conn, $sql);
$paciente = mysqli_fetch_assoc($result);
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
  <meta charset="UTF-8">
  <title>Editar Paciente</title>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap/dist/css/bootstrap.min.css">
</head>
<body class="container mt-5">
  <h2>Editar Paciente</h2>
  <form method="POST" class="w-50">
    <input type="hidden" name="id" value="<?= $paciente['id'] ?>">
    <input type="text" name="nome" class="form-control mb-2" value="<?= $paciente['nome'] ?>" required>
    <input type="text" name="cpf" class="form-control mb-2" value="<?= $paciente['cpf'] ?>" required>
    <input type="date" name="data_nascimento" class="form-control mb-2" value="<?= $paciente['data_nascimento'] ?>" required>
    <input type="text" name="telefone" class="form-control mb-2" value="<?= $paciente['telefone'] ?>">
    <button class="btn btn-primary">Salvar</button>
    <a href="paciente.php" class="btn btn-secondary">Cancelar</a>
  </form>
</body>
</html>
