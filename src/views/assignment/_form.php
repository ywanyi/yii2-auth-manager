<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model yii\auth\models\Assignment */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="assignment-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'item_name')
        ->checkboxList(yii\helpers\ArrayHelper::map(\yii\auth\models\Item::find()->all(),'name','description'),['maxlength' => true]) ?>

    <?= $form->field($model, 'user_id')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'created_at')->hiddenInput()->label(false) ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Save'), ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
