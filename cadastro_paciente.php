<?php include 'connection.php'; ?>

<!DOCTYPE html>
<html lang="pt-br">
    <head>
        <meta charset="UTF-8">
        <title>Cadastro de Pacientes</title>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    </head>
<body class="bg-light">
    <div class="container mt-5">
        <div class="card shadow-lg p-4">
            <h2 class="mb-4 text-center">Cadastrar Paciente</h2>
            <form method="POST" action="">
                <div class="mb-3">
                    <label for="nome" class="form-label">Nome</label>
                    <input type="text" name="nome" class="form-control" required>
                </div>

                <div class="mb-3">
                    <label class="form-label">CPF</label>
                    <input type="text" name="cpf" class="form-control" placeholder="000.000.000-00" required>
                </div>

                <div class="mb-3">
                    <label class="form-label">Data de Nascimento</label>
                    <input type="date" name="data_nascimento" class="form-control" required>
                </div>

                <div class="mb-3">
                    <label class="form-label">Telefone</label>
                    <input type="text" name="telefone" class="form-control">
                </div>

                <button type="submit" name="cadastrar" class="btn btn-primary w-100">Cadastrar</button>
            </form>

        </div>
    </div>
</body>
</html>

<?php
if (isset($_POST['cadastraar'])){
    $nome = $_POST['nome'];
    $cpf = $_POST['cpf'];
    $data_nasc = $_POST['data_nascimento'];
    $telefone = $_POST['telefone'];

    $sql = "INSERT INTO pacientes (nome, cpf, data_nascimento, telefone)
            VALUES ('$nome','$cpf','$data_nasc','$telefone')";

    if (mysqli_query($con, $sql)) {
        echo "<div class='container mt-3 alert alert-success'>Paciente cadastrado com sucesso !</div>";
    }else{
        echo "<div class='container mt-3 alert alert-danger'>Erro:".mysqli_error($conn)."</div>";
    }
} 



?>
