<!doctype html>
<html>
    <head>
        <?= $this->html->css('bootstrap.min.css') ?>
        <?= $this->html->css('main.css') ?>
        <?= $this->html->css('jquery-ui.min.css') ?>
        <?= $this->html->css('jquery-ui.theme.min.css') ?>
        <?= $this->html->css('jquery-ui.structure.min.css') ?>
        <?= $this->html->script(['jquery.js', 'jquery-ui.min.js', 'bootstrap.min.js']) ?>
        <?= $this->html->script(['toggleRoleList.js']) ?>
        <script>
            $(document).ready(function () {
                toggleRoleList(jQuery, '<?= $roles ?>', null);
                $("#datepicker1").datepicker({dateFormat: 'yy/mm/dd'});
                $("#datepicker2").datepicker({dateFormat: 'yy/mm/dd'});
            });
        </script>
    </head>
    <body>
        <?= $this->element('header') ?>

        <?php
            $this->Form->templates([
                'inputContainer' => '<div class="form-container-field">{{content}}</div>',
                'input' => '<input class="form-container-field-input" type="{{type}}" name="{{name}}" {{attrs}} />',
                'dateWidget' => '<div class="form-container-field-input"><div class="date-form">{{year}}{{month}}{{day}}{{hour}}{{minute}}{{second}}{{meridian}}</div></div>',
            ]);
            $users_array = [];
            foreach ($users as $user) {
                $users_array[$user['id']] = $user['last_name'] . " " . $user['first_name'];
            }
        ?>

        <div class="form-container-wrapper">
            <?php
                echo $this->Form->create($project, [
                    'class'=>'form-container add-project',
                ]);
            ?>

            <fieldset>
                <legend>プロジェクトを追加する</legend>
                <div class="form-container-fields add-project">
                    <?php
                        echo $this->Form->input('name', ['label' => 'プロジェクト名 : ']);
                        echo $this->Form->input('budget', ['label' => '予算 : ']);
                        echo $this->Form->input('customer_name', ['label' => '顧客名 : ']);
                        echo $this->Form->input('started_at', [
                            'label' => '開始期間 : ',
                            'type'=>'text',
                            'id'=>'datepicker1',
                        ]);
                        echo $this->Form->input('finished_at', [
                            'label' => '終了期間 : ',
                            'type'=>'text',
                            'id'=>'datepicker2',
                        ]);
                    ?>
                    <div class="checkbox-form form-container-field add-project">
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
                </div>
            </fieldset>

            <div class="form-container-footer">
                <?= $this->Form->button("決定") ?>
            </div>
            <?= $this->Form->end() ?>
        </div>
    </body>
</html>
