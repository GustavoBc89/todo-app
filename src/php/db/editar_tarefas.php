<?php

include('./conexao.php');
$conexao = new mysqli($host, $user, $password, $database);

session_start();

$title = mysqli_real_escape_string($conexao, $_POST['titulo']);
$description = mysqli_real_escape_string($conexao, $_POST['descricao']);
$date = mysqli_real_escape_string($conexao, $_POST['data']);
$time = mysqli_real_escape_string($conexao, $_POST['tempo']);
$id_usuario = $_SESSION['id'];
$id_tarefa = mysqli_real_escape_string($conexao, $_POST['id_tarefa']);

$query = "UPDATE tarefa SET titulo = '{$title}', descricao = '{$description}', data = '{$date}', tempo = '{$time}' WHERE id_usuario = '{$id_usuario}' AND id_tarefa = '{$id_tarefa}'";

$result = mysqli_query($conexao, $query);

if ($result) {
  header('Location: ../../painel.php');
} else {
  echo "Ocorreu um erro ao atualizar a tarefa!";
}