<?php

include('./conexao.php'); 
$conexao = new mysqli($host, $user, $password, $database);

session_start();

$titulo = mysqli_real_escape_string($conexao, $_POST['titulo']);
$descricao = mysqli_real_escape_string($conexao, $_POST['descricao']);
$data = mysqli_real_escape_string($conexao, $_POST['data']);
$tempo = mysqli_real_escape_string($conexao, $_POST['tempo']);
$id_usuario = $_SESSION['id'];

$query = "INSERT INTO tarefa(titulo, descricao, data, tempo, status , id_usuario) VALUES ('{$titulo}', '{$descricao}', '{$data}', '{$tempo}', 'pendente','{$id_usuario}')";

$result = mysqli_query($conexao, $query);

if ($result) {
  header('Location: ../../painel.php');
} else {
  echo "Ocorreu um erro ao adicionar a tarefa!";
}