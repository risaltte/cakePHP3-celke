<div class="d-flex">
    <div class="mr-auto p-2">
        <h2 class="display-4 titulo">
            Alterar Senha
        </h2>
    </div>
    <div class="p-2">
        <!----------------- BOTOES CABECALHO ------------------------------------->
        <span class="d-none d-md-block">
            <?=
                $this->Html->link(
                    __('Voltar'),
                    ['controller' => 'Users', 'action' => 'perfil'],
                    ['class' => 'btn btn-outline-primary btn-sm']
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
                        __('Voltar'),
                        ['controller' => 'Users', 'action' => 'perfil'],
                        ['class' => 'dropdown-item'])
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
