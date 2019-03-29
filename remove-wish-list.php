<?php
session_start();
$id = $_GET['id'];
if (isset($_SESSION['wish-list'])){
    foreach($_SESSION['wish-list'] as $value){
        if($value[0] == $id){
            unset($_SESSION['wish-list'][$id]);
        }
    }
}
if(empty($_SESSION['wish-list'])){
    session_destroy();
}
header('Location: view-wish-list.php');
?>