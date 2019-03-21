<?php
namespace app\components\actions;

use yii\base\Action;

class GetCepAction extends Action
{
    public function run()
    {
        $cep = \Yii::$app->request->get('cep');
        $model = new \app\models\Enderecos();
        return json_encode($model->searchCep($cep));
    }
}