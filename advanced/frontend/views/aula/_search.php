<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model frontend\models\AulaSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="aula-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'idAula') ?>

    <?= $form->field($model, 'nome') ?>

    <?= $form->field($model, 'horaInicio') ?>

    <?= $form->field($model, 'horaFim') ?>

    <?= $form->field($model, 'choveu') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
