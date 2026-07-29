<?php
$perfume = $perfume_nome;

$sql = "SELECT AVG(nota) as media FROM avaliacoes WHERE nome_perfume='$perfume'";
$res = mysqli_query($conexao,$sql);
$dado = mysqli_fetch_assoc($res);

$media = round($dado['media'],1);

if(!$media){
    $media = 0;
}

// porcentagem (cada estrela = 20%)
$porcentagem = ($media / 5) * 100;
?>

<style>
.estrelas {
  font-size: 30px;
  position: relative;
  display: inline-block;
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
  width: <?php echo $porcentagem; ?>%;
  overflow: hidden;
  white-space: nowrap;
}
</style>

<div class="estrelas"></div>
<p>(<?php echo $media; ?>)</p>