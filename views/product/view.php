<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Product */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Produtos', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="product-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Editar', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
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
            'name',
            [
                'attribute' => 'category_id',
                'value' => $model->category->name
            ],
            'description:ntext',
            'sku',
            [
                'attribute' => 'price',
                'value' => 'R$ '. $model->preco
            ],
            'width',
            'height',
            'enable',
            [
                'attribute' => 'created_at',
                'value' => !is_null($model->created_at) ? date('d/m/Y h:i:s', $model->created_at) : NULL
            ],
            [
                'attribute' => 'updated_at',
                'value' => !is_null($model->updated_at) ? date('d/m/Y h:i:s', $model->updated_at) : NULL
            ],
        ],
    ]) ?>

</div>
