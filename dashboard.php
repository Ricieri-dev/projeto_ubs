<?php
include "conexao.php";

// Contadores
$totalPacientes = mysqli_fetch_assoc(mysqli_query($conn, "SELECT COUNT(*) as total FROM pacientes"))['total'];
$totalUsuarios  = mysqli_fetch_assoc(mysqli_query($conn, "SELECT COUNT(*) as total FROM usuarios"))['total'];
$totalAtend     = mysqli_fetch_assoc(mysqli_query($conn, "SELECT COUNT(*) as total FROM atendimentos"))['total'];
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Dashboard</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="container mt-5">

    <h2 class="mb-4">📊 Dashboard</h2>

    <div class="row">
        <!-- Pacientes -->
        <div class="col-md-4">
            <div class="card text-bg-primary mb-3">
                <div class="card-body">
                    <h5 class="card-title">Pacientes</h5>
                    <p class="card-text fs-3"><?php echo $totalPacientes; ?></p>
                    <a href="pacientes.php" class="btn btn-light">Ver Pacientes</a>
                </div>
            </div>
        </div>

        <!-- Usuários -->
        <div class="col-md-4">
            <div class="card text-bg-success mb-3">
                <div class="card-body">
                    <h5 class="card-title">Usuários</h5>
                    <p class="card-text fs-3"><?php echo $totalUsuarios; ?></p>
                    <a href="usuarios.php" class="btn btn-light">Ver Usuários</a>
                </div>
            </div>
        </div>

        <!-- Atendimentos -->
        <div class="col-md-4">
            <div class="card text-bg-warning mb-3">
                <div class="card-body">
                    <h5 class="card-title">Atendimentos</h5>
                    <p class="card-text fs-3"><?php echo $totalAtend; ?></p>
                    <a href="atendimentos.php" class="btn btn-light">Ver Atendimentos</a>
                </div>
            </div>
        </div>
    </div>

</body>
</html>
