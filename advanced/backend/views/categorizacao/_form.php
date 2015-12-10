<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\Categorizacao */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="categorizacao-form">

    <?php $form = ActiveForm::begin(); ?>
    <?php
    var_dump($model->getAlunos())
    ?>
    <?= $form->field($model, 'Aluno_idAluno')->dropDownList($model->getAlunos())?>

    <?= $form->field($model, 'Categorias_idCategorias')->dropDownList($model->getCategorias())?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
