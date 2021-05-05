<?php
    // get user's id
    $userId = $user->id;

    //get user's image
    $userImagem = !empty($user->imagem) ?  '../files/users/' . $userId . '/' . $user->imagem :
    '../files/users/icone_usuario.png';
?>


<div class="d-flex">
    <div class="mr-auto p-2">
        <h2 class="display-4 titulo">Perfil</h2>
    </div>
    <div class="p-2">
        <!----------------- BOTOES CABECALHO ------------------------------------->
        <span class="d-none d-md-block">
            <?=
            $this->Html->link(
                __('Editar'),
                ['controller' => 'Users', 'action' => 'editPerfil'],
                ['class' => 'btn btn-outline-warning btn-sm']
            )
            ?>

            <?=
            $this->Html->link(
                __('Alterar senha'),
                ['controller' => 'Users', 'action' => 'alterPasswordProfile'],
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
                    __('Editar'),
                    ['controller' => 'Users', 'action' => 'editPerfil'],
                    ['class' => 'dropdown-item']
                )
                ?>

                <?=
                $this->Html->link(
                    __('Alterar Senha'),
                    ['controller' => 'Users', 'action' => 'alterPasswordProfile'],
                    ['class' => 'dropdown-item']
                )
                ?>
            </div>
        </div>
    </div>
</div>
<hr>

<?= $this->Flash->render() ?>

<dl class="row">
    <dt class="col-sm-3">Imagem</dt>
    <dd class="col-sm-9">
        <?=
            $this->Html->image($userImagem, [
                'class' => 'rounded-circle',
                'width' => '120',
                'height' => '120'
            ])
        ?>

        <?= $this->Html->link(__('Alterar Imagem'),
            ['controller' => 'Users', 'action' => 'alterImageProfile'],
            ['class' => 'btn btn-sm btn-outline-primary']
        ) ?>
    </dd>

    <dt class="col-sm-3">ID</dt>
    <dd class="col-sm-9"><?= $user->id ?></dd>

    <dt class="col-sm-3">Nome</dt>
    <dd class="col-sm-9"><?= $user->name ?></dd>

    <dt class="col-sm-3">Username</dt>
    <dd class="col-sm-9"><?= $user->username ?></dd>

    <dt class="col-sm-3">E-mail</dt>
    <dd class="col-sm-9"><?= $user->email ?></dd>
</dl>
