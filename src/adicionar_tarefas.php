<?php
  
  include('./php/db/verificar_login.php');
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Adicionar Tarefas</title>

  <link rel="stylesheet" href="./css/painel.css">

</head>
<body>

  <div id="pop-up" class="adicionar-tarefa">
    <form action="./php/db/add_tarefas.php" method="POST">
      <h1>Adicionar tarefa</h1>
        
        <div class="input-titulo">
          <label for="title">Título*</label>
          <input type="text" name="titulo" required>
        </div>

        <div class="input-descricao" style="position: relative;">
          <label for="description">Descrição</label>
          <textarea id="descricao" name="descricao" maxlength="250" cols="30" rows="10"></textarea>
        </div>

        <div class="input-data-hora">
          <div class="input-wrapper">
            <label for="date">Data*</label>
            <input type="date" name="data" required>
          </div>
          <div class="input-wrapper">
            <label for="time">Hora</label>
            <input type="time" name="tempo">
          </div>
        </div>

        
        <a href="./painel.php" class="sair">Voltar</a>
        <button type="submit">Adicionar</button>

      </form>

  </div>
</body>
</html>