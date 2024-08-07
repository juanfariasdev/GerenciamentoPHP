<?php
session_start();

if (empty($_POST['email']) || empty($_POST['senha']) || empty($_POST['perfil'])) {
    $_SESSION['texto_erro_login'] = 'Por favor, preencha todos os campos!';
    header("Location: index.php");
    exit();
}

$email = trim($_POST["email"]);
$senha = trim($_POST["senha"]);
$perfil = intval($_POST["perfil"]);

switch ($perfil) {
    case 1:
        require_once("bd/bd_usuario.php");
        $dados = checaUsuario($email, $senha);
        break;
    case 2:
        require_once("bd/bd_cliente.php");
        $dados = checaCliente($email, $senha);
        break;
    case 3:
        require_once("bd/bd_terceirizado.php");
        $dados = checaTerceirizado($email, $senha);
        break;
    default:
        $_SESSION['texto_erro_login'] = 'Perfil inválido!';
        header("Location: index.php");
        exit();
}

if (!$dados) {
    $_SESSION['texto_erro_login'] = 'Email, Senha ou Perfil Inválido!';
    header("Location: index.php");
    exit();
} elseif ($dados['status'] != 1) {
    $_SESSION['texto_erro_login'] = 'Acesso bloqueado ao sistema!';
    header("Location: index.php");
    exit();
} else {
    // Salva os dados encontrados na sessão
    $_SESSION['cod_usu'] = $dados['cod'];
    $_SESSION['nome_usu'] = $dados['nome'];
    $_SESSION['perfil'] = $perfil;
    $_SESSION['status'] = $dados['status'];
    header("Location: home.php");
    exit();
}
?>
