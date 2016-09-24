<!doctype html>
<html>
    <head>
        <?= $this->html->css('bootstrap.min.css') ?>
        <?= $this->html->script(['jquery.js', 'bootstrap.min.js']) ?>
    </head>
    <body>
        <?= $this->element('header') ?>

        <div class="container">
            <div class="users view large-9 medium-8 columns content">
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
            </div>
        </div>
    </body>
</html>
