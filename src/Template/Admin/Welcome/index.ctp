<h2>Bem vindo <?= $user['name'] ?></h2>
<?= $this->Html->link('Sair', [
    'controller' => 'Users',
    'action' => 'logout'
]); ?>