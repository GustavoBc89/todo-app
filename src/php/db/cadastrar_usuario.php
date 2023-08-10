<?php
session_start();

include('./conexao.php'); 
$conexao = new mysqli($host, $user, $password, $database);

$nome = mysqli_real_escape_string($conexao, $_POST['nome']);
$email = mysqli_real_escape_string($conexao, $_POST['email']);
$senha = mysqli_real_escape_string($conexao, $_POST['senha']);

$queryInsert = "INSERT INTO usuario(nome, email, senha) VALUES ('{$nome}', '{$email}', md5('{$senha}'))";

$result = mysqli_query($conexao, $queryInsert);

if (!$result) {
  $_SESSION['nao_autenticado_cadastro'] = true;
  header('Location: ../../index.php?erro=cadastro');
} else {
  header('Location: ../../index.php');
}