<?php
include("includes/conexao.php");
session_start();

if(!isset($_SESSION['usuario_id'])){
    die("Você precisa estar logado.");
}

$id_usuario = $_SESSION['usuario_id'];
$perfume = $_POST['perfume'];

// EVITAR DUPLICADO
$sql_check = "SELECT * FROM favoritos 
WHERE id_usuario='$id_usuario' AND perfume='$perfume'";

$res = mysqli_query($conexao, $sql_check);

if(mysqli_num_rows($res) == 0){

    $sql = "INSERT INTO favoritos (id_usuario, perfume) 
    VALUES ('$id_usuario', '$perfume')";

    mysqli_query($conexao, $sql);
}

// VOLTA PRA PÁGINA ANTERIOR
header("Location: " . $_SERVER['HTTP_REFERER']);
exit;
?>