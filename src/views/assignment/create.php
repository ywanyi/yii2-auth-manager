<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model yii\auth\models\Assignment */

$this->title = Yii::t('app', 'Create Assignment');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Assignments'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="assignment-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
