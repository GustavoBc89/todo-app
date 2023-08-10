<?php

session_start();

include('./conexao.php'); 
$conexao = new mysqli($host, $user, $password, $database);

if(empty($_POST['email']) || empty($_POST['senha'])) {
  header('Location: ../../index.php');
  exit();
}

$email = mysqli_real_escape_string($conexao, $_POST['email']);
$senha = mysqli_real_escape_string($conexao, $_POST['senha']);

$query = "SELECT id_usuario, nome FROM usuario WHERE email = '{$email}' and senha = md5('{$senha}')";

$result = mysqli_query($conexao, $query);

$row = mysqli_num_rows($result);


if ($row == 1) {
  while ($rows = mysqli_fetch_assoc($result)) { 
    $_SESSION['id'] = $rows['id_usuario'];
    $_SESSION['nome'] = $rows['nome'];
  };
  header("Location: ../../painel.php");
} else {
  $_SESSION['nao_autenticado_login'] = true;
  header('Location: ../../index.php?erro=login');
}


