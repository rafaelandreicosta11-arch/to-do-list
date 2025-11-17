<?php 
include("conexao.php");
session_start();

if (!empty($_POST['descricao'])) {
    $descricao = trim($_POST['descricao']);
    $sql = "INSERT INTO tarefas (descricao) VALUES ('$descricao')";
    $conexao->query($sql);
}

header("Location: index.php");
exit;
?>