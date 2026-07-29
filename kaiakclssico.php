<?php
require_once("../includes/conexao.php");
require_once("../includes/header.php");

// PERFUME
$perfume_nome = "Kaiak Clássico";

// LOGIN
$logado = isset($_SESSION['usuario_id']);
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>

<meta charset="UTF-8">

<title>Kaiak Clássico</title>

<link rel="stylesheet" href="/perfumatch/includes/style.css">
<link rel="stylesheet" href="/perfumatch/perfumes/perfumes.css">

<style>

.estrelas-input{
display:flex;
flex-direction:row-reverse;
justify-content:center;
}

.estrelas-input input{
display:none;
}

.estrelas-input label{
font-size:30px;
color:#444;
cursor:pointer;
transition:.2s;
}

.estrelas-input input:checked ~ label,
.estrelas-input label:hover,
.estrelas-input label:hover ~ label{
color:gold;
}

</style>

</head>

<body>

<div class="conteudo-principal">

<h2 class="titulo-centro">Kaiak Clássico</h2>

<div class="perfume-detalhe">

<!-- ESQUERDA -->

<div class="bloco">

<img class="logo-marca" src="/perfumatch/uploads/marcas/natura.png">

<img class="img-perfume" src="/perfumatch/uploads/kaiak clássico.jfif">

<div class="info">

<p><strong>Gênero:</strong> Masculino</p>

<p><strong>Ocasião:</strong> Dia • Calor • Academia</p>

<p><strong>Fixação:</strong> 5–7h</p>

<p><strong>Projeção:</strong> 1–2h média</p>

<p><strong>Tipo de pele:</strong> Todas</p>

</div>

</div>

<!-- CENTRO -->

<div class="bloco">

<h3>Pirâmide Olfativa</h3>

<h4>Topo</h4>

<div class="notas">

<div class="nota">
<img src="/perfumatch/uploads/notas/bergamota.png">
<span>Bergamota</span>
</div>

<div class="nota">
<img src="/perfumatch/uploads/notas/limao.png">
<span>Limão</span>
</div>


</div>

<h4>Coração</h4>

<div class="notas">

<div class="nota">
<img src="/perfumatch/uploads/notas/flordelaranjeira.png">
<span>Flor de Laranjeira</span>
</div>

<div class="nota">
<img src="/perfumatch/uploads/notas/geranio.png">
<span>Gerânio</span>
</div>

<div class="nota">
<img src="/perfumatch/uploads/notas/jasmim.png">
<span>Jasmim</span>
</div>

<div class="nota">
<img src="/perfumatch/uploads/notas/lirio.png">
<span>Lírio</span>
</div>

<div class="nota">
<img src="/perfumatch/uploads/notas/notasamadeiradas.png">
<span>Madeiras Transparentes</span>
</div>

</div>

<h4>Base</h4>

<div class="notas">

<div class="nota">
<img src="/perfumatch/uploads/notas/almiscar.png">
<span>Almíscar</span>
</div>

<div class="nota">
<img src="/perfumatch/uploads/notas/musgodecarvalho.png">
<span>Musgo de Carvalho</span>
</div>

<div class="nota">
<img src="/perfumatch/uploads/notas/ambar.png">
<span>Âmbar</span>
</div>

<div class="nota">
<img src="/perfumatch/uploads/notas/sandalo.png">
<span>Sândalo</span>
</div>

</div>

</div>

<!-- DIREITA -->

<div class="bloco">

<h3>Preço</h3>

<div class="preco">
R$ 110 – R$ 190
</div>

<h3>Avaliação</h3>

<?php if($logado){ ?>

<form method="POST" action="/perfumatch/includes/votar.php">

<input type="hidden" name="perfume" value="<?php echo $perfume_nome; ?>">

<div class="estrelas-input">

<input type="radio" name="nota" value="5" id="e5">
<label for="e5">★</label>

<input type="radio" name="nota" value="4" id="e4">
<label for="e4">★</label>

<input type="radio" name="nota" value="3" id="e3">
<label for="e3">★</label>

<input type="radio" name="nota" value="2" id="e2">
<label for="e2">★</label>

<input type="radio" name="nota" value="1" id="e1">
<label for="e1">★</label>

</div>

<button type="submit" style="margin-top:10px;">
Avaliar
</button>

</form>

<?php } else { ?>

<p style="color:orange;">
Faça login para avaliar
</p>

<?php } ?>

<?php include("../includes/votacao.php"); ?>

<h3>Favoritar</h3>

<?php if($logado){ ?>

<form method="POST" action="/perfumatch/favoritar.php">

<input type="hidden" name="perfume" value="<?php echo $perfume_nome; ?>">

<button type="submit">
❤️ Favoritar
</button>

</form>

<?php } else { ?>

<p style="color:orange;">
Faça login para favoritar
</p>

<?php } ?>

<h3>Sensação</h3>

<p class="sensacao">
Kaiak Clássico é um aquático fresco extremamente versátil, combinando notas cítricas, florais e amadeiradas para transmitir sensação de banho tomado, energia e liberdade. É uma excelente escolha para dias quentes, academia e uso diário.
</p>

<h3>Inspirados</h3>

<ul class="inspirados">

<li>Perfumes aquáticos clássicos</li>

<li>Fragrâncias frescas para calor e pós-banho</li>

</ul>

</div>

</div>

</div>

<script src="/perfumatch/includes/script.js"></script>

</body>
</html>