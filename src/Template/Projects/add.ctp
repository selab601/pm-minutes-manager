<!doctype html>
<html>
    <head>
        <?= $this->html->css('bootstrap.min.css') ?>
        <?= $this->html->script(['jquery.js', 'bootstrap.min.js']) ?>
        <script>
            $(document).ready(function () {
                var $elem = $('div.form-group.select').clone();
                $elem.appendTo(".checkbox>label");

                $('.checkbox>label').each(function (index, element) {
                    var checkboxValue = $(this).children("input[type=checkbox]").attr('value');
                    $(this).children("div.role-select").children("input").attr('name', 'roles['+checkboxValue+']');
                    $(this).children("div.role-select").children("select").attr('name', 'roles['+checkboxValue+'][]');
                });

                $('input[type=checkbox]').change(function () {
                    var $selectbox = $(this).parent().children(".select");
                    if ($(this).prop('checked')) {
                        $selectbox.show();
                    } else {
                        $selectbox.hide();
                    }
                });
            });
        </script>
    </head>
    <body>
        <?= $this->element('header') ?>

        <div class="container">
            <div class="projects form large-9 medium-8 columns content">
                <?= $this->Form->create($project) ?>
                <fieldset>
                    <legend><?= __('Add Project') ?></legend>
                    <?php
                        echo $this->Form->input('name');
                        echo $this->Form->input('budget');
                        echo $this->Form->input('customer_name');
                        echo $this->Form->input('started_at');
                        echo $this->Form->input('finished_at');

                        $users_array = [];
                        foreach ($users as $user) {
                            $users_array[$user['id']] = $user['last_name'] . " " . $user['first_name'];
                        }
                        echo $this->Form->input('users._ids', [
                            'options' => $users_array,
                            'templates' => [
                                'checkbox' => '<input type="checkbox" name="{{name}}" value="{{value}}"{{attrs}}>',
                                'checkboxFormGroup' => '{{label}}',
                                'inputContainer' => '<div class="form-group role-checkbox {{type}}{{required}}">{{content}}</div>',
                            ],
                            'multiple' => 'checkbox',
                        ]);
                    ?>

                    <?php
                        /* セレクトボックスの雛形の生成 */
                        echo '<div class="form-group select role-select" style="display: none;">';
                        echo '  <input type="hidden" value="">';
                        echo '  <select class="form-control" multiple="multiple">';
                        foreach ($roles as $role) {
                            echo '<option value="' . $role['id'] . '">' . $role['name'] . '</option>';
                        }
                        echo '  </select>';
                        echo '</div>';
                    ?>
                </fieldset>
                <?= $this->Form->button(__('Submit')) ?>
                <?= $this->Form->end() ?>
            </div>
        </div>
    </body>
</html>
