<?php

require_once("conecta_bd.php");

// Função para verificar se o terceirizado existe
function checaTerceirizado($email, $senha) {
    $conexao = conecta_bd();
    $senhaMd5 = md5($senha);
    $query = "SELECT * FROM terceirizado WHERE email=? AND senha=?";
    $stmt = mysqli_prepare($conexao, $query);
    mysqli_stmt_bind_param($stmt, 'ss', $email, $senhaMd5);
    mysqli_stmt_execute($stmt);
    $resultado = mysqli_stmt_get_result($stmt);
    $dados = mysqli_fetch_array($resultado, MYSQLI_ASSOC);
    mysqli_stmt_close($stmt);
    return $dados;
}

// Função para listar todos os terceirizados
function listaTerceirizados(){
    $conexao = conecta_bd();
    $terceirizados = array();
    $query = "SELECT * FROM terceirizado ORDER BY nome";
    $resultado = mysqli_query($conexao, $query);

    while ($dados = mysqli_fetch_array($resultado, MYSQLI_ASSOC)){
        array_push($terceirizados, $dados);
    }

    return $terceirizados;
}

// Função para buscar um terceirizado pelo email
function buscaTerceirizado($email) {
    $conexao = conecta_bd();
    $query = "SELECT * FROM terceirizado WHERE email=?";
    $stmt = mysqli_prepare($conexao, $query);
    mysqli_stmt_bind_param($stmt, 's', $email);
    mysqli_stmt_execute($stmt);
    $resultado = mysqli_stmt_get_result($stmt);
    mysqli_stmt_close($stmt);
    return $resultado;
}

// Função para cadastrar um novo terceirizado
function cadastraTerceirizado($nome, $email, $telefone, $senha, $status, $perfil, $data){
    $conexao = conecta_bd();
    $senhaMd5 = md5($senha);
    $query = "INSERT INTO terceirizado (nome, email, telefone, senha, status, perfil, data) 
              VALUES (?, ?, ?, ?, ?, ?, ?)";
    $stmt = mysqli_prepare($conexao, $query);
    mysqli_stmt_bind_param($stmt, 'sssssis', $nome, $email, $telefone, $senhaMd5, $status, $perfil, $data);
    mysqli_stmt_execute($stmt);
    $dados = mysqli_stmt_affected_rows($stmt);
    mysqli_stmt_close($stmt);
    return $dados;
}

// Função para remover um terceirizado
function removeTerceirizado($codigo){
    $conexao = conecta_bd();
    $query = "DELETE FROM terceirizado WHERE cod=?";
    $stmt = mysqli_prepare($conexao, $query);
    mysqli_stmt_bind_param($stmt, 'i', $codigo);
    mysqli_stmt_execute($stmt);
    $dados = mysqli_stmt_affected_rows($stmt);
    mysqli_stmt_close($stmt);
    return $dados;
}

// Função para buscar um terceirizado pelo código
function buscaTerceirizadoeditar($codigo){
    $conexao = conecta_bd();
    $query = "SELECT * FROM terceirizado WHERE cod=?";
    $stmt = mysqli_prepare($conexao, $query);
    mysqli_stmt_bind_param($stmt, 'i', $codigo);
    mysqli_stmt_execute($stmt);
    $resultado = mysqli_stmt_get_result($stmt);
    $dados = mysqli_fetch_array($resultado, MYSQLI_ASSOC);
    mysqli_stmt_close($stmt);
    return $dados;
}

// Função para editar a senha de um terceirizado
function editarSenhaTerceirizado($codigo, $senha) {
    $conexao = conecta_bd();
    $senhaMd5 = md5($senha);
    $query = "UPDATE terceirizado SET senha=? WHERE cod=?";
    $stmt = mysqli_prepare($conexao, $query);
    mysqli_stmt_bind_param($stmt, 'si', $senhaMd5, $codigo);
    mysqli_stmt_execute($stmt);
    $resultado = mysqli_stmt_affected_rows($stmt);
    mysqli_stmt_close($stmt);
    return $resultado > 0;
}

// Função para editar o perfil de um terceirizado
function editarPerfilTerceirizado($codigo, $nome, $email, $telefone, $data){
    $conexao = conecta_bd();
    $query = "UPDATE terceirizado SET nome=?, email=?, telefone=?, data=? WHERE cod=?";
    $stmt = mysqli_prepare($conexao, $query);
    mysqli_stmt_bind_param($stmt, 'ssssi', $nome, $email, $telefone, $data, $codigo);
    mysqli_stmt_execute($stmt);
    $dados = mysqli_stmt_affected_rows($stmt);
    mysqli_stmt_close($stmt);
    return $dados;
}

?>
