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
                        <?php
                            if ($this->request->session()->read('Auth.User.is_authorized') == 1) {
                                echo "<li>" .$this->Html->link(
                                    'ユーザ管理', ['controller'=>'Users', 'action'=>'index']
                                ) . "</li>";
                                echo "<li>" . $this->Html->link(
                                    'プロジェクト管理', ['controller'=>'Projects', 'action'=>'index']
                                ) . "</li>";
                            }
                        ?>
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
