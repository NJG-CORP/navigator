<?php
/**
 * Created by PhpStorm.
 * User: dev
 * Date: 15.07.18
 * Time: 16:21
 */

namespace app\controllers;


use app\models\Tracing;
use app\models\TracingEditForm;
use app\models\User;
use Yii;
use yii\data\ActiveDataProvider;
use yii\filters\AccessControl;
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
            "data" => Tracing::prepareApi(Tracing::find()->select(['user_id', 'url', 'time'])->asArray()->all())
        ];
    }

    public function actionGetEditForm($id)
    {
        $TracingObj = Tracing::findOne($id);
        if ($TracingObj === null) {
            return '';
        }
        $model = new TracingEditForm();
        $model->fill($TracingObj);
        return $this->renderFile('@app/views/forms/tracing/edit.php', [
            "model" => $model
        ]);
    }

    public function actionUpdate()
    {
        if (Yii::$app->user->identity->isAdmin()) {
            $model = new TracingEditForm();
            $model->load(Yii::$app->request->post());
            return $model->update() ? "OK" : "Error";
        }
        return '';
    }

    public function actionExport()
    {

        $data = "User;Url;Time;".PHP_EOL;
        $model = Tracing::find()->all();
        foreach ($model as $value) {
            $data .= User::getUserName($value['user_id']). // Это костыль только для этой реализцаии, чтобы не писать авторизацию и тд по юзеру
                ';' . $value->url .
                ';' . $value->time .
                PHP_EOL;
        }
        Yii::$app->response->format = \yii\web\Response::FORMAT_RAW;
        $headers = Yii::$app->response->headers;
        $headers->add('Content-Type', 'text/csv');
        $headers->add('Content-Disposition','attachment; filename="export_' . date('d.m.Y') . '.csv"');
        return $data;
    }
}