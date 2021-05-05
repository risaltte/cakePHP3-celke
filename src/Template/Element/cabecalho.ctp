<?php
    //get user's first name
    $userFirstName = current(str_word_count($perfilUser->name, 2));
    $userId = $perfilUser->id;
    $userImagem = !empty($perfilUser->imagem) ?  '../files/users/' . $userId . '/' . $perfilUser->imagem :
    '../files/users/icone_usuario.png';
?>

<nav class="navbar navbar-expand navbar-dark bg-primary">
    <a class="sidebar-toggle text-light mr-3">
        <span class="navbar-toggler-icon"></span>
    </a>
    <a class="navbar-brand" href="#">Celke</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse">
        <ul class="navbar-nav ml-auto">
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle menu-header" href="#" id="navbarDropdownMenuLink" data-toggle="dropdown">
                    <?=
                        $this->Html->image($userImagem, [
                            'class' => 'rounded-circle',
                            'width' => '20',
                            'height' => '20'
                        ])
                    ?> &nbsp;
                    <span class="d-none d-sm-inline"><?= $userFirstName ?></span>
                </a>
                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdownMenuLink">
                    <?=
                        $this->Html->link(__('<i class="fas fa-user"></i> Perfil'),
                            ['controller' => 'Users', 'action' => 'perfil'],
                            ['class' => 'dropdown-item', 'escape' => false]
                        );
                    ?>
                    <?=
                        $this->Html->link(__('<i class="fas fa-sign-out-alt"></i> Sair'),
                            ['controller' => 'Users', 'action' => 'logout'],
                            ['class' => 'dropdown-item', 'escape' => false]
                        );
                    ?>
                </div>
            </li>
        </ul>
    </div>
</nav>
