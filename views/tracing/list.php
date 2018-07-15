<?php

use app\models\User;

/**
 * @var \yii\data\ActiveDataProvider $provider
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
            'time'
        ]
    ]);
} catch (Exception $e) {
}