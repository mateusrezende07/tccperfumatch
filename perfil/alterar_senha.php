<?php
session_start();
include("../includes/conexao.php");

// ===== LOGIN =====
if(isset($_POST['email']) && isset($_POST['senha']) && !isset($_POST['recuperar'])){

    $email = mysqli_real_escape_string($conexao, $_POST['email']);
    $senha = md5($_POST['senha']);

    $sql = "SELECT * FROM usuarios WHERE email='$email' AND senha='$senha'";
    $resultado = mysqli_query($conexao,$sql);

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

// ===== RECUPERAR SENHA =====
if(isset($_POST['recuperar']) && isset($_POST['email_recuperar'])){

    $email = mysqli_real_escape_string($conexao, $_POST['email_recuperar']);

    // Verifica se o email existe
    $sql = "SELECT * FROM usuarios WHERE email='$email'";
    $resultado = mysqli_query($conexao, $sql);

    if(mysqli_num_rows($resultado) == 1){

        // Gera token único
        $token = bin2hex(random_bytes(32));
        $expiracao = date('Y-m-d H:i:s', strtotime('+1 hour'));

        // Salva token no banco
        $sql_update = "UPDATE usuarios SET reset_token='$token', reset_expiracao='$expiracao' WHERE email='$email'";
        mysqli_query($conexao, $sql_update);

        // Link para redefinição (usando o alterar_senha.php com token)
        $link = "http://localhost/perfumatch/perfil/alterar_senha.php?token=$token";
        
        // Mensagem de sucesso
        $msg_sucesso = "Um link de recuperação foi enviado para seu email.";
        $link_mostrar = $link; // Apenas para teste

    } else {
        $erro_recuperar = "Email não encontrado.";
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
    margin: 100px auto 60px;
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
    justify-content: space-between;
    margin-top: 18px;
    font-size: 13px;
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
    margin-top: 5px;
}

.msg-sucesso {
    color: #66d9a0;
    font-size: 14px;
    text-align: center;
    padding: 10px;
    background: #66d9a011;
    border-radius: 8px;
    border: 1px solid #66d9a033;
    margin-top: 5px;
}

/* ===== RECUPERAR SENHA ===== */
.recuperar-area {
    margin-top: 25px;
    padding-top: 20px;
    border-top: 1px solid #043a63;
}

.recuperar-toggle {
    color: #8899aa;
    font-size: 13px;
    cursor: pointer;
    text-decoration: underline;
    text-underline-offset: 3px;
    transition: 0.3s;
    background: none;
    border: none;
    letter-spacing: 0.5px;
}

.recuperar-toggle:hover {
    color: #00bfff;
}

.recuperar-form {
    display: none;
    flex-direction: column;
    gap: 12px;
    margin-top: 15px;
}

.recuperar-form.visible {
    display: flex;
}

.recuperar-input {
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

.recuperar-input:focus {
    border-color: #00bfff;
    box-shadow: 0 0 20px #00bfff11;
}

.btn-recuperar {
    padding: 12px;
    background: transparent;
    border: 1px solid #00bfff55;
    border-radius: 8px;
    color: #e8e8e8;
    font-size: 13px;
    letter-spacing: 1px;
    cursor: pointer;
    transition: 0.3s;
}

.btn-recuperar:hover {
    background: #00bfff;
    color: #010b16;
    border-color: #00bfff;
    box-shadow: 0 0 30px #00bfff33;
}

.link-test {
    color: #66d9a0;
    font-size: 13px;
    word-break: break-all;
    text-align: center;
    padding: 10px;
    background: #010b16;
    border-radius: 6px;
    margin-top: 5px;
}

.link-test a {
    color: #00bfff;
    text-decoration: none;
}

.link-test a:hover {
    text-decoration: underline;
}

/* ===== RESPONSIVIDADE ===== */
@media(max-width: 480px) {
    .login-container {
        margin: 60px 15px 40px;
        padding: 30px 20px;
    }
    
    .login-titulo {
        font-size: 20px;
        letter-spacing: 2px;
    }
    
    .login-links {
        flex-direction: column;
        gap: 8px;
        align-items: center;
    }
}
</style>

</head>

<body>

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
        <button class="recuperar-toggle" onclick="toggleRecuperar()">Esqueci minha senha</button>
    </div>

    <!-- ===== RECUPERAR SENHA ===== -->
    <div class="recuperar-area">
        <div class="recuperar-form" id="recuperarForm">
            <form method="POST">
                <input type="hidden" name="recuperar" value="1">
                <input type="email" name="email_recuperar" placeholder="Digite seu email" required class="recuperar-input">
                <button type="submit" class="btn-recuperar">Enviar link de recuperação</button>
            </form>

            <?php if(isset($msg_sucesso)): ?>
                <p class="msg-sucesso"><?php echo $msg_sucesso; ?></p>
                <?php if(isset($link_mostrar)): ?>
                    <div class="link-test">
                        <strong>Link de teste:</strong><br>
                        <a href="<?php echo $link_mostrar; ?>" target="_blank"><?php echo $link_mostrar; ?></a>
                        <br><small style="color:#556677;">(Em produção, este link será enviado por email)</small>
                    </div>
                <?php endif; ?>
            <?php endif; ?>

            <?php if(isset($erro_recuperar)): ?>
                <p class="msg-erro"><?php echo $erro_recuperar; ?></p>
            <?php endif; ?>
        </div>
    </div>

</div>

<script>
function toggleRecuperar() {
    var form = document.getElementById('recuperarForm');
    form.classList.toggle('visible');
}
</script>

</body>
</html>