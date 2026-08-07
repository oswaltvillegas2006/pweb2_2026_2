<div class="row">
    <?php actionMessage($success, $actionError) ?>
    <?php showValidationError($errors) ?>

    <form action="UsuarioForm.php" method="post">
        <h3>Formulário Usuário</h3>
        <input type="hidden" name="id" value="<?php echo getFormValue($data, 'id'); ?>">
        <div class="col-6">
            <label for="nome">Nome</label>
            <input type="text" name="nome" class="form-control" value="<?php echo getFormValue($data, 'nome'); ?>">
        </div>
        <div class="col-6">
            <label for="email">Email</label>
            <input type="email" name="email" class="form-control" value="<?php echo getFormValue($data, 'email'); ?>">
        </div>
        <div class="col-6">
            <label for="telefone">Telefone</label>
            <input type="text" name="telefone" class="form-control" value="<?php echo getFormValue($data, 'telefone'); ?>">
        </div>
        <div class="mt-2">
            <button type="submit" class="btn btn-success">Salvar</button>
            <a href="./UsuarioList.php" class="btn btn-primary"> Voltar</a>
        </div>


    </form>

</div>
