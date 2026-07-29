<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
?>

<header class="header">

<div class="logo-area">
<a href="/perfumatch/index.php">
<img src="/perfumatch/imagens/logo.png" class="logo">
</a>
<h1 class="logo-text">PERFUMATCH</h1>
</div>

<div class="search-area">
<form action="/perfumatch/buscar.php" method="GET">
<input type="text" name="pesquisa" placeholder="Pesquisar perfume..." required>
<button type="submit">🔍</button>
</form>
</div>

<div class="perfil-area">
<?php
if(isset($_SESSION['nome'])){
echo "<a href='/perfumatch/perfil/perfil.php' class='btn-perfil'>".$_SESSION['nome']."</a>";
}else{
echo "
<a href='/perfumatch/perfil/criarperfil.php' class='btn-perfil'>Cadastrar</a>
<a href='/perfumatch/perfil/entrar.php' class='btn-perfil'>Entrar</a>
";
}
?>
</div>

</header>

<div class="linha"></div>