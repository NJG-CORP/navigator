<?php
/**
 * Created by PhpStorm.
 * User: dev
 * Date: 15.07.18
 * Time: 16:41
 */

namespace app\models;


use yii\db\ActiveRecord;

class Tracing extends ActiveRecord
{
    public static function tableName()
    {
        return '{{tracing}}';
    }

    //Тк юзеры хранятся не в БД а как массив, для тестовго представления, не через джоины - делаю такую подготовку
    public static function prepareApi($rows)
    {
        foreach ($rows as &$row)
        {
            $row['user'] = User::getUserName($row['user_id']);
            unset($row['user_id']);
        }

        return $rows;
    }
}