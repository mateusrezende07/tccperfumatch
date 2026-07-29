<?php
session_start();
include("../includes/conexao.php");
include("../includes/header.php");

// ===== LOGIN =====
if(isset($_POST['email']) && isset($_POST['senha'])){

    $email = mysqli_real_escape_string($conexao, $_POST['email']);
    $senha = md5($_POST['senha']);

    $sql = "SELECT * FROM usuarios WHERE email='$email' AND senha='$senha'";
    $resultado = mysqli_query($conexao, $sql);

    if(mysqli_num_rows($resultado) == 1){
        $usuario = mysqli_fetch_assoc($resultado);
        $_SESSION['nome'] = $usuario['nome'];
        $_SESSION['usuario_id'] = $usuario['id'];
        header("Location: ../index.php");
        exit;
    }else{
        $erro = "Email ou senha incorretos";
    }
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Entrar - PerfumeMatch</title>
<link rel="stylesheet" href="../includes/style.css">

<style>
/* ===== CONTAINER ===== */
.login-container {
    max-width: 440px;
    margin: 40px auto 60px;
    background: #021c34;
    border-radius: 16px;
    padding: 45px 40px 40px;
    border: 1px solid #043a63;
    box-shadow: 0 10px 40px rgba(0,0,0,0.5);
}

/* ===== TÍTULO ===== */
.login-titulo {
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

/* ===== FORMULÁRIO ===== */
.login-form {
    display: flex;
    flex-direction: column;
    gap: 16px;
}

.login-input {
    width: 100%;
    padding: 14px 18px;
    background: #010b16;
    border: 1px solid #043a63;
    border-radius: 8px;
    color: #ffffff;
    font-size: 14px;
    transition: 0.3s;
    outline: none;
    box-sizing: border-box;
}

.login-input:focus {
    border-color: #00bfff;
    box-shadow: 0 0 20px #00bfff11;
}

.login-input::placeholder {
    color: #556677;
}

.btn-entrar {
    padding: 14px;
    background: #00bfff;
    border: none;
    border-radius: 8px;
    color: #010b16;
    font-size: 15px;
    font-weight: 600;
    letter-spacing: 2px;
    cursor: pointer;
    transition: 0.3s;
    margin-top: 5px;
}

.btn-entrar:hover {
    background: #0099cc;
    box-shadow: 0 0 30px #00bfff44;
}

/* ===== LINKS ===== */
.login-links {
    display: flex;
    justify-content: center;
    margin-top: 20px;
    font-size: 14px;
    gap: 20px;
}

.login-links a {
    color: #8899aa;
    text-decoration: none;
    transition: 0.3s;
    letter-spacing: 0.5px;
}

.login-links a:hover {
    color: #00bfff;
}

/* ===== ERRO ===== */
.msg-erro {
    color: #ff6b6b;
    font-size: 14px;
    text-align: center;
    padding: 10px;
    background: #ff6b6b11;
    border-radius: 8px;
    border: 1px solid #ff6b6b33;
    margin-top: 10px;
}

/* ===== RESPONSIVIDADE ===== */
@media(max-width: 480px) {
    .login-container {
        margin: 20px 15px 40px;
        padding: 30px 20px;
    }
    
    .login-titulo {
        font-size: 20px;
        letter-spacing: 2px;
    }
    
    .login-links {
        flex-direction: column;
        gap: 10px;
        align-items: center;
    }
}
</style>

</head>

<body>

<!-- ===== HEADER JÁ INCLUÍDO VIA include("../includes/header.php") ===== -->

<div class="login-container">

    <h2 class="login-titulo">Entrar</h2>

    <!-- ===== FORMULÁRIO DE LOGIN ===== -->
    <form method="POST" class="login-form">
        <input type="email" name="email" placeholder="Email" required class="login-input">
        <input type="password" name="senha" placeholder="Senha" required class="login-input">
        <button type="submit" class="btn-entrar">Entrar</button>
    </form>

    <?php if(isset($erro)): ?>
        <p class="msg-erro"><?php echo $erro; ?></p>
    <?php endif; ?>

    <!-- ===== LINKS ===== -->
    <div class="login-links">
        <a href="criarperfil.php">Criar conta</a>
    </div>

</div>

</body>
</html>