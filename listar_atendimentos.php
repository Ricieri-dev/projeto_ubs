<?php include "connection.php"; ?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Lista de Atendimentos</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
    <div class="container mt-5">
        <div class="card shadow-lg p-4">
            <h2 class="mb-4 text-center">Atendimentos Registrados</h2>
            <table class="table table-striped table-hover">
                <thead class="table-dark">
                    <tr>
                        <th>ID</th>
                        <th>Paciente</th>
                        <th>Data/Hora</th>
                        <th>CID</th>
                        <th>Alta Médica</th>
                        <th>Encaminhamento</th>
                        <th>Observações</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $sql = "SELECT a.*, p.nome 
                            FROM atendimentos a 
                            JOIN pacientes p ON a.paciente_id = p.id 
                            ORDER BY a.data_hora DESC";
                    $result = mysqli_query($conn, $sql);
                    
                    while ($row = mysqli_fetch_assoc($result)) {
                        echo "<tr>";
                        echo "<td>".$row['id']."</td>";
                        echo "<td>".$row['nome']."</td>";
                        echo "<td>".$row['data_hora']."</td>";
                        echo "<td>".$row['cid']."</td>";
                        echo "<td>".($row['alta_medica'] ? "Sim" : "Não")."</td>";
                        echo "<td>".$row['encaminhamento']."</td>";
                        echo "<td>".$row['observacoes']."</td>";
                        echo "</tr>";
                    }
                    ?>
                </tbody>
            </table>
        </div>
    </div>
</body>
</html>
