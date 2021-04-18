<div class="d-flex">
    <div class="mr-auto p-2">
        <h2 class="display-4 titulo">
            Alterar imagem
        </h2>
    </div>
    <div class="p-2">
        <!----------------- BOTOES CABECALHO ------------------------------------->
        <span class="d-none d-md-block">
            <?=
            $this->Html->link(
                __('Perfil'),
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
                    __('Perfil'),
                    ['controller' => 'Users', 'action' => 'perfil'],
                    ['class' => 'dropdown-item']
                )
                ?>
            </div>
        </div>
    </div>
</div>
<hr>

<?= $this->Flash->render() ?>

<?= $this->Form->create($user, ['enctype' => 'multipart/form-data']) ?>

<div class="form-group col-md-12">
    <label for="username"><span class="text-danger">*</span> Imagem</label>
    <?=
    $this->Form->file('imagem', [
        'id' => 'imagem',
        'class' => 'form-control',
        'accept' => '.jpeg, .jpg, .png',
        'label' => false
    ])
    ?>
</div>

<p>
    <span class="text-danger">* </span>Campo obrigatório
</p>
<?= $this->Form->button(__('Salvar'), ['class' => 'btn btn-warning']) ?>

<?= $this->Form->end() ?>
