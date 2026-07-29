<?php
include("conexao.php");
session_start();

if(!isset($_SESSION['usuario_id'])){
    die("Você precisa estar logado.");
}

$id_usuario = $_SESSION['usuario_id'];
$perfume = $_POST['perfume'];
$nota = $_POST['nota'];

// VERIFICA SE JÁ VOTOU
$sql_check = "SELECT * FROM avaliacoes 
WHERE id_usuario='$id_usuario' AND nome_perfume='$perfume'";

$res = mysqli_query($conexao, $sql_check);

if(mysqli_num_rows($res) > 0){
    // ATUALIZA VOTO
    mysqli_query($conexao,"UPDATE avaliacoes 
    SET nota='$nota' 
    WHERE id_usuario='$id_usuario' AND nome_perfume='$perfume'");
}else{
    // INSERE VOTO
    mysqli_query($conexao,"INSERT INTO avaliacoes 
    (id_usuario, nome_perfume, nota)
    VALUES ('$id_usuario','$perfume','$nota')");
}

// VOLTA PRA PÁGINA
header("Location: " . $_SERVER['HTTP_REFERER']);
exit;
?>