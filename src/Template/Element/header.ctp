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
                        <?=
                            $this->Html->link(
                                'ようこそ ' . $this->request->session()->read('Auth.User.first_name') . ' さん',
                                '#',
                                ['class' => 'navbar-brand']
                            );
                        ?>
                        <li class="dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">管理<span class="caret"></span></a>
                            <ul class="dropdown-menu" role="menu">
                                <?php
                                    if ($this->request->session()->read('Auth.User.is_authorized') == 1) {
                                        echo "<li>" .$this->Html->link(
                                            'ユーザ', ['controller'=>'Users', 'action'=>'index']
                                        ) . "</li>";
                                        echo "<li>" . $this->Html->link(
                                            'プロジェクト', ['controller'=>'Projects', 'action'=>'index']
                                        ) . "</li>";
                                        echo "<li>" .$this->Html->link(
                                            'プロジェクト担当', ['controller'=>'Roles', 'action'=>'index']
                                        ) . "</li>";
                                        echo "<li>" .$this->Html->link(
                                            '案件種別', ['controller'=>'ItemCategories', 'action'=>'index']
                                        ) . "</li>";
                                    }
                                ?>
                            </ul>
                        </li>
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
