<!doctype html>
<html>
    <head>
        <?= $this->html->css('bootstrap.min.css') ?>
        <?= $this->html->css('main.css') ?>
        <?= $this->html->script(['jquery.js', 'bootstrap.min.js']) ?>
        <?= $this->html->script(['toggleRoleList.js']) ?>
        <script>
            $(document).ready(function () {
                toggleRoleList(jQuery, '<?= $roles ?>', null);
            });
        </script>
    </head>
    <body>
        <?= $this->element('header') ?>

        <?php
            $this->Form->templates([
                'inputContainer' => '<div class="form-container-fields-field">{{content}}</div>',
                'input' => '<input class="form-container-fields-field-input" type="{{type}}" name="{{name}}" {{attrs}} />',
            ]);
            $users_array = [];
            foreach ($users as $user) {
                $users_array[$user['id']] = $user['last_name'] . " " . $user['first_name'];
            }
        ?>

        <div class="form-container-wrapper">

            <?= $this->Form->create($project, ['class'=>'form-container', 'id'=>'add-project-container']) ?>

            <fieldset class="form-container-fields">

                <legend>プロジェクトを追加する</legend>
                <?php
                    echo $this->Form->input('name', ['label' => 'プロジェクト名 : ']);
                    echo $this->Form->input('budget', ['label' => '予算 : ']);
                    echo $this->Form->input('customer_name', ['label' => '顧客名 : ']);
                    echo $this->Form->input('started_at', ['label' => '開始期間 : ']);
                    echo $this->Form->input('finished_at', ['label' => '終了期間 : ']);
                ?>

                <div class="checkbox-form">
                    <label>参加者 : </label>
                    <div class="checkbox-form-input-wrapper">
                        <div class="checkbox-form-input">
                            <?php
                                echo $this->Form->input('users._ids', [
                                    'options' => $users_array,
                                    'multiple' => 'checkbox',
                                    'label' => false,
                                    'templates' => [
                                        'inputContainer' => '{{content}}',
                                    ],
                                ]);
                            ?>
                        </div>
                    </div>
                </div>

                </fieldset>

                <div class="form-container-footer">
                    <?= $this->Form->button("決定") ?>
                </div>
                <?= $this->Form->end() ?>
            </div>
        </div>
    </body>
</html>
