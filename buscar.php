<?php
session_start();
include("includes/conexao.php");
include("includes/header.php");

// PEGAR PESQUISA
$pesquisa = isset($_GET['pesquisa']) ? trim($_GET['pesquisa']) : "";

// SQL
if($pesquisa == ""){
    $sql = "SELECT * FROM perfumes";
} else {
    $palavras = explode(" ", $pesquisa);
    $condicoes = [];

    foreach($palavras as $p){
        $p = mysqli_real_escape_string($conexao, $p);
        $condicoes[] = "(nome LIKE '%$p%' OR marca LIKE '%$p%')";
    }

    $sql = "SELECT * FROM perfumes WHERE " . implode(" AND ", $condicoes);
}

$resultado = mysqli_query($conexao, $sql);

// 🔥 FUNÇÃO PADRÃO PRA GERAR LINK
function gerarLink($nome){
    $nome = iconv('UTF-8', 'ASCII//TRANSLIT', $nome);
    $nome = strtolower($nome);
    $nome = str_replace(" ", "", $nome);
    $nome = preg_replace('/[^a-z0-9]/', '', $nome);
    return $nome . ".php";
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Busca - PerfumeMatch</title>
<link rel="stylesheet" href="includes/style.css">

<style>
/* ===== CONTAINER ===== */
.busca-container {
    max-width: 1200px;
    margin: 40px auto 60px;
    padding: 0 20px;
}

/* ===== TÍTULO ===== */
.busca-titulo {
    text-align: center;
    font-size: 24px;
    color: #e8e8e8;
    font-weight: 300;
    letter-spacing: 2px;
    margin-bottom: 30px;
}

.busca-titulo span {
    color: #00bfff;
}

/* ===== RESULTADOS ===== */
.resultados-grid {
    display: grid;
    grid-template-columns: repeat(auto-fill, 200px);
    gap: 25px;
    justify-content: center;
}

/* ===== CARD PERFUME ===== */
.perfume-box {
    background: #021c34;
    border-radius: 12px;
    overflow: hidden;
    text-decoration: none;
    border: 1px solid #043a63;
    transition: 0.3s;
    width: 200px;
    display: flex;
    flex-direction: column;
}

.perfume-box:hover {
    transform: scale(1.05);
    box-shadow: 0 0 30px #00bfff11;
    border-color: #00bfff66;
}

/* ===== IMAGEM ===== */
.imagem-container {
    width: 200px;
    height: 200px;
    background: #031d36;
    display: flex;
    align-items: center;
    justify-content: center;
    overflow: hidden;
    padding: 0;
}

.perfume-box img {
    width: 100%;
    height: 100%;
    object-fit: cover;
    transition: 0.3s;
}

.perfume-box:hover img {
    transform: scale(1.05);
}

/* ===== NOME ===== */
.perfume-title {
    background: #05294a;
    color: white;
    text-align: center;
    padding: 12px;
    font-weight: 300;
    font-size: 14px;
    min-height: 45px;
    display: flex;
    align-items: center;
    justify-content: center;
    border-top: 1px solid #043a63;
    letter-spacing: 1px;
}

/* ===== AVALIAÇÃO ===== */
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

/* ===== SEM RESULTADOS ===== */
.sem-resultados {
    text-align: center;
    color: #8899aa;
    font-size: 18px;
    padding: 60px 0;
    grid-column: 1/-1;
}

.sem-resultados span {
    color: #00bfff;
}

/* ===== RESPONSIVIDADE ===== */
@media(max-width: 768px) {
    .resultados-grid {
        justify-content: center;
        gap: 15px;
    }
    
    .perfume-box {
        width: 160px;
    }
    
    .imagem-container {
        width: 160px;
        height: 160px;
    }
}

@media(max-width: 480px) {
    .perfume-box {
        width: 140px;
    }
    
    .imagem-container {
        width: 140px;
        height: 140px;
    }
    
    .busca-titulo {
        font-size: 18px;
    }
}
</style>

</head>

<body>

<div class="busca-container">

    <h2 class="busca-titulo">
        Resultados para "<span><?php echo htmlspecialchars($pesquisa); ?></span>"
    </h2>

    <div class="resultados-grid">

    <?php if(mysqli_num_rows($resultado) > 0): ?>

        <?php while($perfume = mysqli_fetch_assoc($resultado)): 

            $link = gerarLink($perfume['nome']);

            // BUSCA AVALIAÇÃO
            $sql_avaliacao = "SELECT AVG(nota) as media FROM avaliacoes WHERE nome_perfume = '" . mysqli_real_escape_string($conexao, $perfume['nome']) . "'";
            $res_avaliacao = mysqli_query($conexao, $sql_avaliacao);
            $dado_avaliacao = mysqli_fetch_assoc($res_avaliacao);

            $media = $dado_avaliacao['media'] ? round($dado_avaliacao['media'], 1) : 0;
            $porcentagem = ($media / 5) * 100;

            $sql_votos = "SELECT COUNT(*) as total FROM avaliacoes WHERE nome_perfume = '" . mysqli_real_escape_string($conexao, $perfume['nome']) . "'";
            $res_votos = mysqli_query($conexao, $sql_votos);
            $dado_votos = mysqli_fetch_assoc($res_votos);
            $qtd_votos = $dado_votos['total'];

        ?>

        <a class="perfume-box" href="perfumes/<?php echo $link; ?>">

            <div class="imagem-container">
                <img src="uploads/<?php echo htmlspecialchars($perfume['imagem']); ?>" alt="<?php echo htmlspecialchars($perfume['nome']); ?>">
            </div>

            <div class="perfume-title">
                <?php echo htmlspecialchars($perfume['nome']); ?>
            </div>

            <div class="avaliacao">
                <span class="estrelas" style="--porcentagem: <?php echo $porcentagem; ?>%;"></span>
                <span class="nota-media"><?php echo $media; ?> (<?php echo $qtd_votos; ?>)</span>
            </div>

        </a>

        <?php endwhile; ?>

    <?php else: ?>

        <div class="sem-resultados">
            😢 Nenhum perfume encontrado para "<span><?php echo htmlspecialchars($pesquisa); ?></span>"
        </div>

    <?php endif; ?>

    </div>

</div>

</body>
</html>