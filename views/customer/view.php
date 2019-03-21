<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Customer */

$this->title = $model->nomeCompleto;
$this->params['breadcrumbs'][] = ['label' => 'Clientes', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="customer-view">

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

    <?= 

        !is_null($model->enderecos) ? DetailView::widget([
            'model' => $model,
            'attributes' => [
                'id',
                'first_name',
                'last_name',
                'cpf',
                'email:email',
                'tel',
                [
                    'label' => 'Endereço',
                    'value' => $model->enderecos[0]->enderecoCompleto
                ],
                [
                    'label' => 'Bairro',
                    'value' => $model->enderecos[0]->bairro
                ],
                [
                    'label' => 'Cidade',
                    'value' => $model->enderecos[0]->cidade
                ],
                //'created_at',
                //'updated_at',
                //'deleted_at',
            ],
        ]) : DetailView::widget([
            'model' => $model,
            'attributes' => [
                'id',
                'first_name',
                'last_name',
                'cpf',
                'email:email',
                'tel',
                //'created_at',
                //'updated_at',
                //'deleted_at',
            ],
        ])


     ?>

</div>
