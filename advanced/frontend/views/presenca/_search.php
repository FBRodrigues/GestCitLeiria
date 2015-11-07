<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model frontend\models\PresencaSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="presenca-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'idPresenca') ?>

    <?= $form->field($model, 'Aluno_idAluno') ?>

    <?= $form->field($model, 'Aula_idAula') ?>

    <?= $form->field($model, 'Presente') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>