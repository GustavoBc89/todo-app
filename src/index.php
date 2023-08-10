<?php
  session_start();
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
  <meta charset="UTF-8">
  <title>Gerenciamento de Tarefas</title>

  <link rel="stylesheet" href="./css/index.css">

</head>
<body>
  <div id="login">
    <div class="container">
      <div class="left">       
        <div class="form" data-form="login">           
          <form action="./php/db/login.php" method="POST">
            <h1><span>Gerenciador de Tarefas</span></h1>

            <!-- Mensagem de erro -->
            <?php
              if(isset($_SESSION['nao_autenticado_login'])) {
            ?>  
            <div class="erro">
              <div class="icone">
                <i class="fa fa-exclamation fa-lg fa-fw" aria-hidden="true"></i>
              </div>
              <p>E-mail ou senha inválidos!</p>
            </div>
            <?php
              }
              unset($_SESSION['nao_autenticado_login'])
            ?>
            <!-- Mensagem de erro -->

            <div class="input">
              <input name="email" type="email" placeholder="E-mail*" required>
              <i class="fa fa-envelope fa-lg fa-fw" aria-hidden="true"></i>
            </div>            
            <div class="input">
              <input name="senha" type="password" placeholder="Senha*" required>
              <i class="fa fa-lock fa-lg fa-fw" aria-hidden="true"></i>
            </div>        
            
            <div class="botoes">
              <button type="submit">Entrar</button>
              <a href="#">Cadastre-se</a>
            </div>
          </form>
        </div>
        <div class="form" data-form="cadastro">
           
          <form action="./php/db/cadastrar_usuario" method="POST" class="cadastro">
            <h1>Faça o seu <span>cadastro</span></h1>

            <!-- Mensagem de erro -->
            <?php
              if(isset($_SESSION['nao_autenticado_cadastro'])) {
            ?>  
            <div class="erro">
              <div class="icone">
                <i class="fa fa-exclamation fa-lg fa-fw" aria-hidden="true"></i>
              </div>
              <p>E-mail já cadastrado!</p>
            </div>
            <?php
              }
              unset($_SESSION['nao_autenticado_cadastro'])
            ?>
            <!-- Mensagem de erro -->

            <div class="input">
              <input name="nome" type="text" placeholder="Nome*" required>
              <i class="fa fa-user fa-lg fa-fw" aria-hidden="true"></i>
            </div>  
            <div class="input">
              <input name="email" type="email" placeholder="E-mail*" required>
              <i class="fa fa-envelope fa-lg fa-fw" aria-hidden="true"></i>
            </div>            
            <div class="input">
              <input name="senha" type="password" placeholder="Senha*" required>
              <i class="fa fa-lock fa-lg fa-fw" aria-hidden="true"></i>
            </div>        
            
            <div class="botoes">
              <a href="#">Voltar</a>
              <button type="submit">Cadastre-se</button>
            </div>
          </form>
        </div>
      </div>
      <div class="right">   </div>

    </div>
  </div>
  <script src="./js/index.js"></script>
</body>
</html>