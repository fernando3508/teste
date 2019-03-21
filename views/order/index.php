<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\helpers\ArrayHelper;
use app\models\OrderStatus;

/* @var $this yii\web\View */
/* @var $searchModel app\models\SearchOrder */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Pedidos';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="order-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Novo Pedido', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            [
                'attribute' => 'customer_id',
                'value' => function($model){
                    return $model->customer->nomeCompleto;
                }
            ],
            [
                'label' => 'Data',
                'value' => function($model){
                    return !is_null($model->created_at) ?  date('d/m/Y', $model->created_at) : NULL;                }
            ],
            [
                'filter' => ArrayHelper::map(OrderStatus::find()->all(), 'id', 'name'),
                'attribute' => 'order_status_id',
                'value' => function($model){
                    return $model->orderStatus->name;
                }   
            ],
            
            //'created_at',
            //'updated_at',
            //'deleted_at',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
