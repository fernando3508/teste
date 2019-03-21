<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use app\models\Customer;
use wbraganca\dynamicform\DynamicFormWidget;
use app\models\Product;
use app\models\OrderStatus;
/* @var $this yii\web\View */
/* @var $model app\models\Order */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="order-form">

    <?php $form = ActiveForm::begin(['id' => 'a']); ?>

    <div class="row">
    	<div class="col-md-6">
    		<?= $form->field($model, 'customer_id')->dropDownList(ArrayHelper::map(Customer::find()->all(), 'id', 'nomeCompleto'), ['prompt' => '']) ?>
    	</div>
    	<div class="col-md-6">
    		<?= $form->field($model, 'order_status_id')->dropDownList(ArrayHelper::map(OrderStatus::find()->all(), 'id', 'name'), ['prompt' => '']) ?>
    	</div>
    </div>

	<?php DynamicFormWidget::begin([
	        'widgetContainer' => 'dynamicform_wrapper', // required: only alphanumeric characters plus "_" [A-Za-z0-9_]
	        'widgetBody' => '.container-items', // required: css class selector
	        'widgetItem' => '.item', // required: css class
	        'limit' => 4, // the maximum times, an element can be added (default 999)
	        'min' => 1, // 0 or 1 (default 1)
	        'insertButton' => '.add-item', // css class
	        'deleteButton' => '.remove-item', // css class
	        'model' => $modelProducts[0],
	        'formId' => 'a',
	        'formFields' => [
	            'product_id',
	            'quatity',
	        ],
	    ]); ?>


	    <div class="panel panel-default">
        <div class="panel-heading">
            <h4>
                 Produtos
                <button type="button" class="add-item btn btn-success btn-sm pull-right"><i class="glyphicon glyphicon-plus"></i> Add</button>
            </h4>
        </div>
        <div class="panel-body">
            <div class="container-items"><!-- widgetBody -->
            <?php foreach ($modelProducts as $i => $modelProduct): ?>
                <div class="item panel panel-default"><!-- widgetItem -->
                    <div class="panel-heading">
                        <h3 class="panel-title pull-left">Produto</h3>
                        <div class="pull-right">
                            <button type="button" class="remove-item btn btn-danger btn-xs"><i class="glyphicon glyphicon-minus"></i></button>
                        </div>
                        <div class="clearfix"></div>
                    </div>
                    <div class="panel-body">
                        <?php
                            // necessary for update action.
                            if (!$modelProduct->isNewRecord) {
                                echo Html::activeHiddenInput($modelProduct, "[{$i}]id");
                            }
                        ?>
                        <div class="row">
                            <div class="col-sm-6">
                                <?= $form->field($modelProduct, "[{$i}]product_id")->dropDownList(ArrayHelper::map(Product::find()->all(), 'id', 'name'), ['prompt' => '']) ?>
                            </div>
                            <div class="col-sm-6">
                                <?= $form->field($modelProduct, "[{$i}]quatity")->textInput(['maxlength' => true]) ?>
                            </div>
                        </div><!-- .row -->
                    </div>
                </div>
            <?php endforeach; ?>
            </div>
        </div>
    </div><!-- .panel -->


	    <?php DynamicFormWidget::end(); ?>
    

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
