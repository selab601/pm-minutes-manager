<div class="form-container-field">
    <div class="form-container-field-column">
        <label class="form-container-field-column-label">開催日時 : </label>
        <div class="form-container-field-column-input">
            <div class="span-datetime-form">
                <?= $form->input('date', [
                    'label' => false,
                    'templates' => ['inputContainer' => '{{content}}'],
                    'placeholder' => '開催日',
                    'id'=>'datepicker',
                    'class' => 'span-datetime-form-date',
                    'type' => 'text',
                    'value' => isset($date) ? $date : "",
                    'required' => true,
                    ])?>
                <?= $form->input('holded_at', [
                    'label' => false,
                    'templates' => ['inputContainer' => '{{content}}'],
                    'placeholder' => '開始時刻',
                    'id'=>'datetimepicker1',
                    'class' => 'span-datetime-form-holded_at',
                    'type' => 'text',
                    'value' => isset($holded_at) ? $holded_at : "",
                    'required' => true,
                    ])?>
                <span>〜</span>
                <?= $form->input('ended_at', [
                    'label' => false,
                    'placeholder' => '終了時刻',
                    'templates' => ['inputContainer' => '{{content}}'],
                    'id'=>'datetimepicker2',
                    'class' => 'span-datetime-form-ended_at',
                    'type' => 'text',
                    'value' => isset($ended_at) ? $ended_at : "",
                    ]) ?>
            </div>
        </div>
    </div>
</div>
