<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\Categorizacao */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="categorizacao-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'Aluno_idAluno')->textInput() ?>

    <?= $form->field($model, 'Categorias_idCategorias')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
