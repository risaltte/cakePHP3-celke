<div class="d-flex">
    <div class="mr-auto p-2">
        <h2 class="display-4 titulo">Listar usuários</h2>
    </div>
    <div class="p-2">
        <?=
        $this->Html->link(
            __('Cadastrar'),
            ['controller' => 'Users', 'action' => 'add'],
            ['class' => 'btn btn-sm btn-outline-success']
        )
        ?>
    </div>
</div>

<?= $this->Flash->render() ?>

<div class="table-responsive">
    <table class="table table-striped table-hover table-bordered">
        <caption>Listagem de usuários</caption>
        <thead>
            <tr>
                <th>ID</th>
                <th>Nome</th>
                <th class="d-none d-sm-table-cell">E-mail</th>
                <th class="d-none d-lg-table-cell">Data de cadastro</th>
                <th class="text-center">Ações</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($users as $user) : ?>
                <tr>
                    <th><?= $this->Number->format($user->id) ?></th>
                    <td><?= h($user->name) ?></td>
                    </td>
                    <td class="d-none d-sm-table-cell"><?= h($user->email) ?></td>
                    <td class="d-none d-lg-table-cell"><?= h($user->date) ?></td>
                    <td class="text-center">
                        <span class="d-none d-md-block">
                            <?=
                            $this->Html->link(
                                __('Vizualizar'),
                                ['controller' => 'Users', 'action' => 'view', $user->id],
                                ['class' => 'btn btn-outline-primary btn-sm']
                            )
                            ?>
                            <?=
                            $this->Html->link(
                                __('Editar'),
                                ['controller' => 'Users', 'action' => 'edit', $user->id],
                                ['class' => 'btn btn-outline-warning btn-sm']
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
                                    __('Vizualizar'),
                                    ['controller' => 'Users', 'action' => 'view', $user->id],
                                    ['class' => 'dropdown-item']
                                )
                                ?>
                                <?=
                                $this->Html->link(
                                    __('Editar'),
                                    ['controller' => 'Users', 'action' => 'edit', $user->id],
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
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>

    <!-- Pagination -->
    <?= $this->element('pagination') ?>

</div><!-- table-responsive -->