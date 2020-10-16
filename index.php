<?php 
include_once("conexao.php");
session_start();
?>
<!doctype html>
<html lang="pt-br">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.1/css/all.css" integrity="sha384-vp86vTRFVJgpjF9jiIGPEEqYqlDwgyBgEF109VFjmqGmIY/Y4HV4d3Gp2irVfcrp" crossorigin="anonymous">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@600&display=swap" rel="stylesheet">
    <link rel="shortcut icon" href="img/task.png"/> 
    <link rel="stylesheet" href="css/style.css">
    <title>Task List</title>
  </head>
  <body>
    <main>
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="d-flex justify-content-center">
                        <div class="card mb-4" id="card-task">
                            <div class="card-body">    
                            <div class="d-flex flex-row-reverse bd-highlight">
                            <input type="checkbox" title="🌙" id="switch" class="form-check-input" onchange="myfunction(this)"> 
                            </div>         
                                <h1 class="card-title text-center"><i class="fas fa-tasks mr-3"></i>Task List</h1>
                                <form method="POST" action="task.php">
                                    
                                       <div class="row">
                                           <div class="col-11">
                                            <div class="input-group mt-3 mb-2">
                                                <input name="tarefa" type="text" class="control-input" placeholder="Adicione uma tarefa...">
                                                <span class="focus-border"></span>
                                            </div>
                                            </div>
                                            <div class="input-group-append">
                                                <button class="btn btn-a" value="cad" type="submit" id="button-addon2"><i class="fas fa-plus"></i></button>
                                            </div>
                                        </div>  
                                </form>
                                <?php 
                                    $tabela = "SELECT * FROM tarefas";
                                    $result_tabela = mysqli_query($conn, $tabela);
                                    $reg_tarefas = mysqli_num_rows($result_tabela);
                                    while($row_tarefa = mysqli_fetch_assoc($result_tabela)){
                                        $nome_tarefa = $row_tarefa['tarefa'];
                                        $data_br = date("d/m/y", strtotime($row_tarefa ['created']));
                                        $hora_br = date("H:i", strtotime($row_tarefa ['created']));
                                        $apagar = $row_tarefa['id'];
                                        if($row_tarefa['checked']){
                                            echo "
                                        <div class='row'>
                                        <div class='col-12'>
                                            <div class='task mt-2'>
                                                <div class='card-text'>
                                                <i style='color: #444;' class='fas fa-thumbtack mx-2'></i><input type='checkbox' data-todo-id='$apagar' class='mr-2 check-box' id='indef' checked><span class='marked'>{$nome_tarefa}</span><span class='badge badge-pill badge-primary marked-date ml-2'><i class='far fa-calendar-alt'></i> {$data_br}</span><span class='badge badge-pill badge-success marked-date ml-1'><i class='far fa-clock'></i> {$hora_br}</span>
                                                <a data-toggle='modal' data-target='#apagar{$apagar}'><i class='fas fa-trash mx-2'></i></a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class='modal fade' id='apagar{$apagar}' tabindex='-1' aria-labelledby='exampleModalLabel' aria-hidden='true'>
                                    <div class='modal-dialog modal-dialog-centered'>
                                        <div class='modal-content'>
                                        <div class='modal-header'>
                                            <h5 class='modal-title' id='exampleModalLabel'><i class='fas fa-trash-alt mr-2'></i>Apagar tarefa</h5>
                                            <button type='button' class='close' data-dismiss='modal' aria-label='Close'>
                                            <i class='fas fa-times-circle'></i>
                                            </button>
                                        </div>
                                        <div class='modal-body'>
                                            <p class='h5'>Deseja realmente apagar essa tarefa?</p>
                                        </div>
                                        <div class='modal-footer'>
                                            <button type='button' class='btn btn-secondary' data-dismiss='modal'>Cancelar</button>
                                            <a href='task-del.php?id=".$apagar."' class='btn btn-danger'>Apagar</a>
                                        </div>
                                        </div>
                                    </div>
                                    </div>
                                    ";
                                        }else{
                                            echo "
                                        <div class='row'>
                                        <div class='col-12'>
                                            <div class='task mt-2'>
                                                <div class='card-text'>
                                                <i style='color: #444;' class='fas fa-thumbtack mx-2'></i><input type='checkbox' data-todo-id='$apagar' class='mr-2 check-box' id='indef'><span class=''>{$nome_tarefa}</span><span class='badge badge-pill badge-primary ml-2'><i class='far fa-calendar-alt'></i> {$data_br}</span><span class='badge badge-pill badge-success ml-1'><i class='far fa-clock'></i> {$hora_br}</span>
                                                <a data-toggle='modal' data-target='#apagar{$apagar}'><i class='fas fa-trash mx-2'></i></a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class='modal fade' id='apagar{$apagar}' tabindex='-1' aria-labelledby='exampleModalLabel' aria-hidden='true'>
                                    <div class='modal-dialog modal-dialog-centered'>
                                        <div class='modal-content'>
                                        <div class='modal-header'>
                                            <h5 class='modal-title' id='exampleModalLabel'><i class='fas fa-trash-alt mr-2'></i>Apagar tarefa</h5>
                                            <button type='button' class='close' data-dismiss='modal' aria-label='Close'>
                                            <i class='fas fa-times-circle'></i>
                                            </button>
                                        </div>
                                        <div class='modal-body'>
                                            <p class='h5'>Deseja realmente apagar essa tarefa?</p>
                                        </div>
                                        <div class='modal-footer'>
                                            <button type='button' class='btn btn-secondary' data-dismiss='modal'>Cancelar</button>
                                            <a href='task-del.php?id=".$apagar."' class='btn btn-danger'>Apagar</a>
                                        </div>
                                        </div>
                                    </div>
                                    </div>
                                    ";
                                        }
                                        
                                    }
                                ?>
                                <?php 
                                    if($reg_tarefas === 0){
                                        echo "<img style='width: 20%' src='./gif/loading.gif' class='rounded mx-auto d-block'";
                                    }
                                ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
    <script>  
        var audio = new Audio('audio/rain.mp4');
        audio.volume = 0.5;
        audio.oncanplay = function() {
        if (document.getElementById("switch").checked) this.play()
        }
        function myfunction(el) {    
            if (el.checked) {
                audio.load();
            }else{
                audio.pause();
            }
        }
    </script>
    <script src="darkmode.js"></script>
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script>
        $(document).ready(function(){
            $(".check-box").click(function(e){
                const id = $(this).attr('data-todo-id');
                $.post('check.php',
                        {
                          id: id
                        },
                      (data) => {
                          if(data != 'error'){
                              location.reload();
                          }
                      } 
                );
            });
        });
    </script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
  </body>
</html>