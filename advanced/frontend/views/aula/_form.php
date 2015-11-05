<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model frontend\models\Aula */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="aula-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'idAula')->textInput() ?>

    <?= $form->field($model, 'Nome')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'HoraInicio')->textInput() ?>

    <?= $form->field($model, 'HoraFim')->textInput() ?>

    <?= $form->field($model, 'Choveu')->textInput(['maxlength' => true]) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>