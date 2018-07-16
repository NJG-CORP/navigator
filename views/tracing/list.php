<?php

use app\models\User;

/**
 * @var \yii\data\ActiveDataProvider $provider
 * @var \yii\web\View $this
 */

try {
    echo \yii\grid\GridView::widget([
        "dataProvider" => $provider,
        "columns" => [
            [
                'attribute' => 'user_id',
                'label' => 'User',
                'value' => function ($model) {
                    return User::getUserName($model['user_id']);
                }
            ],
            'url',
            'time',
            [
                'label' => 'Edit',
                'value' => function ($model) {
                    return \yii\bootstrap\Html::button('Edit',[
                        "class" => 'btn btn-info',
                        "onclick" => "
                            $.pjax({
                                url: '/tracing/get-edit-form?id={$model['id']}',
                                push: false,
                                container:'#tracingEditForm'
                            });
                            $('#tracingEditModal').modal('show');",
                        "data-pjax" => 0,
                    ]);
                },
                'format' => 'raw'
            ]
        ]
    ]);
} catch (Exception $e) {
}

echo $this->renderFile('@app/views/modals/tracingEditModal.php');