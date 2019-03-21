<?php

use yii\helpers\Url;
use yii\helpers\Html;
use yii\grid\GridView;
use yii\helpers\ArrayHelper;
use app\models\OrderStatus;

?>
<div class="order-index">

    <legend>Pedidos do Cliente</legend>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
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

            [
                'class' => 'yii\grid\ActionColumn',
                'template' => '{view}{update}{delete}',
                'buttons' => [
                    'view' => function($url, $model){
                        return Html::a('<span class="glyphicon glyphicon-eye-open"></span>', ['/order/view', 'id' => $model->id]);
                    },
                    'update' => function($url, $model){
                        return Html::a('<span class="glyphicon glyphicon-pencil"></span>', ['/order/update', 'id' => $model->id]);
                    },
                    'delete' => function($url, $model){
                        return Html::a('<span class="glyphicon glyphicon-trash"></span>', ['/order/delete', 'id' => $model->id], [
                            'class' => '',
                            'data' => [
                                'confirm' => 'Você tem certeza absoluta? Você perderá todas as informações sobre esse usuário com essa ação.',
                                'method' => 'post',
                            ],
                        ]);
                    }
                ],
            ],
        ],
    ]); ?>
</div>
