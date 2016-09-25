<!doctype html>
<html>
    <head>
        <?= $this->html->css('bootstrap.min.css') ?>
        <?= $this->html->css('main.css') ?>
        <?= $this->html->script(['jquery.js', 'bootstrap.min.js']) ?>
    </head>
    <body>
        <?= $this->element('header') ?>

        <div class="container">
                <h3>あなたのプロフィールです</h3>
                <table class="table table-striped">
                    <tr>
                        <th scope="row"><?= __('Id') ?></th>
                        <td><?= $this->Number->format($user->id) ?></td>
                    </tr>
                    <tr>
                        <th scope="row"><?= __('Id String') ?></th>
                        <td><?= h($user->id_string) ?></td>
                    </tr>
                    <tr>
                        <th scope="row"><?= __('Last Name') ?></th>
                        <td><?= h($user->last_name) ?></td>
                    </tr>
                    <tr>
                        <th scope="row"><?= __('First Name') ?></th>
                        <td><?= h($user->first_name) ?></td>
                    </tr>
                    <tr>
                        <th scope="row"><?= __('Mail') ?></th>
                        <td><?= h($user->mail) ?></td>
                    </tr>
                    <tr>
                        <th scope="row"><?= __('Created At') ?></th>
                        <td><?= h($user->created_at) ?></td>
                    </tr>
                    <tr>
                        <th scope="row"><?= __('Updated At') ?></th>
                        <td><?= h($user->updated_at) ?></td>
                    </tr>
                    <tr>
                        <th scope="row"><?= __('Is Authorized') ?></th>
                        <td><?= $user->is_authorized ? __('Yes') : __('No'); ?></td>
                    </tr>
                </table>
                <?= $this->Html->link(__('Edit'), ['action' => 'edit', $user->id]) ?>
                <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $user->id], ['confirm' => __('Are you sure you want to delete # {0}?', $user->id_string)]) ?>
        </div>
    </body>
</html>
