<?php

$host = "localhost";
$user = "root";
$senha = "";
$banco = "perfumatch";

$conexao = mysqli_connect($host,$user,$senha,$banco);

if(!$conexao){

die("Erro na conexão com banco de dados");

}

?>