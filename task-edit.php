<?php
session_start();
include_once("conexao.php");

$taskid = filter_input(INPUT_POST, 'taskid', FILTER_SANITIZE_NUMBER_INT);
$taskname = filter_input(INPUT_POST, 'taskname', FILTER_SANITIZE_STRING);
$taskdate = filter_input(INPUT_POST, 'taskdate', FILTER_SANITIZE_STRING);
$filtrotask = trim($taskname);
if(empty($taskdate)){
    $taskdate = 'data indefinida';
}
if(empty($filtrotask)){
    header("Location: index.php#card-task");
}else{
    $query_edit = "UPDATE tarefas SET tarefa='$taskname', created='$taskdate' WHERE id='$taskid'";
    $result_edit = mysqli_query($conn, $query_edit);
}

if(mysqli_affected_rows($conn)){
    header("Location: index.php#card-task");
}else{
    header("Location: index.php#card-task");
}