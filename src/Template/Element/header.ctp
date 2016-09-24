<header>
    <div class="navbar navbar-default">
        <div class="container">
            <div class="navbar-header">
                    <?=
                        $this->Html->link(
                            '議事録',
                            [
                                'controller' => 'pages',
                                'action' => 'display',
                                'home'
                            ],
                            [
                                'class' => 'navbar-brand',
                            ]
                        );
                    ?>
            </div>
            <div class="navbar-collapse collapse" id="navbar-main">
                <ul class="nav navbar-nav navbar-right">
                    <?php if (($this->request->session()->read('Auth.User')) == false): ?>
                        <!-- 未ログインユーザ用メニュー -->

                        <li>
                            <?=
                                $this->Html->link(
                                    'ログイン', [
                                        'controller' => 'Users',
                                        'action' => 'login',
                                    ]
                                );
                            ?>
                        </li>
                        <li>
                            <?=
                                $this->Html->link(
                                    '新規登録', [
                                        'controller' => 'Users',
                                        'action' => 'signup',
                                    ]
                                );
                            ?>
                        </li>
                    <?php else: ?>
                        <!-- ログインユーザ用メニュー -->

                        <!-- 挨拶 -->
                        <?=
                            $this->Html->link(
                                'ようこそ ' . $this->request->session()->read('Auth.User.first_name') . ' さん',
                                '#',
                                ['class' => 'navbar-brand']
                            );
                        ?>

                        <!-- 一般ユーザ用メニュー -->
                        <li>
                            <?php
                                echo $this->Html->link('プロフィール', [
                                    'controller'=>'Users',
                                    'action'=>'view',
                                    $this->request->session()->read('Auth.User.id')
                                ]);
                            ?>
                        </li>
                        <li>
                            <?=
                                $this->Html->link('プロジェクト', [
                                    'controller'=>'Users',
                                    'action'=>'projectsView',
                                    $this->request->session()->read('Auth.User.id')
                                ])
                            ?>
                        </li>

                        <!-- 管理者ユーザ用メニュー -->
                        <?php if ($this->request->session()->read('Auth.User.is_authorized') == 1): ?>
                            <li class="dropdown">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">管理<span class="caret"></span></a>
                                <ul class="dropdown-menu" role="menu">
                                    <li><?=  $this->Html->link('ユーザ', ['controller'=>'Users', 'action'=>'index']) ?></li>
                                    <li><?=  $this->Html->link('プロジェクト', ['controller'=>'Projects', 'action'=>'index']) ?></li>
                                    <li><?=  $this->Html->link('担当種別', ['controller'=>'Roles', 'action'=>'index']) ?></li>
                                    <li><?=  $this->Html->link('案件種別', ['controller'=>'ItemCategories', 'action'=>'index']) ?></li>
                                </ul>
                            </li>
                        <?php endif; ?>
                        <li>
                            <?= $this->Html->link(
                                'ログアウト', [
                                    'controller' => 'Users',
                                    'action' => 'logout',
                                ]
                                ) ?>
                        </li>
                    <?php endif; ?>
                </ul>
            </div>
        </div>
    </div>
</header>
