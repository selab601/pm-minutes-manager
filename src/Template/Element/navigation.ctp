<?php
    $user_id = $this->request->session()->read('Auth.User.id');
    if (!empty($user_id)) {
        $user_url = $this->Html->link('プロフィール', ['controller'=>'Users','action'=>'view',$user_id]);
        $project_view_url = $this->Html->link('プロジェクト一覧', ['controller'=>'Users','action'=>'projectsView',$user_id]);
        switch ($this->request->controller) {
            case "Users":
                if ($this->request->action == "projectsView") {
                    echo $project_view_url;
                } else {
                    echo $user_url;
                }
                break;

            case "Projects":
                if ($this->request->action == "index") {
                    // 管理者画面
                } else if ($this->request->action == "add") {
                    echo $project_view_url;
                } else {
                    echo $project_view_url;
                    echo "<span> > </span>";
                    echo $this->Html->link('プロジェクト', [
                        'controller'=>'Projects',
                        'action'=>'view'
                       ,$this->request->pass[0]
                    ]);
                }
                break;

            case "Minutes":
                if ($this->request->action == "add") {
                    echo $project_view_url;
                    echo "<span> > </span>";
                    echo $this->Html->link('プロジェクト', [
                        'controller'=>'Projects',
                        'action'=>'view',
                        $this->request->pass[0]
                    ]);
                } else {
                    echo $project_view_url;
                    echo "<span> > </span>";
                    echo $this->Html->link(
                        'プロジェクト', [
                            'controller' => 'Projects',
                            'action' => 'view',
                            $minute->project_id,
                        ]
                    );
                    echo "<span> > </span>";
                    echo $this->Html->link(
                        '議事録', [
                            'controller' => 'Minutes',
                            'action' => 'view',
                            $minute->id,
                        ]
                    );
                }
                break;

            case "Items":
                echo $project_view_url;
                echo "<span> > </span>";
                echo $this->Html->link(
                    'プロジェクト', [
                        'controller' => 'Projects',
                        'action' => 'view',
                        $minute->project_id,
                    ]
                );
                echo "<span> > </span>";
                echo $this->Html->link(
                    '議事録', [
                        'controller' => 'Minutes',
                        'action' => 'view',
                        $minute->id,
                    ]
                );
                break;

        }
    }
?>
