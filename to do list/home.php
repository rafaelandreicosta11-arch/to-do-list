<?php
session_start();
include('conexao.php');

if (!isset($_SESSION['usuario'])) {
    header('Location: login.php');
    exit;
}

// obtém id do usuário logado
$usuario = $_SESSION['usuario'];
$result = $conexao->query("SELECT id FROM usuarios WHERE usuario='$usuario'");
$dadosUsuario = $result->fetch_assoc();
$usuario_id = $dadosUsuario['id'];

// inserir nova tarefa
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $titulo = trim($_POST['titulo']);
    if (!empty($titulo)) {
        $sql = "INSERT INTO tarefas (titulo, usuario_id) VALUES ('$titulo', '$usuario_id')";
        $conexao->query($sql);
    }
    header('Location: home.php');
    exit;
}

// excluir tarefa
if (isset($_GET['delete'])) {
    $id = $_GET['delete'];
    $conexao->query("DELETE FROM tarefas WHERE id=$id AND usuario_id=$usuario_id");
    header('Location: home.php');
    exit;
}

// listar tarefas do usuário logado
$tarefas = $conexao->query("SELECT * FROM tarefas WHERE usuario_id=$usuario_id ORDER BY id DESC");
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>To-do List</title>
   <link rel="stylesheet" href="style.css">

</head>
<body>
    <div class=task-card>
    <h2>Bem-vindo, <?php echo htmlspecialchars($usuario); ?>!</h2>

    <form method="POST" action="">
        <input type="text" name="titulo" placeholder="Digite uma nova tarefa">
        <button type="submit">Adicionar</button>
    </form>
    </div>

    <div class="tarefas">
        <?php while ($tarefa = $tarefas->fetch_assoc()): ?>
            <div class="tarefa">
                <span><?php echo htmlspecialchars($tarefa['titulo']); ?></span>
                <div>
                    <a href="editar.php?id=<?php echo $tarefa['id']; ?>">Editar</a> |
                    <a href="?delete=<?php echo $tarefa['id']; ?>" onclick="return confirm('Tem certeza que deseja excluir?')">Excluir</a>
                </div>
            </div>
        <?php endwhile; ?>
    </div>

    <a href="logout.php" class="logout-btn">Sair</a>
</body>
</html>
