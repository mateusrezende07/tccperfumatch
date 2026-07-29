<?php 
require_once("../includes/conexao.php");
require_once("../includes/header.php");

// PERFUME
$perfume_nome = "Malbec Magnetic";

// LOGIN
$logado = isset($_SESSION['usuario_id']);
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>

<meta charset="UTF-8">

<title>Malbec Magnetic</title>

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


<h2 class="titulo-centro">Malbec Magnetic</h2>



<div class="perfume-detalhe">



<!-- ESQUERDA -->

<div class="bloco">


<img class="logo-marca" src="/perfumatch/uploads/marcas/oboticario.png">


<img class="img-perfume" src="/perfumatch/uploads/malbec magnetic.png">



<div class="info">


<p><strong>Gênero:</strong> Masculino</p>


<p><strong>Ocasião:</strong> Encontros • Noite</p>


<p><strong>Fixação:</strong> 9–11h</p>


<p><strong>Projeção:</strong> 2–3h média</p>


<p><strong>Tipo de pele:</strong> Todas</p>


</div>


</div>







<!-- CENTRO -->

<div class="bloco">


<h3>Pirâmide Olfativa</h3>



<h4>Topo</h4>


<div class="notas">


<div class="nota">
<img src="/perfumatch/uploads/notas/uva.png">
<span>Uva</span>
</div>


<div class="nota">
<img src="/perfumatch/uploads/notas/maca.png">
<span>Maçã</span>
</div>


<div class="nota">
<img src="/perfumatch/uploads/notas/pimentarosa.png">
<span>Pimenta Rosa</span>
</div>


<div class="nota">
<img src="/perfumatch/uploads/notas/limao.png">
<span>Cítricos</span>
</div>


<div class="nota">
<img src="/perfumatch/uploads/notas/cardamomo.png">
<span>Cardamomo</span>
</div>


<div class="nota">
<img src="/perfumatch/uploads/notas/cipreste.png">
<span>Cipreste</span>
</div>


</div>







<h4>Coração</h4>


<div class="notas">


<div class="nota">
<img src="/perfumatch/uploads/notas/notasminerais.png">
<span>Notas Metálicas</span>
</div>


<div class="nota">
<img src="/perfumatch/uploads/notas/notasamadeiradas.png">
<span>Notas Amadeiradas</span>
</div>


<div class="nota">
<img src="/perfumatch/uploads/notas/rosa.png">
<span>Rosa</span>
</div>


<div class="nota">
<img src="/perfumatch/uploads/notas/patchouli.png">
<span>Patchouli</span>
</div>


<div class="nota">
<img src="/perfumatch/uploads/notas/cashmeran.png">
<span>Cashmeran</span>
</div>


<div class="nota">
<img src="/perfumatch/uploads/notas/notasverdes.png">
<span>Notas Verdes</span>
</div>


<div class="nota">
<img src="/perfumatch/uploads/notas/nozmoscada.png">
<span>Noz Moscada</span>
</div>


<div class="nota">
<img src="/perfumatch/uploads/notas/zimbro.png">
<span>Zimbro</span>
</div>


</div>








<h4>Base</h4>


<div class="notas">


<div class="nota">
<img src="/perfumatch/uploads/notas/baunilha.png">
<span>Baunilha</span>
</div>


<div class="nota">
<img src="/perfumatch/uploads/notas/ambar.png">
<span>Âmbar</span>
</div>


<div class="nota">
<img src="/perfumatch/uploads/notas/almiscar.png">
<span>Almíscar</span>
</div>


<div class="nota">
<img src="/perfumatch/uploads/notas/bergamota.png">
<span>Nagarmota</span>
</div>


<div class="nota">
<img src="/perfumatch/uploads/notas/olibano.png">
<span>Olíbano</span>
</div>


</div>



</div>










<!-- DIREITA -->


<div class="bloco">



<h3>Preço</h3>


<div class="preco">

R$ 180 – R$ 260

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

O Malbec Magnetic transmite uma sensação doce, amadeirada e envolvente. A combinação de frutas, especiarias e madeiras modernas cria uma fragrância marcante, elegante e atual, ideal para encontros e momentos noturnos.


</p>







<h3>Inspirados</h3>


<ul class="inspirados">


<li>Perfumes doces amadeirados masculinos</li>

<li>Fragrâncias modernas e sedutoras para noite</li>


</ul>



</div>



</div>


</div>



<script src="/perfumatch/includes/script.js"></script>


</body>

</html>