<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model yii\auth\models\Permission */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="permission-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'type')->hiddenInput()->label(false) ?>

    <?= $form->field($model, 'description')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'rule_name')->dropDownList(yii\helpers\ArrayHelper::map(\yii\auth\models\Rule::find()->all(),'name','name'),['prompt' => '']) ?>

    <?= $form->field($model, 'data')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'created_at')->hiddenInput()->label(false) ?>

    <?= $form->field($model, 'updated_at')->hiddenInput()->label(false) ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Save'), ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
