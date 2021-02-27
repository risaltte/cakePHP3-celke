<?= $this->Form->create('post', ['class' => 'form-signin']) ?>
    <?= $this->Html->image('logo_celke.png', [
        'class' => 'mb-4',
        'alt' => 'Logo',
        'width' => '72',
        'height' => '72',
    ]); ?>  

    <h1 class="h3 mb-3 font-weight-normal">Área Restrita</h1>

    <div class="form-group">
        <label for="user">Usuário</label>
        <?= $this->Form->control('username', [
            'type' => 'text',
            'id' => 'user',
            'class' => 'form-control',
            'placeholder' => 'Digite o usuário',
            'label' => false
        ]); ?>
    </div>

    <div class="form-group">
        <label for="password">Senha</label>
        <?= $this->Form->control('password', [
            'type' => 'password',
            'id' => 'password',
            'class' => 'form-control',
            'placeholder' => 'Digite a senha',
            'label' => false
        ]); ?>
    </div>  

    
    <?= $this->Form->button(__('Entrar'), [
        'class' => 'btn btn-lg btn-primary btn-block',
        'type' => 'submit',

    ]) ?>

    <p class="text-center">Esqueceu a senha?</p>
    
<?= $this->Form->end() ?>

