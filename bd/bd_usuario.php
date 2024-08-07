<?php

require_once("conecta_bd.php");

// Função para verificar se o usuário existe
function checaUsuario($email, $senha) {
    $conexao = conecta_bd();
    $senhaMd5 = md5($senha);
    $query = "SELECT * FROM usuario WHERE email=? AND senha=?";
    $stmt = mysqli_prepare($conexao, $query);
    mysqli_stmt_bind_param($stmt, 'ss', $email, $senhaMd5);
    mysqli_stmt_execute($stmt);
    $resultado = mysqli_stmt_get_result($stmt);
    $dados = mysqli_fetch_array($resultado, MYSQLI_ASSOC);
    mysqli_stmt_close($stmt);
    return $dados;
}

// Função para listar todos os usuários
function listaUsuarios(){
    $conexao = conecta_bd();
    $usuarios = array();
    $query = "SELECT * FROM usuario ORDER BY nome";
    $resultado = mysqli_query($conexao, $query);

    while($dados = mysqli_fetch_array($resultado, MYSQLI_ASSOC)) {
        array_push($usuarios, $dados);
    }

    return $usuarios;
}

// Função para buscar um usuário pelo email
function buscaUsuario($email) {
    $conexao = conecta_bd();
    $query = "SELECT * FROM usuario WHERE email=?";
    $stmt = mysqli_prepare($conexao, $query);
    mysqli_stmt_bind_param($stmt, 's', $email);
    mysqli_stmt_execute($stmt);
    $resultado = mysqli_stmt_get_result($stmt);
    mysqli_stmt_close($stmt);
    return $resultado;
}

// Função para cadastrar um novo usuário
function cadastraUsuario($nome, $senha, $email, $perfil, $status, $data){
    $conexao = conecta_bd();
    $senhaMd5 = md5($senha);
    $query = "INSERT INTO usuario (nome, senha, email, perfil, status, data) VALUES (?, ?, ?, ?, ?, ?)";
    $stmt = mysqli_prepare($conexao, $query);
    mysqli_stmt_bind_param($stmt, 'ssssis', $nome, $senhaMd5, $email, $perfil, $status, $data);
    mysqli_stmt_execute($stmt);
    $dados = mysqli_stmt_affected_rows($stmt);
    mysqli_stmt_close($stmt);
    return $dados;
}

// Função para remover um usuário
function removeUsuario($codigo) {
    $conexao = conecta_bd();
    $query = "DELETE FROM usuario WHERE cod=?";
    $stmt = mysqli_prepare($conexao, $query);
    mysqli_stmt_bind_param($stmt, 'i', $codigo);
    mysqli_stmt_execute($stmt);
    $dados = mysqli_stmt_affected_rows($stmt);
    mysqli_stmt_close($stmt);
    return $dados;
}

// Função para buscar um usuário pelo código
function buscaUsuarioeditar($codigo){
    $conexao = conecta_bd();
    $query = "SELECT * FROM usuario WHERE cod=?";
    $stmt = mysqli_prepare($conexao, $query);
    mysqli_stmt_bind_param($stmt, 'i', $codigo);
    mysqli_stmt_execute($stmt);
    $resultado = mysqli_stmt_get_result($stmt);
    $dados = mysqli_fetch_array($resultado, MYSQLI_ASSOC);
    mysqli_stmt_close($stmt);
    return $dados;
}

// Função para editar o status e a data de um usuário
function editarUsuario($codigo, $status, $data){
    $conexao = conecta_bd();
    $query = "UPDATE usuario SET status=?, data=? WHERE cod=?";
    $stmt = mysqli_prepare($conexao, $query);
    mysqli_stmt_bind_param($stmt, 'isi', $status, $data, $codigo);
    mysqli_stmt_execute($stmt);
    $dados = mysqli_stmt_affected_rows($stmt);
    mysqli_stmt_close($stmt);
    return $dados;
}

// Função para editar a senha de um usuário
function editarSenhaUsuario($codigo, $senha) {
    $conexao = conecta_bd();
    $senhaMd5 = md5($senha);
    $query = "UPDATE usuario SET senha=? WHERE cod=?";
    $stmt = mysqli_prepare($conexao, $query);
    mysqli_stmt_bind_param($stmt, 'si', $senhaMd5, $codigo);
    mysqli_stmt_execute($stmt);
    $resultado = mysqli_stmt_affected_rows($stmt);
    mysqli_stmt_close($stmt);
    return $resultado > 0;
}

// Função para editar o perfil de um usuário
function editarPerfilUsuario($codigo, $nome, $email, $data){
    $conexao = conecta_bd();
    $query = "UPDATE usuario SET nome=?, email=?, data=? WHERE cod=?";
    $stmt = mysqli_prepare($conexao, $query);
    mysqli_stmt_bind_param($stmt, 'sssi', $nome, $email, $data, $codigo);
    mysqli_stmt_execute($stmt);
    $dados = mysqli_stmt_affected_rows($stmt);
    mysqli_stmt_close($stmt);
    return $dados;
}

?>
