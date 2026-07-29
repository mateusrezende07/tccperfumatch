<?php
session_start();
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>PerfumeMatch</title>
<link rel="stylesheet" href="includes/style.css">

<style>
/* ===== RESET E BASE ===== */
* {
    margin: 0;
    padding: 0;
    box-sizing: border-box;
}

body {
    background: #010b16;
    color: #e8e8e8;
    font-family: 'Helvetica Neue', 'Arial', sans-serif;
    font-weight: 300;
    line-height: 1.6;
    min-height: 100vh;
}

/* ===== HEADER ===== */
/* O header.php deve ser mantido com as cores originais */
.header {
    background: #021c34;
    border-bottom: 1px solid #043a63;
    padding: 15px 40px;
    display: flex;
    justify-content: space-between;
    align-items: center;
}

.logo-text {
    color: #00bfff;
    font-size: 20px;
    letter-spacing: 4px;
    font-weight: 300;
}

/* ===== HERO ===== */
.hero {
    text-align: center;
    padding: 60px 20px 30px;
    background: transparent;
    margin: 0 0 20px 0;
}

.hero h2 {
    font-size: 34px;
    color: #ffffff;
    font-weight: 200;
    letter-spacing: 6px;
    text-transform: uppercase;
    margin-bottom: 8px;
}

.hero p {
    font-size: 15px;
    color: #8899aa;
    font-weight: 300;
    letter-spacing: 2px;
}

/* ===== FILTROS ===== */
.filtros {
    display: flex;
    justify-content: center;
    gap: 30px;
    padding: 15px 0 10px 0;
    flex-wrap: wrap;
    background: transparent;
    border-bottom: 1px solid #043a6344;
}

.dropdown {
    position: relative;
}

.btn-filtro {
    background: transparent;
    border: none;
    color: #aabbcc;
    padding: 8px 5px;
    cursor: pointer;
    font-size: 13px;
    letter-spacing: 2px;
    text-transform: uppercase;
    font-weight: 300;
    transition: 0.3s;
    border-bottom: 1px solid transparent;
}

.btn-filtro:hover {
    color: #ffffff;
    border-bottom-color: #00bfff;
}

.dropdown-conteudo {
    display: none;
    position: absolute;
    top: 120%;
    left: 50%;
    transform: translateX(-50%);
    background: #021c34;
    border: 1px solid #043a63;
    border-radius: 8px;
    min-width: 160px;
    box-shadow: 0 10px 30px rgba(0,0,0,0.8);
    overflow: hidden;
    z-index: 100;
}

.dropdown-conteudo a {
    display: block;
    padding: 10px 20px;
    color: #aabbcc;
    text-decoration: none;
    font-size: 12px;
    letter-spacing: 1px;
    transition: 0.2s;
    border-bottom: 1px solid #043a6333;
    text-align: center;
}

.dropdown-conteudo a:hover {
    background: #00bfff11;
    color: #ffffff;
}

.dropdown:hover .dropdown-conteudo {
    display: block;
}

/* ===== BOTÃO FORMULÁRIO ===== */
.formulario-area {
    text-align: center;
    margin: 15px 0 40px;
    background: transparent;
    padding: 10px 0;
}

.btn-formulario {
    display: inline-block;
    border: 1px solid #00bfff55;
    padding: 14px 50px;
    border-radius: 30px;
    text-decoration: none;
    color: #e8e8e8;
    font-size: 13px;
    letter-spacing: 3px;
    text-transform: uppercase;
    font-weight: 300;
    transition: 0.3s;
    background: transparent;
}

.btn-formulario:hover {
    background: #00bfff;
    color: #010b16;
    border-color: #00bfff;
    box-shadow: 0 0 30px #00bfff33;
}

/* ===== CARROSSEL ===== */
.lancamentos {
    margin: 0 auto 60px;
    max-width: 1200px;
    padding: 0 20px;
}

.titulo-lancamento {
    text-align: center;
    font-size: 18px;
    color: #8899aa;
    font-weight: 300;
    letter-spacing: 6px;
    text-transform: uppercase;
    margin-bottom: 25px;
}

.carrossel-container {
    display: flex;
    justify-content: center;
}

.carrossel {
    display: flex;
    overflow: hidden;
    gap: 20px;
    scroll-behavior: smooth;
    width: 100%;
    max-width: 1100px;
    padding: 10px 0;
}

.card {
    flex: 0 0 200px;
    height: 250px;
    background: #021c34;
    border-radius: 12px;
    overflow: hidden;
    border: 1px solid #043a6344;
    transition: 0.4s;
    cursor: pointer;
}

.card:hover {
    border-color: #00bfff66;
    transform: scale(1.03);
    box-shadow: 0 0 30px #00bfff11;
}

.card img {
    width: 100%;
    height: 100%;
    object-fit: cover;
    transition: 0.4s;
}

.card:hover img {
    transform: scale(1.05);
}

/* ===== RESPONSIVIDADE ===== */
@media(max-width: 768px) {
    .hero h2 {
        font-size: 24px;
        letter-spacing: 4px;
    }
    
    .filtros {
        gap: 15px;
    }
    
    .btn-filtro {
        font-size: 11px;
        padding: 8px 5px;
    }
    
    .card {
        flex: 0 0 150px;
        height: 190px;
    }
    
    .btn-formulario {
        padding: 12px 30px;
        font-size: 11px;
        letter-spacing: 2px;
    }
}

@media(max-width: 480px) {
    .card {
        flex: 0 0 120px;
        height: 160px;
    }
}
</style>

</head>

<body>

<?php include("includes/header.php"); ?>

<!-- ===== FILTROS ===== -->
<section class="filtros">
    <div class="dropdown">
        <button class="btn-filtro">Tipos de Perfumaria</button>
        <div class="dropdown-conteudo">
            <a href="tipos/importado.php">Importado</a>
            <a href="tipos/nacional.php">Nacional</a>
            <a href="tipos/arabe.php">Árabe</a>
            <a href="tipos/nicho.php">Nicho</a>
        </div>
    </div>

    <div class="dropdown">
        <button class="btn-filtro">Ocasião</button>
        <div class="dropdown-conteudo">
            <a href="ocasiao/encontro.php">Encontro</a>
            <a href="ocasiao/escola.php">Escola</a>
            <a href="ocasiao/trabalho.php">Trabalho</a>
            <a href="ocasiao/balada.php">Balada</a>
            <a href="ocasiao/academia.php">Academia</a>
            <a href="ocasiao/reuniao.php">Reunião</a>
        </div>
    </div>
</section>

<!-- ===== HERO ===== -->
<section class="hero">
    <h2>Descubra sua assinatura olfativa</h2>
    <p>Encontre o perfume ideal para cada momento</p>
</section>

<!-- ===== BOTÃO FORMULÁRIO ===== -->
<section class="formulario-area">
    <a href="formulario.php" class="btn-formulario">Responder Formulário de Preferências</a>
</section>

<!-- ===== CARROSSEL ===== -->
<section class="lancamentos">
    <h2 class="titulo-lancamento">Novos Lançamentos</h2>

    <div class="carrossel-container">
        <div class="carrossel" id="carrossel">
            <div class="card"><img src="imagens/lebeaunarcisse.jpg" alt="Perfume"></div>
            <div class="card"><img src="imagens/lemaleinblue.webp" alt="Perfume"></div>
            <div class="card"><img src="imagens/phantomred.png" alt="Perfume"></div>
            <div class="card"><img src="imagens/adgedpintense.jfif" alt="Perfume"></div>
            <div class="card"><img src="imagens/purplemelancolia.png" alt="Perfume"></div>
            <div class="card"><img src="imagens/scandalelixir.jfif" alt="Perfume"></div>
            <div class="card"><img src="imagens/swuspices.webp" alt="Perfume"></div>
            <div class="card"><img src="imagens/swyporwerfully.png" alt="Perfume"></div>
            <div class="card"><img src="imagens/lebeaunarcisse.jpg" alt="Perfume"></div>
            <div class="card"><img src="imagens/lemaleinblue.webp" alt="Perfume"></div>
            <div class="card"><img src="imagens/phantomred.png" alt="Perfume"></div>
            <div class="card"><img src="imagens/adgedpintense.jfif" alt="Perfume"></div>
            <div class="card"><img src="imagens/purplemelancolia.png" alt="Perfume"></div>
            <div class="card"><img src="imagens/scandalelixir.jfif" alt="Perfume"></div>
            <div class="card"><img src="imagens/swuspices.webp" alt="Perfume"></div>
            <div class="card"><img src="imagens/swyporwerfully.png" alt="Perfume"></div>
        </div>
    </div>
</section>

<!-- ===== SCRIPTS ===== -->
<script>
// ===== AUTO SLIDE =====
const carrossel = document.getElementById('carrossel');
const larguraCard = 220;

function autoRolar() {
    if (carrossel.scrollLeft + carrossel.clientWidth >= carrossel.scrollWidth) {
        carrossel.scrollLeft = 0;
    } else {
        carrossel.scrollLeft += larguraCard;
    }
}

let intervalo = setInterval(autoRolar, 3500);

// ===== PAUSA NO HOVER =====
carrossel.addEventListener('mouseenter', () => {
    clearInterval(intervalo);
});

carrossel.addEventListener('mouseleave', () => {
    intervalo = setInterval(autoRolar, 3500);
});
</script>

</body>
</html>