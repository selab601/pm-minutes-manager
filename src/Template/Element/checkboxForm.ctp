<div class="form-container-field checkbox-form <?= $classes ?>">
    <div class="form-container-field-column checkbox-form-column">
        <label class="form-container-field-column-label"><?= $label ?></label>
        <div class="form-container-field-column-input checkbox-form-input-wrapper">
            <div class="checkbox-form-input">
                <?php
                    echo $form->input($name, [
                        'options' => $options,
                        'checked' => true,
                        'default' => $default,
                        'multiple' => 'checkbox',
                        'label' => false,
                        'templates' => [
                            'inputContainer' => '{{content}}',
                        ],
                        'disabled' => $disabled,
                    ]);
                ?>
            </div>
        </div>
    </div>
</div>
