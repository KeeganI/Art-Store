<?php
session_start();
include 'include/config.php';
include 'functions.php';
$id = $_GET['id'];
$name = $_GET['name'];
$pic = $_GET['pic'];
$myarray = array($id,$name,$pic);
if(isset($_SESSION['wish-list'][$id])){

}else{
$_SESSION['wish-list'][$id] = $myarray;
}

header('Location: browse-paintings.php')
?>
