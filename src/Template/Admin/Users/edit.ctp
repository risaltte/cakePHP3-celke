<div class="d-flex">
    <div class="mr-auto p-2">
        <h2 class="display-4 titulo">
            Editar Usuário
        </h2>
    </div>
    <div class="p-2">
        <span class="d-none d-md-block">
            <?=
            $this->Html->link(
                __('Listar'),
                ['controller' => 'Users', 'action' => 'index'],
                ['class' => 'btn btn-sm btn-outline-info', 'title' => 'Listar usuários']
            )
            ?>
            <?=
            $this->Html->link(
                __('Visualizar'),
                ['controller' => 'Users', 'action' => 'view', $user->id],
                ['class' => 'btn btn-sm btn-outline-primary', 'title' => 'Visualizar usuário']
            )
            ?>
            <?=
            $this->Form->postLink(
                __('Apagar'),
                ['controller' => 'Users', 'action' => 'delete', $user->id],
                [
                    'class' => 'btn btn-sm btn-outline-danger',
                    'title' => 'Apagar usuário',
                    'confirm' => __('Tem certeza que deseja apagar o usuário #{0}?', $user->id)
                ]
            )
            ?>
        </span>
        <div class="dropdown d-block d-md-none">
            <button class="btn btn-primary dropdown-toggle btn-sm" type="button" id="acoesListar" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                Ações
            </button>
            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="acoesListar">
                <?=
                $this->Html->link(
                    __('Listar'),
                    ['controller' => 'Users', 'action' => 'index'],
                    ['class' => 'dropdown-item']
                )
                ?>
                <?=
                $this->Html->link(
                    __('Visualizar'),
                    ['controller' => 'Users', 'action' => 'view', $user->id],
                    ['class' => 'dropdown-item']
                )
                ?>
                <?=
                $this->Form->postLink(
                    __('Apagar'),
                    ['controller' => 'Users', 'action' => 'delete', $user->id],
                    [
                        'class' => 'dropdown-item',
                        'title' => 'Apagar usuário',
                        'confirm' => __('Tem certeza que deseja apagar o usuário #{0}?', $user->id)
                    ]
                )
                ?>
            </div>
        </div>
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

    <div class="form-group col-md-12">
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
</div>

<p>
    <span class="text-danger">*</span> Campo Obrigatório
</p>
<?=
$this->Form->button(__('Salvar'), [
    'type' => 'submit',
    'class' => 'btn btn-success'
])
?>
<?= $this->Form->end() ?>