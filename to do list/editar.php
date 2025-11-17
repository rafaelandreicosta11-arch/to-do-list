<?php
session_start();
include('conexao.php');

if (!isset($_SESSION['usuario'])) {
    header('Location: login.php');
    exit;
}

$usuario = $_SESSION['usuario'];
$result = $conexao->query("SELECT id FROM usuarios WHERE usuario='$usuario'");
$dadosUsuario = $result->fetch_assoc();
$usuario_id = $dadosUsuario['id'];

$id = $_GET['id'] ?? null;

if (!$id) {
    header('Location: home.php');
    exit;
}

// Atualizar tarefa
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $novo_titulo = trim($_POST['titulo']);
    if (!empty($novo_titulo)) {
        $sql = "UPDATE tarefas SET titulo='$novo_titulo' WHERE id=$id AND usuario_id=$usuario_id";
        $conexao->query($sql);
        header('Location: home.php');
        exit;
    }
}

// Buscar tarefa atual
$sql = "SELECT * FROM tarefas WHERE id=$id AND usuario_id=$usuario_id";
$resultado = $conexao->query($sql);
$tarefa = $resultado->fetch_assoc();

if (!$tarefa) {
    header('Location: home.php');
    exit;
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
      <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Tarefa</title>
    <link rel="stylesheet" href="style.css">

</head>
<body>
    <div class="card">
        <h2>Editar Tarefa</h2>
        <form method="POST">
            <input type="text" name="titulo" value="<?php echo htmlspecialchars($tarefa['titulo']); ?>">
            <button type="submit">Salvar</button>
            <a href="home.php" class="btn-voltar">Cancelar</a>
        </form>
    </div>
</body>
</html>
