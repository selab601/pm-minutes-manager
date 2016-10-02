<div class="form-container-field checkbox-form <?= $classes ?>">
    <div class="checkbox-form-column">
        <label><?= $label ?></label>
        <div class="checkbox-form-input-wrapper">
            <div class="checkbox-form-input">
                <?php
                    echo $form->input('users._ids', [
                        'options' => $options,
                        'checked' => true,
                        'default' => $default,
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
