<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\InscricaoSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="inscricao-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'idInscricao') ?>

    <?= $form->field($model, 'idAluno') ?>

    <?= $form->field($model, 'dataInicio') ?>

    <?= $form->field($model, 'dataFim') ?>

    <?= $form->field($model, 'nrAulas')->textInput()->label('Nr de aulas/semana') ?>

    <?php // echo $form->field($model, 'tipo') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
