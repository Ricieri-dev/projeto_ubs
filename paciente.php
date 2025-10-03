<?php
session_start();
include 'connection.php';

// Verifica se está logado
if (!isset($_SESSION['user_id'])){
    header("Location: login.php");
    exit;
}

// Inserir paciente
if($_SERVER["REQUEST_METHOD"] == "POST"){
    $nome = $_POST["nome"];
    $cpf = $_POST["cpf"];
    $data_nasc = $_POST["data_nascimento"];
    $telefone = $_POST["telefone"];

    $sql = "INSERT INTO pacientes (nome, cpf, data_nascimento, telefone) 
            VALUES ('$nome', '$cpf', '$data_nasc', '$telefone')";
    mysqli_query($conn, $sql);
}

// Listar pacientes
$sql = "SELECT * FROM pacientes ORDER BY id DESC";
$result = mysqli_query($conn, $sql);
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
  <meta charset="UTF-8">
  <title>Pacientes</title>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap/dist/css/bootstrap.min.css">
</head>
<body class="container mt-5">
  <h2>Cadastro de Pacientes</h2>

  <form method="POST" class="mb-4">
    <input type="text" name="nome" class="form-control mb-2" placeholder="Nome" required>
    <input type="text" name="cpf" class="form-control mb-2" placeholder="CPF" required>
    <input type="date" name="data_nascimento" class="form-control mb-2" required>
    <input type="text" name="telefone" class="form-control mb-2" placeholder="Telefone">
    <button class="btn btn-primary">Cadastrar</button>
  </form>

  <h3>Lista de Pacientes</h3>
  <table class="table table-bordered">
    <thead>
      <tr>
        <th>ID</th><th>Nome</th><th>CPF</th><th>Data Nasc.</th><th>Telefone</th>
      </tr>
    </thead>
    <tbody>
      <?php while($p = mysqli_fetch_assoc($result)): ?>
      <tr>
        <td><?= $p['id'] ?></td>
        <td><?= $p['nome'] ?></td>
        <td><?= $p['cpf'] ?></td>
        <td><?= $p['data_nascimento'] ?></td>
        <td><?= $p['telefone'] ?></td>
      </tr>
      <?php endwhile; ?>
    </tbody>
  </table>

  <a href="dashboard.php" class="btn btn-secondary">Voltar</a>
</body>
</html>
