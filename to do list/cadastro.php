<?php
include('conexao.php');

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $usuario = trim($_POST['usuario']);
    $senha = trim($_POST['senha']);

    if (!empty($usuario) && !empty($senha)) {
        // Verifica se o usuário já existe
        $check = $conexao->query("SELECT * FROM usuarios WHERE usuario='$usuario'");
        if ($check->num_rows > 0) {
            echo "<script>alert('Usuário já existe! Escolha outro nome.');</script>";
        } else {
            // Criptografa a senha
            $senhaHash = password_hash($senha, PASSWORD_DEFAULT);
            $sql = "INSERT INTO usuarios (usuario, senha) VALUES ('$usuario', '$senhaHash')";
            if ($conexao->query($sql)) {
                echo "<script>alert('Usuário cadastrado com sucesso! Faça login.'); window.location='login.php';</script>";
            } else {
                echo "<script>alert('Erro ao cadastrar.');</script>";
            }
        }
    } else {
        echo "<script>alert('Preencha todos os campos!');</script>";
    }
}
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
  <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Criar Conta</title>
<link rel="stylesheet" href="style.css">

</head>
<body>
  <div class="container">
    <h1>Cadastro</h1>
    <form method="POST">
      <input type="text" name="usuario" placeholder="Usuário" required>
      <input type="password" name="senha" placeholder="Senha" required>
      <button type="submit">Cadastrar</button>
    </form>
    <p>Já tem conta? <a href="login.php">Faça login</a></p>
  </div>
</body>
</html>
