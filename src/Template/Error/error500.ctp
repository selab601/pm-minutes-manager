<?php
use Cake\Core\Configure;
use Cake\Error\Debugger;

$this->layout = 'error';

if (Configure::read('debug')):
    $this->layout = 'dev_error';

    $this->assign('title', $message);
    $this->assign('templateName', 'error500.ctp');

    $this->start('file');
?>
<?php if (!empty($error->queryString)) : ?>
    <p class="notice">
        <strong>SQL Query: </strong>
        <?= h($error->queryString) ?>
    </p>
<?php endif; ?>
<?php if (!empty($error->params)) : ?>
        <strong>SQL Query Params: </strong>
        <?php Debugger::dump($error->params) ?>
<?php endif; ?>
<?php if ($error instanceof Error) : ?>
        <strong>Error in: </strong>
        <?= sprintf('%s, line %s', str_replace(ROOT, 'ROOT', $error->getFile()), $error->getLine()) ?>
<?php endif; ?>
<?php
    echo $this->element('auto_table_warning');

    if (extension_loaded('xdebug')):
        xdebug_print_function_stack();
    endif;

    $this->end();
endif;
?>

<div class="form-container error">
    <h2><?= h("技術的な問題が発生しています") ?></h2>
    <p class="error">
        申し訳ございません．技術的な問題が発生しているようです．
        お手数ですが，<a href="https://github.com/selab601/web_minutes/issues">GitHub の issue</a>，もしくは Slack を使用して問題を報告してください．
    </p>
    <p style="color:gray;"><?=h($message) ?></p>
    <center>
        <?= $this->Html->link(__('戻る'), 'javascript:history.back()') ?>
    </center>
</div>
