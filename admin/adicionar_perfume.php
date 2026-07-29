<?php
// MOSTRAR ERROS (IMPORTANTE PRA DEBUG)
error_reporting(E_ALL);
ini_set("display_errors", 1);

include("../includes/conexao.php");
include("../includes/header.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    // PROTEÇÃO CONTRA ERROS
    $nome = isset($_POST['nome']) ? mysqli_real_escape_string($conexao, $_POST['nome']) : '';
    $tipo = isset($_POST['tipo']) ? mysqli_real_escape_string($conexao, $_POST['tipo']) : '';
    $familia = isset($_POST['familia']) ? mysqli_real_escape_string($conexao, $_POST['familia']) : '';
    $preco = isset($_POST['preco']) ? mysqli_real_escape_string($conexao, $_POST['preco']) : '';
    $intensidade = isset($_POST['intensidade']) ? mysqli_real_escape_string($conexao, $_POST['intensidade']) : '';
    $marca = isset($_POST['marca']) ? mysqli_real_escape_string($conexao, $_POST['marca']) : '';

    /* OCASIÕES */
    if (isset($_POST['ocasiao'])) {
        $ocasiao = implode(",", $_POST['ocasiao']);
        $ocasiao = mysqli_real_escape_string($conexao, $ocasiao);
    } else {
        $ocasiao = "";
    }

    /* IMAGEM */
    $imagem = "";
    if (isset($_FILES['imagem']) && $_FILES['imagem']['error'] == 0) {
        $extensao = pathinfo($_FILES['imagem']['name'], PATHINFO_EXTENSION);
        $nome_imagem = strtolower(str_replace(" ", "_", $nome)) . "." . $extensao;
        $imagem = $nome_imagem;
        $tmp = $_FILES['imagem']['tmp_name'];

        move_uploaded_file($tmp, "../uploads/" . $imagem);
    }

    /* INSERT SEGURO COM TODOS OS CAMPOS */
    $stmt = $conexao->prepare("INSERT INTO perfumes (nome, marca, tipo, ocasiao, imagem, familia, preco, intensidade) VALUES (?, ?, ?, ?, ?, ?, ?, ?)");

    if ($stmt) {
        $stmt->bind_param("ssssssss", $nome, $marca, $tipo, $ocasiao, $imagem, $familia, $preco, $intensidade);

        if ($stmt->execute()) {
            $msg = "Perfume adicionado com sucesso!";
            $msg_tipo = "sucesso";
        } else {
            $msg = "Erro ao executar: " . $stmt->error;
            $msg_tipo = "erro";
        }

    } else {
        $msg = "Erro na preparação: " . $conexao->error;
        $msg_tipo = "erro";
    }
}
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Adicionar Perfume - PerfumeMatch</title>
<link rel="stylesheet" href="../includes/style.css">

<style>
/* ===== CONTAINER ===== */
.admin-container {
    max-width: 600px;
    margin: 40px auto 60px;
    background: #021c34;
    padding: 45px 40px 40px;
    border-radius: 16px;
    border: 1px solid #043a63;
    box-shadow: 0 10px 40px rgba(0,0,0,0.5);
}

/* ===== TÍTULO ===== */
.admin-titulo {
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

/* ===== FORMULÁRIO ===== */
.admin-form {
    display: flex;
    flex-direction: column;
    gap: 18px;
}

.admin-form label {
    color: #e8e8e8;
    font-size: 14px;
    font-weight: 300;
    letter-spacing: 1px;
    margin-bottom: 4px;
}

.admin-form input[type="text"],
.admin-form input[type="number"],
.admin-form select {
    width: 100%;
    padding: 12px 16px;
    background: #010b16;
    border: 1px solid #043a63;
    border-radius: 8px;
    color: #ffffff;
    font-size: 14px;
    transition: 0.3s;
    outline: none;
    box-sizing: border-box;
}

.admin-form input:focus,
.admin-form select:focus {
    border-color: #00bfff;
    box-shadow: 0 0 20px #00bfff11;
}

.admin-form input::placeholder {
    color: #556677;
}

.admin-form select option {
    background: #021c34;
    color: #e8e8e8;
}

/* ===== CHECKBOXES ===== */
.checkbox-group {
    display: grid;
    grid-template-columns: repeat(3, 1fr);
    gap: 8px;
    background: #010b16;
    padding: 15px;
    border-radius: 8px;
    border: 1px solid #043a63;
}

.checkbox-group label {
    color: #aabbcc;
    font-size: 13px;
    font-weight: 300;
    display: flex;
    align-items: center;
    gap: 8px;
    cursor: pointer;
    transition: 0.3s;
}

.checkbox-group label:hover {
    color: #ffffff;
}

.checkbox-group input[type="checkbox"] {
    width: 16px;
    height: 16px;
    accent-color: #00bfff;
    cursor: pointer;
}

/* ===== BOTÃO ===== */
.btn-adicionar {
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

.btn-adicionar:hover {
    background: #00bfff;
    color: #010b16;
    border-color: #00bfff;
    box-shadow: 0 0 30px #00bfff33;
}

/* ===== MENSAGEM ===== */
.msg {
    text-align: center;
    padding: 12px;
    border-radius: 8px;
    margin-bottom: 20px;
    font-weight: 300;
    letter-spacing: 1px;
}

.msg-sucesso {
    color: #66d9a0;
    background: #66d9a011;
    border: 1px solid #66d9a033;
}

.msg-erro {
    color: #ff6b6b;
    background: #ff6b6b11;
    border: 1px solid #ff6b6b33;
}

/* ===== RESPONSIVIDADE ===== */
@media(max-width: 600px) {
    .admin-container {
        margin: 20px 15px 40px;
        padding: 25px 20px;
    }
    
    .admin-titulo {
        font-size: 20px;
        letter-spacing: 2px;
    }
    
    .checkbox-group {
        grid-template-columns: repeat(2, 1fr);
    }
}
</style>

</head>

<body>

<div class="admin-container">

    <h2 class="admin-titulo">Adicionar Perfume</h2>

    <?php if (isset($msg)): ?>
        <p class="msg <?php echo $msg_tipo == 'sucesso' ? 'msg-sucesso' : 'msg-erro'; ?>">
            <?php echo $msg; ?>
        </p>
    <?php endif; ?>

    <form method="POST" enctype="multipart/form-data" class="admin-form">

        <!-- NOME -->
        <div>
            <label>Nome do perfume</label>
            <input type="text" name="nome" placeholder="Ex: 1 Million Elixir" required>
        </div>

        <!-- MARCA -->
        <div>
            <label>Marca</label>
            <input type="text" name="marca" placeholder="Ex: Rabanne">
        </div>

        <!-- TIPO -->
        <div>
            <label>Tipo de Perfumaria</label>
            <select name="tipo" required>
                <option value="">Selecione</option>
                <option value="importado">Importado</option>
                <option value="nacional">Nacional</option>
                <option value="arabe">Árabe</option>
                <option value="nicho">Nicho</option>
            </select>
        </div>

        <!-- FAMÍLIA -->
        <div>
            <label>Família Olfativa</label>
            <select name="familia">
                <option value="">Selecione</option>
                <option value="citrico">Cítrico</option>
                <option value="frutado">Frutado</option>
                <option value="amadeirado">Amadeirado</option>
                <option value="doce">Doce</option>
                <option value="aquatico">Aquático</option>
                <option value="floral">Floral</option>
                <option value="oriental">Oriental</option>
                <option value="picante">Picante</option>
                <option value="abaunilhado">Baunilhado</option>
                <option value="fresco">Fresco</option>
                <option value="verde">Verde</option>
                <option value="terroso">Terroso</option>
                <option value="animalico">Animalico</option>
                <option value="tropical">Tropical</option>
            </select>
        </div>

        <!-- PREÇO -->
        <div>
            <label>Preço (R$)</label>
            <input type="text" name="preco" placeholder="Ex: 899.90">
        </div>

        <!-- INTENSIDADE -->
        <div>
            <label>Intensidade</label>
            <select name="intensidade">
                <option value="">Selecione</option>
                <option value="leve">Leve</option>
                <option value="media">Média</option>
                <option value="forte">Forte</option>
                <option value="extremo">Extremo</option>
            </select>
        </div>

        <!-- OCASIÕES -->
        <div>
            <label>Ocasiões (selecione uma ou mais)</label>
            <div class="checkbox-group">
                <label><input type="checkbox" name="ocasiao[]" value="encontro"> Encontro</label>
                <label><input type="checkbox" name="ocasiao[]" value="escola"> Escola</label>
                <label><input type="checkbox" name="ocasiao[]" value="trabalho"> Trabalho</label>
                <label><input type="checkbox" name="ocasiao[]" value="balada"> Balada</label>
                <label><input type="checkbox" name="ocasiao[]" value="academia"> Academia</label>
                <label><input type="checkbox" name="ocasiao[]" value="reuniao"> Reunião</label>
                <label><input type="checkbox" name="ocasiao[]" value="dia"> Dia a dia</label>
                <label><input type="checkbox" name="ocasiao[]" value="noite"> Noite</label>
            </div>
        </div>

        <!-- IMAGEM -->
        <div>
            <label>Imagem do perfume</label>
            <input type="file" name="imagem" accept="image/*" style="color:#8899aa;padding:8px 0;">
        </div>

        <button type="submit" class="btn-adicionar">Adicionar Perfume</button>

    </form>

</div>

</body>
</html>