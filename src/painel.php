<?php
  include('./php/db/conexao.php'); 
  include('./php/db/verificar_login.php');
  $conexao = new mysqli($host, $user, $password, $database);

  $id_usuario = $_SESSION['id'];
  
  if (isset($_GET['busca'])) {
    $dataCompleta = $_GET['busca'];
    $dia = explode("/",$dataCompleta)[0];
    $mes = explode("/",$dataCompleta)[1];
    $ano = explode("/",$dataCompleta)[2];
    $busca = $ano.'-'.$mes.'-'.$dia;
  } else {
    $busca = '';
  }
  $queryPendentes = "SELECT id_tarefa, titulo, descricao, data, tempo FROM tarefa WHERE id_usuario = '{$id_usuario}' AND status = 'pendente' AND data LIKE '%{$busca}%' ORDER BY data, tempo ASC";

  $resultPendentes = mysqli_query($conexao, $queryPendentes);
  $arrayTarefasPendentes = mysqli_fetch_assoc($resultPendentes);
  $iPendentes = mysqli_num_rows($resultPendentes);

  $queryConcluidas = "SELECT id_tarefa, titulo, descricao, data, tempo FROM tarefa WHERE id_usuario = '{$id_usuario}' AND status = 'concluida' AND data LIKE '%{$busca}%' ORDER BY data, tempo ASC";
  
  $resultConcluidas = mysqli_query($conexao, $queryConcluidas);
 
  $arrayTarefasConcluidas = mysqli_fetch_assoc($resultConcluidas);

  $iConcluidas = mysqli_num_rows($resultConcluidas);

?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title> Painel </title>
  
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.css">
  <link rel="stylesheet" href="./css/painel.css">

  <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.11/jquery.mask.min.js"></script>
  <script>
    document.documentElement.className += ' js';
  </script>

</head>
<body>
  <section id="dashboard">    
    <header>
      <div class="container">
        <a href="painel.php" class="logotipo">
          <div class="icone">
            <i class="fa fa-check fa-lg fa-fw" aria-hidden="true"></i>
          </div>
          <h1>Gerenciador de Tarefas</h1>
        </a>
        <div class="perfil">
          <div class="avatar">

          </div>
          <div class="nome">
            <h1><?php echo $_SESSION['nome'];?></h1>
            <a href="./php/db/logout.php">
              <i class="fa fa-sign-out fa-lg fa-fw icone" aria-hidden="true"></i>
            </a>
          </div>          
        </div>
      </div>
    </header>
    <main>
      <div class="container">
        <div class="topo">
          <h1>Tarefas</h1>
          <div class="filtro">
            <a href=>Pendentes</a>
            <a href=>Concluídas</a>
          </div>
        </div>
        <div class="hero">
          <form class="pesquisa">
             
            <input name="busca" id="busca" type="text" placeholder="Pesquise por data (DD/MM/AAAA)">
            <button class="submit">
              <i class="fa fa-search fa-lg fa-fw" aria-hidden="true"></i>
            </button>
              
          </form>
          <a href="./adicionar_tarefas.php" class="adicionar">
              <div class="icone">
                <i class="fa fa-plus fa-lg fa-fw" aria-hidden="true"></i>
              </div>
              <h2>Nova tarefa</h2>
          </a>
        </div>
        <div class="cards">

          <div class="pendentes">
            <?php
              echo '<h1 class="mobile-title" style="margin: -5px 0 20px;">Pendentes</h1>';
              if($iPendentes > 0) {
                do {
            ?>

            <dl class="card js-card">
              <div>

              </div>
              <dt class="header">
                <a href="./php/db/editar_tarefas_pendentes.php?id_tarefa=<?= $arrayTarefasPendentes['id_tarefa']?>" class="check">
                  <i class="fa fa-check fa-lg fa-fw" aria-hidden="true"></i>
                </a>
                <h1><?php echo $arrayTarefasPendentes['titulo'];?></h1>
                <a class="seta" href="#">
                  <i class="fa fa-chevron-down fa-lg fa-fw setas ativo" aria-hidden="true"></i>
                  <i class="fa fa-chevron-up fa-lg fa-fw setas" aria-hidden="true"></i>
                </a>
              </dt>
              <dd>
                <p><?php echo $arrayTarefasPendentes['descricao'];?></p>
              </dd>
              <footer>
                <div class="data-hora">
                  <div class="data">
                    <i class="fa fa-calendar fa-lg fa-fw" aria-hidden="true"></i>
                    <span><?php echo $arrayTarefasPendentes['data'];?></span>
                  </div>
                  <div class="hora">
                    <img src="https://image.flaticon.com/icons/svg/1124/1124602.svg"></i>
                    <span><?php echo $arrayTarefasPendentes['tempo'];?></span>
                  </div>
                </div>
                <div class="opcoes">
                  <a href="./editar_tarefas.php?id_tarefa=<?= $arrayTarefasPendentes['id_tarefa']?>" class="editar">
                    <i class="fa fa-edit fa-lg fa-fw" aria-hidden="true"></i>
                  </a>
                  <a href="./php/db/deletar_tarefas.php?id_tarefa=<?php echo $arrayTarefasPendentes['id_tarefa'];?>" class="excluir">
                    <i class="fa fa-trash fa-lg fa-fw" aria-hidden="true"></i>
                  </a>
                </div>
              </footer>
            </dl>

            <?php
                }while($arrayTarefasPendentes = mysqli_fetch_assoc($resultPendentes));
              } 
            ?>
          </div>

          <div class="concluidas">
            <?php
              echo '<h1 class="mobile-title" style="margin: 40px 0 20px">Concluídas</h1>';
              if($iConcluidas > 0) {
                do {
            ?>
            <dl class="card js-card checked">
              <dt class="header">
                <a href="./php/db/eidtar_tarefas_concluidas.php?id_tarefa=<?= $arrayTarefasConcluidas['id_tarefa']?>" class="check checked">
                  <i class="fa fa-check fa-lg fa-fw" aria-hidden="true"></i>
                </a>
                <h1 class="riscado"><?php echo $arrayTarefasConcluidas['titulo'];?></h1>
                <a class="seta" href="#">
                  <i class="fa fa-chevron-down fa-lg fa-fw setas ativo" aria-hidden="true"></i>
                  <i class="fa fa-chevron-up fa-lg fa-fw setas" aria-hidden="true"></i>
                </a>
              </dt>
              <dd>
                <p><?php echo $arrayTarefasConcluidas['descricao'];?></p>
              </dd>
              <footer>
                <div class="data-hora">
                  <div class="data">
                    <i class="fa fa-calendar fa-lg fa-fw" aria-hidden="true"></i>
                    <span><?php echo $arrayTarefasConcluidas['data'];?></span>
                  </div>
                  <div class="hora">
                    <img src="https://image.flaticon.com/icons/svg/1124/1124602.svg"></i>
                    <span><?php echo $arrayTarefasConcluidas['tempo'];?></span>
                  </div>
                </div>
                <div class="opcoes">
                  <a href="./editar_tarefas.php?id_tarefa=<?= $arrayTarefasConcluidas['id_tarefa']?>" class="editar">
                    <i class="fa fa-edit fa-lg fa-fw" aria-hidden="true"></i>
                  </a>
                  <a href="./php/db/deletar_tarefas.php?id_tarefa=<?php echo $arrayTarefasConcluidas['id_tarefa'];?>" class="excluir">
                    <i class="fa fa-trash fa-lg fa-fw" aria-hidden="true"></i>
                  </a>
                </div>
              </footer>
            </dl>

            <?php
                }while($arrayTarefasConcluidas = mysqli_fetch_assoc($resultConcluidas));
              } else {
                echo '<h1 class="no-task">Nenhuma tarefa foi concluída!</h1>';
              }
            ?>
          </div>
        </div>
      </div>
    </main>
  </section>
  <script src="./js/scripts.js"></script>
  <script type="text/javascript">
    $("#busca").mask("00/00/0000");
  </script>
</body>
</html>