<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\Aluno */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="aluno-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'Escalao_idEscalao')->textInput() ?>

    <?= $form->field($model, 'Nome')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'DataNascimento')->textInput() ?>

    <?= $form->field($model, 'Idade')->textInput() ?>

    <?= $form->field($model, 'Contato1')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'Contato2')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'Contato3_Email')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'EncarregadoEducacao')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'Sexo')->textInput(['maxlength' => true]) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Criar' : 'Atualizar', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
