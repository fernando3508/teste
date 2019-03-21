<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Order */

$this->title = 'Pedido: ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Pedidos', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="order-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            [
                'attribute' => 'customer_id',
                'value' => $model->customer->nomeCompleto
            ],
            [
                'attribute' => 'order_status_id',
                'value' => $model->orderStatus->name
            ],
            [
                'attribute' => 'created_at',
                'value' => !is_null($model->created_at) ? date('d/m/Y', $model->created_at) : NULL
            ],
            [
                'attribute' => 'updated_at',
                'value' => !is_null($model->updated_at) ? date('d/m/Y', $model->updated_at) : NULL
            ],
            [
                'label' => 'Total',
                'value' => 'R$ ' . $model->totalOrder
            ]
        ],
    ]) ?>

    <?php

        echo $this->render('_items', ['searchModel' => $searchModel, 'dataProvider' => $dataProvider]);

    ?>

</div>
