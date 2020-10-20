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
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/tempusdominus-bootstrap-4/5.1.2/css/tempusdominus-bootstrap-4.min.css" integrity="sha512-PMjWzHVtwxdq7m7GIxBot5vdxUY+5aKP9wpKtvnNBZrVv1srI8tU6xvFMzG8crLNcMj/8Xl/WWmo/oAP/40p1g==" crossorigin="anonymous" />
    <link rel="shortcut icon" href="img/task.png"/> 
    <link rel="stylesheet" href="css/style.css">
    <title>Task List</title>
  </head>
  <body>
  <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.1/moment.js" integrity="sha512-z8IfZLl5ZASsWvr1syw5rkpo2HKBexjwzYDaUkIfoWo0aEqL/MgGKniDouh5DmsD9YrisbM+pihyCKIHL9VucQ==" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.1/locale/pt-br.js" integrity="sha512-LyWB6atNPbjwXIx4FlfhaXj+iwhj8tO3C27acO0OUX4ftNSNv3gAlbqndXk56aKW8hoLiF2SzhjxeHC1kbZWug==" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/tempusdominus-bootstrap-4/5.1.2/js/tempusdominus-bootstrap-4.min.js" integrity="sha512-2JBCbWoMJPH+Uj7Wq5OLub8E5edWHlTM4ar/YJkZh3plwB2INhhOC3eDoqHm1Za/ZOSksrLlURLoyXVdfQXqwg==" crossorigin="anonymous"></script>
    <script>
        $.fn.datetimepicker.Constructor.Default = $.extend({}, $.fn.datetimepicker.Constructor.Default, {
            icons: {
                time: 'far fa-clock',
                date: 'far fa-calendar',
                up: 'fas fa-arrow-up',
                down: 'fas fa-arrow-down',
                previous: 'fas fa-chevron-left',
                next: 'fas fa-chevron-right',
                today: 'fas fa-calendar-check',
                clear: 'fas fa-trash-alt',
                close: 'fas fa-times'
            } });
    </script>
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
                                <h1 onclick="window.location.href='index.php'" class="card-title text-center"><i class="fas fa-tasks mr-3"></i>Task List</h1>
                                <div class="row">
                                    <div class="col-12">
                                        <div class="d-flex flex-row-reverse">
                                        <form class="form-inline" method="GET" action="search.php">
                                            <input class="search form-control form-control-sm" type="text" name="pesquisar" id="pesquisa" placeholder="Pesquisar...">
                                            <button class="btn btn-search pl-1" type="submit"><i class="fas fa-search"></i></button>
                                        </form>
                                        </div>
                                    </div>
                                </div>
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
                                        $data = $row_tarefa['created'];
                                        $apagar = $row_tarefa['id'];
                                        if($row_tarefa['checked']){
                                            echo "
                                        <div class='row'>
                                        <div class='col-12'>
                                            <div class='task mt-2'>
                                                <div class='card-text'>
                                                <i style='color: #444;' class='fas fa-thumbtack mx-2'></i><input type='checkbox' data-todo-id='$apagar' class='mr-2 check-box' id='indef' checked><span class='marked'>{$nome_tarefa}</span><span class='badge badge-pill badge-primary marked-date ml-2'><i class='far fa-calendar-minus'></i> {$data}</span>
                                                <a title='Editar tarefa' data-toggle='modal' data-target='#editar{$apagar}'><i class='fas fa-edit fa-editar ml-2'></i></a>
                                                <a title='Apagar tarefa' data-toggle='modal' data-target='#apagar{$apagar}'><i class='fas fa-trash mx-2'></i></a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class='modal fade' id='editar{$apagar}' tabindex='-1' aria-labelledby='exampleModalLabel' aria-hidden='true'>
                                        <div class='modal-dialog modal-dialog-centered'>
                                            <div class='modal-content'>
                                            <div class='modal-header edit-header'>
                                                <h5 class='modal-title' id='exampleModalLabel'><i class='fas fa-edit mr-2 edit-ico'></i>Editar tarefa</h5>
                                                <button type='button' class='close' data-dismiss='modal' aria-label='Close'>
                                                <i class='fas fa-times-circle'></i>
                                                </button>
                                            </div>
                                            <div class='modal-body'>
                                                <div class='row mb-4'>
                                                    <div class='col-12'>
                                                    <form method='POST' action='task-edit.php'>
                                                    <input type='hidden' name='taskid' value='{$apagar}'>
                                                    <label class='ml-2 mb-2 h6'>Nome da tarefa</label>
                                                    <input name='taskname' class='control-input foc-edit' type='text' value='{$nome_tarefa}'>
                                                    </div>
                                                </div>
                                                <div class='row'>
                                                    <div class='col-12'>
                                                    <label class='ml-2 mb-2 h6'>Definir data e hora</label>
                                                    <div class='form-group'>
                                                        <div class='input-group date' id='datetimepicker{$apagar}' data-target-input='nearest'>
                                                            <input name='taskdate' placeholder='00/00/0000 00:00' data-mask='00/00/0000 00:00' type='text' class='form-control date-c datetimepicker-input' data-target='#datetimepicker{$apagar}'/>
                                                            <div class='input-group-append' data-target='#datetimepicker{$apagar}' data-toggle='datetimepicker'>
                                                                <div class='calendar-c input-group-text'><i class='fas fa-calendar-alt calendar-hover'></i></div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class='modal-footer'>
                                                <button type='button' class='btn btn-secondary' data-dismiss='modal'>Cancelar</button>
                                                <button type='submit' value='salvar' class='btn btn-success'>Salvar</button>
                                                </form>
                                            </div>
                                            </div>
                                        </div>
                                    </div>
                                    <script>
                                            $(function () {
                                                $('#datetimepicker{$apagar}').datetimepicker();
                                            });
                                    </script>
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
                                    ";}
                                    elseif($data === 'data indefinida'){
                                        echo "
                                        <div class='row'>
                                        <div class='col-12'>
                                            <div class='task mt-2'>
                                                <div class='card-text'>
                                                <i style='color: #444;' class='fas fa-thumbtack mx-2'></i><input type='checkbox' data-todo-id='$apagar' class='mr-2 check-box' id='indef'><span class=''>{$nome_tarefa}</span><span class='badge badge-pill badge-secondary ml-2'><i class='far fa-calendar-check'></i> {$data}</span>
                                                <a title='Editar tarefa' data-toggle='modal' data-target='#editar{$apagar}'><i class='fas fa-edit fa-editar ml-2'></i></a>
                                                <a title='Apagar tarefa' data-toggle='modal' data-target='#apagar{$apagar}'><i class='fas fa-trash mx-2'></i></a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class='modal fade' id='editar{$apagar}' tabindex='-1' aria-labelledby='exampleModalLabel' aria-hidden='true'>
                                        <div class='modal-dialog modal-dialog-centered'>
                                            <div class='modal-content'>
                                            <div class='modal-header edit-header'>
                                                <h5 class='modal-title' id='exampleModalLabel'><i class='fas fa-edit mr-2 edit-ico'></i>Editar tarefa</h5>
                                                <button type='button' class='close' data-dismiss='modal' aria-label='Close'>
                                                <i class='fas fa-times-circle'></i>
                                                </button>
                                            </div>
                                            <div class='modal-body'>
                                                <div class='row mb-4'>
                                                    <div class='col-12'>
                                                    <form method='POST' action='task-edit.php'>
                                                    <input type='hidden' name='taskid' value='{$apagar}'>
                                                    <label class='ml-2 mb-2 h6'>Nome da tarefa</label>
                                                    <input name='taskname' class='control-input foc-edit' type='text' value='{$nome_tarefa}'>
                                                    </div>
                                                </div>
                                                <div class='row'>
                                                    <div class='col-12'>
                                                    <label class='ml-2 mb-2 h6'>Definir data e hora</label>
                                                    <div class='form-group'>
                                                        <div class='input-group date' id='datetimepicker{$apagar}' data-target-input='nearest'>
                                                            <input name='taskdate' placeholder='00/00/0000 00:00' data-mask='00/00/0000 00:00' type='text' class='form-control date-c datetimepicker-input' data-target='#datetimepicker{$apagar}'/>
                                                            <div class='input-group-append' data-target='#datetimepicker{$apagar}' data-toggle='datetimepicker'>
                                                                <div class='calendar-c input-group-text'><i class='fas fa-calendar-alt calendar-hover'></i></div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class='modal-footer'>
                                                <button type='button' class='btn btn-secondary' data-dismiss='modal'>Cancelar</button>
                                                <button type='submit' value='salvar' class='btn btn-success'>Salvar</button>
                                                </form>
                                            </div>
                                            </div>
                                        </div>
                                    </div>
                                    <script>
                                            $(function () {
                                                $('#datetimepicker{$apagar}').datetimepicker();
                                            });
                                    </script>
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
                                    "; }
                                    else{
                                            echo "
                                        <div class='row'>
                                        <div class='col-12'>
                                            <div class='task mt-2'>
                                                <div class='card-text'>
                                                <i style='color: #444;' class='fas fa-thumbtack mx-2'></i><input type='checkbox' data-todo-id='$apagar' class='mr-2 check-box' id='indef'><span class=''>{$nome_tarefa}</span><span class='badge badge-pill badge-primary ml-2'><i class='far fa-calendar-check'></i> {$data}</span>
                                                <a title='Editar tarefa' data-toggle='modal' data-target='#editar{$apagar}'><i class='fas fa-edit fa-editar ml-2'></i></a>
                                                <a title='Apagar tarefa' data-toggle='modal' data-target='#apagar{$apagar}'><i class='fas fa-trash mx-2'></i></a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class='modal fade' id='editar{$apagar}' tabindex='-1' aria-labelledby='exampleModalLabel' aria-hidden='true'>
                                        <div class='modal-dialog modal-dialog-centered'>
                                            <div class='modal-content'>
                                            <div class='modal-header edit-header'>
                                                <h5 class='modal-title' id='exampleModalLabel'><i class='fas fa-edit mr-2 edit-ico'></i>Editar tarefa</h5>
                                                <button type='button' class='close' data-dismiss='modal' aria-label='Close'>
                                                <i class='fas fa-times-circle'></i>
                                                </button>
                                            </div>
                                            <div class='modal-body'>
                                                <div class='row mb-4'>
                                                    <div class='col-12'>
                                                    <form method='POST' action='task-edit.php'>
                                                    <input type='hidden' name='taskid' value='{$apagar}'>
                                                    <label class='ml-2 mb-2 h6'>Nome da tarefa</label>
                                                    <input name='taskname' class='control-input foc-edit' type='text' value='{$nome_tarefa}'>
                                                    </div>
                                                </div>
                                                <div class='row'>
                                                    <div class='col-12'>
                                                    <label class='ml-2 mb-2 h6'>Definir data e hora</label>
                                                    <div class='form-group'>
                                                        <div class='input-group date' id='datetimepicker{$apagar}' data-target-input='nearest'>
                                                            <input name='taskdate' placeholder='00/00/0000 00:00' data-mask='00/00/0000 00:00' type='text' class='form-control date-c datetimepicker-input' data-target='#datetimepicker{$apagar}'/>
                                                            <div class='input-group-append' data-target='#datetimepicker{$apagar}' data-toggle='datetimepicker'>
                                                                <div class='calendar-c input-group-text'><i class='fas fa-calendar-alt calendar-hover'></i></div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class='modal-footer'>
                                                <button type='button' class='btn btn-secondary' data-dismiss='modal'>Cancelar</button>
                                                <button type='submit' value='salvar' class='btn btn-success'>Salvar</button>
                                                </form>
                                            </div>
                                            </div>
                                        </div>
                                    </div>
                                    <script>
                                            $(function () {
                                                $('#datetimepicker{$apagar}').datetimepicker();
                                            });
                                    </script>
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
                                        echo "<img style='width: 15%' src='./gif/loading.gif' class='rounded mx-auto d-block'";
                                    }
                                ?>
                            </div>            
                            <?php
                               if($reg_tarefas != 0){
                               $pendentes = "SELECT * FROM tarefas WHERE checked = '0'";
                               $result_pendentes = mysqli_query($conn, $pendentes);
                               $reg_pendentes = mysqli_num_rows($result_pendentes);
                               echo "
                               <div class='card-footer text-muted'>
                               <div class='ml-2'>
                               {$reg_pendentes} tarefas pendentes 
                               </div>
                               </div>";
                            }
                            ?>
                        </div>  
                    </div>
                </div>
            </div>
        </div>
    </main>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.15/jquery.mask.min.js"></script>
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