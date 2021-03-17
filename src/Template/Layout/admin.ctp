<?php

/**
 * CakePHP(tm) : Rapid Development Framework (https://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (https://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright (c) Cake Software Foundation, Inc. (https://cakefoundation.org)
 * @link          https://cakephp.org CakePHP(tm) Project
 * @since         0.10.0
 * @license       https://opensource.org/licenses/mit-license.php MIT License
 */

$cakeDescription = 'Celke - Administrativo';
?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
    <?= $this->Html->charset() ?>
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>
        <?= $cakeDescription ?>:
        <?= $this->fetch('title') ?>
    </title>
    <?= $this->Html->meta('icon') ?>

    <?= $this->Html->css(['bootstrap.min']) ?>
    <?= $this->Html->script(['fontawesome-all.min']) ?>
    <?= $this->Html->css(['fontawesome.min', 'dashboard']) ?>

    <?= $this->fetch('meta') ?>
    <?= $this->fetch('css') ?>
    <?= $this->fetch('script') ?>
</head>

<body>
    <!----------- NAVBAR ------------->
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
                        <img class="rounded-circle" src="imagem/icon.png" width="20" height="20">
                        &nbsp; <span class="d-none d-sm-inline">Usuário</span>
                    </a>
                    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdownMenuLink">
                        <a class="dropdown-item" href="#"><i class="fas fa-user"></i> Perfil</a>
                        <a class="dropdown-item" href="#"><i class="fas fa-sign-out-alt"></i> Sair</a>
                    </div>
                </li>
            </ul>
        </div>
    </nav>

    <!----------- SIDEBAR ------------->
    <div class="d-flex">
        <nav class="sidebar">
            <ul class="list-unstyled">
                <li><a href="#"><i class="fas fa-tachometer-alt"></i> Dashboard</a></li>
                <li>
                    <a href="#submenu1" data-toggle="collapse">
                        <i class="fas fa-user"></i> Usuário
                    </a>
                    <ul class="list-unstyled collapse" id="submenu1">
                        <li><a href="listar.html"><i class="fas fa-users"></i> Usuários</a></li>
                        <li><a href="#"><i class="fas fa-key"></i> Nível de acesso</a></li>
                    </ul>
                </li>
                <li>
                    <a href="#submenu2" data-toggle="collapse">
                        <i class="fas fa-list-ul"></i> Menu
                    </a>
                    <ul class="list-unstyled collapse" id="submenu2">
                        <li><a href="#"><i class="fas fa-file-alt"></i> Páginas</a></li>
                        <li><a href="#"><i class="fab fa-elementor"></i> Item de menu</a></li>
                    </ul>
                </li>
                <li><a href="#">Ítem 1</a></li>
                <li><a href="#">Ítem 2</a></li>
                <li><a href="#">Ítem 3</a></li>
                <li class="active"><a href="#">Ítem 4</a></li>
                <li><a href="#"><i class="fas fa-sign-out-alt"></i> Sair</a></li>
            </ul>
        </nav>

        <!----------- CONTENT ------------->
        <div class="content p-1">

            <div class="list-group-item">
                <?= $this->fetch('content') ?>
            </div>

        </div>
    </div>

    <?= $this->Html->script(['jquery-3.3.1.min', 'bootstrap-4.1.3.min', 'popper.mim', 'dashboard']) ?>
</body>

</html>
