<?php
require_once(__DIR__ . "/includes/conexao.php");
require_once(__DIR__ . "/includes/header.php");
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Descubra seu Perfume Ideal - PerfumeMatch</title>
<link rel="stylesheet" href="includes/style.css">

<style>
/* ===== CONTAINER PRINCIPAL ===== */
.form-container {
    max-width: 1100px;
    margin: 40px auto 60px;
    background: #021c34;
    padding: 45px 40px 40px;
    border-radius: 16px;
    border: 1px solid #043a63;
    box-shadow: 0 10px 40px rgba(0,0,0,0.5);
}

/* ===== TÍTULO ===== */
.form-container h2 {
    text-align: center;
    font-size: 28px;
    color: #00bfff;
    font-weight: 300;
    letter-spacing: 4px;
    text-transform: uppercase;
    margin-bottom: 30px;
    padding-bottom: 20px;
    border-bottom: 1px solid #043a63;
}

/* ===== SUBTÍTULO ===== */
.subtitulo {
    text-align: center;
    color: #8899aa;
    font-size: 14px;
    font-weight: 300;
    letter-spacing: 1px;
    margin-bottom: 25px;
}

/* ===== FORMULÁRIO ===== */
.form-perguntas {
    display: flex;
    flex-direction: column;
    gap: 18px;
}

.pergunta {
    display: flex;
    flex-direction: column;
    gap: 6px;
}

.pergunta label {
    color: #e8e8e8;
    font-size: 14px;
    font-weight: 300;
    letter-spacing: 1px;
}

.pergunta select {
    width: 100%;
    padding: 12px 16px;
    background: #010b16;
    border: 1px solid #043a63;
    border-radius: 8px;
    color: #ffffff;
    font-size: 14px;
    transition: 0.3s;
    outline: none;
    cursor: pointer;
    appearance: none;
    background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='12' height='12' viewBox='0 0 12 12'%3E%3Cpath fill='%23556677' d='M6 8L1 3h10z'/%3E%3C/svg%3E");
    background-repeat: no-repeat;
    background-position: right 16px center;
}

.pergunta select:focus {
    border-color: #00bfff;
    box-shadow: 0 0 20px #00bfff11;
}

.pergunta select option {
    background: #021c34;
    color: #e8e8e8;
}

/* ===== BOTÃO ===== */
.btn-descobrir {
    width: 100%;
    padding: 14px;
    margin-top: 10px;
    background: transparent;
    border: 1px solid #00bfff55;
    border-radius: 8px;
    color: #e8e8e8;
    font-size: 15px;
    font-weight: 300;
    letter-spacing: 3px;
    text-transform: uppercase;
    cursor: pointer;
    transition: 0.3s;
}

.btn-descobrir:hover {
    background: #00bfff;
    color: #010b16;
    border-color: #00bfff;
    box-shadow: 0 0 30px #00bfff33;
}

/* ===== RESULTADO ===== */
.resultado {
    margin-top: 35px;
    padding-top: 30px;
    border-top: 1px solid #043a63;
}

.perfil-usuario {
    text-align: center;
    margin-bottom: 30px;
}

.perfil-usuario h3 {
    color: #e8e8e8;
    font-size: 18px;
    font-weight: 300;
    letter-spacing: 2px;
    margin-bottom: 5px;
}

.perfil-usuario p {
    color: #00bfff;
    font-size: 14px;
    letter-spacing: 2px;
    font-weight: 300;
}

/* ===== LISTA DE PERFUMES ===== */
.lista-perfumes {
    display: grid;
    grid-template-columns: repeat(3, 1fr);
    gap: 25px;
}

.titulo-faixa {
    grid-column: 1/-1;
    margin-top: 30px;
    margin-bottom: 10px;
    text-align: center;
    color: #8899aa;
    font-size: 18px;
    font-weight: 300;
    letter-spacing: 3px;
    text-transform: uppercase;
    padding-bottom: 10px;
    border-bottom: 1px solid #043a63;
}

.titulo-faixa:first-of-type {
    margin-top: 0;
}

/* ===== CARD PERFUME ===== */
.card-perfume {
    background: #010b16;
    padding: 20px;
    border-radius: 12px;
    text-align: center;
    height: 100%;
    transition: 0.3s;
    border: 1px solid #043a63;
    display: flex;
    flex-direction: column;
    align-items: center;
}

.card-perfume:hover {
    transform: translateY(-5px);
    border-color: #00bfff66;
    box-shadow: 0 10px 30px rgba(0,0,0,0.3);
}

.card-perfume img {
    width: 150px;
    height: 180px;
    object-fit: contain;
    margin-bottom: 12px;
    transition: 0.3s;
}

.card-perfume:hover img {
    transform: scale(1.05);
}

.card-perfume h3 {
    color: #ffffff;
    font-size: 15px;
    font-weight: 300;
    letter-spacing: 1px;
    margin-bottom: 4px;
}

.card-perfume .marca {
    color: #8899aa;
    font-size: 13px;
    font-weight: 300;
    margin-bottom: 4px;
}

.card-perfume .preco {
    color: #00bfff;
    font-size: 16px;
    font-weight: 300;
    letter-spacing: 1px;
}

/* ===== AVALIAÇÃO NO CARD ===== */
.avaliacao-card {
    margin-top: 8px;
    padding-top: 8px;
    border-top: 1px solid #043a63;
    width: 100%;
}

.estrelas-card {
    font-size: 14px;
    position: relative;
    display: inline-block;
    color: #444;
    letter-spacing: 2px;
}

.estrelas-card::before {
    content: '★★★★★';
    color: #444;
}

.estrelas-card::after {
    content: '★★★★★';
    color: gold;
    position: absolute;
    left: 0;
    top: 0;
    overflow: hidden;
    white-space: nowrap;
    width: var(--porcentagem);
}

.nota-card {
    color: #8899aa;
    font-size: 12px;
    margin-left: 5px;
}

/* ===== SEM RESULTADOS ===== */
.sem-resultados {
    text-align: center;
    color: #8899aa;
    font-size: 16px;
    padding: 40px 0;
    grid-column: 1/-1;
}

/* ===== RESPONSIVIDADE ===== */
@media(max-width: 900px) {
    .lista-perfumes {
        grid-template-columns: repeat(2, 1fr);
        gap: 20px;
    }
    
    .form-container {
        padding: 30px 25px;
    }
    
    .form-container h2 {
        font-size: 22px;
        letter-spacing: 2px;
    }
}

@media(max-width: 600px) {
    .lista-perfumes {
        grid-template-columns: 1fr;
        gap: 15px;
    }
    
    .form-container {
        margin: 20px 15px 40px;
        padding: 25px 15px;
    }
    
    .form-container h2 {
        font-size: 18px;
    }
    
    .card-perfume img {
        width: 120px;
        height: 150px;
    }
    
    .btn-descobrir {
        font-size: 13px;
        letter-spacing: 2px;
    }
}
</style>

</head>

<body>

<div class="form-container">

    <h2>Descubra sua fragrância ideal</h2>
    <p class="subtitulo">Encontre o perfume perfeito para seu estilo</p>

    <form method="POST" class="form-perguntas">

        <div class="pergunta">
            <label>Família olfativa</label>
            <select name="familia" required>
                <option value="">Selecione</option>
                <option value="amadeirado">Amadeirado</option>
                <option value="doce">Doce</option>
                <option value="citrico">Cítrico</option>
                <option value="frutado">Frutado</option>
                <option value="aquatico">Aquático</option>
            </select>
        </div>

        <div class="pergunta">
            <label>Ocasião</label>
            <select name="ocasiao" required>
                <option value="">Selecione</option>
                <option value="dia">Dia a dia</option>
                <option value="trabalho">Trabalho</option>
                <option value="balada">Balada</option>
                <option value="encontro">Encontro</option>
                <option value="academia">Academia</option>
            </select>
        </div>

        <div class="pergunta">
            <label>Intensidade</label>
            <select name="intensidade" required>
                <option value="">Selecione</option>
                <option value="leve">Leve</option>
                <option value="media">Média</option>
                <option value="forte">Forte</option>
            </select>
        </div>

        <button type="submit" name="enviar" class="btn-descobrir">Descobrir</button>

    </form>

    <div class="resultado">

    <?php
    if(isset($_POST['enviar'])){

        $familia = mysqli_real_escape_string($conexao, $_POST['familia']);
        $ocasiao = mysqli_real_escape_string($conexao, $_POST['ocasiao']);
        $intensidade = mysqli_real_escape_string($conexao, $_POST['intensidade']);

        // Mapeia os valores para o banco
        $mapa_intensidade = [
            'leve' => 'leve',
            'media' => 'media',
            'forte' => 'forte'
        ];

        $intensidade_busca = isset($mapa_intensidade[$intensidade]) ? $mapa_intensidade[$intensidade] : $intensidade;

        echo '
        <div class="perfil-usuario">
            <h3>Seu perfil</h3>
            <p>' . ucfirst($familia) . ' • ' . ucfirst($ocasiao) . ' • ' . ucfirst($intensidade) . '</p>
        </div>
        ';

        $faixas = [
            ['nome' => 'Premium - Acima de R$1000', 'condicao' => 'preco >= 1000'],
            ['nome' => 'Luxo - R$700 até R$999', 'condicao' => 'preco BETWEEN 700 AND 999'],
            ['nome' => 'Intermediário - R$400 até R$699', 'condicao' => 'preco BETWEEN 400 AND 699'],
            ['nome' => 'Acessível - Até R$399', 'condicao' => 'preco <= 399']
        ];

        echo '<div class="lista-perfumes">';

        foreach($faixas as $faixa){

            echo '<h3 class="titulo-faixa">' . $faixa['nome'] . '</h3>';

            // Busca com intensidade correta
            $sql = "SELECT * FROM perfumes 
                    WHERE familia LIKE '%$familia%' 
                    AND ocasiao LIKE '%$ocasiao%' 
                    AND intensidade = '$intensidade_busca'
                    AND {$faixa['condicao']} 
                    ORDER BY RAND() 
                    LIMIT 3";

            $resultado = mysqli_query($conexao, $sql);

            // Se não encontrar com a intensidade específica, busca por similaridade
            if(mysqli_num_rows($resultado) == 0){
                $sql = "SELECT * FROM perfumes 
                        WHERE familia LIKE '%$familia%' 
                        AND ocasiao LIKE '%$ocasiao%' 
                        AND intensidade LIKE '%$intensidade_busca%'
                        AND {$faixa['condicao']} 
                        ORDER BY RAND() 
                        LIMIT 3";
                $resultado = mysqli_query($conexao, $sql);
            }

            // Se ainda não encontrar, busca apenas pela faixa de preço
            if(mysqli_num_rows($resultado) == 0){
                $sql = "SELECT * FROM perfumes 
                        WHERE {$faixa['condicao']} 
                        ORDER BY RAND() 
                        LIMIT 3";
                $resultado = mysqli_query($conexao, $sql);
            }

            if(mysqli_num_rows($resultado) > 0){
                while($perfume = mysqli_fetch_assoc($resultado)){

                    if(!empty($perfume['pagina'])){
                        $link = $perfume['pagina'];
                    }else{
                        $link = strtolower(str_replace(" ", "", $perfume['nome'])) . ".php";
                        $link = preg_replace('/[^a-z0-9\.]/', '', $link);
                    }

                    // Busca avaliação
                    $sql_avaliacao = "SELECT AVG(nota) as media, COUNT(*) as total FROM avaliacoes WHERE nome_perfume = '" . mysqli_real_escape_string($conexao, $perfume['nome']) . "'";
                    $res_avaliacao = mysqli_query($conexao, $sql_avaliacao);
                    $dado_avaliacao = mysqli_fetch_assoc($res_avaliacao);
                    
                    $media = $dado_avaliacao['media'] ? round($dado_avaliacao['media'], 1) : 0;
                    $porcentagem = ($media / 5) * 100;
                    $qtd_votos = $dado_avaliacao['total'] ? $dado_avaliacao['total'] : 0;

                    ?>
                    <a href="/perfumatch/perfumes/<?php echo $link; ?>" style="text-decoration:none;color:white;">
                        <div class="card-perfume">
                            <img src="/perfumatch/uploads/<?php echo $perfume['imagem']; ?>" alt="<?php echo $perfume['nome']; ?>">
                            <h3><?php echo $perfume['nome']; ?></h3>
                            <p class="marca"><?php echo $perfume['marca']; ?></p>
                            <p class="preco">R$ <?php echo number_format($perfume['preco'], 2, ',', '.'); ?></p>
                            <div class="avaliacao-card">
                                <span class="estrelas-card" style="--porcentagem: <?php echo $porcentagem; ?>%;"></span>
                                <span class="nota-card"><?php echo $media; ?> (<?php echo $qtd_votos; ?>)</span>
                            </div>
                        </div>
                    </a>
                    <?php
                }
            } else {
                echo '<p class="sem-resultados">Nenhum perfume encontrado nesta faixa</p>';
            }
        }

        echo '</div>';
    }
    ?>

    </div>

</div>

</body>
</html>