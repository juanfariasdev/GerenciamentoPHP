<?php

require_once("conecta_bd.php");

// Função para verificar se o cliente existe
function checaCliente($email, $senha) {
    $conexao = conecta_bd();
    $senhaMd5 = md5($senha);
    $query = "SELECT * FROM cliente WHERE email=? AND senha=?";
    $stmt = mysqli_prepare($conexao, $query);
    mysqli_stmt_bind_param($stmt, 'ss', $email, $senhaMd5);
    mysqli_stmt_execute($stmt);
    $resultado = mysqli_stmt_get_result($stmt);
    $dados = mysqli_fetch_array($resultado, MYSQLI_ASSOC);
    mysqli_stmt_close($stmt);
    return $dados;
}

// Função para listar todos os clientes
function listaClientes(){
    $conexao = conecta_bd();
    $clientes = array();
    $query = "SELECT * FROM cliente ORDER BY nome";
    $resultado = mysqli_query($conexao, $query);

    while ($dados = mysqli_fetch_array($resultado, MYSQLI_ASSOC)){
        array_push($clientes, $dados);
    }

    return $clientes;
}

// Função para buscar um cliente pelo email
function buscaCliente($email) {
    $conexao = conecta_bd();
    $query = "SELECT * FROM cliente WHERE email=?";
    $stmt = mysqli_prepare($conexao, $query);
    mysqli_stmt_bind_param($stmt, 's', $email);
    mysqli_stmt_execute($stmt);
    $resultado = mysqli_stmt_get_result($stmt);
    mysqli_stmt_close($stmt);
    return $resultado;
}

// Função para cadastrar um novo cliente
function cadastraCliente($nome, $email, $senha, $cep, $endereco, $numero, $bairro, $cidade, $uf, $telefone, $status, $perfil, $data){
    $conexao = conecta_bd();
    $senhaMd5 = md5($senha);
    $query = "INSERT INTO cliente (nome, email, senha, cep, endereco, numero, bairro, cidade, uf, telefone, status, perfil, data) 
              VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
    $stmt = mysqli_prepare($conexao, $query);
    mysqli_stmt_bind_param($stmt, 'ssssssssssiss', $nome, $email, $senhaMd5, $cep, $endereco, $numero, $bairro, $cidade, $uf, $telefone, $status, $perfil, $data);
    mysqli_stmt_execute($stmt);
    $dados = mysqli_stmt_affected_rows($stmt);
    mysqli_stmt_close($stmt);
    return $dados;
}

// Função para remover um cliente
function removeCliente($codigo){
    $conexao = conecta_bd();
    $query = "DELETE FROM cliente WHERE cod=?";
    $stmt = mysqli_prepare($conexao, $query);
    mysqli_stmt_bind_param($stmt, 'i', $codigo);
    mysqli_stmt_execute($stmt);
    $dados = mysqli_stmt_affected_rows($stmt);
    mysqli_stmt_close($stmt);
    return $dados;
}

// Função para buscar um cliente pelo código
function buscaClienteeditar($codigo){
    $conexao = conecta_bd();
    $query = "SELECT * FROM cliente WHERE cod=?";
    $stmt = mysqli_prepare($conexao, $query);
    mysqli_stmt_bind_param($stmt, 'i', $codigo);
    mysqli_stmt_execute($stmt);
    $resultado = mysqli_stmt_get_result($stmt);
    $dados = mysqli_fetch_array($resultado, MYSQLI_ASSOC);
    mysqli_stmt_close($stmt);
    return $dados;
}

// Função para editar o status e a data de um cliente
function editarCliente($codigo, $status, $data){
    $conexao = conecta_bd();
    $query = "UPDATE cliente SET status=?, data=? WHERE cod=?";
    $stmt = mysqli_prepare($conexao, $query);
    mysqli_stmt_bind_param($stmt, 'isi', $status, $data, $codigo);
    mysqli_stmt_execute($stmt);
    $dados = mysqli_stmt_affected_rows($stmt);
    mysqli_stmt_close($stmt);
    return $dados;
}

// Função para editar a senha de um cliente
function editarSenhaCliente($codigo, $senha) {
    $conexao = conecta_bd();
    $senhaMd5 = md5($senha);
    $query = "UPDATE cliente SET senha=? WHERE cod=?";
    $stmt = mysqli_prepare($conexao, $query);
    mysqli_stmt_bind_param($stmt, 'si', $senhaMd5, $codigo);
    mysqli_stmt_execute($stmt);
    $resultado = mysqli_stmt_affected_rows($stmt);
    mysqli_stmt_close($stmt);
    return $resultado > 0;
}

// Função para editar o perfil de um cliente
function editarPerfilCliente($codigo, $nome, $email, $endereco, $numero, $bairro, $cidade, $telefone, $data){
    $conexao = conecta_bd();
    $query = "UPDATE cliente SET nome=?, email=?, endereco=?, numero=?, bairro=?, cidade=?, telefone=?, data=? WHERE cod=?";
    $stmt = mysqli_prepare($conexao, $query);
    mysqli_stmt_bind_param($stmt, 'ssssssssi', $nome, $email, $endereco, $numero, $bairro, $cidade, $telefone, $data, $codigo);
    mysqli_stmt_execute($stmt);
    $dados = mysqli_stmt_affected_rows($stmt);
    mysqli_stmt_close($stmt);
    return $dados;
}

?>
