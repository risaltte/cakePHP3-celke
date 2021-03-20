<div class="d-flex">
    <div class="mr-auto p-2">
        <h2 class="display-4 titulo">
            Adicionar Usuário
        </h2>
    </div>
    <div class="p-2">
        <?=
        $this->Html->link(
            __('Listar'),
            ['controller' => 'Users', 'action' => 'index'],
            ['class' => 'btn btn-sm btn-outline-info', 'title' => 'Listar usuários']
        )
        ?>
    </div>
</div>
<hr>

<?= $this->Flash->render() ?>

<!------------------------------------- FORM --------------------------------------------------->
<?= $this->Form->create($user) ?>
    <div class="form-row">
        <div class="form-group col-md-6">
            <label for="name"><span class="text-danger">*</span> Nome</label>
            <?= 
                $this->Form->control('name', [
                    'id' => 'name',
                    'placeholder' => 'Nome completo',
                    'type' => 'text',
                    'class' => 'form-control',
                    'label' => false
                ]) 
            ?>
        </div>
        <div class="form-group col-md-6">
            <label for="email"><span class="text-danger">*</span> E-mail</label>
            <?= 
                $this->Form->control('email', [
                    'id' => 'email',
                    'placeholder' => 'exemplo@email.com',
                    'type' => 'email',
                    'class' => 'form-control',
                    'label' => false
                ])
            ?>
        </div>

        <div class="form-group col-md-6">
            <label for="username"><span class="text-danger">*</span> Username</label>
            <?= 
                $this->Form->control('username', [
                    'id' => 'username',
                    'placeholder' => 'Nome de usuário',
                    'type' => 'text',
                    'class' => 'form-control',
                    'label' => false
                ]) 
            ?>
        </div>
        <div class="form-group col-md-6">
            <label for="password"><span class="text-danger">*</span> Password</label>
            <?= 
                $this->Form->control('password', [
                    'id' => 'password',
                    'placeholder' => 'A senha deve ter no mínimo 6 caracters',
                    'type' => 'password',
                    'class' => 'form-control',
                    'label' => false
                ])
            ?>
        </div>
    </div>

    <p>
        <span class="text-danger">*</span> Campo Obrigatório
    </p>
    <?= 
        $this->Form->button(__('Adicionar'), [
            'type' => 'submit',
            'class' => 'btn btn-success'
        ]) 
    ?>
<?= $this->Form->end() ?>
