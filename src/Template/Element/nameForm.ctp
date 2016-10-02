<div class="form-container-field">
    <div class="form-container-field-column">
        <label class="form-container-field-column-label">名前 : </label>
        <div class="form-container-field-column-input">
            <div class="name-form">
                <?= $form->input('last_name', [
                    'label' => false,
                    'templates' => ['inputContainer' => '{{content}}'],
                    'placeholder' => '性',
                    'id' => 'name-form-last-name',
                    ])?>
                <?= $form->input('first_name', [
                    'label' => false,
                    'placeholder' => '名',
                    'templates' => ['inputContainer' => '{{content}}'],
                    'id' => 'name-form-first-name',
                    ]) ?>
            </div>
        </div>
    </div>
</div>
