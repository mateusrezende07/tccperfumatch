<?php 
require_once("../includes/conexao.php");
require_once("../includes/header.php");

// PERFUME
$perfume_nome = "Windstorm";

// LOGIN
$logado = isset($_SESSION['usuario_id']);
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>

<meta charset="UTF-8">

<title>Windstorm</title>

<link rel="stylesheet" href="/perfumatch/includes/style.css">
<link rel="stylesheet" href="/perfumatch/perfumes/perfumes.css">


<style>

.estrelas-input {
  display: flex;
  flex-direction: row-reverse;
  justify-content: center;
}

.estrelas-input input {
  display: none;
}

.estrelas-input label {
  font-size: 30px;
  color: #444;
  cursor: pointer;
  transition: 0.2s;
}

.estrelas-input input:checked ~ label,
.estrelas-input label:hover,
.estrelas-input label:hover ~ label {
  color: gold;
}

</style>

</head>


<body>


<div class="conteudo-principal">


<h2 class="titulo-centro">Windstorm</h2>



<div class="perfume-detalhe">



<!-- ESQUERDA -->

<div class="bloco">


<img class="logo-marca" src="/perfumatch/uploads/marcas/lab8.png">


<img class="img-perfume" src="/perfumatch/uploads/Windstorm.jfif">



<div class="info">


<p><strong>Gênero:</strong> Masculino</p>


<p><strong>Ocasião:</strong> Noite • Eventos • Encontros • Outono/Inverno</p>


<p><strong>Fixação:</strong> 8–10h</p>


<p><strong>Projeção:</strong> 2–4h forte</p>


<p><strong>Tipo de pele:</strong> Todas</p>


</div>


</div>







<!-- CENTRO -->

<div class="bloco">


<h3>Pirâmide Olfativa</h3>





<h4>Topo</h4>


<div class="notas">



<div class="nota">
<img src="/perfumatch/uploads/notas/toranja.png">
<span>Toranja</span>
</div>


<div class="nota">
<img src="/perfumatch/uploads/notas/bergamota.png">
<span>Bergamota</span>
</div>


<div class="nota">
<img src="/perfumatch/uploads/notas/pimentarosa.png">
<span>Pimenta Rosa</span>
</div>


<div class="nota">
<img src="/perfumatch/uploads/notas/abacaxi.png">
<span>Abacaxi</span>
</div>


<div class="nota">
<img src="/perfumatch/uploads/notas/nozmoscada.png">
<span>Noz-Moscada</span>
</div>


<div class="nota">
<img src="/perfumatch/uploads/notas/cravo.png">
<span>Cravo-da-Índia</span>
</div>


</div>







<h4>Coração</h4>


<div class="notas">



<div class="nota">
<img src="/perfumatch/uploads/notas/gengibre.png">
<span>Gengibre</span>
</div>


<div class="nota">
<img src="/perfumatch/uploads/notas/limao.png">
<span>Cidra</span>
</div>


<div class="nota">
<img src="/perfumatch/uploads/notas/canela.png">
<span>Canela</span>
</div>


<div class="nota">
<img src="/perfumatch/uploads/notas/cardamomo.png">
<span>Cardamomo</span>
</div>


<div class="nota">
<img src="/perfumatch/uploads/notas/rosa.png">
<span>Rosa</span>
</div>


</div>








<h4>Base</h4>


<div class="notas">



<div class="nota">
<img src="/perfumatch/uploads/notas/patchouli.png">
<span>Patchouli</span>
</div>


<div class="nota">
<img src="/perfumatch/uploads/notas/vetiver.png">
<span>Vetiver</span>
</div>


<div class="nota">
<img src="/perfumatch/uploads/notas/musgodecarvalho.png">
<span>Musgo de Carvalho</span>
</div>


<div class="nota">
<img src="/perfumatch/uploads/notas/ambroxan.png">
<span>Ambroxan</span>
</div>


<div class="nota">
<img src="/perfumatch/uploads/notas/almiscar.png">
<span>Almíscar</span>
</div>



<div class="nota">
<img src="/perfumatch/uploads/notas/sandalo.png">
<span>Sândalo</span>
</div>


<div class="nota">
<img src="/perfumatch/uploads/notas/favatonka.png">
<span>Fava Tonka</span>
</div>


</div>



</div>










<!-- DIREITA -->


<div class="bloco">



<h3>Preço</h3>


<div class="preco">

R$ 140 – R$ 180

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


O Windstorm é um perfume intenso, frutado e especiado, com abertura explosiva e vibrante, coração quente e aromático e um fundo profundo, amadeirado e sensual. Transmite força, elegância e presença marcante em qualquer ambiente.


</p>







<h3>Inspirados</h3>


<ul class="inspirados">


<li>Perfumes frutados especiados intensos</li>

<li>Fragrâncias masculinas modernas de alta projeção</li>


</ul>



</div>



</div>


</div>



<script src="/perfumatch/includes/script.js"></script>


</body>
</html>