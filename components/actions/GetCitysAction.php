<?php
namespace app\components\actions;

use yii\base\Action;

class GetCitysAction extends Action
{
    public function run()
    {
        $id = \Yii::$app->request->get('id');
        $citys = \app\models\City::find()->where(['state_id'=>$id])->all();
        echo \yii\helpers\Html::tag('option', 'Selecione uma Cidade', ['value' => '']);

        foreach ($citys as $key => $value)
        {
            echo \yii\helpers\Html::tag('option', $value->name, ['value' => $value->id]);
        }
    }
}