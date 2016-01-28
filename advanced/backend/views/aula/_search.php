<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\AulaSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="aula-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'idAula') ?>

    <?= $form->field($model, 'HoraInicio') ?>

    <?= $form->field($model, 'HoraFim') ?>

    <?= $form->field($model, 'Nome') ?>

    <?= $form->field($model, 'Estado') ?>

    <?= $form->field($model, 'DiaSemana') ?>

    <?= $form->field($model, 'Data') ?>


    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
