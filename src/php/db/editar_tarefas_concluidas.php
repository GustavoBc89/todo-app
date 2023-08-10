<?php

include('./conexao.php');

session_start();

$id_usuario = $_SESSION['id'];
$id_tarefa = $_GET['id_tarefa'];

$query = "UPDATE task SET status_tarefa = 'pendente' WHERE id_usuario = '{$id_usuario}' AND id_tarefa = '{$id_tarefa}'";

$result = mysqli_query($conexao, $query);

if ($result) {
  header('Location: ../../painel.php');
} else {
  echo "Ocorreu um erro ao trocar o status da tarefa!";
}