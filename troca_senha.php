<?php
session_start();
require_once("bd/bd_usuario.php");
require_once("bd/bd_cliente.php");
require_once("bd/bd_terceirizado.php");

if (empty($_POST['email']) || empty($_POST['nova_senha'])) {
    $_SESSION['mensagem_erro'] = 'Por favor, preencha todos os campos!';
    header("Location: troca_senha_form.php");
    exit();
}

$email = $_POST["email"];
$nova_senha = md5($_POST["nova_senha"]);

// Verifica se o email existe na tabela de usuários
$usuarioExiste = buscaUsuario($email);
if ($usuarioExiste) {
    $dadosUsuario = mysqli_fetch_assoc($usuarioExiste);
    $resultado = editarSenhaUsuario($dadosUsuario['cod'], $nova_senha);
    if ($resultado) {
        $_SESSION['mensagem_sucesso'] = 'Senha alterada com sucesso!';
        header("Location: index.php");
        exit();
    } else {
        $_SESSION['mensagem_erro'] = 'Erro ao alterar a senha do usuário.';
        header("Location: troca_senha_form.php");
        exit();
    }
}

// Verifica se o email existe na tabela de clientes
$clienteExiste = buscaCliente($email);
if ($clienteExiste) {
    $dadosCliente = mysqli_fetch_assoc($clienteExiste);
    $resultado = editarSenhaCliente($dadosCliente['cod'], $nova_senha);
    if ($resultado) {
        $_SESSION['mensagem_sucesso'] = 'Senha alterada com sucesso!';
        header("Location: index.php");
        exit();
    } else {
        $_SESSION['mensagem_erro'] = 'Erro ao alterar a senha do cliente.';
        header("Location: troca_senha_form.php");
        exit();
    }
}

// Verifica se o email existe na tabela de terceirizados
$terceirizadoExiste = buscaTerceirizado($email);
if ($terceirizadoExiste) {
    $dadosTerceirizado = mysqli_fetch_assoc($terceirizadoExiste);
    $resultado = editarSenhaTerceirizado($dadosTerceirizado['cod'], $nova_senha);
    if ($resultado) {
        $_SESSION['mensagem_sucesso'] = 'Senha alterada com sucesso!';
        header("Location: index.php");
        exit();
    } else {
        $_SESSION['mensagem_erro'] = 'Erro ao alterar a senha do terceirizado.';
        header("Location: troca_senha_form.php");
        exit();
    }
}

// Se o email não for encontrado em nenhuma tabela
$_SESSION['mensagem_erro'] = 'Email não encontrado!';
header("Location: troca_senha_form.php");
exit();
?>
