<?php
session_start();
include 'connection.php';

// exige login
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit;
}

// inserir paciente (somente secretaria/admin)
if ($_SERVER["REQUEST_METHOD"] == "POST" && ($_SESSION['role'] == 'secretaria' || $_SESSION['role'] == 'admin')) {
    $nome = $_POST["nome"];
    $cpf = $_POST["cpf"];
    $data_nasc = $_POST["data_nascimento"];
    $telefone = $_POST["telefone"];

    $sql = "INSERT INTO pacientes (nome, cpf, data_nascimento, telefone) 
            VALUES ('$nome', '$cpf', '$data_nasc', '$telefone')";
    mysqli_query($conn, $sql);
}

// listar pacientes
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
  <h2>Pacientes</h2>
  
  <?php if($_SESSION['role'] == 'secretaria' || $_SESSION['role'] == 'admin'): ?>
  <form method="POST" class="mb-4">
    <input type="text" name="nome" class="form-control mb-2" placeholder="Nome" required>
    <input type="text" name="cpf" class="form-control mb-2" placeholder="CPF" required>
    <input type="date" name="data_nascimento" class="form-control mb-2" required>
    <input type="text" name="telefone" class="form-control mb-2" placeholder="Telefone">
    <button class="btn btn-primary">Cadastrar</button>
  </form>
  <?php endif; ?>

  <h3>Lista de Pacientes</h3>
  <table class="table table-bordered">
    <thead>
      <tr>
        <th>ID</th><th>Nome</th><th>CPF</th><th>Data Nasc.</th><th>Telefone</th><th>Ações</th>
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
        <td>
          <?php if($_SESSION['role'] == 'secretaria' || $_SESSION['role'] == 'admin'): ?>
          <a href="editar_paciente.php?id=<?= $p['id'] ?>" class="btn btn-sm btn-warning">Editar</a>
          <a href="excluir_paciente.php?id=<?= $p['id'] ?>" class="btn btn-sm btn-danger" onclick="return confirm('Excluir paciente?')">Excluir</a>
          <?php else: ?>
          <span class="text-muted">Sem permissão</span>
          <?php endif; ?>
        </td>
      </tr>
      <?php endwhile; ?>
    </tbody>
  </table>

  <a href="dashboard.php" class="btn btn-secondary">Voltar</a>
</body>
</html>
