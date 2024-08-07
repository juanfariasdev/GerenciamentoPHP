<?php
session_start();
require_once("bd/bd_usuario.php");
require_once("bd/bd_cliente.php");
require_once("bd/bd_terceirizado.php");

function redirecionarComMensagem($tipo, $mensagem, $local) {
    $_SESSION[$tipo] = $mensagem;
    header("Location: $local");
    exit();
}

if (empty($_POST['email']) || empty($_POST['nova_senha'])) {
    redirecionarComMensagem('mensagem_erro', 'Por favor, preencha todos os campos!', 'troca_senha_form.php');
}

$email = filter_var(trim($_POST["email"]), FILTER_VALIDATE_EMAIL);
$nova_senha = trim($_POST["nova_senha"]);

if (!$email || strlen($nova_senha) < 6) {
    redirecionarComMensagem('mensagem_erro', 'Email inválido ou senha muito curta!', 'troca_senha_form.php');
}

$nova_senha_hash = $nova_senha;

// Função genérica para alterar senha
function alterarSenha($usuario, $tipo) {
    global $nova_senha_hash;
    $dados = mysqli_fetch_assoc($usuario);
    $editarFunc = 'editarSenha' . ucfirst($tipo);
    $resultado = $editarFunc($dados['cod'], $nova_senha_hash);
    if ($resultado) {
        redirecionarComMensagem('mensagem_sucesso', 'Senha alterada com sucesso!', 'index.php');
    } else {
        redirecionarComMensagem('mensagem_erro', "Erro ao alterar a senha do $tipo.", 'troca_senha_form.php');
    }
}

// Verifica se o email existe nas tabelas de usuários, clientes ou terceirizados
$usuario = buscaUsuario($email);
if (mysqli_num_rows($usuario) > 0) {
    alterarSenha($usuario, 'usuario');
}

$cliente = buscaCliente($email);
if (mysqli_num_rows($cliente) > 0) {
    alterarSenha($cliente, 'cliente');
}

$terceirizado = buscaTerceirizado($email);
if (mysqli_num_rows($terceirizado) > 0) {
    alterarSenha($terceirizado, 'terceirizado');
}

// Se o email não for encontrado em nenhuma tabela
redirecionarComMensagem('mensagem_erro', 'Email não encontrado!', 'troca_senha_form.php');
?>
