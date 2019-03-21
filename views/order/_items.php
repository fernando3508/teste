<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
use app\models\Product;
use yii\helpers\ArrayHelper;

?>
<div class="order-products-index">

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            //'id',
            [
                'filter' => ArrayHelper::map(Product::find()->all(), 'id', 'name'),
                'attribute' => 'product_id',
                'value' => function($model){
                    return $model->product->name;
                }
            ],
            'quatity',
            [
                'attribute' => 'price',
                'value' => function($model){
                    return $model->product->preco;
                }
            ],
            'total',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
