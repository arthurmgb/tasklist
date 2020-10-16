<?php
session_start();
include_once("conexao.php");
$id = filter_input(INPUT_GET, 'id', FILTER_SANITIZE_NUMBER_INT);
if(!empty($id)){
    $delete_task = "DELETE FROM tarefas WHERE id='$id'";
    $delete_task_query = mysqli_query($conn, $delete_task);

    if(mysqli_affected_rows($conn)){
        header("Location: index.php#card-task");
    }else{
        header("Location: 404.php");
    }
}else{
    header("Location: 404.php");
}