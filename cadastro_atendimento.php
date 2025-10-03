<?php include 'connection.php' ?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
        <meta charset="UTF-8">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
    
    <div class="containet mt-5">
        <div class="card shadow-lg p4">
            <h2 class="mb-4 text-center">Cadastrar Pacientes</h2>
            <form method="POST" action="">
                <!--Seleciona o paciente-->
                <div class="mb-3">
                    <label for="paciente_id" class="form-label">Paciente</label>
                    <select name="paciente_id" id="form-select" required>
                        <option value="">Selecione...</option>
                        <?php
                            
                            $result = mysqli_query($conn, "SELECT * FROM pacientes ORDER BY nome" );
                            while($row = mysqli_fetch_assoc($result)){
                                echo "<option value='".$row['id']."'>".$row['nome']." - ".$row['cpf']."</option>";
                            }
                        ?>

                    </select>
                </div>

                <!-- Data e hora -->
                <div class="mb-3">
                    <label class="form-label">Data e Hora</label>
                    <input type="datetime-local" name="data_hora" class="form-control" required>
                </div>

                <!-- CID -->
                <div class="mb-3">
                    <label class="form-label">CID</label>
                    <input type="text" name="cid" class="form-control" placeholder="Ex: J45" required>
                </div>

                <!-- Alta médica -->
                <div class="mb-3">
                    <label class="form-label">Alta Médica</label>
                    <select name="alta_medica" class="form-select">
                        <option value="0">Não</option>
                        <option value="1">Sim</option>
                    </select>
                </div>

                <!-- Encaminhamento -->
                <div class="mb-3">
                    <label class="form-label">Encaminhamento</label>
                    <select name="encaminhamento" class="form-select">
                        <option value="">Nenhum</option>
                        <option value="Cirurgia">Cirurgia</option>
                        <option value="Psicólogo">Psicólogo</option>
                        <option value="Exames">Exames</option>
                        <option value="Outro">Outro</option>
                    </select>
                </div>

                <!-- Observações -->
                <div class="mb-3">
                    <label class="form-label">Observações</label>
                    <textarea name="observacoes" class="form-control" rows="3"></textarea>
                </div>

                <button type="submit" name="cadastrar" class="btn btn-primary w-100">Cadastrar Atendimento</button>
            </form>

        </div>
    </div>
    


</body>
</html>

<?php
if (isset($_POST['cadastrar'])){
    $paciente_id = $_POST['paciente_id'];
    $data_hora = $_POST['data_hora'];
    $cid = $_POST['cid'];
    $alta = $_POST['alta_medica'];
    $encaminhamento = $_POST['encaminhamento'];
    $obs = $_POST['observacoes'];

    $sql = "INSERT INTO atendimentos (paciente_id, data_hora, cid, alta_medica, encaminhamento, observacoes)
            VALUES ('$paciente_id', '$data_hora', '$cid', '$alta', '$encaminhamento', '$obs')";

    if(mysqli_query($conn,$sql)){
        echo "<div class='container mt-3 alert alert-success'>Atendimento cadastrado com sucesso!</div>";
    }else{
        echo "<div class='container mt-3 alert alert-danger'>Erro: " . mysqli_error($conn) . "</div>";
        }
    }

?>