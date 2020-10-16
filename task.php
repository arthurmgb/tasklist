<?php
session_start();
include_once("conexao.php");
 
$trimmed = filter_input(INPUT_POST, 'tarefa', FILTER_SANITIZE_STRING);
$task = trim($trimmed);
if(!empty($task) AND $task){
    $result_task = "INSERT INTO tarefas (tarefa, created, checked) VALUES ('$task', NOW(), 0)";
    $task_insert = mysqli_query($conn, $result_task);
    
    if(mysqli_insert_id($conn)){
        header("Location: index.php#card-task");
    }else{
        header("Location: index.php#card-task");
    }
}else{
    header("Location: index.php#card-task");
}