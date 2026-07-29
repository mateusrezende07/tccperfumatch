<?php
include("../includes/conexao.php");
require_once("../includes/header.php");

if(!isset($_SESSION['usuario_id'])){
    die("Você precisa estar logado.");
}

$id = $_SESSION['usuario_id'];

// ALTERAR SENHA
if(isset($_POST['nova_senha'])){
    $nova = md5($_POST['nova_senha']);
    mysqli_query($conexao,"UPDATE usuarios SET senha='$nova' WHERE id='$id'");
    $msg = "Senha alterada com sucesso!";
}

// BUSCAR USUÁRIO
$sql = "SELECT * FROM usuarios WHERE id='$id'";
$res = mysqli_query($conexao,$sql);
$user = mysqli_fetch_assoc($res);
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
<meta charset="UTF-8">
<title>Perfil</title>
<link rel="stylesheet" href="../includes/style.css">

<style>
/* ===== CONTAINER PRINCIPAL ===== */
.perfil-container {
    max-width: 600px;
    margin: 100px auto 60px;
    background: #021c34;
    border-radius: 16px;
    padding: 40px;
    border: 1px solid #043a63;
    box-shadow: 0 10px 40px rgba(0,0,0,0.5);
}

/* ===== TÍTULO ===== */
.perfil-titulo {
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

/* ===== INFORMAÇÕES DO USUÁRIO ===== */
.info-usuario {
    display: flex;
    flex-direction: column;
    gap: 12px;
    margin-bottom: 30px;
}

.info-item {
    display: flex;
    justify-content: space-between;
    padding: 12px 0;
    border-bottom: 1px solid #043a6344;
}

.info-label {
    color: #8899aa;
    font-size: 14px;
    font-weight: 300;
    letter-spacing: 1px;
}

.info-value {
    color: #ffffff;
    font-size: 15px;
    font-weight: 300;
}

/* ===== DIVISOR ===== */
.divisor {
    border: none;
    border-top: 1px solid #043a63;
    margin: 25px 0;
}

/* ===== SEÇÃO SENHA ===== */
.senha-titulo {
    color: #e8e8e8;
    font-size: 18px;
    font-weight: 300;
    letter-spacing: 2px;
    margin-bottom: 15px;
}

.senha-form {
    display: flex;
    gap: 12px;
    flex-wrap: wrap;
}

.senha-input {
    flex: 1;
    min-width: 200px;
    padding: 12px 16px;
    background: #010b16;
    border: 1px solid #043a63;
    border-radius: 8px;
    color: #ffffff;
    font-size: 14px;
    transition: 0.3s;
    outline: none;
}

.senha-input:focus {
    border-color: #00bfff;
    box-shadow: 0 0 20px #00bfff11;
}

.btn-alterar {
    padding: 12px 30px;
    background: transparent;
    border: 1px solid #00bfff55;
    border-radius: 8px;
    color: #e8e8e8;
    font-size: 13px;
    letter-spacing: 1px;
    cursor: pointer;
    transition: 0.3s;
    font-weight: 300;
}

.btn-alterar:hover {
    background: #00bfff;
    color: #010b16;
    border-color: #00bfff;
    box-shadow: 0 0 30px #00bfff33;
}

.msg-sucesso {
    color: #66d9a0;
    font-size: 14px;
    margin-top: 12px;
    text-align: center;
    letter-spacing: 1px;
}

/* ===== SEÇÃO FAVORITOS ===== */
.favoritos-titulo {
    color: #e8e8e8;
    font-size: 18px;
    font-weight: 300;
    letter-spacing: 2px;
    margin-bottom: 15px;
}

.favoritos-lista {
    display: flex;
    flex-direction: column;
    gap: 10px;
}

.favorito-item {
    display: flex;
    justify-content: space-between;
    align-items: center;
    background: #010b16;
    padding: 12px 16px;
    border-radius: 8px;
    border: 1px solid #043a6344;
    transition: 0.3s;
}

.favorito-item:hover {
    border-color: #00bfff33;
}

.favorito-nome {
    color: #e8e8e8;
    font-size: 14px;
    font-weight: 300;
    letter-spacing: 1px;
}

.favorito-nome .heart {
    color: #ff6b6b;
    margin-right: 8px;
}

.btn-remover {
    color: #ff6b6b;
    text-decoration: none;
    font-size: 12px;
    letter-spacing: 1px;
    padding: 4px 12px;
    border: 1px solid #ff6b6b33;
    border-radius: 4px;
    transition: 0.3s;
}

.btn-remover:hover {
    background: #ff6b6b;
    color: #010b16;
    border-color: #ff6b6b;
}

.sem-favoritos {
    text-align: center;
    color: #8899aa;
    font-size: 14px;
    padding: 20px 0;
    letter-spacing: 1px;
}

/* ===== BOTÃO SAIR ===== */
.btn-sair {
    display: block;
    text-align: center;
    padding: 14px;
    background: transparent;
    border: 1px solid #ff6b6b55;
    border-radius: 8px;
    color: #ff6b6b;
    text-decoration: none;
    font-size: 14px;
    letter-spacing: 2px;
    font-weight: 300;
    transition: 0.3s;
    margin-top: 10px;
}

.btn-sair:hover {
    background: #ff6b6b;
    color: #010b16;
    border-color: #ff6b6b;
    box-shadow: 0 0 30px #ff6b6b22;
}

/* ===== RESPONSIVIDADE ===== */
@media(max-width: 640px) {
    .perfil-container {
        margin: 80px 15px 40px;
        padding: 25px;
    }
    
    .perfil-titulo {
        font-size: 22px;
        letter-spacing: 2px;
    }
    
    .senha-form {
        flex-direction: column;
    }
    
    .senha-input {
        min-width: auto;
    }
    
    .btn-alterar {
        width: 100%;
    }
    
    .favorito-item {
        flex-wrap: wrap;
        gap: 8px;
    }
}
</style>

</head>

<body>

<div class="perfil-container">

    <h2 class="perfil-titulo">Meu Perfil</h2>

    <!-- ===== INFORMAÇÕES DO USUÁRIO ===== -->
    <div class="info-usuario">
        <div class="info-item">
            <span class="info-label">Nome</span>
            <span class="info-value"><?php echo htmlspecialchars($user['nome']); ?></span>
        </div>
        <div class="info-item">
            <span class="info-label">Email</span>
            <span class="info-value"><?php echo htmlspecialchars($user['email']); ?></span>
        </div>
    </div>

    <hr class="divisor">

    <!-- ===== ALTERAR SENHA ===== -->
    <h3 class="senha-titulo">Alterar Senha</h3>

    <form method="POST" class="senha-form">
        <input type="password" name="nova_senha" placeholder="Nova senha" required class="senha-input">
        <button type="submit" class="btn-alterar">Alterar</button>
    </form>

    <?php if(isset($msg)): ?>
        <p class="msg-sucesso"><?php echo $msg; ?></p>
    <?php endif; ?>

    <hr class="divisor">

    <!-- ===== FAVORITOS ===== -->
    <h3 class="favoritos-titulo">Perfumes Favoritos</h3>

    <div class="favoritos-lista">
    <?php
    $sql = "SELECT * FROM favoritos WHERE id_usuario='$id' ORDER BY id DESC";
    $resultado = mysqli_query($conexao, $sql);

    if(mysqli_num_rows($resultado) == 0): ?>
        <p class="sem-favoritos">Nenhum perfume favoritado ainda</p>
    <?php else: 
        while($fav = mysqli_fetch_assoc($resultado)): ?>
            <div class="favorito-item">
                <span class="favorito-nome">
                    <span class="heart">❤</span> 
                    <?php echo htmlspecialchars($fav['perfume']); ?>
                </span>
                <a href="/perfumatch/remover_favorito.php?id=<?php echo $fav['id']; ?>" class="btn-remover">Remover</a>
            </div>
    <?php 
        endwhile; 
    endif; 
    ?>
    </div>

    <hr class="divisor">

    <!-- ===== SAIR ===== -->
    <a href="/perfumatch/logout.php" class="btn-sair">Sair da conta</a>

</div>

</body>
</html>