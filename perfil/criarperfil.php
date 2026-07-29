<?php
session_start();
include("../includes/conexao.php");
include("../includes/header.php");

if(isset($_POST['nome'])){

    $nome = mysqli_real_escape_string($conexao, $_POST['nome']);
    $email = mysqli_real_escape_string($conexao, $_POST['email']);
    $senha = md5($_POST['senha']);

    $verificar = "SELECT * FROM usuarios WHERE email='$email'";
    $resultado = mysqli_query($conexao, $verificar);

    if(mysqli_num_rows($resultado) > 0){
        $erro = "Este email já possui conta.";
    }else{
        $sql = "INSERT INTO usuarios (nome, email, senha) VALUES ('$nome','$email','$senha')";
        mysqli_query($conexao, $sql);
        $_SESSION['nome'] = $nome;
        $_SESSION['usuario_id'] = mysqli_insert_id($conexao);
        header("Location: ../index.php");
        exit();
    }
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Criar Conta - PerfumeMatch</title>
<link rel="stylesheet" href="../includes/style.css">

<style>
/* ===== CONTAINER ===== */
.form-container {
    max-width: 440px;
    margin: 40px auto 60px;
    background: #021c34;
    border-radius: 16px;
    padding: 45px 40px 40px;
    border: 1px solid #043a63;
    box-shadow: 0 10px 40px rgba(0,0,0,0.5);
}

/* ===== TÍTULO ===== */
.form-container h2 {
    text-align: center;
    font-size: 26px;
    color: #00bfff;
    font-weight: 300;
    letter-spacing: 4px;
    text-transform: uppercase;
    margin-bottom: 30px;
    padding-bottom: 20px;
    border-bottom: 1px solid #043a63;
}

/* ===== INPUTS ===== */
.form-container input {
    width: 100%;
    padding: 14px 18px;
    margin-top: 12px;
    background: #010b16;
    border: 1px solid #043a63;
    border-radius: 8px;
    color: #ffffff;
    font-size: 14px;
    transition: 0.3s;
    outline: none;
    box-sizing: border-box;
}

.form-container input:focus {
    border-color: #00bfff;
    box-shadow: 0 0 20px #00bfff11;
}

.form-container input::placeholder {
    color: #556677;
}

/* ===== BOTÃO ===== */
.form-container button {
    width: 100%;
    padding: 14px;
    margin-top: 20px;
    background: #00bfff;
    border: none;
    border-radius: 8px;
    color: #010b16;
    font-size: 15px;
    font-weight: 600;
    letter-spacing: 2px;
    cursor: pointer;
    transition: 0.3s;
}

.form-container button:hover {
    background: #0099cc;
    box-shadow: 0 0 30px #00bfff44;
}

/* ===== ERRO ===== */
.erro {
    color: #ff6b6b;
    font-size: 14px;
    text-align: center;
    padding: 10px;
    background: #ff6b6b11;
    border-radius: 8px;
    border: 1px solid #ff6b6b33;
    margin-top: 15px;
}

/* ===== LINK LOGIN ===== */
.link-login {
    text-align: center;
    margin-top: 18px;
    font-size: 14px;
}

.link-login a {
    color: #8899aa;
    text-decoration: none;
    transition: 0.3s;
    letter-spacing: 0.5px;
}

.link-login a:hover {
    color: #00bfff;
}

/* ===== RESPONSIVIDADE ===== */
@media(max-width: 480px) {
    .form-container {
        margin: 20px 15px 40px;
        padding: 30px 20px;
    }
    
    .form-container h2 {
        font-size: 20px;
        letter-spacing: 2px;
    }
}
</style>

</head>

<body>

<!-- ===== HEADER JÁ INCLUÍDO VIA include("../includes/header.php") ===== -->

<div class="form-container">

    <h2>Criar Conta</h2>

    <form method="POST">
        <input type="text" name="nome" placeholder="Seu nome" required>
        <input type="email" name="email" placeholder="Seu email" required>
        <input type="password" name="senha" placeholder="Crie uma senha" required>
        <button type="submit">Cadastrar</button>
    </form>

    <?php if(isset($erro)): ?>
        <p class="erro"><?php echo $erro; ?></p>
        <div class="link-login">
            <a href="entrar.php">Já possui conta? Entrar</a>
        </div>
    <?php endif; ?>

    <?php if(!isset($erro)): ?>
        <div class="link-login">
            <a href="entrar.php">Já possui conta? Entrar</a>
        </div>
    <?php endif; ?>

</div>

</body>
</html>