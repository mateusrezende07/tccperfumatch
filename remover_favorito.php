<?php
include("includes/conexao.php");
session_start();

// VERIFICA LOGIN
if(!isset($_SESSION['usuario_id'])){
    die("Você precisa estar logado.");
}

// VERIFICA ID
if(!isset($_GET['id'])){
    die("ID não informado");
}

$id_usuario = $_SESSION['usuario_id'];
$id_fav = $_GET['id'];

// DELETE CORRETO
$sql = "DELETE FROM favoritos 
WHERE id='$id_fav' AND id_usuario='$id_usuario'";

$resultado = mysqli_query($conexao, $sql);

// DEBUG (se quiser testar)
// if(!$resultado){
//     die("Erro: " . mysqli_error($conexao));
// }

header("Location: /perfumatch/perfil/perfil.php");
exit;
?>