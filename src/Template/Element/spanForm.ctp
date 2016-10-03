<div class="form-container-field">
    <div class="form-container-field-column">
        <label class="form-container-field-column-label">期間 : </label>
        <div class="form-container-field-column-input">
            <div class="span-form">
                <?= $form->input('started_at', [
                    'label' => false,
                    'templates' => ['inputContainer' => '{{content}}'],
                    'placeholder' => '開始期間',
                    'id'=>'datepicker1',
                    'class' => 'span-form-started_at',
                    'type' => 'text',
                    'value' => isset($started_at) ? $started_at : "",
                    ])?>
                <span>〜</span>
                <?= $form->input('finished_at', [
                    'label' => false,
                    'placeholder' => '終了期間',
                    'templates' => [
                        'inputContainer' => '{{content}}',
                    ],
                    'id'=>'datepicker2',
                    'class' => 'span-form-finished_at',
                    'type' => 'text',
                    'value' => isset($finished_at) ? $finished_at : "",
                    ]) ?>
            </div>
        </div>
    </div>
</div>
