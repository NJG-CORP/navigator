<?php

use yii\bootstrap\Modal;
use yii\widgets\Pjax;

Modal::begin([
    'header' => '<h4>Изменение</h4>',
    'id' => 'tracingEditModal',
]);

Pjax::begin(['id' => 'tracingEditForm', 'enablePushState' => false]);
/*
 * Form
 */
Pjax::end();
Modal::end();
