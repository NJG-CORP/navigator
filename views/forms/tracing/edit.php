<?php

use yii\bootstrap\ActiveForm;
use yii\bootstrap\Html;

$form = ActiveForm::begin(['options' => ['data-pjax' => true, 'method' => 'put'], 'action' => '/tracing/update',]);
?>

<?= $form->field($model, 'id')->hiddenInput()->label(false) ?>
<?= $form->field($model, 'url')->textInput() ?>
<?= $form->field($model, 'time')->textInput(['type' => 'number'])->label("Время в мкс") ?>
<div class="form-group">
    <?= Html::submitButton('Изменить', ['class' => 'btn btn-primary', 'name' => 'login-button']) ?>
</div>

<?php
ActiveForm::end();