<div class="d-flex">
    <div class="mr-auto p-2">
        <h2 class="display-4 titulo">
            Alterar Senha do usuário: <span class="text-success"><b><?= $user->name ?></b></span>
        </h2>
    </div>
    <div class="p-2">
        <!----------------- BOTOES CABECALHO ------------------------------------->
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
        <!----------------- BOTAO MENU DROPDOWN TELAS PEQUENAS ------------------------------------->
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

<?= $this->Form->create($user) ?>

    <div class="form-row">
        <div class="form-group col-md-6">
            <label for="name"><span class="text-danger">*</span> Password</label>
            <?=
            $this->Form->control('password', [
                'id' => 'password',
                'placeholder' => 'A senha deve ter no mínimo 6 caracteres',
                'type' => 'password',
                'value' => '',
                'class' => 'form-control',
                'label' => false
            ])
            ?>
        </div>
    </div>

    <p>
        <span class="text-danger">* </span>Campo obrigatório
    </p>
    <?= $this->Form->button(__('Salvar'), ['class' => 'btn btn-warning']) ?>
<?= $this->Form->end() ?>
