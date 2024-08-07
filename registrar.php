<?php
include_once('./api/cep/viacep.php');
require_once('valida_session.php');
require_once('header.php'); 
?>

<body class="bg-gradient-primary">

    <div class="container">
        <!-- Outer Row -->
        <div class="row justify-content-center">
            <div class="col-xl-10 col-lg-12 col-md-9">
                <div class="card o-hidden border-0 shadow-lg my-5">
                    <div class="card-body p-0">
                        <!-- Nested Row within Card Body -->
                        <div class="row">
                            <div class="col-lg-6 d-none d-lg-block bg-login-image"></div>
                            <div class="col-lg-6">
                                <div class="p-4">
                                    <div class="text-center">
                                        <h1 class="h4 text-gray-900 mb-4">Registrar</h1>
                                    </div>
                                    
                                    <?php if (isset($_SESSION['texto_erro'])): ?>
                                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                            <strong><?= $_SESSION['texto_erro'] ?></strong> 
                                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                    <?php unset($_SESSION['texto_erro']); endif; ?>
                                    
                                    <?php if (isset($_SESSION['texto_sucesso'])): ?>
                                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                                            <strong><?= $_SESSION['texto_sucesso'] ?></strong> 
                                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                    <?php unset($_SESSION['texto_sucesso']); endif; ?>

                                    <form class="user" action="cad_cliente_envia.php" method="post">
                                        <div class="form-group">
                                            <label for="nome">Nome Completo</label>
                                            <input type="text" class="form-control form-control-user" id="nome" name="nome" value="<?php if (!empty($_SESSION['nome'])) { echo $_SESSION['nome'];} ?>" placeholder="Nome Completo" required>
                                        </div>
                                        <div class="form-group">
                                            <label for="email">Email</label>
                                            <input type="email" class="form-control form-control-user" id="email" name="email" value="<?php if (!empty($_SESSION['email'])) { echo $_SESSION['email'];} ?>" placeholder="Endereço de Email" required>
                                        </div>
                                        <div class="form-group">
                                            <label for="senha">Senha</label>
                                            <input type="password" class="form-control form-control-user" id="senha" name="senha" placeholder="Senha" required>
                                        </div>
                                        <div class="form-group">
                                            <label for="confirma_senha">Confirmar Senha</label>
                                            <input type="password" class="form-control form-control-user" id="confirma_senha" name="confirma_senha" placeholder="Confirmar Senha" oninput="validatepassword(this)" required>
                                        </div>
                                        <div class="form-group">
                                            <label for="cep">CEP</label>
                                            <input type="text" class="form-control form-control-user" id="cep" name="cep" value="<?php if (!empty($_SESSION['cep'])) { echo $_SESSION['cep'];} ?>" placeholder="CEP" required>
                                        </div>
                                        <div class="form-group">
                                            <label for="endereco">Endereço</label>
                                            <input type="text" class="form-control form-control-user" id="endereco" name="endereco" value="<?php if (!empty($_SESSION['endereco'])) { echo $_SESSION['endereco'];} ?>" placeholder="Endereço" required>
                                        </div>
                                        <div class="form-group">
                                            <label for="numero">Número</label>
                                            <input type="number" class="form-control form-control-user" id="numero" name="numero" value="<?php if (!empty($_SESSION['numero'])) { echo $_SESSION['numero'];} ?>" placeholder="Número" required>
                                        </div>
                                        <div class="form-group">
                                            <label for="bairro">Bairro</label>
                                            <input type="text" class="form-control form-control-user" id="bairro" name="bairro" value="<?php if (!empty($_SESSION['bairro'])) { echo $_SESSION['bairro'];} ?>" placeholder="Bairro" required>
                                        </div>
                                        <div class="form-group">
                                            <label for="cidade">Cidade</label>
                                            <input type="text" class="form-control form-control-user" id="cidade" name="cidade" value="<?php if (!empty($_SESSION['cidade'])) { echo $_SESSION['cidade'];} ?>" placeholder="Cidade" required>
                                        </div>
                                        <div class="form-group">
                                            <label for="uf">UF</label>
                                            <input type="text" class="form-control form-control-user" id="uf" name="uf" value="<?php if (!empty($_SESSION['uf'])) { echo $_SESSION['uf'];} ?>" placeholder="UF" required>
                                        </div>
                                        <div class="form-group">
                                            <label for="telefone">Telefone - Ex.: (11) 91234-1234</label>
                                            <input type="tel" class="form-control form-control-user" id="telefone" name="telefone" placeholder="(xx)xxxxx-xxxx" value="<?php if (!empty($_SESSION['telefone'])) { echo $_SESSION['telefone'];} ?>" maxlength="15" required>
                                        </div>
                                        <div class="form-group">
                                            <label for="status">Situação</label>
                                            <select class="form-control" id="status" name="status" required>
                                                <option value="">Selecione...</option>
                                                <option value="1">Ativo</option>
                                                <option value="2">Inativo</option>
                                            </select>
                                        </div>
                                        <button type="submit" class="btn btn-primary btn-user btn-block">Registrar</button> 
                                        <hr>
                                        <div class="text-center">
                                            <a class="small" href="cliente.php">Voltar</a>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap core JavaScript-->
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="vendor/jquery-easing/jquery.easing.min.js"></script>
    <script src="js/sb-admin-2.min.js"></script>
    <script src="api/cep/viacep.js"></script>
    
</body>
</html>
