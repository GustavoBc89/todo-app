<?php

include('./conexao.php');
$conexao = new mysqli($host, $user, $password, $database);


session_start();

$id_usuario = $_SESSION['id'];
$id_tarefa = $_GET['id_tarefa'];

$query = "UPDATE tarefa SET status = 'concluida' WHERE id_usuario = '{$id_usuario}' AND id_tarefa = '{$id_tarefa}'";

$result = mysqli_query($conexao, $query);

if ($result) {
  header('Location: ../../painel.php');
} else {
  echo "Ocorreu um erro ao trocar o status a tarefa!";
}