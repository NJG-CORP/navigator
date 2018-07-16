<?php

namespace app\models;

use yii\base\Model;

class TracingEditForm extends Model
{
    public $id;
    public $url;
    public $time;

    public function rules(): array
    {
        return [
            // username and password are both required
            [['id', 'url', 'time'], 'required'],
        ];
    }

    public function update(): bool
    {
        if ($this->validate()) {
            $TracingObj = Tracing::findOne($this->id);
            if ($TracingObj === null)
                return false;
            $TracingObj->time = $this->time;
            $TracingObj->url = $this->url;
            return $TracingObj->save();
        }
        return false;
    }

    /**
     * @param Tracing $TracingObj
     */
    public function fill($TracingObj): void
    {
        if ($TracingObj instanceof Tracing) {
            $this->id = $TracingObj->id;
            $this->url = $TracingObj->url;
            $this->time = $TracingObj->time;
        }
    }
}