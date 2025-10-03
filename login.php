<?php
session_start();
include 'connection.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $email = $_POST['email'];
    $senha = $_POST['senha']; // 

    // busca usuário pelo email
    $sql = "SELECT * FROM usuarios WHERE email = '$email' LIMIT 1";
    $result = mysqli_query($conn, $sql);

    if (mysqli_num_rows($result) == 1) {
        $user = mysqli_fetch_assoc($result);

        // comparar senha (simples, já que não foi ensinado hash)
        if ($senha == $user["senha"]) {
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['nome'] = $user['nome'];

            header('Location: dashboard.php');
            exit;
        } else {
            $erro = 'Senha incorreta!';
        }
    } else {
        $erro = 'Usuário não encontrado!';
    }
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Login</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap/dist/css/bootstrap.min.css">
</head>
<body class="container mt-5">
    <h2>Login</h2>
    <?php if (isset($erro)) echo "<p class='text-danger'>$erro</p>"; ?>

    <form method="POST">
        <input type="email" name="email" class="form-control mb-2" placeholder="Email" required>
        <input type="password" name="senha" class="form-control mb-2" placeholder="Senha" required>
        <button class="btn btn-primary">Entrar</button>
    </form>
</body>
</html>
