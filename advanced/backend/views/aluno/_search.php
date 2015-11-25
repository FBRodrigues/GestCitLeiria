<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\AlunoSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="aluno-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'idAluno') ?>

    <?= $form->field($model, 'Escalao_idEscalao') ?>

    <?= $form->field($model, 'Nome') ?>

    <?= $form->field($model, 'DataNascimento') ?>

    <?= $form->field($model, 'Idade') ?>

    <?php // echo $form->field($model, 'Contato1') ?>

    <?php // echo $form->field($model, 'Contato2') ?>

    <?php // echo $form->field($model, 'Contato3_Email') ?>

    <?php // echo $form->field($model, 'EncarregadoEducacao') ?>

    <?php // echo $form->field($model, 'Sexo') ?>

    <div class="form-group">
        <?= Html::submitButton('Procurar', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reiniciar', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
