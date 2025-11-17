<?php
session_start();
include('conexao.php');

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $usuario = $_POST['usuario'];
    $senha = $_POST['senha'];

    $sql = "SELECT * FROM usuarios WHERE usuario='$usuario'";
    $result = $conexao->query($sql);

    if ($result->num_rows > 0) {
        $dados = $result->fetch_assoc();
        if (password_verify($senha, $dados['senha'])) {
    $_SESSION['usuario'] = $usuario;
    $_SESSION['usuario_id'] = $dados['id']; // <-- salva o ID do usuário logado
    header('Location: home.php');
    exit;
}
else {
            echo "<script>alert('Senha incorreta!');</script>";
        }
    } else {
        echo "<script>alert('Usuário não encontrado!');</script>";
    }
}
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Login</title>
 <link rel="stylesheet" href="style.css"a>

</head>
<body>
  <div class="container">
    <h1>Login</h1>
    <form method="POST">
      <input type="text" name="usuario" placeholder="Usuário" required>
      <input type="password" name="senha" placeholder="Senha" required>
      <button type="submit">Entrar</button>
    </form>
    <p>Não tem conta? <a href="cadastro.php">Cadastre-se</a></p>
    <p><a href="index.php">Voltar</a></p>
  </div>
</body>
</html>
