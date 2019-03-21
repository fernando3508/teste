<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use \yii\widgets\MaskedInput;
/* @var $this yii\web\View */
/* @var $model app\models\Customer */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="customer-form">

    <?php $form = ActiveForm::begin(); ?>

    <div class="row">
        <div class="col-md-6">
            <?= $form->field($model, 'first_name')->textInput(['maxlength' => true]) ?>
        </div>
        <div class="col-md-6">
            <?= $form->field($model, 'last_name')->textInput(['maxlength' => true]) ?>
        </div>
    </div>

    <div class="row">
        <div class="col-md-6">
            <?= $form->field($model, 'cpf')->widget(MaskedInput::className(), ['mask' => '999.999.999-99', 'type' => 'tel', 'options' => ['class' => 'form-control fisica']])->input('tel', ['class' => 'form-control']) ?>

        </div>
        <div class="col-md-6">
            <?= $form->field($model, 'tel')->widget(MaskedInput::className(), ['mask' => '(99) 9999-99999', 'type' => 'tel', 'clientOptions' => ['placeholder' => ''], 'options' => ['class' => 'form-control']])->input('tel', ['class' => 'form-control']) ?>
        </div>
    </div>

    <div class="row">
        <div class="col-md-12">
            <?= $form->field($model, 'email')->textInput(['maxlength' => true]) ?>
        </div>
    </div>

    <legend>Endereço</legend>

    <?php echo $this->render('_form_endereco', ['form' => $form, 'model' => $model_endereco])?>

    

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
