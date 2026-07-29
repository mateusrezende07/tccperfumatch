<?php
require_once("../includes/conexao.php");
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>

<meta charset="UTF-8">
<title>Perfumes para Escola</title>

<link rel="stylesheet" href="../includes/style.css">

<style>

/* HEADER FIXO */
.header{
position:fixed;
top:0;
left:0;
width:100%;
z-index:999;
background:#021c34;
display:flex;
align-items:center;
justify-content:space-between;
padding:10px 20px;
box-shadow:0 2px 10px rgba(0,0,0,0.5);
}

/* ESPAÇO DO HEADER */
body{
padding-top:80px;
background:linear-gradient(to bottom,#010b16,#021c34);
color:white;
}

/* GRID DOS PERFUMES - PADRÃO FIXO DE 200px */
.perfume-grid{
display:grid;
grid-template-columns:repeat(auto-fill, 200px);
gap:25px;
margin:40px;
padding-left:40px;
}

/* CARD PERFUME - PADRÃO */
.perfume-box{
background:#021c34;
border-radius:10px;
overflow:hidden;
text-decoration:none;
border:1px solid #043a63;
transition:0.3s;
width:200px;
display:flex;
flex-direction:column;
}

/* HOVER - PADRÃO */
.perfume-box:hover{
transform:scale(1.05);
box-shadow:0 0 10px #00bfff;
border-color:#00bfff;
}

/* CONTAINER DA IMAGEM - SEM PADDING */
.imagem-container{
width:200px;
height:200px;
background:#031d36;
display:flex;
align-items:center;
justify-content:center;
overflow:hidden;
padding:0;
}

/* IMAGEM - OCUPA 100% DO ESPAÇO */
.perfume-box img{
width:100%;
height:100%;
object-fit:cover;
transition:0.3s;
}

/* NOME - PADRÃO */
.perfume-title{
background:#05294a;
color:white;
text-align:center;
padding:12px;
font-weight:bold;
font-size:14px;
min-height:45px;
display:flex;
align-items:center;
justify-content:center;
border-top:1px solid #043a63;
}

/* AVALIAÇÃO */
.avaliacao {
    text-align: center;
    padding: 10px 0;
    background: #031d36;
    border-top: 1px solid #043a63;
}

.estrelas {
    font-size: 16px;
    position: relative;
    display: inline-block;
    color: #444;
    letter-spacing: 2px;
}

.estrelas::before {
    content: '★★★★★';
    color: #444;
}

.estrelas::after {
    content: '★★★★★';
    color: gold;
    position: absolute;
    left: 0;
    top: 0;
    overflow: hidden;
    white-space: nowrap;
    width: var(--porcentagem);
}

.nota-media {
    color: #ccc;
    font-size: 12px;
    margin-left: 5px;
}

/* TÍTULO CENTRALIZADO */
.titulo-centro{
text-align:center;
margin-top:30px;
color:#00bfff;
font-size:28px;
text-transform:uppercase;
letter-spacing:2px;
}

/* MENSAGEM QUANDO NÃO ENCONTRA PERFUMES */
.sem-resultados{
    text-align:center;
    color:#ff6b6b;
    font-size:20px;
    margin-top:50px;
    grid-column:1/-1;
}

/* RESPONSIVIDADE */
@media(max-width: 768px){
    .perfume-grid{
        justify-content:center;
        padding-left:0;
        margin:20px;
    }
}

</style>

</head>

<body>

<?php require_once("../includes/header.php"); ?>

<h2 class="titulo-centro">Perfumes para Escola</h2>

<div class="perfume-grid">

<?php

$sql = "SELECT * FROM perfumes WHERE FIND_IN_SET('escola', ocasiao)";
$resultado = mysqli_query($conexao,$sql);

if(mysqli_num_rows($resultado) > 0){

while($perfume = mysqli_fetch_assoc($resultado)){

// 🔥 GERA LINK PADRÃO (SEGURO)
$pagina = strtolower(str_replace(" ","",$perfume['nome']));
$pagina = preg_replace('/[^a-z0-9]/', '', $pagina);

// 🔥 BUSCA A MÉDIA DE AVALIAÇÕES
$sql_avaliacao = "SELECT AVG(nota) as media FROM avaliacoes WHERE nome_perfume = '" . mysqli_real_escape_string($conexao, $perfume['nome']) . "'";
$res_avaliacao = mysqli_query($conexao, $sql_avaliacao);
$dado_avaliacao = mysqli_fetch_assoc($res_avaliacao);

$media = $dado_avaliacao['media'] ? round($dado_avaliacao['media'], 1) : 0;
$porcentagem = ($media / 5) * 100;

// 🔥 CONTA QUANTOS VOTOS
$sql_votos = "SELECT COUNT(*) as total FROM avaliacoes WHERE nome_perfume = '" . mysqli_real_escape_string($conexao, $perfume['nome']) . "'";
$res_votos = mysqli_query($conexao, $sql_votos);
$dado_votos = mysqli_fetch_assoc($res_votos);
$qtd_votos = $dado_votos['total'];

?>

<a class="perfume-box" href="../perfumes/<?php echo $pagina; ?>.php">

    <div class="imagem-container">
        <img src="../uploads/<?php echo $perfume['imagem']; ?>" alt="<?php echo htmlspecialchars($perfume['nome']); ?>">
    </div>

    <div class="perfume-title">
        <?php echo htmlspecialchars($perfume['nome']); ?>
    </div>

    <div class="avaliacao">
        <span class="estrelas" style="--porcentagem: <?php echo $porcentagem; ?>%;"></span>
        <span class="nota-media"><?php echo $media; ?> (<?php echo $qtd_votos; ?>)</span>
    </div>

</a>

<?php 
    }
} else { 
?>

<div class="sem-resultados">
    😢 Nenhum perfume encontrado para Escola
</div>

<?php } ?>

</div>

</body>
</html>