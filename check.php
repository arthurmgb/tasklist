<?php

include_once("conexao.php");

if(isset($_POST['id'])){
    
    $id = $_POST['id'];

    if(empty($id)){
        header("Location: index.php");
    }
    else {
        $tarefas_select = "SELECT id, checked FROM tarefas WHERE id=$id";
        $todosquery = mysqli_query($conn, $tarefas_select);
        $row_tarefa = mysqli_fetch_assoc($todosquery);

        $uId = $row_tarefa['id'];
        $checked = $row_tarefa['checked'];

        $uChecked = $checked ? 0 : 1;

        $tarefas_update = "UPDATE tarefas SET checked=$uChecked WHERE id=$uId";
        $update_query = mysqli_query($conn, $tarefas_update);
    }
}else {
    header("Location: index.php");
}