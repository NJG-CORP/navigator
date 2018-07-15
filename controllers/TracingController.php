<?php
/**
 * Created by PhpStorm.
 * User: dev
 * Date: 15.07.18
 * Time: 16:21
 */

namespace app\controllers;


use app\models\Tracing;
use Yii;
use yii\data\ActiveDataProvider;
use yii\web\Controller;
use yii\web\Response;

class TracingController extends Controller
{
    public function actionStore()
    {
        if (!Yii::$app->user->isGuest) {
            $Tracing = new Tracing();

            $Tracing->user_id = Yii::$app->user->id;
            $Tracing->time = Yii::$app->request->post('time');
            $Tracing->url = Yii::$app->request->post('url');
            $Tracing->save();
        }

        return '';
    }

    public function actionShow()
    {
        if (Yii::$app->user->identity->isAdmin()) {
            return $this->render('list', [
                "provider" => new ActiveDataProvider(["query" => Tracing::find()])
            ]);
        } else {
            return $this->goHome();
        }
    }

    public function actionApiShow()
    {
        \Yii::$app->response->format = Response::FORMAT_JSON;
        return [
            "data" => Tracing::prepareApi(Tracing::find()->select(['user_id','url','time'])->asArray()->all())
        ];
    }
}