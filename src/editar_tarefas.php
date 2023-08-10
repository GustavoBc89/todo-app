<?php
  include("./php/db/conexao.php");
  include('./php/db/verificar_login.php');
  $conexao = new mysqli($host, $user, $password, $database);

  $id_tarefa = $_GET['id_tarefa'];

  $query = "SELECT * FROM tarefa where id_tarefa = '$id_tarefa'";
  $result = mysqli_query($conexao, $query);
  $tarefa = mysqli_fetch_array($result);
?>

<!DOCTYPE html>
<html lang="pt_br">
<head>
  
  <title>Editar Tarefas</title>
  <link rel="stylesheet" href="./css/painel.css">

</head>
<body>

  <div id="pop-up" class="editar-tarefa">
    <form action="./php/db/editar_tarefas.php" method="POST">
      <h1>Editar tarefa</h1>
      <div class="input-titulo">
        <label for="title">Título</label>
        <input type="text" name="titulo" placeholder="Informe o título da tarefa" value = "<?= $tarefa['titulo']?>">
      </div>

      <div class="input-descricao" style="position: relative;">
        <label for="description">Descrição</label>
        <textarea id="descricao" name="descricao" maxlength="250" cols="30" rows="10" placeholder="Digite uma breve descrição"><?= $tarefa['descricao']?></textarea>
        <div class="contador-de-caracteres" style="background-color: white; color: var(--principal); position: absolute; bottom: 10px; right: 10px; font-size: 14px;"></div>
      </div>

      <div class="input-data-hora">
        <div class="input-wrapper">
          <label for="date">Data</label>
          <input type="date" name="data" value = "<?= $tarefa['data']?>">
        </div>

        <div class="input-wrapper">
          <label for="time">Hora</label>
          <input type="time" name="tempo" value = "<?= $tarefa['tempo']?>">
        </div>
      </div>
        
      <input type="hidden" name="id_tarefa" value = "<?= $tarefa['id_tarefa']?>">

      <a href="./painel.php" class="sair">Voltar</a>
      <button type="submit">Editar</button>

    </form>
  </div>
</body>
</html>