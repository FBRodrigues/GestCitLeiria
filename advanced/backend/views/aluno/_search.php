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

    <?= $form->field($model, 'Pessoa_idPessoa') ?>

    <?= $form->field($model, 'Horario_idHorario') ?>

    <?= $form->field($model, 'Escalao_idEscalao') ?>

    <?= $form->field($model, 'Nome') ?>

    <?php // echo $form->field($model, 'DataNascimento') ?>

    <?php // echo $form->field($model, 'Idade') ?>

    <?php // echo $form->field($model, 'Contato1') ?>

    <?php // echo $form->field($model, 'Contato2') ?>

    <?php // echo $form->field($model, 'Contato3/Email') ?>

    <?php // echo $form->field($model, 'EncarregadoEducacao') ?>

    <?php // echo $form->field($model, 'Sexo') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
