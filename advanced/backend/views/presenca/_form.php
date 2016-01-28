<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\Presenca */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="presenca-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'Aluno_idAluno')->textInput() ?>

    <?= $form->field($model, 'Aula_idAula')->textInput() ?>

    <?= $form->field($model, 'Estado')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'TipoAula')->textInput(['maxlength' => true]) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
