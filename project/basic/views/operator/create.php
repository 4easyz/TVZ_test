<?php

use yii\bootstrap4\ActiveForm;
use yii\bootstrap4\Html;

$this->title = $title;
?>
<div class="operator-create">
    <h1><?= Html::encode($this->title) ?></h1>
    <hr>
    <?php $form = ActiveForm::begin([
        'id' => 'operator-create',
        'layout' => 'horizontal',
        'fieldConfig' => [
            'labelOptions' => ['class' => 'col-lg-1 col-form-label mr-lg-3'],
            'inputOptions' => ['class' => 'col-lg-3 form-control'],
            'errorOptions' => ['class' => 'col-lg-7 invalid-feedback'],
        ],
    ]); ?>

        <?= $form->field($model, 'name')->textInput() ?>
        
        <?php foreach ($cars as $car) { ?>
            <?= $form->field($modeOperatorCar, "cars_on_opearator_id[$car->id]")->checkbox(['checked '=> in_array($car->id, array_keys($carsOnOperator)),], true)->label($car->name) ?>
        <?php } ?>

        <div class="form-actions">
		    <?php echo Html::submitButton('Submit', null, null, array('class' => 'btn btn-primary')); ?>
	    </div>


    <?php ActiveForm::end(); ?>
</div>
