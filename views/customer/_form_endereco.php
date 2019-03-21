<?php
use yii\helpers\Html;
use yii\helpers\Url;
use yii\helpers\ArrayHelper;
use \yii\widgets\MaskedInput;
use app\models\State;
use app\models\City;
//$this->registerJsFile('@web/js/enderecos.js', ['depends' => [\app\assets\AppAsset::className()]]);

$url_getCep = Url::to(['@web/site/get-cep', 'cep' => ''], true);
$url_getCity = Url::to(['@web/site/get-citys', 'id' => ''], true);

$citys = $model->state_id != NULL ? ArrayHelper::map(City::find()->where(['state_id' => $model->state_id])->all(), 'id', 'name') : [];

$scripState = <<<JS

$.post('{$url_getCity}'+$(this).val(), function(data){
	$('.city_d').html(data);
});

JS;

$scriptCep = <<<JS

if($(this).val().length == 9){
	$.getJSON('{$url_getCep}'+$(this).val(), function(result){
		$('.logradouro_d').val(result.logradouro);
		$('.bairro_d').val(result.bairro);
		$('.state_d').val(result.state_id);
	
		$.post('{$url_getCity}'+result.state_id, function(result_city){
			$('.city_d').html(result_city).val(result.city_id);
		});
	
		$("#endereco").css("display", "block");
		$('.numero_d').focus();
		

	}).fail(function(){
	    $("#endereco").css("display", "block");
	    $(".logradouro_d").focus();
	});
	$("#endereco").css("display", "block");
}

JS;


?>


<div class="row">
    <div class="col-md-12">
        <?php echo $form->field($model, 'cep')->widget(MaskedInput::className(), ['mask' => '99999-999', 'type' => 'tel', 'options' => ['class' => 'form-control'], 'clientOptions' => ['placeholder' => '']])->input('tel', ['class' => 'form-control', 'onBlur' => $scriptCep, 'placeholder' => $model->getAttributeLabel('cep')]) ?>
    </div>
</div>

<div id="endereco">
    <div class="row">
        <div class="col-md-4">
            <?php echo $form->field($model, 'logradouro')->textInput(['class' => 'form-control logradouro_d', 'placeholder' => $model->getAttributeLabel('logradouro')]) ?>
        </div>
        <div class="col-md-4">
            <?php echo $form->field($model, 'numero')->input('tel', ['class' => 'form-control numero_d', 'placeholder' => $model->getAttributeLabel('numero')]) ?>
        </div>
        <div class="col-md-4">
            <?php echo $form->field($model, 'complemento')->textInput(['placeholder' => $model->getAttributeLabel('complemento')]) ?>
        </div>
    </div>
    <div class="row">
        <div class="col-md-4">
            <?php echo $form->field($model, 'bairro')->textInput(['class' => 'form-control bairro_d', 'placeholder' => $model->getAttributeLabel('bairro')]) ?>
        </div>
        <div class="col-md-4">
            <?php echo $form->field($model, 'state_id')->dropDownList(ArrayHelper::map(State::find()->all(), 'id', 'name'), ['class' => 'form-control state_d', 'prompt' => 'Selecione o Estado', 'onChange' => $scripState]) ?>
        </div>
        <div class="col-md-4">
            <?php echo $form->field($model, 'city_id')->dropDownList($citys, ['class' => 'form-control city_d', 'prompt' => 'Selecione o Estado']) ?>
        </div>
    </div>
</div>